<?php


namespace app\controllers;


use app\models\Auto;
use app\models\ContactForm;
use app\models\LoginForm;
use Yii;
use yii\base\BaseObject;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class AutoController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }


    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionIndex()
    {
        //$autos =  Auto::find()->all();
        $query = Auto::find();
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 4]);
        $autos = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index', compact('autos', 'pages'));
    }
    public function actionView($id)
    {
        //$autos =  Auto::find()->all();
        $autos = Auto::find()->where(['id' => $id])->all();
        $auto = $autos[0];
        if (Yii::$app->user->identity->username == 'admin') {
            Yii::$app->session->setFlash('contactFormSubmitted');
        }
        return $this->render('view', compact('auto' ));
    }
    public function actionDelete($id)
    {
        $auto = Auto::find()->where(['id' => $id])->all();
        $auto[0]->delete();

        return $this->render('delete', compact('id'));
    }
    public function actionError()
    {

        return $this->render('error');
    }
    public function actionContact()
    {
        if (Yii::$app->user->identity->username != 'admin') {
            return $this->actionError();
        }
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post())) {

            Yii::$app->session->setFlash('contactFormSubmitted');
            $autos = Auto::find()->all();
            $auto = new Auto();
            for ($i = 0; $i < count($autos); $i++) {
                if ($autos[$i]['name'] == $model->name && $autos[$i]['brand'] == $model->brand) {
                    $auto->number = $autos[$i]['number'] + 1;
                    $auto->name = $autos[$i]['name'];
                    $auto->brand = $autos[$i]['brand'];
                    $autos[$i]->delete();
                    $auto->save();
                    return $this->refresh();
                }
            }
            $auto->name = $model->name;
            $auto->brand = $model->brand;
            $auto->save();


            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);

    }
}
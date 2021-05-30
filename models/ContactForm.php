<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $brand;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, brand, subject and body are required
            [['name', 'brand'], 'required']

        ];
    }


}

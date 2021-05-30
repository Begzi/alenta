<?php
$this->title = 'Auto';
$this->params['breadcrumbs'][] = $this->title;?>
<div class="col-md-12">
    <div class="col-md-3">
        <div class="single-auto">

            <h3><?php echo $auto['name'] ?></h3>
            <h4><span>Brand: <?php echo $auto['brand'] ?></span></h4>
            <p>How much: <?php echo $auto['number'] ?></p>
        </div>
    </div>
    <?php
    if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
        <a href="<?= \yii\helpers\Url::to(['/auto/delete','id' => $auto['id']])?>" >
            Delete this auto
        </a>


    <?php endif; ?>
</div>


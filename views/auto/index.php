<?php

for ($i = 0; $i < count($autos); $i++)
{
    var_dump($autos[$i]['name'], $autos[$i]['brand'], $autos[$i]['number']);
}
?>

<section class="auto-post-area">
    <div class="conteiner"">
         <?php for ($i = 0; $i < count($autos); $i++):?>
         <div class="col-md-12">
              <div class="col-md-3">
                   <div class="single-auto">

                       <h3><a href="<?= \yii\helpers\Url::to(['/auto/view','id' => $autos[$i]['id']])?>"><?php echo $autos[$i]['name'] ?></a></h3>
                       <h4><span>Brand: <?php echo $autos[$i]['brand'] ?></span></h4>
                       <p>How much: <?php echo $autos[$i]['number'] ?></p>
                   </div>
              </div>
         </div>
         <?php endfor; ?>
    </div>

    <div class="pegination">
        <div class="nav-links">
        <?php echo \yii\widgets\LinkPager::widget([
                'pagination' => $pages,
])?>
        </div>
    </div>

</section>

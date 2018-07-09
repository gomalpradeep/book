<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Wislist';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-wishlist">
    <h1><?= Html::encode($this->title) ?></h1>

            <div class="row">
			<?php  foreach($model as $book){?>
			 <div class="col-sm-3 col-md-3">
    <div class="thumbnail">
      <img src="<?= Yii::$app->getUrlManager()->createUrl('images/242.svg');?>" alt="...">
      <div class="caption">
        <h4><?= $book->book->title?></h4>
        <p><?= $book->book->description?></p>
      
	
			
      </div>
    </div>
  </div>
					
			<?php }?>

        </div>
</div>

<script>
function  removeWistlist(wishlist_id)
{
	 $.post('<?= Url::toRoute('site/remove-wishlist') ?>', { wishlist_id: wishlist_id }, 
        function(res)
        {
           if(res=='success'){
			   location.reload();
		   }else{
			   alert(res);
		   }
        });
}
</script>
<?php

/* @var $this yii\web\View */
use frontend\models\WishList;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
$this->title = 'BOOKS';
?>
<div class="site-index">

    <div class="body-content">
	<h1>Book Store <?php if(!Yii::$app->user->isGuest){?><span class="pull-right"><a class="btn btn-default" href="<?= Yii::$app->getUrlManager()->createUrl('books/create');?>">Add Book</a></span><?php }?> </h1>
    <div class="row">
	 <div class="col-lg-6">
	 <?php $form = ActiveForm::begin(['enableClientValidation' => true,'action'=>'search','method'=>'get',
    'options' => [
        'validateOnSubmit' => true,
        'class' => 'form',
		
    ]]); ?>
		<div class="input-group">
		  <span class="input-group-btn">
			<button class="btn btn-default" type="submit">Go!</button>
		  </span>
		  <input type="text" class="form-control" name="search" required='required' placeholder="Search for books...">
			
		</div><!-- /input-group -->
		<?php ActiveForm::end(); ?>
	  </div><!-- /.col-lg-6 -->
	
	
	</div>
	<hr>
    <div class="row">
		<?php  foreach($books as $book){?>
		<div id="bookview" class="col-sm-3 col-md-3">
			<div class="thumbnail">
				<?PHP 
					if(!empty($book->files)){
						$file=	$book->files;
					}else{
						$file='242.svg';
					}
					
				?>
			  <img src="<?= Yii::$app->getUrlManager()->createUrl('images/'.$file);?>" alt="...">
			  <div class="caption">
				<h4><a href="<?= Yii::$app->getUrlManager()->createUrl('books/view?id='.$book->id);?>"><?= $book->title?></a></h4>
				<p><?= $book->description?></p>
				<p>   
				<?php if(isset( $user_id)  ){  
				$wl=WishList::find()->where(['user_id'=>$user_id,'book_id'=>$book->id])->status()->one()		?>
						<?php  if(!isset($wl)){?>
							<button class="btn	 btn-success" onclick="addTowishlist(<?= $book->id?>)">Add To Wishlist</button>
						<?php }else{?>
							<button class="btn	 btn-default" onclick="removeWistlist(<?= $wl->id?>)">Remove Wishlist</button>
						<?php } }?> <!--<a href="#" class="btn btn-default" role="button">Button</a>--></p>
				</div>
			</div>
		</div>
					
		<?php }?>

        </div>
			<hr>	
		<div class="row">
		<h1>All Users</h1>
		<?php  foreach($users as $user){?>
		  <div class="col-sm-6 col-md-4">
			<div class="thumbnail">
			 
			  <div class="caption">
				<h4><a href="<?= Yii::$app->getUrlManager()->createUrl('site/wishlist?name='.$user->username);?>" ><?= $user->username?></a></h4>
			
				  </div>
			</div>
		  </div>
		<?php }?>
		</div>

    </div>
</div>
<script>
function addTowishlist(bookid){
	
	//alert(bookid);
	 $.post('<?= Url::toRoute('site/add-wishlist') ?>', { bookid: bookid }, 
        function(res)
        {
           if(res=='success'){
			   location.reload();
		   }else{
			   alert(res);
		   }
        });
}
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
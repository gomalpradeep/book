<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Search Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

   
	<div class="row">
		<?php if(empty($model)){?>
		<div class="alert alert-warning" role="alert">
		  Not found
		</div>
		<?php }?>
		<ul class="list-group">
		
		<?php foreach($model as $one){?>
			
			
		  <li class="list-group-item">
			<span class="badge">0</span>
			<a href="<?= Yii::$app->getUrlManager()->createUrl('books/view?id='.$one->id);?>"><?= $one->title?></a>
		  </li>

		<?php }?>
		</ul>
    </div>

</div>

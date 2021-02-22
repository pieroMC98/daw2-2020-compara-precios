<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<h1>Esto es la creacion del usuario</h1>
	<?= Html::beginForm(['user/cargar'],'put')?>
	<?= Html::input('text','name')?>
	<?= Html::input('text','password')?>
	<?= Html::submitButton('enviar get',['class'=>'btn btn-primary'])?>
	<?= Html::endForm()?>

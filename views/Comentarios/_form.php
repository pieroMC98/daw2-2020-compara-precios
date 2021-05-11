<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Comentarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comentarios-form">


    <?php $form = ActiveForm::begin(); ?>
	
	<?= $form->field($model, 'nomTienda')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'tienda_id')->textInput(['readonly'=> true]) ?>
	
	<?= $form->field($model, 'nomArticulo')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'articulo_id')->textInput(['readonly'=> true]) ?>

    <?= $form->field($model, 'valoracion')->textInput()->dropdownList([

        1=>"1",2=>"2",3=>"3",4=>"4",5=>"5",6=>"6",7=>"7",8=>"8",9=>"9",10=>"10",
    ],
    ['prompt'=>'Elige la valoración']) ?>


    <?= $form->field($model, 'texto')->textarea(['rows' => 6]) ?>
	
	<?= $form->field($model, 'comentario_id')->hiddenInput()->label(false) ?>


    <?= $form->field($model, 'cerrado')->textInput()->dropdownList([
        0 => 'No', 
        1 => 'Si',
    ],
    ['prompt'=>'Selecciona si es posible responder a este mensaje']) ?>

    <?= $form->field($model, 'notas_admin')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

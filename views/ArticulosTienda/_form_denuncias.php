<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Articulostienda */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="articulostienda-form">

    <?php $form = ActiveForm::begin(); ?> 

    <?= $form->field($model, 'num_denuncias')->textInput() ?>

    <?= $form->field($model, 'fecha_denuncia1')->textInput() ?>

    <?= $form->field($model, 'notas_denuncia')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'bloqueado')->textInput()->dropdownList([
        0 => 'No', 
        1 => 'Bloqueado por denuncias',
		2 => 'Bloqueado por moderador o administrador',
    ],
    ['prompt'=>'Seleccionar tipo de bloqueado']) ?>

    <?= $form->field($model, 'fecha_bloqueo')->textInput() ?>

    <?= $form->field($model, 'notas_bloqueo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cerrado_comentar')->textInput()->textInput()->dropdownList([
        0 => 'No', 
        1 => 'Si',
    ],
    ['prompt'=>'Selecciona si se pueden añadir comentarios']) ?>

    <?= $form->field($model, 'modi_usuario_id')->textInput() ?>

    <?= $form->field($model, 'modi_fecha')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tiendas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tiendas-form">

    <?php
    $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre_tienda')->textInput(['readonly'=> true])?>

    <?= $form->field($model, 'usuario_id')->textInput(['readonly'=> true])?>

    <?= $form->field($model, 'nif_cif')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['readonly'=> true])?>

    <?= $form->field($model, 'apellidos')->textInput(['readonly'=> true])?>

    <?= $form->field($model, 'razon_social')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textInput(['readonly'=> true])?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

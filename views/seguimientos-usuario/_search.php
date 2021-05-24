<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SeguimientosUsuarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seguimientos-usuario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'usuario_id') ?>

    <?= $form->field($model, 'tienda_id') ?>

    <?= $form->field($model, 'articulo_id') ?>

    <?= $form->field($model, 'oferta_id') ?>

    <?php // echo $form->field($model, 'fecha_alta') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

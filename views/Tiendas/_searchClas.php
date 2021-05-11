<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TiendasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tiendas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['clasificacion'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'clasificacion_id')->dropDownList($clases)->label('Selecciona una clasificación'); ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Eliminar busqueda', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

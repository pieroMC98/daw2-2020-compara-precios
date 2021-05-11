<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="articulos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['busqetiquetas'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'etiquetaId')->dropDownList($etiquetas)->label('Selecciona una etiqueta'); ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Eliminar busqueda', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

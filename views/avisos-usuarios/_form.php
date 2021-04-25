<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\AvisosUsuarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="avisos-usuarios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecha_aviso')->widget(DatePicker::className(),['clientOptions' => ['dateFormat' => 'dd-mm-YY', 'defaultDate' => '01-01-2021', 'language' => 'es-ES','changeMonth'=> true, 'changeYear'=> true,], 'dateFormat' => 'php:Y-m-d H:i:s']) ?>

    <?= $form->field($model, 'clase_aviso')->dropdownList([
            'A' => 'Aviso', 
            'N' => 'Notificación',
            'D' => 'Denuncia',
            'C' => 'Consulta',
            'B' => 'Bloqueo',
            'M' => 'Mensaje'
        ],
        ['options' => ['A' => ['Selected' => true]]]
    ); ?>

    <?= $form->field($model, 'texto')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'destino_usuario_id')->textInput() ?>

    <?= $form->field($model, 'origen_usuario_id')->textInput() ?>

    <?= $form->field($model, 'tienda_id')->textInput() ?>

    <?= $form->field($model, 'articulo_id')->textInput() ?>

    <?= $form->field($model, 'comentario_id')->textInput() ?>

    <?= $form->field($model, 'fecha_lectura')->widget(DatePicker::className(),['clientOptions' => ['defaultDate' => '2021-01-01'], 'dateFormat' => 'php:Y-m-d H:i:s']) ?>

    <?= $form->field($model, 'fecha_aceptado')->widget(DatePicker::className(),['clientOptions' => ['defaultDate' => '2021-01-01'], 'dateFormat' => 'php:Y-m-d H:i:s']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

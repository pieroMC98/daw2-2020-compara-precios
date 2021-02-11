<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Articulostienda */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="articulostienda-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'articulo_id')->textInput(['readonly'=> true]) ?>

    <?= $form->field($model, 'tienda_id')->textInput(['readonly'=> true]) ?>

    <?= $form->field($model, 'imagen_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url_articulo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'precio')->textInput() ?>

    <?= $form->field($model, 'sumaValores')->textInput() ?>

    <?= $form->field($model, 'totalVotos')->textInput() ?>

    <?= $form->field($model, 'visible')->textInput()->dropdownList([
        0 => 'Invisible', 
        1 => 'Visible',
    ],
    ['prompt'=>'Selecciona visibilidad']) ?>

    <?= $form->field($model, 'cerrado')->textInput()->dropdownList([
        0 => 'Activo', 
        1 => 'Eliminado por solicitud de baja',
		2 => 'Suspendido',
		3 => 'Cancelado por Inadecuado'
    ],
    ['prompt'=>'Indicador de artículo cancelado']) ?>

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

    <?= $form->field($model, 'crea_usuario_id')->textInput() ?>

    <?= $form->field($model, 'crea_fecha')->textInput() ?>

    <?= $form->field($model, 'modi_usuario_id')->textInput() ?>

    <?= $form->field($model, 'modi_fecha')->textInput() ?>

    <?= $form->field($model, 'notas_admin')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

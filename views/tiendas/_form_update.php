<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Regiones;
use app\models\Usuarios;

/* @var $this yii\web\View */
/* @var $model app\models\Tiendas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tiendas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre_tienda')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'descripcion_tienda')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'lugar_tienda')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'url_tienda')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'direccion_tienda')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'region_id_tienda')->dropDownList(\yii\helpers\ArrayHelper::map(Regiones::find()->all(), 'id', 'nombre'), ['prompt' => 'Seleccione una región' ]) ?>

    <?= $form->field($model, 'telefono_tienda')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clasificacion_id')->textInput() ?>

    <?= $form->field($model, 'imagen_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sumaValores')->textInput() ?>

    <?= $form->field($model, 'totalVotos')->textInput() ?>

    <?= $form->field($model, 'visible')->dropDownList([
            0 => 'Invisible', 
            1 => 'Visible']
        ) ?>

    <?= $form->field($model, 'cerrada')->dropDownList([
            0 => 'No (activa)', 
            1 => 'Eliminada por solicitud de baja',
            2 => 'Suspendida',
            3 => 'Cancelada por Inadecuada']
        ) ?>

    <?= $form->field($model, 'num_denuncias')->textInput() ?>

    <?= $form->field($model, 'fecha_denuncia1')->textInput() ?>

    <?= $form->field($model, 'notas_denuncia')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'bloqueada')->dropDownList([
            0 => 'No', 
            1 => 'Si (bloqueada por denuncias)',
            2 => 'Si (bloqueada por moderador o administrador)']
        ) ?>

    <?= $form->field($model, 'fecha_bloqueo')->textInput() ?>

    <?= $form->field($model, 'notas_bloqueo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cerrado_comentar')->dropDownList([
            0 => 'No', 
            1 => 'Si']
        ) ?>

    <?= $form->field($model, 'usuario_id')->textInput() ?>

    <?= $form->field($model, 'usuario_id')->dropDownList(\yii\helpers\ArrayHelper::map(Usuarios::find()->all(), 'id', 'id'), ['prompt' => 'Seleccione un usuario' ]) ?>

    <?= $form->field($model, 'nif_cif')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'razon_social')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'region_id')->dropDownList(\yii\helpers\ArrayHelper::map(Regiones::find()->all(), 'id', 'nombre'), ['prompt' => 'Seleccione una región' ]) ?>

    <?= $form->field($model, 'telefono_contacto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'crea_usuario_id')->textInput() ?>

    <?= $form->field($model, 'crea_fecha')->textInput() ?>

    <?= $form->field($model, 'modi_usuario_id')->textInput() ?>

    <?= $form->field($model, 'modi_fecha')->textInput() ?>

    <?= $form->field($model, 'notas_admin')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Actualizar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

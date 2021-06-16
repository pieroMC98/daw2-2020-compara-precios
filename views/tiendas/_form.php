<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Regiones;
use app\models\Usuarios;
use app\models\Clasificadores;

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

    <?= $form->field($model, 'clasificacion_id')->dropDownList(\yii\helpers\ArrayHelper::map(Clasificadores::find()->all(), 'id', 'nombre'), ['prompt' => 'Seleccione una clasificación' ]) ?>

    <?= $form->field($model, 'visible')->dropDownList([
            0 => 'Invisible', 
            1 => 'Visible']
        ) ?>

    <?= $form->field($model, 'usuario_id')->hiddenInput(['value'=> 0])->label(false); ?>

    <?= $form->field($model, 'nif_cif')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'razon_social')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'region_id')->dropDownList(\yii\helpers\ArrayHelper::map(Regiones::find()->all(), 'id', 'nombre'), ['prompt' => 'Seleccione una región' ]) ?>

    <?= $form->field($model, 'telefono_contacto')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Crear Tienda', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use app\models\Categorias;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Articulos */
/* @var $form yii\widgets\ActiveForm */

/*
        if ($model->isNewRecord) {
     no previously db data loaded -
     new instance of model (new data not saved yet)
    }
        */
        


        $cargarCategorias = \yii\helpers\ArrayHelper::map(Categorias::find()->all(), 'id', 'nombre');
        $opcionesIndiArti = [ 0 => 'Activo', 1 => 'Suspendido',  2 => 'Eliminado', 3 => 'Cancelado por inadecuado'];
?>

<div class="articulos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textarea(['rows' => 6,'placeholder'=>'Aqui solamente'])->label("Mete aqui el nombre") ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'categoria_id')->dropDownList($cargarCategorias)->label("Elije una categoría")?>

    <?= $form->field($model, 'imagen_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'visible')->textInput() ?>

    <?= $form->field($model, 'cerrado')->dropDownList($opcionesIndiArti)->label("Estado Artículo") ?>

    <?= $form->field($model, 'comun')->textInput() ?>

    <?= $form->field($model, 'crea_usuario_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'crea_fecha')->hiddenInput()->label(false)?>

    <?= $form->field($model, 'modi_usuario_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'modi_fecha')->hiddenInput()->label(false)?>

    <?= $form->field($model, 'notas_admin')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    
    <?php ActiveForm::end(); ?>

    
</div>

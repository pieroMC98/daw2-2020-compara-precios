<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TiendasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tiendas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre_tienda') ?>

    <?= $form->field($model, 'descripcion_tienda') ?>

    <?= $form->field($model, 'lugar_tienda') ?>

    <?= $form->field($model, 'url_tienda') ?>

    <?php // echo $form->field($model, 'direccion_tienda') ?>

    <?php // echo $form->field($model, 'region_id_tienda') ?>

    <?php // echo $form->field($model, 'telefono_tienda') ?>

    <?php // echo $form->field($model, 'clasificacion_id') ?>

    <?php // echo $form->field($model, 'imagen_id') ?>

    <?php // echo $form->field($model, 'sumaValores') ?>

    <?php // echo $form->field($model, 'totalVotos') ?>

    <?php // echo $form->field($model, 'visible') ?>

    <?php // echo $form->field($model, 'cerrada') ?>

    <?php // echo $form->field($model, 'num_denuncias') ?>

    <?php // echo $form->field($model, 'fecha_denuncia1') ?>

    <?php // echo $form->field($model, 'notas_denuncia') ?>

    <?php // echo $form->field($model, 'bloqueada') ?>

    <?php // echo $form->field($model, 'fecha_bloqueo') ?>

    <?php // echo $form->field($model, 'notas_bloqueo') ?>

    <?php // echo $form->field($model, 'cerrado_comentar') ?>

    <?php // echo $form->field($model, 'usuario_id') ?>

    <?php // echo $form->field($model, 'nif_cif') ?>

    <?php // echo $form->field($model, 'nombre') ?>

    <?php // echo $form->field($model, 'apellidos') ?>

    <?php // echo $form->field($model, 'razon_social') ?>

    <?php // echo $form->field($model, 'direccion') ?>

    <?php // echo $form->field($model, 'region_id') ?>

    <?php // echo $form->field($model, 'telefono_contacto') ?>

    <?php // echo $form->field($model, 'crea_usuario_id') ?>

    <?php // echo $form->field($model, 'crea_fecha') ?>

    <?php // echo $form->field($model, 'modi_usuario_id') ?>

    <?php // echo $form->field($model, 'modi_fecha') ?>

    <?php // echo $form->field($model, 'notas_admin') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

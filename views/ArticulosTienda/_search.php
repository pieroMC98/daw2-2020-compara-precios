<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
<<<<<<< HEAD
/* @var $model app\models\ArticulostiendaSearch */
=======
/* @var $model app\models\articulostiendaSearch */
>>>>>>> 4f292c02449476aa1046f6afaba692881f2a80ca
/* @var $form yii\widgets\ActiveForm */
?>

<div class="articulostienda-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'articulo_id') ?>

    <?= $form->field($model, 'tienda_id') ?>

    <?= $form->field($model, 'imagen_id') ?>

    <?= $form->field($model, 'url_articulo') ?>

    <?php // echo $form->field($model, 'precio') ?>

    <?php // echo $form->field($model, 'sumaValores') ?>

    <?php // echo $form->field($model, 'totalVotos') ?>

    <?php // echo $form->field($model, 'visible') ?>

    <?php // echo $form->field($model, 'cerrado') ?>

    <?php // echo $form->field($model, 'num_denuncias') ?>

    <?php // echo $form->field($model, 'fecha_denuncia1') ?>

    <?php // echo $form->field($model, 'notas_denuncia') ?>

    <?php // echo $form->field($model, 'bloqueado') ?>

    <?php // echo $form->field($model, 'fecha_bloqueo') ?>

    <?php // echo $form->field($model, 'notas_bloqueo') ?>

    <?php // echo $form->field($model, 'cerrado_comentar') ?>

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

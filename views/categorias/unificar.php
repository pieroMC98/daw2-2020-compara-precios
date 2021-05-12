<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;



$this->title = Yii::t('app', 'Unificar categorias');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categorias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="categoria-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'categoriaMantener_id')->dropDownList($nombre_categorias)->label('Categoria a mantener'); ?>

        <?= $form->field($model, 'categoriaEliminar_id')->dropDownList($nombre_categorias)->label('Categoria a eliminar'); ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
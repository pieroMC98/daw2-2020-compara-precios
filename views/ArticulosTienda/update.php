<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ArticulosTienda */

$this->title = 'Update Articulos Tienda: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Articulos Tiendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="articulos-tienda-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

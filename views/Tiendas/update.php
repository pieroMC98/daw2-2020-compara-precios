<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tiendas */

$this->title = 'Modificar Tienda: ' . $model->nombre_tienda;
$this->params['breadcrumbs'][] = ['label' => 'Tiendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre_tienda, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="tiendas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_update', [
        'model' => $model,
    ]) ?>

</div>

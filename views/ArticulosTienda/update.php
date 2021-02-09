<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\articulostienda */

$this->title = 'Update Articulostienda: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Articulostiendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="articulostienda-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

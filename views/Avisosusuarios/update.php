<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Avisosusuarios */

$this->title = 'Update Avisosusuarios: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Avisosusuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="avisosusuarios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

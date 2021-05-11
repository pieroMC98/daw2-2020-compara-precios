<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ArticulosEtiquetas */

$this->title = 'Update Articulos Etiquetas: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Articulos Etiquetas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="articulos-etiquetas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

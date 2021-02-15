<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tiendas */
/* @var $aviso app\models\Avisosusuarios */

$this->title = 'Denuncia esta tienda: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tiendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Denuncia';
?>
<div class="tiendas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_denuncia2', [
        'model' => $model, 'aviso' => $aviso,
    ]) ?>

</div>

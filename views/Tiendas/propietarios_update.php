<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tiendas */

$this->title = 'Actualizar Propietario: ' . $model->nombre_tienda;
$this->params['breadcrumbs'][] = ['label' => 'Tiendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Propietarios', 'url' => ['propietarios']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="tiendas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_propietarios', [
        'model' => $model,
    ]) ?>

</div>

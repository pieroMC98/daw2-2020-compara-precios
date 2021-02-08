<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ArticulosTienda */

$this->title = 'Create Articulos Tienda';
$this->params['breadcrumbs'][] = ['label' => 'Articulos Tiendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articulos-tienda-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

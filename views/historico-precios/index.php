<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Historico Precios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historico-precios-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Historico Precios', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'articulo_id',
            'tienda_id',
            'fecha',
            'precio',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

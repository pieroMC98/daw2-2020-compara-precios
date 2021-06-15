<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

<<<<<<< HEAD
$this->title = 'Historico Precios';
=======
$this->title = 'Histórico de precios';
>>>>>>> origin/grupo-2
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historico-precios-index">

    <h1><?= Html::encode($this->title) ?></h1>

<<<<<<< HEAD
    <p>
        <?= Html::a('Create Historico Precios', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

=======
    <?php
        $view_use = '';
        if(!Yii::$app->user->can('update')){ 
            $view_use = '{view}';
        } else{
            $view_use = '{update}{view}{delete}';
           }
        ?>
>>>>>>> origin/grupo-2

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'articulo_id',
            'tienda_id',
<<<<<<< HEAD
            'fecha',
            'precio',
=======
            'fecha:date',
            'precio:currency',
>>>>>>> origin/grupo-2

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

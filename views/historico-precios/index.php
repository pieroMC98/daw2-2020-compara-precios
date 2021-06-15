<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

<<<<<<< HEAD
<<<<<<< HEAD
$this->title = 'Historico Precios';
=======
$this->title = 'Histórico de precios';
>>>>>>> origin/grupo-2
=======
$this->title = 'Histórico de precios';
>>>>>>> origin/grupo-5
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historico-precios-index">

    <h1><?= Html::encode($this->title) ?></h1>

<<<<<<< HEAD
<<<<<<< HEAD
    <p>
        <?= Html::a('Create Historico Precios', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

=======
=======
>>>>>>> origin/grupo-5
    <?php
        $view_use = '';
        if(!Yii::$app->user->can('update')){ 
            $view_use = '{view}';
        } else{
            $view_use = '{update}{view}{delete}';
           }
        ?>
<<<<<<< HEAD
>>>>>>> origin/grupo-2
=======
>>>>>>> origin/grupo-5

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'articulo_id',
            'tienda_id',
<<<<<<< HEAD
<<<<<<< HEAD
            'fecha',
            'precio',
=======
            'fecha:date',
            'precio:currency',
>>>>>>> origin/grupo-2
=======
            'fecha:date',
            'precio:currency',
>>>>>>> origin/grupo-5

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

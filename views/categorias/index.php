<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategoriasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categorias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorias-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
        if(strcmp($_GET['error'], 'Borrado correctamente')===0){
            echo '<p class="alert alert-success">'.$_GET['error'].'</p>';
        }
        else if(isset($_GET['error']))
        {
            echo '<p class="alert alert-danger">'.$_GET['error'].'</p>';
        }
    ?>


    <p>
        <?= Html::a('Create Categorias', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Vista Usuarios', ['public'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'descripcion:ntext',
            'icono',
            'categoria_id',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

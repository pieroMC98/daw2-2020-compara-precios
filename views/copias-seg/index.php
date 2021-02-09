<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CopiasSegSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Copias Segs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="copias-seg-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Copias Seg', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fecha',
            'ruta',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

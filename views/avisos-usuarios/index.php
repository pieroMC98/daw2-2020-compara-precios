<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AvisosUsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Avisos Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avisos-usuarios-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Avisos Usuarios', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fecha_aviso',
            'clase_aviso',
            'texto:ntext',
            'destino_usuario_id',
            'origen_usuario_id',
            'tienda_id',
            'articulo_id',
            'comentario_id',
            'fecha_lectura',
            'fecha_aceptado',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

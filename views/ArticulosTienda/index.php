<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\articulostiendaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articulostiendas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articulostienda-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Articulostienda', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'articulo_id',
            'tienda_id',
            'imagen_id',
            'url_articulo:ntext',
            //'precio',
            //'sumaValores',
            //'totalVotos',
            //'visible',
            //'cerrado',
            //'num_denuncias',
            //'fecha_denuncia1',
            //'notas_denuncia:ntext',
            //'bloqueado',
            //'fecha_bloqueo',
            //'notas_bloqueo:ntext',
            //'cerrado_comentar',
            //'crea_usuario_id',
            //'crea_fecha',
            //'modi_usuario_id',
            //'modi_fecha',
            //'notas_admin:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

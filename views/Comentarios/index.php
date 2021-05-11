<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ComentariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comentarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentarios-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear un comentario', ['tiendas/elegir_tienda','modo'=>1], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'tienda_id',
            'nomTienda',
            //'articulo_id',
            'nomArticulo',
            'texto:ntext',
            //'valoracion',
			[
				'attribute'=>'valoracion',
				'filter'=>array("1"=>"1","2"=>"2","3"=>"3","4"=>"4","5"=>"5","6"=>"6","7"=>"7","8"=>"8","9"=>"9","10"=>"10"),
			],
            //'comentario_id',
            [
                'attribute'=>'cerrado',
                'value'=>'comentariosCerrado',
                'filter'=>array("0"=>"No","1"=>"Si"),
            ],
            'num_denuncias',
            //'fecha_denuncia1',
            //'notas_denuncia:ntext',
            [
                'attribute'=>'bloqueado',
                'value'=>'comBloqueado',
                'filter'=>array("0"=>"No","1"=>"Bloqueado por denuncias","2"=>"Bloqueado por administrador"),
            ],
            //'fecha_bloqueo',
            //'notas_bloqueo:ntext',
            //'crea_usuario_id',
            'nickCreador',
            //'nickModif',
            'crea_fecha',
            //'modi_usuario_id',
            //'modi_fecha',
            //'notas_admin:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

<?php

use app\models\Articulos;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticulosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tabla de Articulos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articulos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Articulos', ['create'], ['class' => 'btn btn-success']) ?>
        <?php //var_dump($categorias) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nombre:ntext',
            'descripcion:ntext',
            [
                'attribute' => 'categoria_id',
                'value' => function ($model) {
                    return $model->get_nombre_categoria();
                },
                'filter'=>array(Articulos::get_categorias_de_una_vez())
				, 'filterInputOptions'=>['prompt'=>'Todos', 'class'=>'form-control']
              ],
            //'imagen_id',
            ['attribute'=>'visible',
            'value' => function ($model) {
                $estados =  Articulos::get_visibilidad();
                return $estados[$model->visible];
            }
				
				, 'filter'=>[0=>'Invisible',1=>'Visible']
				, 'filterInputOptions'=>['prompt'=>'Todos', 'class'=>'form-control']
			],
           // 'visible',
            //'cerrado',
            //'comun',
           // 'crea_usuario_id',
            'crea_fecha',
            //'modi_usuario_id',
            //'modi_fecha',
            //'notas_admin:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

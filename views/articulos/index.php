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
        <?php if (Yii::$app->user->can('update')) { ?>
            <?= Html::a('Create Articulos', ['create'], ['class' => 'btn btn-success']) ?>

        <?php }
        $view_use = '';
        if (!Yii::$app->user->can('update')) {
            $view_use = '{view}';
        } else {
            $view_use = '{update}{view}{delete}';
        }
        ?>
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
                'filter' => Articulos::get_categorias_de_una_vez(), 'filterInputOptions' => ['prompt' => 'Todos', 'class' => 'form-control']
            ],
            //'imagen_id',
            [
                'attribute' => 'visible',
                'value' => function ($model) {
                    $visible =  Articulos::get_visibilidad();
                    return $visible[$model->visible];
                }, 'filter' => [0 => 'Invisible', 1 => 'Visible'], 'filterInputOptions' => ['prompt' => 'Todos', 'class' => 'form-control']
            ],
            // 'visible',
            //'cerrado',
            [
                'attribute' => 'cerrado',
                'value' => function ($model) {
                    $estados =  Articulos::get_estados();
                    return $estados[$model->cerrado];
                }, 'filter' => Articulos::get_estados(), 'filterInputOptions' => ['prompt' => 'Todos', 'class' => 'form-control']
            ],
            //'comun',
            [
                'attribute' => 'comun',
                'value' => function ($model) {
                    $comun =  Articulos::get_comun();
                    return $comun[$model->comun];
                }, 'filter' => Articulos::get_comun(), 'filterInputOptions' => ['prompt' => 'Todos', 'class' => 'form-control']
            ],
            // 'crea_usuario_id',
            // 'crea_fecha',
            [
                'attribute' => 'crea_fecha',
                'value' => 'crea_fecha',
                'filter' => \yii\jui\DatePicker::widget(['language' => 'es', 'dateFormat' => 'dd-MM-yyyy']),

            ],
            ['class' => 'yii\grid\ActionColumn', 'template' => $view_use],

        ],
    ]); ?>



</div>
<?php

use app\models\AvisosUsuarios;
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

    <!-- <p>
        <?//= Html::a('Create Avisos Usuarios', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?php if (Yii::$app->user->can('update')){?>
        <?= Html::a('Crear Aviso', ['create'], ['class' => 'btn btn-success']) ?>
  
        <?php }
        $view_use = '';
        if(!Yii::$app->user->can('update')){ 
            $view_use = '{view}' ;
        } else{
            $view_use = '{update}{view}{delete}';
           }
        ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fecha_aviso:datetime',
            [
                'attribute' => 'clase_aviso',
                'filter' => [
                    'A' => 'Aviso',
                    'N' => 'Notificación', 
                    'D' => 'Denuncia',
                    'C' => 'Consulta',
                    'B' => 'Bloqueo',
                    'M' => 'Mensaje'
                ],
            ],
            'texto:ntext',
            'destino_usuario_id',
            'origen_usuario_id',
            'tienda_id',
            [
                'attribute' => 'tienda_id',
                'value' => 'tienda.nombre',
                'label' => 'Tienda'
            ],
            'articulo_id',
            'comentario_id',
            'fecha_lectura:datetime',
            'fecha_aceptado:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

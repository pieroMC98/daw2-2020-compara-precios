<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TiendasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Propietarios';
$this->params['breadcrumbs'][] = ['label' => 'Tiendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tiendas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tiendas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nombre_tienda:ntext',
            'nickPropietario',
            //'descripcion_tienda:ntext',
            //'lugar_tienda:ntext',
            //'url_tienda:ntext',
            //'direccion_tienda:ntext',
            //'region_id_tienda',
            //'telefono_tienda',
            //'clasificacion_id',
            //'imagen_id',
            //'sumaValores',
            //'totalVotos',
            //'visible',
            //'cerrada',
            //'num_denuncias',
            //'fecha_denuncia1',
            //'notas_denuncia:ntext',
            //'bloqueada',
            //'fecha_bloqueo',
            //'notas_bloqueo:ntext',
            //'cerrado_comentar',
            'nif_cif',
            //'nombre',
            //'apellidos',
            'nombreCompleto',
            'razon_social',
            'direccion:ntext',
            //'region_id',
            'telefono_contacto',
            //'crea_usuario_id',
            //'crea_fecha',
            //'modi_usuario_id',
            //'modi_fecha',
            //'notas_admin:ntext',


            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete}',
            'buttons'  => ['view' => function($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [ 'title' => Yii::t('app', 'View'),]);

                            }

                        ],

            'buttons'  => ['update' => function($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['title' => Yii::t('app', 'Update'),]);

                            }

                        ],

            'buttons'  => ['delete' => function($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['propietarios_delete', 'id' => $model['id']], ['title' => Yii::t('app', 'Delete'), 'data-confirm' => Yii::t('app', 'Are you sure you want to delete this Record?'),'data-method' => 'post']);

                            }

                        ],


            'urlCreator' => function ($action, $model, $key, $index) {

                if ($action === 'view') {

                    $url = 'index.php?r=tiendas/propietarios_view&id='.$model['id'];

                    return $url;

                }

                if($action === 'update') {

                    $url = 'index.php?r=tiendas/propietarios_update&id='.$model['id'];

                    return $url;

                }

            }

        ]
        ],
    ]);
    ?>


</div>

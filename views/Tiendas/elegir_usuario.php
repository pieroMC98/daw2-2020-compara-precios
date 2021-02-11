<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Elige un usuario de los existentes';
?>
<div class="usuarios-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'email:email',
            //'password',
            'nick',
            'nombre',
            'apellidos',
            //'direccion:ntext',
            //'region_id',
            //'telefono_contacto',
            //'fecha_nacimiento',
            'fecha_registro',
            //'confirmado',
            //'fecha_acceso',
            //'num_accesos',
            //'bloqueado',
            //'fecha_bloqueo',
            //'notas_bloqueo:ntext',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{crear_propietario}',
            'buttons'  => ['crear_propietario' => function($url, $model) {
                            //var_dump($id_tienda);
                            return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url.'&id_tienda='.Yii::$app->request->get('id_tienda'), [ 'title' => Yii::t('app', 'Crear_propietario'),]);

                            }

                        ],

            

            'urlCreator' => function ($action, $model, $key, $index) {

                if ($action === 'crear_propietario') {

                    $url = 'index.php?r=tiendas/crear_propietario&id_usuario='.$model['id'];

                    return $url;

                }
             }

        ]
        ],
    ]); ?>


</div>

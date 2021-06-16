<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TiendasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tiendas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tiendas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear una tienda', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Ver propietarios', ['propietarios'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nombre_tienda:ntext',
            'descripcion_tienda:ntext',
            'lugar_tienda:ntext',
            'url_tienda:url',
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
            //'usuario_id',
            //'nif_cif',
            //'nombre',
            //'apellidos',
            //'razon_social',
            //'direccion:ntext',
            //'region_id',
            //'telefono_contacto',
            //'crea_usuario_id',
            //'crea_fecha',
            //'modi_usuario_id',
            //'modi_fecha',
            //'notas_admin:ntext',
            'nombreCompleto',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {propietarios} {addPropietario} {addEtiqueta} {bloquear} {denunciar} {delete}',
                'buttons' => [
                    'propietarios' => function ($url, $model, $key) {
                        return Html::a ('<i class="bi bi-person-badge" title="Ver propietarios"></i>', ['propietarios_view', 'id' => $model->id]);
                    },
                    'addPropietario' => function ($url, $model) {
                        return Html::a('<i class="bi bi-person-plus-fill" title="Actualizar propietarios"></i>', ['propietarios_update', 'id' => $model->id]);
                    },
                    'addEtiqueta' => function ($url, $model) {
                        return Html::a('<i class="bi bi-tag-fill" title="Añadir etiqueta"></i>' ,['etiquetas', 'id' => $model->id]);
                    },
                    'bloquear' => function ($url, $model) {
                        return Html::a('<i class="bi bi-x-octagon-fill" title="Bloquear"></i>', ['bloqueos', 'id' => $model->id]);
                    },
                    'denunciar' => function ($url, $model) {
                        return Html::a('<i class="bi bi-exclamation-diamond-fill" title="Denunciar"></i>', ['denuncias', 'id' => $model->id]);
                    },
                ],
            ]
        ],
    ]); ?>


</div>

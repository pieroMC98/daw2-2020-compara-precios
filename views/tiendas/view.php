<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\models\Tiendas;

/* @var $this yii\web\View */
/* @var $model app\models\Tiendas */

$this->title = $model->nombre_tienda;
$this->params['breadcrumbs'][] = ['label' => 'Tiendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->nombre_tienda;
\yii\web\YiiAsset::register($this);
?>

<div class="tiendas-view">
    <p>
        <?php //Esto debería mostrarse según el tipo de usuario que ha iniciado sesión, pero no funciona correctamente el login. 
        ?>
        <?= Html::a('<i class="bi bi-arrow-repeat"></i> Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="bi bi-person-badge"></i> Ver Propietarios', ['propietarios_view', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a('<i class="bi bi-person-plus-fill"></i> Añadir Propietario', ['propietarios_update', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a('<i class="bi bi-tag-fill"></i> Añadir Etiqueta', ['etiquetas', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="bi bi-x-octagon-fill"></i> Bloquear', ['bloqueos', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('<i class="bi bi-exclamation-diamond-fill"></i> Denunciar', ['denuncias', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('<i class="bi bi-trash-fill"></i> Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Seguro que desea eliminar esta tienda?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="container">
        <div class="col">
            <div class="row">
                <img src="https://via.placeholder.com/300">
                <h1 class="my-4"><?= Html::encode($model->nombre_tienda) ?></h1>
                <h2>
                    <span class="badge badge-warning"><?= Html::encode($model->sumaValores) ?> <i class="bi bi-star-fill"> / <?= Html::encode($model->totalVotos) ?> voto(s)</i></span>
                </h2>
                <p class="my-4"><?= Html::encode($model->descripcion_tienda) ?></p>
                <p class="my-4"><?= Html::encode($model->lugar_tienda) ?></p>
                <p class="my-4" href="<?= $model->url_tienda ?>">Página web</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <img class="card-img-top" src="https://via.placeholder.com/150" alt="Foto articulo">
                <div class="card-body">
                    <h5 class="card-title">Articulo 1</h5>
                    <p class="card-text">Descripción articulo</p>
                    <a href="#" class="btn btn-primary">(precio articulo) €</a>
                </div>
                <div class="col">
                    <img class="card-img-top" src="https://via.placeholder.com/150" alt="Foto articulo">
                    <div class="card-body">
                        <h5 class="card-title">Articulo 2</h5>
                        <p class="card-text">Descripción articulo</p>
                        <a href="#" class="btn btn-primary">(precio articulo) €</a>
                    </div>
                </div>
                <div class="col">
                    <img class="card-img-top" src="https://via.placeholder.com/150" alt="Foto articulo">
                    <div class="card-body">
                        <h5 class="card-title">Articulo 3</h5>
                        <p class="card-text">Descripción articulo</p>
                        <a href="#" class="btn btn-primary">(precio articulo) €</a>
                    </div>
                </div>
            </div>
        </div>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'nombre_tienda:ntext',
                'descripcion_tienda:ntext',
                'lugar_tienda:ntext',
                'url_tienda:url',
                'direccion_tienda:ntext',
                [
                    'attribute' => 'regiones.nombre',
                    'label' => 'Región',
                ],
                'telefono_tienda',
                [
                    'attribute' => 'clasificadores.nombre',
                    'label' => 'Clasificación',
                ],
                'imagen_id',
                'sumaValores',
                'totalVotos',
                [
                    'attribute' => 'visible',
                    'label' => 'Visibilidad',
                    'value' => function ($model) {
                        switch ($model->visible) {
                            case 0:
                                return 'Invisible';
                            case 1:
                                return 'Visible';
                        }
                    },
                ],
                [
                    'attribute' => 'cerrada',
                    'label' => 'Cerrada',
                    'value' => function ($model) {
                        switch ($model->cerrada) {
                            case 0:
                                return 'No (activa)';
                            case 1:
                                return 'Eliminada por solicitud de baja';
                            case 2:
                                return 'Suspendida';
                            case 3:
                                return 'Cancelada por Inadecuada';
                        }
                    },
                ],
                'num_denuncias',
                'fecha_denuncia1:date',
                'notas_denuncia:ntext',
                [
                    'attribute' => 'bloqueada',
                    'label' => 'Bloqueada',
                    'value' => function ($model) {
                        switch ($model->bloqueada) {
                            case 0:
                                return 'No';
                            case 1:
                                return 'Si (bloqueada por denuncias)';
                            case 2:
                                return 'Si (bloqueada por moderador o administrador)';
                        }
                    },
                ],
                'fecha_bloqueo:date',
                'notas_bloqueo:ntext',
                [
                    'attribute' => 'cerrado_comentar',
                    'label' => 'Cerrado comentar',
                    'value' => function ($model) {
                        switch ($model->cerrado_comentar) {
                            case 0:
                                return 'No';
                            case 1:
                                return 'Si';
                        }
                    },
                ],
                'usuario_id',
                'nif_cif',
                'nombre',
                'apellidos',
                'razon_social',
                'direccion:ntext',
                'region_id',
                'telefono_contacto',
                'crea_usuario_id',
                'crea_fecha:date',
                'modi_usuario_id',
                'modi_fecha:date',
                'notas_admin:ntext',
                'nick_propietario',
            ],
        ]) ?>

    </div>
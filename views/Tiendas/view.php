<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tiendas */

$this->title = $model->nombre_tienda;
$this->params['breadcrumbs'][] = ['label' => 'Tiendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->nombre_tienda;
\yii\web\YiiAsset::register($this);
?>

<div class="tiendas-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Seguro que desea eliminar esta tienda?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="container">
        <div class="row">
            <div class="col-3">
                <img src="https://via.placeholder.com/300">
                <h1 class="my-4"><?= Html::encode($model->nombre_tienda) ?></h1>
                <h2>
                    <span class="badge badge-warning"><?= Html::encode($model->sumaValores) ?> <i class="bi bi-star-fill"> / <?= Html::encode($model->totalVotos) ?> voto(s)</i></span>
                </h2>
                <p class="my-4"><?= Html::encode($model->descripcion_tienda) ?></p>
                <p class="my-4"><?= Html::encode($model->lugar_tienda) ?></p>
                <p class="my-4" href="<?= $model->url_tienda ?>">Página web</p>
                <div class="list-group">
                    <!-- Por hacer: widget de "Categorias" -->
                    <a href="#" class="list-group-item">Categoria 1</a>
                    <a href="#" class="list-group-item">Categoria 2</a>
                    <a href="#" class="list-group-item">...</a>
                </div>
            </div>

            <div class="col">
                    <div class="card-group">
                        <!-- Por hacer: widget de "card" -->
                        <div class="card">
                            <img class="card-img-top" src="https://via.placeholder.com/150" alt="Foto producto">
                            <div class="card-body">
                                <h5 class="card-title">Producto 1</h5>
                                <p class="card-text">Descripción producto</p>
                                <a href="#" class="btn btn-primary">(precio producto) €</a>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-img-top" src="https://via.placeholder.com/150" alt="Foto producto">
                            <div class="card-body">
                                <h5 class="card-title">Producto 2</h5>
                                <p class="card-text">Descripción producto.</p>
                                <a href="#" class="btn btn-primary">(precio producto) €</a>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-img-top" src="https://via.placeholder.com/150" alt="Foto producto">
                            <div class="card-body">
                                <h5 class="card-title">Producto 3</h5>
                                <p class="card-text">Descripción producto</p>
                                <a href="#" class="btn btn-primary">(precio producto) €</a>
                            </div>
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
                'url_tienda:ntext',
                'direccion_tienda:ntext',
                'region_id_tienda',
                'telefono_tienda',
                'clasificacion_id',
                'imagen_id',
                'sumaValores',
                'totalVotos',
                'visible',
                'cerrada',
                'num_denuncias',
                'fecha_denuncia1',
                'notas_denuncia:ntext',
                'bloqueada',
                'fecha_bloqueo',
                'notas_bloqueo:ntext',
                'cerrado_comentar',
                'usuario_id',
                'nif_cif',
                'nombre',
                'apellidos',
                'razon_social',
                'direccion:ntext',
                'region_id',
                'telefono_contacto',
                'crea_usuario_id',
                'crea_fecha',
                'modi_usuario_id',
                'modi_fecha',
                'notas_admin:ntext',
            ],
        ]) ?>

    </div>
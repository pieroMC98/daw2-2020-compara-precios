<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tiendas */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tiendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tiendas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

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

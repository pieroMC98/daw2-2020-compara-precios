<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AvisosUsuarios */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Avisos Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);


?>
<div class="avisos-usuarios-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Desea eliminar este elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fecha_aviso:datetime',
            'clase_aviso',
            /* [
                'label' => 'clase_aviso',
                'value' => function ($model) {
                    return $model->getClaseAvisoIcono();
                }
            ], */
            'texto:ntext',
            'destino_usuario_id',
            'origen_usuario_id',
            [
                'attribute' => 'tienda_id',
                'label' => 'Tienda'
            ],
            'articulo_id',
            'comentario_id',
            'fecha_lectura:datetime',
            'fecha_aceptado:datetime',
        ],
    ]) ?>

</div>

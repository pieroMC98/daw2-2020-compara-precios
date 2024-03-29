<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Avisosusuarios */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Avisosusuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="avisosusuarios-view">

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
            'fecha_aviso',
            'clase_aviso',
            'texto:ntext',
            'destino_usuario_id',
            'origen_usuario_id',
            'tienda_id',
            'articulo_id',
            'comentario_id',
            'fecha_lectura',
            'fecha_aceptado',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Articulostienda */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Articulostiendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="articulostienda-view">

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
            'articulo_id',
            'nomArticulo',
            'tienda_id',
            'nomTienda',
            'imagen_id',
            'url_articulo:ntext',
            //'precio',
			[
				'attribute' => 'precio',
				//'format' => 'Currency',
				'value' => function ($model) {
					return Yii::$app->formatter->asCurrency($model->precio);
				},
			],
            'sumaValores',
            'totalVotos',
            'artVisible',
            'cerrado',
            'num_denuncias',
            'fecha_denuncia1',
            'notas_denuncia:ntext',
            'artBloqueado',
            'fecha_bloqueo',
            'notas_bloqueo:ntext',
            'cerrado_comentar',
            'crea_usuario_id',
            'crea_fecha',
            'modi_usuario_id',
            'modi_fecha',
            'notas_admin:ntext',
        ],
    ]) ?>

</div>

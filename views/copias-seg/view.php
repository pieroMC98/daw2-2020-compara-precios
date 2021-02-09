<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CopiasSeg */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Copias Segs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="copias-seg-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Recuperar', ['recuperar', 'id' => $model->id], 
            ['class' => 'btn btn-primary',
                'data' => [
                    'confirm' => '¿Quieres restaurar esta copia de seguridad?',
                    'method' => 'post',],
            ]) 
        ?>
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
            'fecha',
            'ruta',
        ],
    ]) ?>

</div>

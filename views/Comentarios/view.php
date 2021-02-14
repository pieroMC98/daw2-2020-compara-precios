<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Comentarios */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Comentarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="comentarios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
        if($model->bloqueado===0 && $model->texto!=="Este comentario ha sido eliminado."){

            echo Html::a('Bloquear', ['bloqueo', 'id' => $model->id], ['class' => 'btn btn-warning']); 
        }

        if($model->bloqueado!==0 && $model->texto!=="Este comentario ha sido eliminado."){

            echo Html::a('Quitar bloqueo', ['quitabloqueo', 'id' => $model->id], ['class' => 'btn btn-warning']); 
        }
        ?>

        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

        <?php /*Boton para probar la denuncia publica  Html::a('Denuncia?', ['denuncia', 'id' => $model->id], ['class' => 'btn btn-primary']) */?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nomTienda',
            'nomArticulo',
            'articulo_id',
            'valoracion',
            'texto:ntext',
            'comentario_id',
            'comentariosCerrado',
            'num_denuncias',
            'fecha_denuncia1',
            'notas_denuncia:ntext',
            'comBloqueado',
            'fecha_bloqueo',
            'notas_bloqueo:ntext',
            'crea_usuario_id',
            'crea_fecha',
            'modi_usuario_id',
            'modi_fecha',
            'notas_admin:ntext',
        ],
    ]) ?>

</div>

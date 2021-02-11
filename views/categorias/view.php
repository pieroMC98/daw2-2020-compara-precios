<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\Categorias */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Categorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="categorias-view">

    <h1><?= Html::encode($model->nombre) ?></h1>

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
            'nombre',
            'descripcion:ntext',
            'icono',
            'categoria_id',          
        ],        
    ])   
    ?>
    <h2>Subcategorias</h2>
    <?php

    foreach ($subcategorias as $sub)
    {
        echo "<a href='index.php?r=categorias%2Fview&id=".$sub['id']."'>".$sub['nombre']."</a>, ";
    }

    ?>
    <h2>Productos</h2>
    <?php
    foreach ($articulos as $art)
    {
        echo "<a href='index.php?r=articulos%2Fview&id=".$art['id']."'>".$art['nombre']."</a>, ";
    }

    ?>

</div>

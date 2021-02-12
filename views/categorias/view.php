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
    
    <?php
    if(!empty($subcategorias)){
        echo '<h2>Subcategorias</h2>';
        foreach ($subcategorias['hijos0'] as $sub)
        {
            echo "<a href='index.php?r=categorias%2Fview&id=".$sub['id']."'><strong>".$sub['nombre']."</strong></a>, ";
        }
        for($j=0;$j<$subcategorias['numeroNiveles'];$j++){
            for($i=1;$i<=$subcategorias['numeroHijos'.$j];$i++)
            {   
                foreach ( $subcategorias['hijos'.$j]['hijo-'.$j.'-'.$i] as $sub)
                {
                    echo "<a href='index.php?r=categorias%2Fview&id=".$sub['id']."'>".$sub['nombre']."</a>, ";
                }
            }  
        }     
    }
    var_dump($subcategorias);
    ?>
    <h2>Productos</h2>
    <?php
    if(!empty($articulos)){
        echo '<h2>Productos</h2>';
        foreach ($articulos as $art)
        {
            echo "<a href='index.php?r=articulos%2Fview&id=".$art['id']."'>".$art['nombre']."</a>, ";
        }
    }

    ?>

</div>

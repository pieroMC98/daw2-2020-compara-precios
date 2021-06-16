<?php

function recorrerCategorias($array, $display){
    $n_hijos=count($array);
    for( $i=0; $i<$n_hijos; $i++){
        
        if($display==1){
            echo '</br>';
            echo "<a href='index.php?r=categorias%2Fview&id=".$array[$i]['id']."'><span class='tam-".$display."'>".$array[$i]['nombre']."</span></a>  ";
            echo '<div class="row">';
        }
        else if($display==2){
            echo '<div class="col-md-4">';
            echo "<a href='index.php?r=categorias%2Fview&id=".$array[$i]['id']."'><span class='tam-".$display."'>".$array[$i]['nombre']."</span></a>  ";
        }else{
            echo "<a href='index.php?r=categorias%2Fview&id=".$array[$i]['id']."'><span class='tam-".$display."'>".$array[$i]['nombre']."</span></a>  ";
        }
        
        if(!empty($array[$i]['hijos'])){
            recorrerCategorias( $array[$i]['hijos'], $display+1);
        }

        if($display==1){
            echo '</div>';
            echo '<hr>';
        }
        else if($display==2){
            echo '</div>'; 
        }
    }
}

function recorrerArticulos($array){
    foreach($array as $art)
    {
        echo "<a href='index.php?r=articulos%2Fview&id=".$art['id']."'>".$art['nombre']."</a>  ";
    }
}

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
        recorrerCategorias($subcategorias, 1);
    }
    ?>
    <?php
    if(!empty($articulos)){
        echo '<h2>Productos</h2>';
        recorrerArticulos($articulos);
    }

    ?>


</div>

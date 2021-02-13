<?php

function recorrerCategorias($array, $display){
    $n_hijos=count($array);
    for( $i=0; $i<$n_hijos; $i++){
        echo "<a href='index.php?r=categorias%2Fview&id=".$array[$i]['id']."'><span class='display- ".$display."'>".$array[$i]['nombre']."</span></a>  ";
        if(!empty($array[$i]['hijos'])){
            recorrerCategorias( $array[$i]['hijos'], $display-1);
        }
    }
}

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategoriasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categorias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorias-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <h2>Nube de categorías</h2>
    <?php recorrerCategorias($categorias,1)?>
</div>

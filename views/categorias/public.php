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

    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <h2>Nube de categorías</h2>
    <div class='container'>
        <?php recorrerCategorias($categorias,1)?>
    </div>


</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TiendasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tiendas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tiendas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <h2>Nube de etiquetas</h2>

    <?php
        //for($i=0; $i<count($etiquetas);$i++){
        foreach($etiquetas as $id => $tag){
            echo '<a class="tam-3 etiqueta" href="index.php?r=tiendas%2Fbusqetiquetas&TiendasSearch%5BetiquetaId%5D='.$id.'">'.$tag.'</a> ';  
        }
    ?>

</div>

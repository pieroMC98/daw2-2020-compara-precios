<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Articulos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articulos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <h2>Nube de etiquetas</h2>

    <?php
        foreach($etiquetas as $id => $tag){
            echo '<a class="tam-3 etiqueta" href="index.php?r=articulos%2Fbusqetiquetas&ArticulosSearch%5BetiquetaId%5D='.$id.'">'.$tag.'</a> ';  
        }
    ?>

</div>

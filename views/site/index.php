<?php

/* @var $this yii\web\View */
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
$this->title = 'Comparador de precios';
?>


<div class="site-index">
	<?php
	?>
	<p>*Barra con el nombre de las categorias*</p>
    <div class="barra">
            <a class="btn elemento" onmouseover="" href='index.php?r=copias-seg'>Categoria 1</a>
            <a class="btn elemento" href='#'>Categoría 2</a>
            <a class="btn elemento" href='#'>Categoría 3</a>
            <a class="btn elemento" href='#'>Categoría 4</a>
            <a class="btn elemento" href='#'>Categoría 5</a>
            <a class="btn elemento" href='#'>Categoría 6</a>
            <a class="btn elemento" href='#'>Categoría 7</a>
    </div>
  
</div>
<br/>
    <div class="body-content">

            <div style="float:left" class="lateral item-box col-3 col-sm-3 col-md-3">
                <h2>Tiendas</h2>
                <p>Pieza con el nombre de las tiendas.</p>

            </div>

            <div style="float:right" class="col-12 col-sm-6 col-md-8 item-box">
                <h2>Ofertas recomendadas</h2>

                <p>Pieza con las ofertas recomendadas para un usuario.</p>

            </div>
          
            <div style="float:right" class="col-12 col-sm-6 col-md-8 item-box">
                <h2>Artículos recomendados según el usuario</h2>

                <p>Pieza con los articulos recomendados para un usuario.</p>

            </div>
        </div>
</div>

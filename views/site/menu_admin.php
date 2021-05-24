<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Menu de Administrador';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="body-content item-box3">

            <table class="default">

			  <tr>

			    <td WIDTH="33%" 
				    HEIGHT="33%"><div class="item-box2">
			                <h2>Ver todas las tiendas</h2>
			                <p><a class="btn btn-default" href="index.php?r=tiendas">Ir a las tiendas &raquo;</a></p>


			            </div></td>

			    <td WIDTH="33%" 
				    HEIGHT="33%"><div class="item-box2">
			                <h2>Ver todos los artículos</h2>

			                <p><a class="btn btn-default" href="index.php?r=articulos">Ir a los artículos &raquo;</a></p>

			            </div></td>

			    <td WIDTH="33%" 
				    HEIGHT="33%"><div class="item-box2">
			                <h2>Ver los artículos de cada tienda</h2>

			               <p><a class="btn btn-default" href="index.php?r=articulostienda">Ir a articulos-tienda &raquo;</a></p>

			            </div></td>

			  </tr>

			  <tr>

			    <td><div class="item-box2">
			                <h2>Ver todos los comentarios de los usuarios</h2>

			                <p><a class="btn btn-default" href="index.php?r=comentarios">Ir a comentarios &raquo;</a></p>

			            </div></td>

			    <td><div class="item-box2">
			                <h2>Ver el historico de precios</h2>

			                <p><a class="btn btn-default" href="index.php?r=historico">Ir a histórico &raquo;</a></p>

			            </div></td>

			    <td><div class="item-box2">
			                <h2>Ver los seguimientos</h2>

			                <p><a class="btn btn-default" href="index.php?r=seguimientos">Ir a seguimiento &raquo;</a></p>

			            </div></td>

			  </tr>

			</table>

        </div>
</div>
</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Articulos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articulos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php  echo $this->render('_searchEtiquetas', ['model' => $searchModel, 'etiquetas'=> $etiquetas]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'nombre:ntext',
            'descripcion:ntext',
            'categoriaNombre',
            'imagen_id',
            //'visible',
            //'cerrado',
            //'comun',
            //'crea_usuario_id',
            //'crea_fecha',
            //'modi_usuario_id',
            //'modi_fecha',
            //'notas_admin:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

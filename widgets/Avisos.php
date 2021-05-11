<?php

namespace app\widgets;
use yii\grid\GridView;

echo GridView::widget([
    'dataProvider' => $dataProvider/*,
    'columns' => [
        'id',
        'fecha_aviso',
        'clase_aviso',
        'texto',
        'destino_usuario_id',
        'origen_usuario_id',
        'tienda_id',
        'comentario_id',
        'fecha_lectura',
        'fecha_aceptado',
        ['class' => 'yii\grid\ActionColumn'],
        ['class' => 'yii\grid\CheckboxColumn'],
    ],*/
]);

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ArticulosEtiquetas */

$this->title = 'Create Articulos Etiquetas';
$this->params['breadcrumbs'][] = ['label' => 'Articulos Etiquetas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articulos-etiquetas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

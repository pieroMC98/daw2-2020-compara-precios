<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TiendasEtiquetas */

$this->title = 'Create Tiendas Etiquetas';
$this->params['breadcrumbs'][] = ['label' => 'Tiendas Etiquetas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tiendas-etiquetas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HistoricoPrecios */

$this->title = 'Create Historico Precios';
$this->params['breadcrumbs'][] = ['label' => 'Historico Precios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historico-precios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

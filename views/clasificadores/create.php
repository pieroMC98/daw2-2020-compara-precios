<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Clasificadores */

$this->title = 'Create Clasificadores';
$this->params['breadcrumbs'][] = ['label' => 'Clasificadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clasificadores-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

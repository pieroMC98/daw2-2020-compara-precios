<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Avisosusuarios */

$this->title = 'Create Avisosusuarios';
$this->params['breadcrumbs'][] = ['label' => 'Avisosusuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avisosusuarios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

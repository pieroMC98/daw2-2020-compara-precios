<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
<<<<<<< HEAD
/* @var $model app\models\Articulostienda */
=======
/* @var $model app\models\articulostienda */
>>>>>>> 4f292c02449476aa1046f6afaba692881f2a80ca

$this->title = 'Update Articulostienda: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Articulostiendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="articulostienda-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

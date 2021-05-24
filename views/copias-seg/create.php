<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CopiasSeg */

$this->title = 'Create Copias Seg';
$this->params['breadcrumbs'][] = ['label' => 'Copias Segs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="copias-seg-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

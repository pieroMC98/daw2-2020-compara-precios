<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AvisosUsuarios */

$this->title = 'Create Avisos Usuarios';
$this->params['breadcrumbs'][] = ['label' => 'Avisos Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avisos-usuarios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

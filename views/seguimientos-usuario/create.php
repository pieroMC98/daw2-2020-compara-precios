<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SeguimientosUsuario */

$this->title = 'Create Seguimientos Usuario';
$this->params['breadcrumbs'][] = ['label' => 'Seguimientos Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seguimientos-usuario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

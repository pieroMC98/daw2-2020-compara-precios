<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SeguimientosUsuario */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Seguimientos Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="seguimientos-usuario-view">
</div>

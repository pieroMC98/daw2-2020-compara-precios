<?php

use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
?>
<h1>Usuario: <?= Yii::$app->user->identity->nick ?></h1>
<?php
echo DetailView::widget([
    'elements' => $elements,
    'cm' => $comments


]); ?>
<?php

use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\helpers\Html;

?>
<h1>Usuario: <?= Yii::$app->user->identity->nick ?></h1>
<?php
echo DetailView::widget([
  'model' => $model,

]); ?>

<?php $form = ActiveForm::begin(['action' => ['update', 'id' => $model->id]]); ?>
<?= Html::submitButton('Editar', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

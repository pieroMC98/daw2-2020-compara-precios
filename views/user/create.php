<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<h1>Esto es la creacion del usuario</h1>
<?php
$form = ActiveForm::begin();

$form->field($model, 'name');
$form->field($model, 'password');
Html::submitButton('enviar get', ['class' => 'btn btn-primary']);
ActiveForm::end();
?>

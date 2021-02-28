<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<h1>Esto es la creacion del usuario</h1>
<?php
$form = ActiveForm::begin();
echo $form->field($model, 'nombre')->textInput()->hint('Nombre de usuario');
echo $form->field($model, 'nick')->textInput()->hint('Nick de usuario');
echo $form->field($model, 'email')->input('email');
echo $form->field($model, 'password')->passwordInput();
echo $form->field($model, 'r_password')->passwordInput();

echo Html::submitButton('enviar get', ['class' => 'btn btn-primary']);
ActiveForm::end();

?>

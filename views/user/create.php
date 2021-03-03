<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
?>
<h1>Esto es la creacion del usuario</h1>
<?php
//Yii::$app->request->enableCsrfValidation = false;
$form = ActiveForm::begin([
	'action' => ['user/create'],
	'id' => 'userform',
	'method' => 'post',
]);
echo $form
	->field($model, 'nombre')
	->textInput()
	->hint('Nombre de usuario');
echo $form
	->field($model, 'apellidos')
	->textInput()
	->hint('Apellidos de usuario');
echo $form
	->field($model, 'direccion')
	->textInput()
	->hint('Direccion de usuario');
echo $form
	->field($model, 'telefono_contacto')
	->textInput()
	->hint('telefono de usuario');
echo $form->field($model, 'fecha_nacimiento')->widget(DatePicker::class, [
	'options' => ['class' => 'form-control'],
]);
echo $form
	->field($model, 'nick')
	->textInput()
	->hint('Nick de usuario');
echo $form->field($model, 'email')->input('email');
echo $form->field($model, 'password')->passwordInput();
echo $form->field($model, 'r_password')->passwordInput();

echo Html::submitButton('enviar get', ['class' => 'btn btn-primary']);
ActiveForm::end();


?>

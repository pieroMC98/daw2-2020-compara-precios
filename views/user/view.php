<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use app\models\User;
?>
	<h1>Usuario: <?= Yii::$app->user->identity->nick ?></h1>
<?php
$user = new User();
$user->load(Yii::$app->user->identity);

/* $form = ActiveForm::begin([ */
/* 'action' => ['user/create'], */
/* 'id' => 'userform', */
/* 'method' => 'post', */
/* ]); */
/* echo $form */
/* ->field($model, 'nombre'); */
/* echo $form */
/* ->field($model, 'apellidos') */
/* ->textInput() */
/* ->hint('Apellidos de usuario'); */
/* echo $form */
/* ->field($model, 'direccion') */
/* ->textInput() */
/* ->hint('Direccion de usuario'); */
/* echo $form */
/* ->field($model, 'telefono_contacto') */
/* ->textInput() */
/* ->hint('telefono de usuario'); */
/* echo $form->field($model, 'fecha_nacimiento')->widget(DatePicker::class, [ */
/* 'options' => ['class' => 'form-control'], */
/* ]); */
/* echo $form */
/* ->field($model, 'nick') */
/* ->textInput() */
/* ->hint('Nick de usuario'); */
/* echo $form->field($model, 'email')->input('email'); */
/* echo $form->field($model, 'password')->passwordInput(); */
/* echo $form->field($model, 'r_password')->passwordInput(); */

/* echo Html::submitButton('cargar', ['class' => 'btn btn-primary']); */
/* ActiveForm::end(); */
?>
<table class="table table-dark">
	<?php foreach ($user->getAttributes() as $i => $j): ?>
  <thead>
    <tr>
  <?= $i ?>
    </tr>
  </thead>
<tbody>
<tr>
  <?= $j ?>
</tr>
</tbody>
	<?php endforeach; ?>
</table>

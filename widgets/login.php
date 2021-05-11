<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\base\Widget;
class Login extends Widget{
	public function run(){

	}
}
?>


<?php
$form = ActiveForm::begin(['id'=>'login']);
$form->field($model, 'name');
$form->field($model, 'password')->passwordInput();
Html::submitButton('enviar get', ['class' => 'btn btn-primary']);
ActiveForm::end();
 ?>

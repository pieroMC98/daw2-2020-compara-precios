<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

/* if (isset($_SESSION['block']) && $_SESSION['block'] == true) { */
/* Yii::$app->session->set('count', 0); */
/* die(); */
/* } */
?>
	<?php if (isset($msg)): ?>
		<div class="alert alert-danger" role="alert">
			<?= $msg ?>
		</div>
	<?php endif; ?>

	<?php if ($model->num_accesos): ?>
		<div class="alert alert-danger" role="alert">
			<?= $model->num_accesos ?>
		</div>
	<?php endif; ?>

<div class="site-login">
	<?php if (isset($error)): ?>
		<div class="alert alert-danger">
			<?= $error ?>
		</div>
	<?php endif; ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Login</p> 
    <?php $form = ActiveForm::begin([
    	'id' => 'login-form',
    	'layout' => 'horizontal',
    	'fieldConfig' => [
    		'template' =>
    			"{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
    		'labelOptions' => ['class' => 'col-lg-1 control-label'],
    	],
    ]); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
        	'template' =>
        		"<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>

		<div class="form-row">
			<div class="col">
				<?= Html::submitButton('Login', [
    	'class' => 'btn btn-primary',
    	'name' => 'login-button',
    ]) ?>
			</div>
		</div>
    <?php ActiveForm::end(); ?>

	
	<?= Html::beginForm(['user/create'], 'get') ?>
	<?= Html::submitButton('Crear Usuario', ['class' => 'btn btn-primary']) ?>
	<?= Html::endForm() ?>

	

    <div class="col-lg-offset-1" style="color:#999;">
        You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
        To modify the username/password, please check out the code <code>app\models\User::$users</code>.
    </div>
</div>

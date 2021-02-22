<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\LoginForm;
use yii\web\Request;
use app\Traits\ApiResponse;

class UserController extends Controller
{
	use ApiResponse;
	function logout()
	{
	}

	function actionLogin()
	{
		return $this->render("login", [
			"msg" => "mensaje de prueba",
			"model" => new LoginForm(),
		]);
	}

	function actionCreate()
	{
		return $this->render("create");
	}

	function actionUpdate($id)
	{
		return $this->render("create", ["user" => User::findIdentity($id)]);
	}

	function actionStorage()
	{
		$request = Yii::$app->request;
		if (!$request->isPut) {
			return $this->render("error");
		}

		$new_user = new User();
		$new_user->username = $request->post("name");
		$new_user->password = $request->post("pass");
		$new_user->rool = $new_user->PROPIETARIO = true;
		if ($new_user->validate()) {
			return $this->responseJson($new_user);
		} else {
			return null;
		}
	}
}

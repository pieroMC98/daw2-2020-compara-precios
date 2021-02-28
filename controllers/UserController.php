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
		return $this->render('login', [
			'msg' => 'mensaje de prueba',
			'model' => new User(),
		]);
	}

	function actionCreate()
	{
		$new_user = new User();
		$new_user->scenario = User::SCENARIO_REGISTER;
		$new_user->rool = User::$MODERADOR;
		$new_user->confirmado = true;
		/* $new_user->nombre = $new_user->nick = 'p1'; */
		/* $new_user->password = 'contrasehna 11 '; */
		/* $new_user->email='p@localhost.com'; */

		if (
			$new_user->load(Yii::$app->request->post()) &&
			$new_user->validate()
		) {
			$new_user->save();
			return $this->render('//site/index', ['model' => $new_user]);
		} else {
			return $this->render('create', ['model' => $new_user]);
		}
	}

	function actionUpdate($id)
	{
		return $this->render('create', ['user' => User::findIdentity($id)]);
	}

	function actionGet($id)
	{
		return $this->render('get', ['user' => User::findIdentity($id)]);
	}

	function actionStorage()
	{
		$request = Yii::$app->request;
		if (!$request->isPut) {
			return $this->render('error');
		}

		$new_user = new User();
		/* $new_user->username = $request->post('name'); */
		/* $new_user->password = $request->post('pass'); */
		if ($new_user->load(Yii::$app->request->post())) {
			$this->responseJson($new_user);
		}
		$new_user->rool = $new_user->PROPIETARIO = true;
		if ($new_user->validate()) {
			return $this->responseJson($new_user);
		} else {
			return null;
		}
	}
}

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

		if (!$new_user->load(Yii::$app->request->post())) {
			return $this->render('create', [
				'model' => $new_user,
				'msg' => 'Error de guardado',
			]);
		}

		$new_user->confirmado = false;
		if (!$new_user->validate()) {
			return $this->responseJson([
				'msg' => 'Error en validacion',
				$new_user->getAttributes(),
			]);
		}

		if (!$new_user->save()) {
			return $this->render('site.index', [
				'model' => $new_user,
				'msg' => 'Error de guardado',
			]);
		}

		Yii::$app->response->statusCode = 201;
		return $this->render('//site/index', ['model' => $new_user]);
	}

	function actionUpdate($id)
	{
		return $this->render('create', ['user' => User::findIdentity($id)]);
	}

	function actionGet($id)
	{
		return $this->render('get', ['user' => User::findIdentity($id)]);
	}

	function actionDelete($id)
	{
		$delete = User::findOne($id);
		if ($delete != null) {
			$delete->delete();
			Yii::$app->response->statusCode = 202;
			return $this->render('index', ['msg' => 'Usuario Eliminado']);
		} else {
			Yii::$app->response->statusCode = 400;
			return $this->render('index', ['msg' => 'Error al eliminar']);
		}
	}
}

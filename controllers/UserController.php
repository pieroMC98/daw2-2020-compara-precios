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
	function actionLogout()
	{
		Yii::$app->user->logout();
		return $this->redirect(['site/index']);
	}

	function actionLogin()
	{
		if (($post = Yii::$app->request->post()) == null) {
			return $this->render('login', [
				'model' => new User(['scenario' => User::SCENARIO_LOGIN]),
			]);
		}

		$login = User::find()
			->where(['email' => $post['User']['email']])
			->one();

		$session = Yii::$app->session;
		if (!isset($session['count'])) {
			$session->set('count', 0);
		}

		if ($login == null) {
			return $this->render('login', [
				'msg' => 'mensaje de prueba',
				'model' => new User(['scenario' => User::SCENARIO_LOGIN]),
			]);
		}

			return $this->responseJson(function () {
				return ['Error' => 'error en la sesion'];
			});
		if ($login->validatePassword($post['User']['password']) == false) {
			$session['count'] = $session['count'] + 1;
			return $this->render('login', [
				'msg' => 'mensaje de prueba',
				'model' => new User(['scenario' => User::SCENARIO_LOGIN]),
			]);
		}

		if (!Yii::$app->user->login(User::findidentity($login->id))) {
			return $this->responseJson(function () {
				return ['Error' => 'error en la sesion'];
			});
		}

		return $this->redirect(['site/index']);
	}

	function actionCreate()
	{
		$new_user = new User();
		$new_user->scenario = User::SCENARIO_REGISTER;
		//$new_user->rool = User::$MODERADOR;
		/* $new_user->nombre = 'yp'; */
		/* $new_user->nick = 'nick de prueba'; */
		/* $new_user->apellidos = 'apellido de prueba'; */
		/* $new_user->direccion = 'calle false, numero 123'; */
		/* $new_user->email = 'yp@localhost.com'; */
		/* $new_user->fecha_nacimiento = 'Mar 2, 2021'; */
		/* $new_user->telefono_contacto = '3245344536'; */
		/* $new_user->password = 'password random'; */

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
			return $this->redirect('index', [
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

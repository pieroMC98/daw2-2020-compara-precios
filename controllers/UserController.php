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
		$new_user->nombre = 'yp';
		$new_user->nick = 'nick de prueba';
		$new_user->apellidos = 'apellido de prueba';
		$new_user->direccion = 'calle false, numero 123';
		$new_user->email = 'yp@localhost.com';
		$new_user->fecha_nacimiento = 'Mar 2, 2021';
		$new_user->telefono_contacto = '3245344536';
		$new_user->password = 'password random';

		/* $sql = "insert into usuarios(`nombre`, `password`, `nick`, `email`, `apellidos`, `direccion`, `telefono_contacto`, `fecha_nacimiento`,`confirmado` */
		/* ) values('yo', '123234523423432', 'p2','prueba@localhost.com','apellidos','direccion falsa n 3', 234234234234, 'Mat, 1 2021', false)"; */
		/* if( !Yii::$app->db->createCommand($sql)->execute()){ */
		/* 	echo $sql; */
		/* 	die(); */
		/* } */

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

		/* return $this->responseJson([ */
			/* 'msg' => 'datos', */
			/* $new_user->getAttributes(), */
		/* ]); */
		//return $this->responseJson(User::getDb());
		if (!$new_user->save()) {
			return $this->render('//site/index', [
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

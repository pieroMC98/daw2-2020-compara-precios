<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\User;
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
		$this->view->params['msg'] = '';
		if (($post = Yii::$app->request->post()) == null) {
			return $this->render('login', [
				'model' => new User(['scenario' => User::SCENARIO_LOGIN]),
			]);
		}

		$login = User::find()
			->where(['email' => $post['User']['email']])
			->one();
		$login->scenario = User::SCENARIO_LOGIN;

		if ($login->confirmado == false) {
			$this->view->params['msg'] = 'El usuario aun no ha sido confirmado';
			return $this->render('login', [
				'model' => new User(['scenario' => User::SCENARIO_LOGIN]),
			]);
		}

		$session = Yii::$app->session;
		if (!isset($session['count'])) {
			$session->set('count', 0);
		}

		if ($session['count'] >= 3 && $login->bloqueado != 1) {
			$time = new \DateTime('now', new \DateTimeZone('+1'));
			$login->bloqueado = 1;
			$login->fecha_bloqueo = $time->format('Y-m-d H:i:s');
			$login->save();
		}

		if ($login->bloqueado == 1) {
			$time = new \DateTime('now', new \DateTimeZone('+1'));
			$fecha_bloqueo = new \DateTime(
				$login->fecha_bloqueo,
				new \DateTimeZone('+1')
			);
			$fecha_bloqueo->modify('+5 minutes');
			if (
				$time->format('Y-m-d H:i:s') >
				$fecha_bloqueo->format('Y-m-d H:i:s')
			) {
				$session['count'] = 0;
				$login->bloqueado = 0;
				$login->save();
			}

			return $this->render('login', [
				'error' =>
					'Demasiados intentos fallidos. Intente de nuevo en 5 minutos.',
				'model' => new User(['scenario' => User::SCENARIO_LOGIN]),
			]);
		}

		if ($login == null) {
			return $this->render('login', [
				'msg' => 'No ha funcionado',
				'model' => new User(['scenario' => User::SCENARIO_LOGIN]),
			]);
		}

		if ($login->validatePassword($post['User']['password']) == false) {
			$session['count'] = $session['count'] + 1;
			$login->num_accesos = $session['count'];
			$login->save();
			return $this->render('login', [
				'msg' => 'Invalido',
				'model' => new User(['scenario' => User::SCENARIO_LOGIN]),
			]);
		}

		if ($login->confirmado == false) {
			return $this->render('login', [
				'msg' => 'Usuario no confirmado',
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

		$this->view->params['msg'] = '';
		if (!$new_user->load(Yii::$app->request->post())) {
			return $this->render('create', [
				'model' => $new_user,
				'msg' => 'Error de guardado',
			]);
		}

		$new_user->confirmado = false;
		if (!$new_user->validate()) {
			return $this->responseJson(function () use ($new_user) {
				return [
					'msg' => 'Error en validacion',
					$new_user->getAttributes(),
				];
			});
		}

		if (!$new_user->save()) {
			return $this->render('//site/index', [
				'model' => $new_user,
				'msg' => 'Error de guardado',
			]);
		}

		$this->view->params['msg'] = 'Su usuario será confirmado';
		Yii::$app->response->statusCode = 201;
		return $this->render('//site/index', [
			'msg' => '',
		]);
		$_POST['User'] = $new_user;
		$this->actionLogin();
	}

	function actionConfirmUser($id)
	{
		if ($user = User::findIdentity($id)) {
			$user->confirmado = true;
		}
		$user->update;
		return $this->render('../Usuarios/view');
	}

	function actionGet()
	{
		return $this->render('view', ['model' => Yii::$app->user->identity]);
	}

	function actionUpdate($id)
	{
		return $this->render('create', ['model' => User::findIdentity($id)]);
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
	public function actionAdmin()
	{
		return $this->render('admin');
	}

	public function actionUpdateRol($id, $opcion, $rol)
	{
		//Se crea un array con los roles para ascender o descender mas facilmente
		$roles = ['usuario', 'moderador', 'admin', 'sysadmin'];

		$auth = Yii::$app->authManager;

		$authorRole = $auth->getRole($rol);
		if ($authorRole == null) {
			//Aqui devuelvo una pagina de error. Excepcion de error de acceso
		}
		if ($auth->getAssignment($rol, $id) == null) {
			$auth->revokeAll($id);
			$auth->assign($authorRole, $id);
		}

		return $this->redirect(['user/admin']);
	}
}

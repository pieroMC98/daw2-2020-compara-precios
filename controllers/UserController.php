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
		if (($post = Yii::$app->request->post()) == null) {
			return $this->render('login', [
				'model' => new User(['scenario' => User::SCENARIO_LOGIN]),
			]);
		}

		$login = User::find()
			->where(['email' => $post['User']['email']])
			->one();

		$session = Yii::$app->session;
		if (!isset($session['count']) || $session['count'] == 3) {
			$session->set('count', 0);
		}

		if ($login == null) {
			return $this->render('login', [
				'msg' => 'mensaje de prueba',
				'model' => new User(['scenario' => User::SCENARIO_LOGIN]),
			]);
		}

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
		$_POST['User'] = $new_user;
		$this->actionLogin();
	}

	function actionGet()
	{
		return $this->render('view', ['model' => Yii::$app->user]);
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

		if ($opcion == 'ascender') {
			$authorRole = $auth->getRole($rol);
			if ($authorRole == null) {
				//Aqui devuelvo una pagina de error. Excepcion de error de acceso
			}
			if ($auth->getAssignment($rol, $id) == null) {
				$auth->revokeAll($id);
				$auth->assign($authorRole, $id);
			}
		}

		//crear la GRUD

		return $this->redirect(['user/admin']);
	}
}

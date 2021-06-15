<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\User;
use app\Traits\ApiResponse;
use yii\data\ActiveDataProvider;

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
		if ($login == null) {
			$this->view->params['msg'] = 'Usuario no encontrado';
			return $this->render('login', [
				'msg' => 'Usuario no encontrado',
				'model' => new User(['scenario' => User::SCENARIO_LOGIN]),
			]);
		}


		$login->scenario = User::SCENARIO_LOGIN;

		if ($login->confirmado == false) {
			$this->view->params['msg'] = 'El usuario aun no ha sido confirmado';
			return $this->render('login', [
				'msg' => 'Usuario no confirmado',
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
				'msg' =>
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
			return $this->render('create', [
				'msg' => 'Error en validacion',
				'model' => $new_user,
				$new_user->errors
			]);

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
		$elements = Yii::$app->user->identity->comentario();
		$provider = new ActiveDataProvider([
			'query' => $elements,
			'pagination' => [
				'pageSize' => 10,
			],
			'sort' => [
				'defaultOrder' => [
					//'created_at' => SORT_DESC,
					//'title' => SORT_ASC,
				]
			],
		]);
		return $this->render('view', ['model' => Yii::$app->user->identity, 'cm' => $provider]);

	}

	function actionUpdate($id)
	{
		$user = User::findIdentity($id);
		$user->scenario = User::SCENARIO_REGISTER;

		return $this->render('create', ['model' => $user]);
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

	function actionTienda()
	{
		$ower = Yii::$app->user->identity->tienda();
		$provider = new ActiveDataProvider([
			'query' => $ower,
			'pagination' => [
				'pageSize' => 10,
			],
			'sort' => [
				'defaultOrder' => [
					//'created_at' => SORT_DESC,
					//'title' => SORT_ASC,
				]
			],
		]);
		return $this->render('tienda', [
			'searchModel' => User::class,
			'dataProvider' => $provider
		]);
	}

	function actionArticulos()
	{
		$elements = Yii::$app->user->identity->articulo();
		$provider = new ActiveDataProvider([
			'query' => $elements,
			'pagination' => [
				'pageSize' => 10,
			],
			'sort' => [
				'defaultOrder' => [
					//'created_at' => SORT_DESC,
					//'title' => SORT_ASC,
				]
			],
		]);
		return $this->render('articulo', [
			'searchModel' => User::class,
			'dataProvider' => $provider
		]);
	}

	function actionComentario()
	{
		$elements = Yii::$app->user->identity->comentario();
		$provider = new ActiveDataProvider([
			'query' => $elements,
			'pagination' => [
				'pageSize' => 10,
			],
			'sort' => [
				'defaultOrder' => [
					//'created_at' => SORT_DESC,
					//'title' => SORT_ASC,
				]
			],
		]);
		return $this->render('comentario', [
			'searchModel' => User::class,
			'dataProvider' => $provider
		]);

	}
}

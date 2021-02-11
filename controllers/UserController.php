<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\LoginForm;
use yii\web\Request;


class UserController extends Controller
{

	function logout()
	{
	}

	function actionLogin()
	{
		return $this->render("login", ["model" => new LoginForm()]);
	}

	function actionCreate()
	{
		return $this->render('create');
	}

	function actionCargar(){
		$request = Yii::$app->request;
		$new_user = new User();
		$request->get("name");
	}
}

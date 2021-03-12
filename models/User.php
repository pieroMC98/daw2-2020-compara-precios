<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
	/* public $id; */
	/* public $nombre; */
	/* public $password; */
	public $r_password;
	public $rememberMe;
	/* public $email; public $nick; public $apellidos; */
	/* public $direccion; */
	/* public $region_id; */
	/* public $telefono_contacto; */
	/* public $fecha_nacimiento; */
	/* public $fecha_registro; */
	/* public $confirmado; */
	/* public $fecha_acceso; */
	/* public $num_accesos; */
	/* public $bloqueado; */
	/* public $fecha_bloqueo; */
	/* public $notas_bloqueo; */
	/* public $authKey; */
	/* public $accessToken; */

	/* static $MODERADOR = false; */
	/* static $PROPIETARIO = false; */
	/* static $ADMINISTRADOR = false; */
	/* public $rool; */

	const SCENARIO_LOGIN = 'login';
	const SCENARIO_REGISTER = 'register';

	public static function tableName()
	{
		return 'usuarios';
	}

	public function scenarios()
	{
		return [
			self::SCENARIO_LOGIN => ['id','email', 'password','rememberMe'],
			self::SCENARIO_REGISTER => [
				'nombre',
				'password',
				'nick',
				'email',
				'apellidos',
				'direccion',
				'telefono_contacto',
				'fecha_nacimiento',
				'r_password',
			],
		];
	}

	public function rules()
	{
		return [
			[['email', 'password', 'nombre'], 'required'],
			['email', 'email'],
			[
				'email',
				'unique',
				'targetClass' => 'app\models\User',
				'message' => 'Email ya existe',
			],
			['password', 'string', 'min' => 6],
			['r_password', 'required'],
			[
				'r_password',
				'compare',
				'compareAttribute' => 'password',
				'on' => 'register',
				'message' => 'contrasena no coinciden',
			],
		];
	}

	/* function isAdmin() */
	/* { */
	/* 	return self::$ADMINISTRADOR; */
	/* } */

	/* function isPropietario() */
	/* { */
	/* 	return self::$PROPIETARIO; */
	/* } */

	/* function isModerador() */
	/* { */
	/* 	return self::$MODERADOR; */
	/* } */

	public function behaviors()
	{
		return [
			[
				'class' => TimestampBehavior::class,
				'createdAtAttribute' => 'fecha_registro',
				'updatedAtAttribute' => false,
				'value' => new Expression('NOW()'),
			],
		];
	}


	/**
	 * {@inheritdoc}
	 */
	public static function findIdentity($id)
	{
		return static::findOne($id);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function findIdentityByAccessToken($token, $type = null)
	{
		foreach (self::$users as $user) {
			if ($user['accessToken'] === $token) {
				return new static($user);
			}
		}

		return null;
	}

	/**
	 * Finds user by username
	 *
	 * @param string $username
	 * @return static|null
	 */
	public static function findByUsername($username)
	{
		foreach (self::$users as $user) {
			if (strcasecmp($user['username'], $username) === 0) {
				return new static($user);
			}
		}

		return null;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getAuthKey()
	{
		return $this->authKey;
	}

	/**
	 * {@inheritdoc}
	 */
	public function validateAuthKey($authKey)
	{
		return $this->authKey === $authKey;
	}

	/**
	 * Validates password
	 *
	 * @param string $password password to validate
	 * @return bool if password provided is valid for current user
	 */
	public function validatePassword($password)
	{
		return $this->password === $password;
	}
}

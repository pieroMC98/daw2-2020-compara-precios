<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\IdentityInterface;


class User extends ActiveRecord implements IdentityInterface
{
	public $r_password;
	public $rememberMe;

	const SCENARIO_LOGIN = 'login';
	const SCENARIO_REGISTER = 'register';

	public static function tableName()
	{
		return 'usuarios';
	}

	public function scenarios()
	{
		return [
			self::SCENARIO_LOGIN => [
				'id',
				'email',
				'password',
				'rememberMe',
				'bloqueado',
				'num_accesos',
			],
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
			['fecha_nacimiento', 'date', 'format' => 'yyyy-MM-dd'],
		];
	}

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
		foreach (self::find()->all() as $user) {
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
		foreach (self::find()->all() as $user) {
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

	public function getRol()
	{
		$auth = Yii::$app->authManager;
		if ($auth == null) return null;
		$roles = $auth->getAssignments($this->id);
		if ($roles == null) return null;
		if (count($roles) > 0) {
			return array_keys($roles)[0];
		} else {
			return null;
		}
	}
	//atributo virtual para rescribir
	//Set roles
	//comparar si lo que escribe es un role valido
	//si es valido implementarlo
	//revocar el anterior.

	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'email' => 'Email',
			'password' => 'Password',
			'r_password' => 'Repetir password',
			'nick' => 'Nick',
			'nombre' => 'Nombre',
			'apellidos' => 'Apellidos',
			'direccion' => 'Direccion',
			'region_id' => 'Region ID',
			'telefono_contacto' => 'Telefono Contacto',
			'fecha_nacimiento' => 'Fecha Nacimiento',
			'fecha_registro' => 'Fecha Registro',
			'confirmado' => 'Confirmado',
			'fecha_acceso' => 'Fecha Acceso',
			'num_accesos' => 'Num Accesos',
			'bloqueado' => 'Bloqueado',
			'fecha_bloqueo' => 'Fecha Bloqueo',
			'notas_bloqueo' => 'Notas Bloqueo',
		];
	}

	function tienda()
	{
		return $this->hasMany(Tiendas::class, ['usuario_id' => 'id']);
	}
}

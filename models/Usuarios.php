<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $id
 * @property string $email Correo Electronico y "login" principal del usuario. Debe ser único.
 * @property string $password
 * @property string $nick Identificador del usuario y posible "login" secundario. Debe ser único.
 * @property string|null $nombre Nombre de la persona.
 * @property string|null $apellidos Apellidos de la persona.
 * @property string|null $direccion Direccion de la persona o NULL si no quiere informar o no se conoce.
 * @property int|null $region_id Región de localización de la persona o CERO si no lo quiere informar (como si fuera NULL), aunque es recomendable, y necesario para comentar.
 * @property string|null $telefono_contacto Telefono de contacto directo con la persona o NULL si no lo quiere informar, no se sabe o no hay.
 * @property string|null $fecha_nacimiento Fecha de nacimiento de la persona o NULL si no lo quiere informar.
 * @property string|null $fecha_registro Fecha y Hora de registro del usuario o NULL si no se conoce por algún motivo (que no debería ser así).
 * @property int $confirmado Indicador de que el usuario ha confirmado su registro o no.
 * @property string|null $fecha_acceso Fecha y Hora del ultimo acceso del usuario. Debería estar a NULL si no ha accedido nunca.
 * @property int $num_accesos Contador de accesos fallidos del usuario o CERO si no ha tenido o se ha reiniciado por un acceso valido o por un administrador.
 * @property int $bloqueado Indicador de usuario bloqueado: 0=No, 1=Si(bloqueado por accesos), 2=Si(bloqueado por administrador), ...
 * @property string|null $fecha_bloqueo Fecha y Hora del bloqueo del usuario. Debería estar a NULL si no está bloqueado o si se desbloquea.
 * @property string|null $notas_bloqueo Notas visibles sobre el motivo del bloqueo del usuario o NULL si no hay -se muestra por defecto según indique "bloqueado"-.
 */


class Usuarios extends \yii\db\ActiveRecord
{
    private $_rol;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password', 'nick', 'confirmado'], 'required'],
            [['direccion', 'notas_bloqueo'], 'string'],
            [['region_id', 'confirmado', 'num_accesos', 'bloqueado'], 'integer'],
            [['fecha_nacimiento', 'fecha_registro', 'fecha_acceso', 'fecha_bloqueo'], 'safe'],
            [['email'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 60],
            [['nick', 'telefono_contacto'], 'string', 'max' => 25],
            [['nombre'], 'string', 'max' => 100],
            [['apellidos'], 'string', 'max' => 150],
            [['rol'], 'in', 'range' => self::lista_roles()],
            [['email'], 'unique'],
            [['nick'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function lista_roles()
    {
        return ['usuario' => 'usuario', 'propietario' => 'propietario', 'moderador' => 'moderador', 'admin' => 'admin', 'sysadmin' => 'sysadmin'];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
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

    public function getRol()
    {
        if (empty($this->_rol)) {
            $auth = Yii::$app->authManager;
            $roles = $auth->getAssignments($this->id);

            if (count($roles) > 0) {
                $this->_rol = array_keys($roles)[0];
            } else {
                $this->_rol = NULL;
            }
        }
        return $this->_rol;
    }

    public function setRol($rol)
    {

        $this->_rol = $rol;
    }
    public function save($runValidation = true, $attributeNames = null)
    {
        $ok = parent::save($runValidation, $attributeNames);
        if ($ok) {
            $auth = Yii::$app->authManager;

            $authorRole = $auth->getRole($this->_rol);
            if ($authorRole == null) {
                $ok = false;
                $this->addError('rol', 'El rol no es valido');
            } else if ($auth->getAssignment($this->_rol, $this->id) == null) {
                $auth->revokeAll($this->id);
                $auth->assign($authorRole, $this->id);
            }
        }
        return $ok;
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "avisos_usuarios".
 *
 * @property int $id
 * @property string $fecha_aviso Fecha y Hora de creación del aviso.
 * @property string $clase_aviso Código de clase de aviso (fijado desde programación): A=Aviso, N=Notificación, D=Denuncia, C=Consulta, B=Bloqueo, M=Mensaje Genérico,...
 * @property string|null $texto Texto con el mensaje de aviso.
 * @property int|null $destino_usuario_id Usuario relacionado, destinatario del aviso, o CERO si es para administración y aún no está aceptado/gestionado.
 * @property int|null $origen_usuario_id Usuario relacionado, origen del aviso, o CERO si es del sistema o de un administrador sin identificar.
 * @property int|null $tienda_id Tienda relacionada con el aviso, o CERO si no tiene que ver.
 * @property int|null $articulo_id Artículo relacionado con el aviso o CERO si no tiene que ver.
 * @property int|null $comentario_id Comentario relacionado con el aviso o NULL si no tiene que ver.
 * @property string|null $fecha_lectura Fecha y Hora de lectura del aviso o NULL si no se ha leido o se ha desmarcado como tal.
 * @property string|null $fecha_aceptado Fecha y Hora de aceptación del aviso o NULL si no se ha aceptado para su gestión por un moderador o administrador. No se usa en otros usuarios.
 */
class AvisosUsuarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'avisos_usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha_aviso'], 'required'],

            [['fecha_aviso', 'fecha_lectura', 'fecha_aceptado', 'nombre_tienda'], 'safe'],

            [['texto'], 'string'],
            [['destino_usuario_id', 'origen_usuario_id', 'tienda_id', 'articulo_id', 'comentario_id'], 'integer'],
            [['clase_aviso'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',

            'fecha_aviso' => 'Fecha de aviso',
            'clase_aviso' => 'Clase de aviso',
            'texto' => 'Texto',
            'destino_usuario_id' => 'Usuario destino',
            'origen_usuario_id' => 'Usuario origen',
            'tienda_id' => 'Tienda',
            'articulo_id' => 'Artículo',
            'comentario_id' => 'Comentario',
            'fecha_lectura' => 'Fecha de lectura',
            'fecha_aceptado' => 'Fecha de aceptación',
        ];
    }

    public static function getClaseAviso()
    {
        return [
            'A' => 'Aviso', 
            'N' => 'Notificación', 
            'D' => 'Denuncia', 
            'C' => 'Consulta', 
            'B' => 'Bloqueo', 
            'M' => 'Mensaje'
    ];
    }

    public static function getClaseAvisoIcono()
    {
        return [ 
            'A' => \yii\helpers\Html::a('<i class="bi bi-exclamation-circle-fill"></i>'), 
            'N' => \yii\helpers\Html::a('<i class="bi bi-bell-fill"></i>'), 
            'D' => \yii\helpers\Html::a('<i class="bi bi-exclamation-triangle-fill"></i>'), 
            'C' => \yii\helpers\Html::a('<i class="bi bi-question-circle-fill"></i>'), 
            'B' => \yii\helpers\Html::a('<i class="bi bi-x-octagon-fill"></i>'), 
            'M' => \yii\helpers\Html::a('<i class="bi bi-chat-left-text-fill"></i>'), 
        ];
    }

    public function getNombreUsuarioDestino()
    {
        return $this->hasOne(User::className(), ['id' => 'destino_usuario_id']);
    }

    public function getNombreUsuarioOrigen()
    {
        return $this->hasOne(User::className(), ['id' => 'origen_usuario_id']);
    }

    public function getNombre_tienda()
    {
        return $this->hasOne(Tiendas::className(), ['id' => 'tienda_id']);
    }
}

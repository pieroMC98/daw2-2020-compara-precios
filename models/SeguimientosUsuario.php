<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "seguimientos_usuario".
 *
 * @property int $id
 * @property int $usuario_id Usuario relacionado, seguidor de la tienda, o el artículo o la oferta indicada. Al menos uno de los IDs no debe ser CERO.
 * @property int $tienda_id Tienda relacionada con el seguimiento, o CERO si no se sigue a una tienda.
 * @property int $articulo_id Artículo relacionado con el seguimiento o CERO si no se sigue a un artículo.
 * @property int $oferta_id Oferta relacionada con el seguimiento o CERO si no se sigue a una oferta.
 * @property string $fecha_alta Fecha y Hora de activación del seguimiento por parte del usuario.
 */
class SeguimientosUsuario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seguimientos_usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'fecha_alta'], 'required'],
            [['usuario_id', 'tienda_id', 'articulo_id', 'oferta_id'], 'integer'],
            [['fecha_alta'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario ID',
            'tienda_id' => 'Tienda ID',
            'articulo_id' => 'Articulo ID',
            'oferta_id' => 'Oferta ID',
            'fecha_alta' => 'Fecha Alta',
        ];
    }

    /**
     * {@inheritdoc}
     * @return SeguimientosUsuarioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SeguimientosUsuarioQuery(get_called_class());
    }
}

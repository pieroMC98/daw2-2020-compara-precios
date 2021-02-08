<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ofertas".
 *
 * @property int $id
 * @property int $articulo_id Artículo relacionado.
 * @property int $tienda_id Tienda relacionada.
 * @property string $texto El texto o descripción de la oferta.
 * @property string|null $fecha_desde Fecha y Hora de inicio de la oferta o NULL si no se conoce (mostrar como *próximamente* en función de la fecha de creación del registro).
 * @property string|null $fecha_hasta Fecha y Hora de finalización de la oferta o NULL si no se conoce (no caduca automáticamente).
 * @property float $precio_oferta Precio del artículo durante el intervalo de tiempo de la oferta.
 * @property float $precio_original Precio del artículo copiado antes de comenzar el intervalo de tiempo de la oferta.
 * @property int|null $crea_usuario_id Usuario que ha creado el registro o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.
 * @property string|null $crea_fecha Fecha y Hora de creación del registro o NULL si no se conoce por algún motivo.
 * @property int|null $modi_usuario_id Usuario que ha modificado el registro por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.
 * @property string|null $modi_fecha Fecha y Hora de la última modificación del registro o NULL si no se conoce por algún motivo.
 * @property string|null $notas_admin Notas adicionales que solo ven/modifican los moderadores/administradores sobre los datos del regsitro o NULL si no hay.
 */
class Oferta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ofertas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['articulo_id', 'tienda_id', 'texto'], 'required'],
            [['articulo_id', 'tienda_id', 'crea_usuario_id', 'modi_usuario_id'], 'integer'],
            [['texto', 'notas_admin'], 'string'],
            [['fecha_desde', 'fecha_hasta', 'crea_fecha', 'modi_fecha'], 'safe'],
            [['precio_oferta', 'precio_original'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'articulo_id' => 'Articulo ID',
            'tienda_id' => 'Tienda ID',
            'texto' => 'Texto',
            'fecha_desde' => 'Fecha Desde',
            'fecha_hasta' => 'Fecha Hasta',
            'precio_oferta' => 'Precio Oferta',
            'precio_original' => 'Precio Original',
            'crea_usuario_id' => 'Crea Usuario ID',
            'crea_fecha' => 'Crea Fecha',
            'modi_usuario_id' => 'Modi Usuario ID',
            'modi_fecha' => 'Modi Fecha',
            'notas_admin' => 'Notas Admin',
        ];
    }

    /**
     * {@inheritdoc}
     * @return OfertasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OfertasQuery(get_called_class());
    }
}

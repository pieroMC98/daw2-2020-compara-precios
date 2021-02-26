<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clasificadores".
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $descripcion Texto adicional que describe el clasificador o NULL si no es necesario.
 * @property string|null $icono Nombre del icono relacionado de entre los disponibles en la aplicación (carpeta iconos posibles).
 */
class Clasificadores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clasificadores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string'],
            [['nombre', 'icono'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'icono' => 'Icono',
        ];
    }
}

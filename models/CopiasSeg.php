<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "copias_seg".
 *
 * @property int $id Clave para identificar las copias de seguridad, autoincrementada
 * @property string|null $fecha fecha de realización de la copia de seguridad
 * @property string|null $ruta ruta en la que se guarda la copia
 */
class CopiasSeg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'copias_seg';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha'], 'safe'],
            [['ruta'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fecha' => 'Fecha',
            'ruta' => 'Ruta',
        ];
    }
    
    public function buscaRuta($id)
	{
        return $this->ruta;		
	}

    /**
     * {@inheritdoc}
     * @return CopiasSegQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CopiasSegQuery(get_called_class());
    }
}

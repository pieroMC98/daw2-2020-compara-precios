<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "configuraciones".
 *
 * @property string $clave
 * @property string|null $valor
 */
class Configuraciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'configuraciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clave'], 'required'],
            [['valor'], 'string'],
            [['clave'], 'string', 'max' => 50],
            [['clave'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'clave' => 'Clave',
            'valor' => 'Valor',
        ];
    }
}

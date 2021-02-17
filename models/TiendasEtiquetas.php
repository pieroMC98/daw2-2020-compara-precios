<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tiendas_etiquetas".
 *
 * @property int $id
 * @property int $tienda_id Tienda relacionada.
 * @property int $etiqueta_id Etiqueta relacionada.
 */
class TiendasEtiquetas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tiendas_etiquetas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tienda_id', 'etiqueta_id'], 'required'],
            [['tienda_id', 'etiqueta_id'], 'integer'],
        ];
    }

    public function getTiendas()
    {
        return $this->hasMany(TiendasEtiquetas::className(), [ 'id' => 'tienda_id'])->inverseOf('etiquetas');
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tienda_id' => 'Tienda ID',
            'etiqueta_id' => 'Etiqueta ID',
        ];
    }

    /**
     * {@inheritdoc}
     * @return TiendasEtiquetasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TiendasEtiquetasQuery(get_called_class());
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "articulos_etiquetas".
 *
 * @property int $id
 * @property int $articulo_id Artículo relacionado.
 * @property int $etiqueta_id Etiqueta relacionada.
 */
class ArticulosEtiquetas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articulos_etiquetas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['articulo_id', 'etiqueta_id'], 'required'],
            [['articulo_id', 'etiqueta_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'articulo_id' => 'Artículo relacionado.',
            'etiqueta_id' => 'Etiqueta relacionada.',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ArticulosEtiquetasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ArticulosEtiquetasQuery(get_called_class());
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categorias".
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $descripcion Texto adicional que describe la categoria.
 * @property string|null $icono Nombre del icono relacionado de entre los disponibles en la aplicación (carpeta iconos posibles).
 * @property int|null $categoria_id Categoria relacionada, para poder realizar la jerarquía de categorías. Nodo padre de la jerarquía de categoría, o CERO si es nodo raiz (como si fuera NULL).
 */
class Categorias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categorias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string'],
            [['categoria_id'], 'integer'],
            [['nombre', 'icono'], 'string', 'max' => 25],
        ];
    }

    public function getArticulos()
    {
        return $this->hasMany(Articulos::className(), [ 'categoria_id' => 'id' ])->inverseOf('categorias');
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
            'categoria_id' => 'Categoria ID',
        ];
    }

    

    /**
     * {@inheritdoc}
     * @return CategoriasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoriasQuery(get_called_class());
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "articulos".
 *
 * @property int $id
 * @property string $nombre Nombre o denominación para el artículo.
 * @property string|null $descripcion Descripción breve del artículo o NULL si no es necesaria.
 * @property int|null $categoria_id Categoria de clasificación del artículo o CERO si no existe o aún no está indicada (como si fuera NULL).
 * @property string|null $imagen_id Nombre identificativo (fichero interno) con la imagen principal o "de presentación" del artículo, o NULL si no hay.
 * @property int $visible Indicador de artículo visible a los usuarios o invisible (se está manteniendo o está desactivado por otras causas): 0=Invisible, 1=Visible.
 * @property int $cerrado Indicador de artículo cancelado, eliminado o suspendido: 0=No (activo), 1=Eliminado por solicitud de baja, 2=Suspendido, 3=Cancelado por Inadecuado, ...
 * @property int $comun Indicador de artículo común a cualquier tienda que lo relacione o particular de una tienda, creado o marcado así por un moderador/administrador: 0=Particular, 1=Comun. Habrá un proceso que pueda convertir un artículo particular en común.
 * @property int|null $crea_usuario_id Usuario que ha creado el registro o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.
 * @property string|null $crea_fecha Fecha y Hora de creación del registro o NULL si no se conoce por algún motivo.
 * @property int|null $modi_usuario_id Usuario que ha modificado el registro por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.
 * @property string|null $modi_fecha Fecha y Hora de la última modificación del registro o NULL si no se conoce por algún motivo.
 * @property string|null $notas_admin Notas adicionales que solo ven/modifican los moderadores/administradores sobre los datos del regsitro o NULL si no hay.
 */
class Articulos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articulos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre', 'descripcion', 'notas_admin'], 'string'],
            [['categoria_id', 'visible', 'cerrado', 'comun', 'crea_usuario_id', 'modi_usuario_id'], 'integer'],
            [['crea_fecha', 'modi_fecha'], 'safe'],
            [['imagen_id'], 'string', 'max' => 25],
        ];
    }

    public function getEtiquetas()
    {
        return $this->hasMany(ArticulosEtiquetas::className(), ['articulo_id' => 'id'])->inverseOf('articulos');
    }

    public function getEtiquetaId()
    {
        if($this->etiquetas!==null){

            return $this->etiquetas->etiqueta_id;
        }

        return null;		
    }

    public function getCategorias()
    {
        return $this->hasOne(Categorias::className(), ['id' => 'categoria_id'])->inverseOf('articulos');
    }

    public function getCategoriaNombre()
    {
        if($this->categorias!==null){

            return $this->categorias->nombre;
        }

        return null;		
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
            'categoria_id' => 'Categoria ID',
            'imagen_id' => 'Imagen ID',
            'visible' => 'Visible',
            'cerrado' => 'Cerrado',
            'comun' => 'Comun',
            'crea_usuario_id' => 'Crea Usuario ID',
            'crea_fecha' => 'Crea Fecha',
            'modi_usuario_id' => 'Modi Usuario ID',
            'modi_fecha' => 'Modi Fecha',
            'notas_admin' => 'Notas Admin',
        ];
    }
}

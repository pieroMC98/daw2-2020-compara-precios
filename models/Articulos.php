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

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {   // aqui hay que poner un if o algo para sacar el texto no el intger
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripción breve',
            'categoria_id' => 'Categoria ',
            'imagen_id' => 'imagen',
            'visible' => 'Visibilidad',
            'cerrado' => 'Estado del artículo',
            'comun' => 'Artículo común o particular',
            'crea_usuario_id' => 'Usuario propietario',
            'crea_fecha' => 'Fecha y Hora de creación',
            'modi_usuario_id' => 'Usuario que ha modificado ',
            'modi_fecha' => 'Fecha y Hora de la última modificación ',
            'notas_admin' => 'Notas adicionales',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ArticulosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ArticulosQuery(get_called_class());
    }

    public static function get_estados(){

       return [ 0 => 'Activo', 1 => 'Suspendido',  2 => 'Eliminado', 3 => 'Cancelado por inadecuado'];
        
    }

    public static function get_comun(){

        return [ 0 => 'Particular', 1 => 'Común'];
         
     }

     public static function get_visibilidad(){

        return [ 0 => 'Invisible', 1 => 'visible'];
         
     }

     public function get_nombre_categoria(){

        $cargarCategorias = \yii\helpers\ArrayHelper::map(Categorias::find()->all(), 'id', 'nombre');

        return $cargarCategorias[$this->categoria_id]; 
     }
     public static function get_categorias_de_una_vez(){
       return \yii\helpers\ArrayHelper::map(Categorias::find()->all(), 'id', 'nombre');
     }



}

/*
Switch(cerrado){
    case '0': text= 'Activo';break;
    case '1': text= 'Eliminado';break;
    case '2': text= 'Suspendido';break;
    case '3': text= 'Cancelado po inadecuado';break;
}

Switch(comun){
    case '0': text='Particular';break
    case '1': text='Comun';break;
}

Switch(visible){
    case '0': text='invisible';break;
    case '1': text='Visible';break;
}

/* Toda la informacion de los campos con los comentarios
'id' => 'ID',
            'nombre' => 'Nombre o denominación para el artículo.',
            'descripcion' => 'Descripción breve del artículo o NULL si no es necesaria.',
            'categoria_id' => 'Categoria de clasificación del artículo o CERO si no existe o aún no está indicada (como si fuera NULL).',
            'imagen_id' => 'Nombre identificativo (fichero interno) con la imagen principal o \"de presentación\" del artículo, o NULL si no hay.',
            'visible' => 'Indicador de artículo visible a los usuarios o invisible (se está manteniendo o está desactivado por otras causas): 0=Invisible, 1=Visible.',
            'cerrado' => 'Indicador de artículo cancelado, eliminado o suspendido: 0=No (activo), 1=Eliminado por solicitud de baja, 2=Suspendido, 3=Cancelado por Inadecuado, ...',
            'comun' => 'Indicador de artículo común a cualquier tienda que lo relacione o particular de una tienda, creado o marcado así por un moderador/administrador: 0=Particular, 1=Comun. Habrá un proceso que pueda convertir un artículo particular en común.',
            'crea_usuario_id' => 'Usuario que ha creado el registro o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
            'crea_fecha' => 'Fecha y Hora de creación del registro o NULL si no se conoce por algún motivo.',
            'modi_usuario_id' => 'Usuario que ha modificado el registro por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.',
            'modi_fecha' => 'Fecha y Hora de la última modificación del registro o NULL si no se conoce por algún motivo.',
            'notas_admin' => 'Notas adicionales que solo ven/modifican los moderadores/administradores sobre los datos del regsitro o NULL si no hay.',

        */
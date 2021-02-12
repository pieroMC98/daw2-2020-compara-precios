<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "articulos_tienda".
 *
 * @property int $id
 * @property int|null $articulo_id Artículo relacionado o CERO (como si fuera NULL) si no existe o aún no está indicado, aunque no debería ser así.
 * @property int|null $tienda_id Tienda a la que pertenece el artículo relacionado o CERO (como si fuera NULL) si no existe o aún no está indicada, aunque no debería ser así.
 * @property string|null $imagen_id Nombre identificativo (fichero interno) con la imagen opcional del artículo, o NULL si no hay, mostrándose en este caso la imagen principal que pueda tener el artículo.
 * @property string|null $url_articulo Dirección web externa (opcional) que enlaza con la página "oficial" de la tienda+artículo o NULL si no hay o no se conoce.
 * @property float $precio Precio actual del artículo en la tienda.
 * @property int $sumaValores Suma acumulada de las valoraciones para el artículo en la tienda.
 * @property int $totalVotos Contador de votos (valoraciones) emitidas para el artículo en la tienda.
 * @property int $visible Indicador de artículo visible a los usuarios o invisible (se está manteniendo o está desactivado por otras causas): 0=Invisible, 1=Visible.
 * @property int $cerrado Indicador de artículo cancelado, eliminado o suspendido: 0=No (activo), 1=Eliminado por solicitud de baja, 2=Suspendido, 3=Cancelado por Inadecuado, ...
 * @property int $num_denuncias Contador de denuncias del artículo en la tienda o CERO si no ha tenido.
 * @property string|null $fecha_denuncia1 Fecha y Hora de la primera denuncia. Debería estar a NULL si no tiene denuncias (contador a cero), o si el contador se reinicia.
 * @property string|null $notas_denuncia Notas o texto visible con el motivo de la primera denuncia del artículo o NULL si no hay -se muestra este campo según el estado de "bloqueado"-.
 * @property int $bloqueado Indicador de artículo bloqueado: 0=No, 1=Si(bloqueado por denuncias), 2=Si(bloqueado por moderador o administrador), ...
 * @property string|null $fecha_bloqueo Fecha y Hora del bloqueo del artículo. Debería estar a NULL si no está bloqueado o si se desbloquea.
 * @property string|null $notas_bloqueo Notas visibles sobre el motivo del bloqueo del artículo o NULL si no hay -se muestra por defecto según indique "bloqueado"-.
 * @property int $cerrado_comentar Indicador de artículo cerrado para agregar comentarios: 0=No, 1=Si.
 * @property int|null $crea_usuario_id Usuario que ha creado el registro o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.
 * @property string|null $crea_fecha Fecha y Hora de creación del registro o NULL si no se conoce por algún motivo.
 * @property int|null $modi_usuario_id Usuario que ha modificado el registro por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.
 * @property string|null $modi_fecha Fecha y Hora de la última modificación del registro o NULL si no se conoce por algún motivo.
 * @property string|null $notas_admin Notas adicionales que solo ven/modifican los moderadores/administradores sobre los datos del regsitro o NULL si no hay.
 */
class ArticulosTienda extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articulos_tienda';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['articulo_id', 'tienda_id', 'sumaValores', 'totalVotos', 'visible', 'cerrado', 'num_denuncias', 'bloqueado', 'cerrado_comentar', 'crea_usuario_id', 'modi_usuario_id'], 'integer'],
            [['url_articulo', 'notas_denuncia', 'notas_bloqueo', 'notas_admin'], 'string'],
            [['precio'], 'number'],
            [['fecha_denuncia1', 'fecha_bloqueo', 'crea_fecha', 'modi_fecha'], 'safe'],
            [['imagen_id'], 'string', 'max' => 25],
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
            'imagen_id' => 'Imagen ID',
            'url_articulo' => 'Url Articulo',
            'precio' => 'Precio',
            'sumaValores' => 'Suma Valores',
            'totalVotos' => 'Total Votos',
            'visible' => 'Visible',
            'cerrado' => 'Cerrado',
            'num_denuncias' => 'Num Denuncias',
            'fecha_denuncia1' => 'Fecha Denuncia1',
            'notas_denuncia' => 'Notas Denuncia',
            'bloqueado' => 'Bloqueado',
            'fecha_bloqueo' => 'Fecha Bloqueo',
            'notas_bloqueo' => 'Notas Bloqueo',
            'cerrado_comentar' => 'Cerrado Comentar',
            'crea_usuario_id' => 'Crea Usuario ID',
            'crea_fecha' => 'Crea Fecha',
            'modi_usuario_id' => 'Modi Usuario ID',
            'modi_fecha' => 'Modi Fecha',
            'notas_admin' => 'Notas Admin',
            'nomTienda' => 'Nombre Tienda',
            'nomArticulo' => 'Nombre Articulo',
            'artBloqueado' => 'Bloqueado',
            'artVisible' => 'Visible',
        ];
    }

    public function getTiendas(){

    	return $this->hasOne(Tiendas::className(),['id' => 'tienda_id']);

    }

    public function getNomTienda(){

    	return $this->tiendas->nombre_tienda;

    }

   	public function getArticulos(){

		return $this->hasOne(Articulos::className(),['id' => 'articulo_id']);

	}

    public function getNomArticulo(){

        if($this->articulos!==null){

            return $this->articulos->nombre;
        }

        return null;		

    }

    public function getArtVisible(){

    	if($this->visible==0){
    		return 'Invisible';
    	}else{
    		return 'Visible';
    	}

    }

    public function getArtBloqueado(){

    	if($this->bloqueado==0){
    		return 'No';
    	}else if($this->bloqueado==1){
    		return 'Bloqueado por denuncias';
    	}else{
    		return 'Bloqueado por Administrador';
    	}	

    }
}

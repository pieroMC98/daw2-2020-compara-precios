<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comentarios".
 *
 * @property int $id
 * @property int $tienda_id Tienda relacionada con el comentario, siempre habrá alguna.
 * @property int $articulo_id Artículo relacionado con el comentario o CERO si el comentario es sólo de tienda.
 * @property int $valoracion Valoración dada a la tienda o al artículo en el comentario. El valor mínimo y máximo se pueden fijar por programación o configurado en la aplicación.
 * @property string $texto El texto del comentario. Poner un límite por programación o configurado en la aplicación.
 * @property int|null $comentario_id Comentario relacionado, si se permiten encadenar respuestas. Nodo padre de la jerarquia de comentarios o CERO si es nodo raiz.
 * @property int $cerrado Indicador de cierre de respuestas al comentario: 0=No, 1=Si(No se puede responder al comentario)
 * @property int $num_denuncias Contador de denuncias del comentario o CERO si no ha tenido.
 * @property string|null $fecha_denuncia1 Fecha y Hora de la primera denuncia. Debería estar a NULL si no tiene denuncias (contador a cero), o si el contador se reinicia.
 * @property string|null $notas_denuncia Notas o texto visible con el motivo de la primera denuncia del comentario o NULL si no hay -se muestra este campo según el estado de "bloqueado"-.
 * @property int $bloqueado Indicador de comentario bloqueado: 0=No, 1=Si(bloqueado por denuncias), 2=Si(bloqueado por administrador), ...
 * @property string|null $fecha_bloqueo Fecha y Hora del bloqueo del comentario. Debería estar a NULL si no está bloqueado o si se desbloquea.
 * @property string|null $notas_bloqueo Notas visibles sobre el motivo del bloqueo del comentario o NULL si no hay -se muestra por defecto según indique "bloqueado"-.
 * @property int|null $crea_usuario_id Usuario que ha creado el registro o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.
 * @property string|null $crea_fecha Fecha y Hora de creación del registro o NULL si no se conoce por algún motivo.
 * @property int|null $modi_usuario_id Usuario que ha modificado el registro por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.
 * @property string|null $modi_fecha Fecha y Hora de la última modificación del registro o NULL si no se conoce por algún motivo.
 * @property string|null $notas_admin Notas adicionales que solo ven/modifican los moderadores/administradores sobre los datos del regsitro o NULL si no hay.
 */
class Comentarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tienda_id', 'texto', 'valoracion'], 'required'],
            [['tienda_id', 'articulo_id', 'valoracion', 'comentario_id', 'cerrado', 'num_denuncias', 'bloqueado', 'crea_usuario_id', 'modi_usuario_id'], 'integer'],
            [['texto', 'notas_denuncia', 'notas_bloqueo', 'notas_admin'], 'string'],
            [['fecha_denuncia1', 'fecha_bloqueo', 'crea_fecha', 'modi_fecha'], 'safe'],
            [['fecha_denuncia1','notas_denuncia', 'fecha_bloqueo', 'notas_bloqueo', 'modi_usuario_id', 'modi_fecha','notas_admin'], 'default', 'value' => NULL],
            [['articulo_id','comentario_id', 'cerrado', 'num_denuncias', 'bloqueado', 'crea_usuario_id'], 'default', 'value' => 0],
            //[['crea_fecha'],'default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tienda_id' => 'Tienda ID',
            'articulo_id' => 'Articulo ID',
            'valoracion' => 'Valoracion',
            'texto' => 'Texto',
            'comentario_id' => 'Comentario ID',
            'cerrado' => 'Cerrado',
            'num_denuncias' => 'Num Denuncias',
            'fecha_denuncia1' => 'Fecha Denuncia1',
            'notas_denuncia' => 'Notas Denuncia',
            'bloqueado' => 'Bloqueado',
            'fecha_bloqueo' => 'Fecha Bloqueo',
            'notas_bloqueo' => 'Notas Bloqueo',
            'crea_usuario_id' => 'Crea Usuario ID',
            'crea_fecha' => 'Crea Fecha',
            'modi_usuario_id' => 'Modi Usuario ID',
            'modi_fecha' => 'Modi Fecha',
            'notas_admin' => 'Notas Admin',
            'nomTienda' => 'Nombre Tienda',
            'nomArticulo' => 'Nombre Articulo',
            'nickCreador' => 'Nick Usuario Creador',
            'nickModificador' => 'Nick Usuario Modificador',
            'comBloqueado' => 'Bloqueado',
            'comentariosCerrado' => 'Cerrado',
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

		return $this->articulos->nombre;

    }

    public function getUsuarios(){

		return $this->hasOne(Usuarios::className(),['id' => 'crea_usuario_id']);

	}

    public function getNickCreador(){

		return $this->usuarios->nick;

    }

     public function getUsuariosModif(){

		return $this->hasOne(Usuarios::className(),['id' => 'modi_usuario_id']);

	}

    public function getNickModif(){

		return $this->usuariosModif->nick;

    }

    public function deleteComentario(){

        $this->valoracion=0;
        $this->texto = "Este comentario ha sido eliminado.";
        $this->cerrado = 1;
        $this->save();
    }

    public function getComentariosCerrado(){

        if($this->cerrado==0){
            return 'No';
        }else{
            return 'Si';
        }

    }

    public function getComBloqueado(){

        if($this->bloqueado==0){
            return 'No';
        }else if($this->bloqueado==1){
            return 'Bloqueado por denuncias';
        }else{
            return 'Bloqueado por Administrador';
        }   

    }
}

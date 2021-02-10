<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tiendas".
 *
 * @property int $id
 * @property string $nombre_tienda Nombre o denominación para la tienda.
 * @property string|null $descripcion_tienda Descripción breve de la tienda o NULL si no es necesaria.
 * @property string|null $lugar_tienda Descripción adicional del lugar donde esta la tienda o NULL si no se conoce, aunque no debería estar vacío este dato.
 * @property string|null $url_tienda Dirección web externa (opcional) que enlaza con la página "oficial" de la tienda o NULL si no hay o no se conoce.
 * @property string|null $direccion_tienda Direccion de la entidad o NULL si no quiere informar o no se conoce.
 * @property int|null $region_id_tienda Región de localización de la tienda o CERO (como si fuera NULL) si no se sabe, o aún no está indicada, aunque es recomendable.
 * @property string|null $telefono_tienda Telefono de la tienda o NULL si no se sabe o no hay.
 * @property int|null $clasificacion_id Clasificación de la tienda o CERO si no existe o aún no está indicada (como si fuera NULL).
 * @property string|null $imagen_id Nombre identificativo (fichero interno) con la imagen principal o "de presentación" de la tienda, o NULL si no hay.
 * @property int $sumaValores Suma acumulada de las valoraciones para la tienda.
 * @property int $totalVotos Contador de votos (valoraciones) emitidas para la tienda.
 * @property int $visible Indicador de tienda visible a los usuarios o invisible (se está manteniendo o está desactivada por otras causas): 0=Invisible, 1=Visible.
 * @property int $cerrada Indicador de tienda cancelada, eliminada o suspendida: 0=No (activa), 1=Eliminada por solicitud de baja, 2=Suspendida, 3=Cancelada por Inadecuada, ...
 * @property int $num_denuncias Contador de denuncias de la tienda o CERO si no ha tenido.
 * @property string|null $fecha_denuncia1 Fecha y Hora de la primera denuncia. Debería estar a NULL si no tiene denuncias (contador a cero), o si el contador se reinicia.
 * @property string|null $notas_denuncia Notas o texto visible con el motivo de la primera denuncia de la tienda o NULL si no hay -se muestra este campo según el estado de "bloqueada"-.
 * @property int $bloqueada Indicador de tienda bloqueada: 0=No, 1=Si(bloqueada por denuncias), 2=Si(bloqueada por moderador o administrador), ...
 * @property string|null $fecha_bloqueo Fecha y Hora del bloqueo de la tienda. Debería estar a NULL si no está bloqueada o si se desbloquea.
 * @property string|null $notas_bloqueo Notas visibles sobre el motivo del bloqueo de la tienda o NULL si no hay -se muestra por defecto según indique "bloqueada"-.
 * @property int $cerrado_comentar Indicador de tienda cerrada para agregar comentarios: 0=No, 1=Si.
 * @property int $usuario_id Usuario relacionado con estos datos principales, propietario de la tienda o CERO (como si fuera NULL) si no tiene usuario vinculado o no se conoce, no existe, o aún no está indicado.
 * @property string $nif_cif Identificador de la entidad.
 * @property string|null $nombre Nombre si la entidad es de tipo persona.
 * @property string|null $apellidos Apellidos si la entidad es de tipo persona.
 * @property string|null $razon_social Razon social de la entidad si es de tipo empresa, o NULL si con el "nombre y apellidos" como persona es suficiente.
 * @property string|null $direccion Direccion de la entidad o NULL si no quiere informar o no se conoce.
 * @property int|null $region_id Región de localización de la entidad o CERO si no lo quiere informar (como si fuera NULL), aunque es recomendable.
 * @property string|null $telefono_contacto Telefono de contacto directo con la entidad o NULL si no se sabe o no hay.
 * @property int|null $crea_usuario_id Usuario que ha creado el registro o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.
 * @property string|null $crea_fecha Fecha y Hora de creación del registro o NULL si no se conoce por algún motivo.
 * @property int|null $modi_usuario_id Usuario que ha modificado el registro por última vez o CERO (como si fuera NULL) si no existe o se hizo por un administrador de sistema.
 * @property string|null $modi_fecha Fecha y Hora de la última modificación del registro o NULL si no se conoce por algún motivo.
 * @property string|null $notas_admin Notas adicionales que solo ven/modifican los moderadores/administradores sobre los datos del regsitro o NULL si no hay.
 */
class Tiendas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tiendas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre_tienda', 'nif_cif'], 'required'],
            [['nombre_tienda', 'descripcion_tienda', 'lugar_tienda', 'url_tienda', 'direccion_tienda', 'notas_denuncia', 'notas_bloqueo', 'direccion', 'notas_admin'], 'string'],
            [['region_id_tienda', 'clasificacion_id', 'sumaValores', 'totalVotos', 'visible', 'cerrada', 'num_denuncias', 'bloqueada', 'cerrado_comentar', 'usuario_id', 'region_id', 'crea_usuario_id', 'modi_usuario_id'], 'integer'],
            [['fecha_denuncia1', 'fecha_bloqueo', 'crea_fecha', 'modi_fecha'], 'safe'],
            [['telefono_tienda', 'imagen_id', 'telefono_contacto'], 'string', 'max' => 25],
            [['nif_cif'], 'string', 'max' => 12],
            [['nombre'], 'string', 'max' => 100],
            [['apellidos'], 'string', 'max' => 150],
            [['razon_social'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_tienda' => 'Nombre Tienda',
            'descripcion_tienda' => 'Descripcion Tienda',
            'lugar_tienda' => 'Lugar Tienda',
            'url_tienda' => 'Url Tienda',
            'direccion_tienda' => 'Direccion Tienda',
            'region_id_tienda' => 'Region Id Tienda',
            'telefono_tienda' => 'Telefono Tienda',
            'clasificacion_id' => 'Clasificacion ID',
            'imagen_id' => 'Imagen ID',
            'sumaValores' => 'Suma Valores',
            'totalVotos' => 'Total Votos',
            'visible' => 'Visible',
            'cerrada' => 'Cerrada',
            'num_denuncias' => 'Num Denuncias',
            'fecha_denuncia1' => 'Fecha Denuncia1',
            'notas_denuncia' => 'Notas Denuncia',
            'bloqueada' => 'Bloqueada',
            'fecha_bloqueo' => 'Fecha Bloqueo',
            'notas_bloqueo' => 'Notas Bloqueo',
            'cerrado_comentar' => 'Cerrado Comentar',
            'usuario_id' => 'Usuario ID',
            'nif_cif' => 'Nif Cif',
            'nombre' => 'Nombre',
            'apellidos' => 'Apellidos',
            'razon_social' => 'Razon Social',
            'direccion' => 'Direccion',
            'region_id' => 'Region ID',
            'telefono_contacto' => 'Telefono Contacto',
            'crea_usuario_id' => 'Crea Usuario ID',
            'crea_fecha' => 'Crea Fecha',
            'modi_usuario_id' => 'Modi Usuario ID',
            'modi_fecha' => 'Modi Fecha',
            'notas_admin' => 'Notas Admin',
            'nombreCompleto' => 'Nombre Completo',
            'nickPropietario' => 'Nick Propietario',
        ];
    }

    public function getNombreCompleto()
    {
        return $this->nombre.' '.$this->apellidos;
    }

    public function getUsuarios(){

        return $this->hasOne(Usuarios::className(),['id' => 'usuario_id']);

    }

    public function getNickPropietario(){

        return $this->usuarios->nick;

    }

    public function deletePropietario(){

        $this->usuario_id =0;
        $this->nif_cif='NULO';
        $this->nombre = NULL;
        $this->apellidos = NULL;
        $this->razon_social = NULL;
        $this->direccion = NULL;
        $this->region_id = 0;
        $this->telefono_contacto = NULL;

        $this->save();
    }

}

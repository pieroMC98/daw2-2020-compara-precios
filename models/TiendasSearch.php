<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tiendas;

/**
 * TiendasSearch represents the model behind the search form of `app\models\Tiendas`.
 */
class TiendasSearch extends Tiendas
{

    public $etiquetaId;

    /**
     * {@inheritdoc}
     */

    public $nombreCompleto;
    public $nickPropietario;

    public function rules()
    {
        return [
            [['id', 'region_id_tienda', 'clasificacion_id', 'sumaValores', 'totalVotos', 'visible', 'cerrada', 'num_denuncias', 'bloqueada', 'cerrado_comentar', 'usuario_id', 'region_id', 'crea_usuario_id', 'modi_usuario_id'], 'integer'],

            [['nombre_tienda', 'descripcion_tienda', 'lugar_tienda', 'url_tienda', 'direccion_tienda', 'telefono_tienda', 'imagen_id', 'fecha_denuncia1', 'notas_denuncia', 'fecha_bloqueo', 'notas_bloqueo', 'nif_cif', 'nombre', 'apellidos', 'razon_social', 'direccion', 'telefono_contacto', 'crea_fecha', 'modi_fecha', 'notas_admin', 'nombreCompleto', 'nickPropietario', 'etiquetaId'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Tiendas::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $orden= $dataProvider->sort;//Aprovechar el objeto de ordenacion interno.
        $orden->attributes['nombreCompleto']= [
            'asc' => ['nombre' => SORT_ASC, 'apellidos' => SORT_ASC],
            'desc' => ['nombre' => SORT_DESC, 'apellidos' => SORT_DESC],
            //'default' => SORT_DESC,
            //'label' => 'Nombre, Apellidos',
        ];

        $orden->attributes['nickPropietario']= [
            'asc' => ['usuarios.nick' => SORT_ASC],
            'desc' => ['usuarios.nick' => SORT_DESC],
            //'default' => SORT_DESC,
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['usuarios']);

            return $dataProvider;
        }

        $query->joinWith(['usuarios']);

        $query->joinWith(['etiquetas']);


        // grid filtering conditions
        $query->andFilterWhere([
            'tiendas.id' => $this->id,
            'tiendas.region_id_tienda' => $this->region_id_tienda,
            'tiendas.clasificacion_id' => $this->clasificacion_id,
            'tiendas.sumaValores' => $this->sumaValores,
            'tiendas.totalVotos' => $this->totalVotos,
            'tiendas.visible' => $this->visible,
            'tiendas.cerrada' => $this->cerrada,
            'tiendas.num_denuncias' => $this->num_denuncias,
            'tiendas.fecha_denuncia1' => $this->fecha_denuncia1,
            'tiendas.bloqueada' => $this->bloqueada,
            'tiendas.fecha_bloqueo' => $this->fecha_bloqueo,
            'tiendas.cerrado_comentar' => $this->cerrado_comentar,
            'tiendas.usuario_id' => $this->usuario_id,
            'tiendas.region_id' => $this->region_id,
            'tiendas.crea_usuario_id' => $this->crea_usuario_id,
            'tiendas.crea_fecha' => $this->crea_fecha,
            'tiendas.modi_usuario_id' => $this->modi_usuario_id,
            'tiendas.modi_fecha' => $this->modi_fecha,
        ]);

        $query->andFilterWhere(['like', 'tiendas.nombre_tienda', $this->nombre_tienda])
            ->andFilterWhere(['like', 'tiendas.descripcion_tienda', $this->descripcion_tienda])
            ->andFilterWhere(['like', 'tiendas.lugar_tienda', $this->lugar_tienda])
            ->andFilterWhere(['like', 'tiendas.url_tienda', $this->url_tienda])
            ->andFilterWhere(['like', 'tiendas.direccion_tienda', $this->direccion_tienda])
            ->andFilterWhere(['like', 'tiendas.telefono_tienda', $this->telefono_tienda])
            ->andFilterWhere(['like', 'tiendas.imagen_id', $this->imagen_id])
            ->andFilterWhere(['like', 'tiendas.notas_denuncia', $this->notas_denuncia])
            ->andFilterWhere(['like', 'tiendas.notas_bloqueo', $this->notas_bloqueo])
            ->andFilterWhere(['like', 'tiendas.nif_cif', $this->nif_cif])
            ->andFilterWhere(['like', 'tiendas.nombre', $this->nombre])
            ->andFilterWhere(['like', 'tiendas.apellidos', $this->apellidos])
            ->andFilterWhere(['like', 'tiendas.razon_social', $this->razon_social])
            ->andFilterWhere(['like', 'tiendas.direccion', $this->direccion])
            ->andFilterWhere(['like', 'tiendas.telefono_contacto', $this->telefono_contacto])
            ->andFilterWhere(['like', 'tiendas.notas_admin', $this->notas_admin])
            ->andFilterWhere(['like', 'tiendas_etiquetas.etiqueta_id', $this->etiquetaId]);
            ->andFilterWhere(['like', 'usuarios.nick', $this->nickPropietario]);

        $query->andFilterWhere(['like'
            , 'CONCAT(tiendas.nombre," ",tiendas.apellidos)'
            , $this->nombreCompleto]);
        
        return $dataProvider;
    }
}

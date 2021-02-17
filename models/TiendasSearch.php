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
    public function rules()
    {
        return [
            [['id', 'region_id_tienda', 'clasificacion_id', 'sumaValores', 'totalVotos', 'visible', 'cerrada', 'num_denuncias', 'bloqueada', 'cerrado_comentar', 'usuario_id', 'region_id', 'crea_usuario_id', 'modi_usuario_id'], 'integer'],
            [['nombre_tienda', 'descripcion_tienda', 'lugar_tienda', 'url_tienda', 'direccion_tienda', 'telefono_tienda', 'imagen_id', 'fecha_denuncia1', 'notas_denuncia', 'fecha_bloqueo', 'notas_bloqueo', 'nif_cif', 'nombre', 'apellidos', 'razon_social', 'direccion', 'telefono_contacto', 'crea_fecha', 'modi_fecha', 'notas_admin', 'etiquetaId'], 'safe'],
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

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith(['etiquetas']);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'region_id_tienda' => $this->region_id_tienda,
            'clasificacion_id' => $this->clasificacion_id,
            'sumaValores' => $this->sumaValores,
            'totalVotos' => $this->totalVotos,
            'visible' => $this->visible,
            'cerrada' => $this->cerrada,
            'num_denuncias' => $this->num_denuncias,
            'fecha_denuncia1' => $this->fecha_denuncia1,
            'bloqueada' => $this->bloqueada,
            'fecha_bloqueo' => $this->fecha_bloqueo,
            'cerrado_comentar' => $this->cerrado_comentar,
            'usuario_id' => $this->usuario_id,
            'region_id' => $this->region_id,
            'crea_usuario_id' => $this->crea_usuario_id,
            'crea_fecha' => $this->crea_fecha,
            'modi_usuario_id' => $this->modi_usuario_id,
            'modi_fecha' => $this->modi_fecha,
        ]);

        $query->andFilterWhere(['like', 'nombre_tienda', $this->nombre_tienda])
            ->andFilterWhere(['like', 'descripcion_tienda', $this->descripcion_tienda])
            ->andFilterWhere(['like', 'lugar_tienda', $this->lugar_tienda])
            ->andFilterWhere(['like', 'url_tienda', $this->url_tienda])
            ->andFilterWhere(['like', 'direccion_tienda', $this->direccion_tienda])
            ->andFilterWhere(['like', 'telefono_tienda', $this->telefono_tienda])
            ->andFilterWhere(['like', 'imagen_id', $this->imagen_id])
            ->andFilterWhere(['like', 'notas_denuncia', $this->notas_denuncia])
            ->andFilterWhere(['like', 'notas_bloqueo', $this->notas_bloqueo])
            ->andFilterWhere(['like', 'nif_cif', $this->nif_cif])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellidos', $this->apellidos])
            ->andFilterWhere(['like', 'razon_social', $this->razon_social])
            ->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'telefono_contacto', $this->telefono_contacto])
            ->andFilterWhere(['like', 'notas_admin', $this->notas_admin])
            ->andFilterWhere(['like', 'tiendas_etiquetas.etiqueta_id', $this->etiquetaId]);
            

        return $dataProvider;
    }
}

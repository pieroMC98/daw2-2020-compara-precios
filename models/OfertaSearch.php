<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Oferta;

/**
 * OfertaSearch represents the model behind the search form of `app\models\Oferta`.
 */
class OfertaSearch extends Oferta
{
    public $tiendaNombre;
    public $articuloNombre;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'articulo_id', 'tienda_id', 'crea_usuario_id', 'modi_usuario_id'], 'integer'],
            [['texto', 'fecha_desde', 'fecha_hasta', 'crea_fecha', 'modi_fecha', 'notas_admin','tiendaNombre','articuloNombre'], 'safe'],
            [['precio_oferta', 'precio_original'], 'number'],
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
        $query = Oferta::find();

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

        $query->joinWith(['articulos', 'tiendas']);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'articulo_id' => $this->articulo_id,
            'tienda_id' => $this->tienda_id,
            'fecha_desde' => $this->fecha_desde,
            'fecha_hasta' => $this->fecha_hasta,
            'precio_oferta' => $this->precio_oferta,
            'precio_original' => $this->precio_original,
            'crea_usuario_id' => $this->crea_usuario_id,
            'crea_fecha' => $this->crea_fecha,
            'modi_usuario_id' => $this->modi_usuario_id,
            'modi_fecha' => $this->modi_fecha,
        ]);

        $query->andFilterWhere(['like', 'texto', $this->texto])
            ->andFilterWhere(['like', 'notas_admin', $this->notas_admin])
            ->andFilterWhere(['like', 'articulos.nombre', $this->articuloNombre])
            ->andFilterWhere(['like', 'tiendas.nombre_tienda', $this->tiendaNombre]);

        return $dataProvider;
    }
}

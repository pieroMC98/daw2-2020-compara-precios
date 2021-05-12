<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SeguimientosUsuario;

/**
 * SeguimientosUsuarioSearch represents the model behind the search form of `app\models\SeguimientosUsuario`.
 */
class SeguimientosUsuarioSearch extends SeguimientosUsuario
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'usuario_id', 'tienda_id', 'articulo_id', 'oferta_id'], 'integer'],
            [['fecha_alta'], 'safe'],
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
        $query = SeguimientosUsuario::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'usuario_id' => $this->usuario_id,
            'tienda_id' => $this->tienda_id,
            'articulo_id' => $this->articulo_id,
            'oferta_id' => $this->oferta_id,
            'fecha_alta' => $this->fecha_alta,
        ]);

        return $dataProvider;
    }
}

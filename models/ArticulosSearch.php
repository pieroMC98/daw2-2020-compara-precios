<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Articulos;

/**
 * ArticulosSearch represents the model behind the search form of `app\models\Articulos`.
 */
class ArticulosSearch extends Articulos

    public $etiquetaId;
    public $categoriaNombre;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'categoria_id', 'visible', 'cerrado', 'comun', 'crea_usuario_id', 'modi_usuario_id'], 'integer'],
            [['nombre', 'descripcion', 'imagen_id', 'crea_fecha', 'modi_fecha', 'notas_admin', 'etiquetaId', 'categoriaNombre'], 'safe'],

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
        $query = Articulos::find();

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

        $query->joinWith(['etiquetas', 'categorias']);

        // grid filtering conditions
        $query->andFilterWhere([
            'articulos.id' => $this->id,
            'articulos.categoria_id' => $this->categoria_id,
            'articulos.visible' => $this->visible,
            'articulos.cerrado' => $this->cerrado,
            'articulos.comun' => $this->comun,
            'articulos.crea_usuario_id' => $this->crea_usuario_id,
            'articulos.crea_fecha' => $this->crea_fecha,
            'articulos.modi_usuario_id' => $this->modi_usuario_id,
            'articulos.modi_fecha' => $this->modi_fecha,
        ]);

        $query->andFilterWhere(['like', 'articulos.nombre', $this->nombre])
            ->andFilterWhere(['like', 'articulos.descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'articulos.imagen_id', $this->imagen_id])
            ->andFilterWhere(['like', 'articulos.notas_admin', $this->notas_admin])
            ->andFilterWhere(['like', 'articulos_etiquetas.etiqueta_id', $this->etiquetaId])
            ->andFilterWhere(['like', 'categorias.nombre', $this->categoriaNombre]);


        return $dataProvider;
    }
}

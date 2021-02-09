<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\articulostienda;

/**
 * articulostiendaSearch represents the model behind the search form of `app\models\articulostienda`.
 */
class articulostiendaSearch extends articulostienda
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'articulo_id', 'tienda_id', 'sumaValores', 'totalVotos', 'visible', 'cerrado', 'num_denuncias', 'bloqueado', 'cerrado_comentar', 'crea_usuario_id', 'modi_usuario_id'], 'integer'],
            [['imagen_id', 'url_articulo', 'fecha_denuncia1', 'notas_denuncia', 'fecha_bloqueo', 'notas_bloqueo', 'crea_fecha', 'modi_fecha', 'notas_admin'], 'safe'],
            [['precio'], 'number'],
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
        $query = articulostienda::find();

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
            'articulo_id' => $this->articulo_id,
            'tienda_id' => $this->tienda_id,
            'precio' => $this->precio,
            'sumaValores' => $this->sumaValores,
            'totalVotos' => $this->totalVotos,
            'visible' => $this->visible,
            'cerrado' => $this->cerrado,
            'num_denuncias' => $this->num_denuncias,
            'fecha_denuncia1' => $this->fecha_denuncia1,
            'bloqueado' => $this->bloqueado,
            'fecha_bloqueo' => $this->fecha_bloqueo,
            'cerrado_comentar' => $this->cerrado_comentar,
            'crea_usuario_id' => $this->crea_usuario_id,
            'crea_fecha' => $this->crea_fecha,
            'modi_usuario_id' => $this->modi_usuario_id,
            'modi_fecha' => $this->modi_fecha,
        ]);

        $query->andFilterWhere(['like', 'imagen_id', $this->imagen_id])
            ->andFilterWhere(['like', 'url_articulo', $this->url_articulo])
            ->andFilterWhere(['like', 'notas_denuncia', $this->notas_denuncia])
            ->andFilterWhere(['like', 'notas_bloqueo', $this->notas_bloqueo])
            ->andFilterWhere(['like', 'notas_admin', $this->notas_admin]);

        return $dataProvider;
    }
}

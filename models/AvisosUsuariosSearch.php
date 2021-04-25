<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AvisosUsuarios;

/**
 * AvisosUsuariosSearch represents the model behind the search form of `app\models\AvisosUsuarios`.
 */
class AvisosUsuariosSearch extends AvisosUsuarios
{
    /**
     * {@inheritdoc}
     */

    public $nombre;

    public function rules()
    {
        return [
            [['id', 'destino_usuario_id', 'origen_usuario_id', 'tienda_id', 'articulo_id', 'comentario_id'], 'integer'],
            [['fecha_aviso', 'clase_aviso', 'texto', 'fecha_lectura', 'fecha_aceptado', 'nombre'], 'safe'],
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
        $query = AvisosUsuarios::find();
        $query->joinWith(['nombre_tienda']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5
            ],
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
            'fecha_aviso' => $this->fecha_aviso,
            'destino_usuario_id' => $this->destino_usuario_id,
            'origen_usuario_id' => $this->origen_usuario_id,
            'tienda_id' => $this->tienda_id,
            'articulo_id' => $this->articulo_id,
            'comentario_id' => $this->comentario_id,
            'fecha_lectura' => $this->fecha_lectura,
            'fecha_aceptado' => $this->fecha_aceptado,
        ]);

        $query->andFilterWhere(['like', 'clase_aviso', $this->clase_aviso])
            ->andFilterWhere(['like', 'texto', $this->texto]);

        return $dataProvider;
    }
}

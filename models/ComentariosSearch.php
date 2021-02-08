<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Comentarios;

/**
 * ComentariosSearch represents the model behind the search form of `app\models\Comentarios`.
 */
class ComentariosSearch extends Comentarios
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tienda_id', 'articulo_id', 'valoracion', 'comentario_id', 'cerrado', 'num_denuncias', 'bloqueado', 'crea_usuario_id', 'modi_usuario_id'], 'integer'],
            [['texto', 'fecha_denuncia1', 'notas_denuncia', 'fecha_bloqueo', 'notas_bloqueo', 'crea_fecha', 'modi_fecha', 'notas_admin'], 'safe'],
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
        $query = Comentarios::find();

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
            'tienda_id' => $this->tienda_id,
            'articulo_id' => $this->articulo_id,
            'valoracion' => $this->valoracion,
            'comentario_id' => $this->comentario_id,
            'cerrado' => $this->cerrado,
            'num_denuncias' => $this->num_denuncias,
            'fecha_denuncia1' => $this->fecha_denuncia1,
            'bloqueado' => $this->bloqueado,
            'fecha_bloqueo' => $this->fecha_bloqueo,
            'crea_usuario_id' => $this->crea_usuario_id,
            'crea_fecha' => $this->crea_fecha,
            'modi_usuario_id' => $this->modi_usuario_id,
            'modi_fecha' => $this->modi_fecha,
        ]);

        $query->andFilterWhere(['like', 'texto', $this->texto])
            ->andFilterWhere(['like', 'notas_denuncia', $this->notas_denuncia])
            ->andFilterWhere(['like', 'notas_bloqueo', $this->notas_bloqueo])
            ->andFilterWhere(['like', 'notas_admin', $this->notas_admin]);

        return $dataProvider;
    }
}

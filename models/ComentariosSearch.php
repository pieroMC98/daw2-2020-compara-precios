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

    public $nomTienda;
    public $nickCreador;
    public $nickModif;
    public $nomArticulo;

    public function rules()
    {
        return [
            [['id', 'tienda_id', 'articulo_id', 'valoracion', 'comentario_id', 'cerrado', 'num_denuncias', 'bloqueado', 'crea_usuario_id', 'modi_usuario_id'], 'integer'],
            [['texto', 'fecha_denuncia1', 'notas_denuncia', 'fecha_bloqueo', 'notas_bloqueo', 'crea_fecha', 'modi_fecha', 'notas_admin', 'nomTienda', 'nickCreador', 'nickModif', 'nomArticulo'], 'safe'],
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


        //Configurar la ordenacion por el nombre completo.
        $orden= $dataProvider->sort;//Aprovechar el objeto de ordenacion interno.
        $orden->attributes['nomTienda']= [
            'asc' => ['tiendas.nombre_tienda' => SORT_ASC],
            'desc' => ['tiendas.nombre_tienda' => SORT_DESC],
            //'default' => SORT_DESC,
        ];
        $orden->attributes['nickCreador']= [
            'asc' => ['usuarios.nick' => SORT_ASC],
            'desc' => ['usuarios.nick' => SORT_DESC],
            //'default' => SORT_DESC,
        ];
        $orden->attributes['nickModif']= [
            'asc' => ['usuarios.nick' => SORT_ASC],
            'desc' => ['usuarios.nick' => SORT_DESC],
            //'default' => SORT_DESC,
        ];
        $orden->attributes['nomArticulo']= [
            'asc' => ['articulos.nombre' => SORT_ASC],
            'desc' => ['articulos.nombre' => SORT_DESC],
            //'default' => SORT_DESC,
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');

            $query->joinWith(['tiendas','usuarios','articulos']);
            return $dataProvider;
        }

        $query->joinWith(['tiendas','usuarios','articulos']);

        // grid filtering conditions
        $query->andFilterWhere([
            'comentarios.id' => $this->id,
            'comentarios.tienda_id' => $this->tienda_id,
            'comentarios.articulo_id' => $this->articulo_id,
            'comentarios.valoracion' => $this->valoracion,
            'comentarios.comentario_id' => $this->comentario_id,
            'comentarios.cerrado' => $this->cerrado,
            'comentarios.num_denuncias' => $this->num_denuncias,
            'comentarios.fecha_denuncia1' => $this->fecha_denuncia1,
            'comentarios.bloqueado' => $this->bloqueado,
            'comentarios.fecha_bloqueo' => $this->fecha_bloqueo,
            'comentarios.crea_usuario_id' => $this->crea_usuario_id,
            'comentarios.crea_fecha' => $this->crea_fecha,
            'comentarios.modi_usuario_id' => $this->modi_usuario_id,
            'comentarios.modi_fecha' => $this->modi_fecha,
        ]);

        $query->andFilterWhere(['like', 'texto', $this->texto])
            ->andFilterWhere(['like', 'notas_denuncia', $this->notas_denuncia])
            ->andFilterWhere(['like', 'notas_bloqueo', $this->notas_bloqueo])
            ->andFilterWhere(['like', 'notas_admin', $this->notas_admin])
            ->andFilterWhere(['like', 'tiendas.nombre_tienda', $this->nomTienda])
            ->andFilterWhere(['like', 'usuarios.nick', $this->nickCreador])
            ->andFilterWhere(['like', 'usuarios.nick', $this->nickModif])
            ->andFilterWhere(['like', 'articulos.nombre', $this->nomArticulo]);
        return $dataProvider;
    }
}

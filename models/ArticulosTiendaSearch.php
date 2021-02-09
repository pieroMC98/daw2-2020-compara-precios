<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
<<<<<<< HEAD
use app\models\Articulostienda;

/**
 * ArticulostiendaSearch represents the model behind the search form of `app\models\Articulostienda`.
 */
class ArticulostiendaSearch extends Articulostienda
=======
use app\models\articulostienda;

/**
 * articulostiendaSearch represents the model behind the search form of `app\models\articulostienda`.
 */
class articulostiendaSearch extends articulostienda
>>>>>>> 4f292c02449476aa1046f6afaba692881f2a80ca
{
    public $nomArticulo;
    public $nomTienda;
    public $artVisible;
    public $artBloqueado;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'articulo_id', 'tienda_id', 'sumaValores', 'totalVotos', 'visible', 'cerrado', 'num_denuncias', 'bloqueado', 'cerrado_comentar', 'crea_usuario_id', 'modi_usuario_id'], 'integer'],
            [['imagen_id', 'url_articulo', 'fecha_denuncia1', 'notas_denuncia', 'fecha_bloqueo', 'notas_bloqueo', 'crea_fecha', 'modi_fecha', 'notas_admin','nomTienda','nomArticulo','artVisible','artBloqueado'], 'safe'],
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
<<<<<<< HEAD
        $query = Articulostienda::find();
=======
        $query = articulostienda::find();
>>>>>>> 4f292c02449476aa1046f6afaba692881f2a80ca

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $orden= $dataProvider->sort;//Aprovechar el objeto de ordenacion interno.
        $orden->attributes['nomTienda']= [
            'asc' => ['tiendas.nombre_tienda' => SORT_ASC],
            'desc' => ['tiendas.nombre_tienda' => SORT_DESC],
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
            $query->joinWith(['tiendas','articulos']);
            return $dataProvider;
        }

        $query->joinWith(['tiendas','articulos']);

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
            ->andFilterWhere(['like', 'notas_admin', $this->notas_admin])
            ->andFilterWhere(['like', 'tiendas.nombre_tienda', $this->nomTienda])
            ->andFilterWhere(['like', 'articulos.nombre', $this->nomArticulo]);
            //->andFilterWhere(['like', 'Visible', $this->artVisible]);
            //->andFilterWhere(['like', 'artBloqueado', $this->bloqueado]);

            if (empty($this->artVisible)) {
            $query->andFilterWhere( ['==', 'visible'
                , $this->visible]);
            } else {
            $query->andFilterWhere( ['==', 'visible'
                , $this->visible]);
            }

        return $dataProvider;
    }
}

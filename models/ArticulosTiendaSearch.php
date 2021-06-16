<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ArticulosTienda;

/**
 * ArticulosTiendaSearch represents the model behind the search form of `app\models\ArticulosTienda`.
 */
class ArticulosTiendaSearch extends ArticulosTienda
{
    public $nomArticulo;
    public $nomTienda;
    public $artVisible;
    public $artBloqueado;
    public $precioDesde;
    public $precioHasta;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'articulo_id', 'tienda_id', 'sumaValores', 'totalVotos', 'visible', 'cerrado', 'num_denuncias', 'bloqueado', 'cerrado_comentar', 'crea_usuario_id', 'modi_usuario_id'], 'integer'],
            [['imagen_id', 'url_articulo', 'fecha_denuncia1', 'notas_denuncia', 'fecha_bloqueo', 'notas_bloqueo', 'crea_fecha', 'modi_fecha', 'notas_admin','nomTienda','nomArticulo','artVisible','artBloqueado','precioDesde', 'precioHasta'], 'safe'],
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
        $query = ArticulosTienda::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $orden= $dataProvider->sort;//Aprovechar el objeto de ordenacion interno.
        $orden->attributes['nomTienda']= [
            'asc' => ['tiendas.nombre_tienda' => SORT_ASC],
            'desc' => ['tiendas.nombre_tienda' => SORT_DESC],
            'default' => SORT_DESC,
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
            'articulos_tienda.id' => $this->id,
            'articulos_tienda.articulo_id' => $this->articulo_id,
            'articulos_tienda.tienda_id' => $this->tienda_id,
            'articulos_tienda.precio' => $this->precio,
            'articulos_tienda.sumaValores' => $this->sumaValores,
            'articulos_tienda.totalVotos' => $this->totalVotos,
            'articulos_tienda.visible' => $this->visible,
            'articulos_tienda.cerrado' => $this->cerrado,
            'articulos_tienda.num_denuncias' => $this->num_denuncias,
            'articulos_tienda.fecha_denuncia1' => $this->fecha_denuncia1,
            'articulos_tienda.bloqueado' => $this->bloqueado,
            'articulos_tienda.fecha_bloqueo' => $this->fecha_bloqueo,
            'articulos_tienda.cerrado_comentar' => $this->cerrado_comentar,
            'articulos_tienda.crea_usuario_id' => $this->crea_usuario_id,
            'articulos_tienda.crea_fecha' => $this->crea_fecha,
            'articulos_tienda.modi_usuario_id' => $this->modi_usuario_id,
            'articulos_tienda.modi_fecha' => $this->modi_fecha,
        ]);

        $query->andFilterWhere(['like', 'url_articulo', $this->url_articulo])
            ->andFilterWhere(['like', 'notas_denuncia', $this->notas_denuncia])
            ->andFilterWhere(['like', 'notas_bloqueo', $this->notas_bloqueo])
            ->andFilterWhere(['like', 'notas_admin', $this->notas_admin])
            ->andFilterWhere(['like', 'tiendas.nombre_tienda', $this->nomTienda])
            ->andFilterWhere(['like', 'articulos.nombre', $this->nomArticulo]);

        if (empty($this->precioHasta)) {
            $query->andFilterWhere( ['>=', 'precio'
                , $this->precioDesde]);
        } else if (empty($this->precioDesde)) {
            $query->andFilterWhere( ['<=', 'precio'
                , $this->precioHasta]);
        } else {
            $query->andFilterWhere( ['between', 'precio'
                , $this->precioDesde, $this->precioHasta ]);
        }
        return $dataProvider;
    }
}

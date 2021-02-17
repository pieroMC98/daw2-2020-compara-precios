<?php

namespace app\controllers;

use Yii;
use app\models\Articulos;
use app\models\ArticulosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\controllers\OfertaController;
use yii\db\Query;

/**
 * ArticulosController implements the CRUD actions for Articulos model.
 */
class ArticulosController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Articulos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticulosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all etiquetas.
     * @return mixed
     */
    public function actionEtiquetas()
    {
        $etiquetas= array();
        $query = new Query;
        // compose the query
        $query->select('etiquetas.id, etiquetas.nombre')
            ->from('etiquetas')
            ->join('INNER JOIN', 'articulos_etiquetas', 'etiquetas.id = articulos_etiquetas.etiqueta_id');

        // build and execute the query
        $listaEtiquetas = $query->all();
        for($i=0; $i<count($listaEtiquetas); $i++){
            $etiquetas[$listaEtiquetas[$i]['id']]=$listaEtiquetas[$i]['nombre'];
        }

        return $this->render('etiquetas', [
            'etiquetas' => $etiquetas,
        ]);
    }

    /**
     * Lists all Articulos models filter by etiqueta.
     * @return mixed
     */
    public function actionBusqetiquetas()
    {
        $searchModel = new ArticulosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $query = new Query;
        // compose the query
        $query->select('etiquetas.id, etiquetas.nombre')
            ->from('etiquetas')
            ->join('INNER JOIN', 'articulos_etiquetas', 'etiquetas.id = articulos_etiquetas.etiqueta_id');
        // build and execute the query
        $listaEtiquetas = $query->all();
        for($i=0; $i<count($listaEtiquetas); $i++){
            $etiquetas[$listaEtiquetas[$i]['id']]=$listaEtiquetas[$i]['nombre'];
        }

        return $this->render('busEtiquetas', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'etiquetas' => $etiquetas,
        ]);
    }

    /**
     * Displays a single Articulos model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Articulos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Articulos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Articulos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Articulos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    /**
     * Finds the Articulos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Articulos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Articulos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new Seguimiento usuarios model from the articulo.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionSeguimiento($id){
        if(Yii::$app->user->getId()!=NULL){
            return $this->redirect(['seguimientos-usuario/seguimiento', 'id_articulo' => $id, 'id_tienda'=>'', 'id_oferta'=>'']);
        }
        else{
            return $this->redirect(['site/login', 'error' => 'No se puede seguir un articulo si no estas conectado']);
        }
    }
    
    /**
     * Creates a new Seguimiento usuarios model from the articulo.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionQuitarseguimiento($id){
        if(Yii::$app->user->getId()!=NULL){
            return $this->redirect(['seguimientos-usuario/quitarseguimiento', 'id' => $id]);
        }
        else{
            return $this->redirect(['site/login', 'error' => 'No se puede seguir un articulo si no estas conectado']);
        }
    }
}

<?php

namespace app\controllers;

use Yii;
use app\models\Tiendas;
use app\models\TiendasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;


/**
 * TiendasController implements the CRUD actions for Tiendas model.
 */
class TiendasController extends Controller
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
     * Lists all Tiendas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TiendasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Tiendas models filter by clasificacion.
     * @return mixed
     */
    public function actionClasificacion()
    {
        $searchModel = new TiendasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $clases = array();
        $query = new Query;
        // compose the query
        $query->select('clasificadores.id, clasificadores.nombre')
            ->from('clasificadores')
            ->join('INNER JOIN', 'tiendas', 'clasificadores.id = tiendas.clasificacion_id');
        // build and execute the query
        $listaClases = $query->all();
        for($i=0; $i<count($listaClases); $i++){
            $clases[$listaClases[$i]['id']]=$listaClases[$i]['nombre'];
        }
        
        return $this->render('busClas', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'clases' => $clases,
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
            ->join('INNER JOIN', 'tiendas_etiquetas', 'etiquetas.id = tiendas_etiquetas.etiqueta_id');
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
     * Lists all Tiendas models filter by etiqueta.
     * @return mixed
     */
    public function actionBusqetiquetas()
    {
        $searchModel = new TiendasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $query = new Query;
        // compose the query
        $query->select('etiquetas.id, etiquetas.nombre')
            ->from('etiquetas')
            ->join('INNER JOIN', 'tiendas_etiquetas', 'etiquetas.id = tiendas_etiquetas.etiqueta_id');
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
     * Displays a single Tiendas model.
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
     * Creates a new Tiendas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tiendas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tiendas model.
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
     * Deletes an existing Tiendas model.
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
     * Finds the Tiendas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tiendas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tiendas::findOne($id)) !== null) {
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
            return $this->redirect(['seguimientos-usuario/seguimiento', 'id_articulo' => '', 'id_tienda'=>$id, 'id_oferta'=>'']);
        }
        else{
            return $this->redirect(['site/login', 'error' => 'No se puede seguir una tienda si no estas conectado']);
        }
    }

        /**
     * Creates a new Seguimiento usuarios model from the articulo.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionQuitarseguimiento($id){
        if(Yii::$app->user->getId()!=NULL){
            return $this->redirect(['seguimientos-usuario/quitarseguimiento', 'id'=> $id]);
        }
        else{
            return $this->redirect(['site/login', 'error' => 'No se puede seguir un articulo si no estas conectado']);
        }
    }

}

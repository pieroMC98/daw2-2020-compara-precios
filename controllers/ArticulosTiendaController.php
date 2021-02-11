<?php

namespace app\controllers;

use Yii;
use app\models\Articulostienda;
use app\models\ArticulostiendaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Tiendas;
use app\models\TiendasSearch;
use app\models\Articulos;
use app\models\ArticulosSearch;

/**
 * ArticulostiendaController implements the CRUD actions for Articulostienda model.
 */
class ArticulostiendaController extends Controller
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
     * Lists all Articulostienda models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticulostiendaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Articulostienda model.
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
     * Creates a new Articulostienda model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Articulostienda();
        $modelousuario = new Articulos();
		$modelotienda= new Tiendas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
		
		$modelotienda = Tiendas::findOne($idtienda=Yii::$app->request->get('id_tienda'));
        $modeloart=Articulos::findOne($idarticulo=Yii::$app->request->get('id_articulo'));

        if ($modeloart === null || $modelotienda === null) {
            
            return $this->redirect(['elegir_tienda']);

        }

        $model->articulo_id= $idarticulo;
		$model->tienda_id= $idtienda;
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Articulostienda model.
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
     * Deletes an existing Articulostienda model.
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
     * Finds the Articulostienda model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Articulostienda the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Articulostienda::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	public function actionElegir_tienda()
    {
        $searchModel = new TiendasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('elegir_tienda', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionElegir_articulo()
    {
        if (Tiendas::findOne($id_tienda=Yii::$app->request->get('id_tienda')) === null) {
            
            return $this->redirect(['elegir_tienda']);

        }

        $searchModel = new ArticulosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('elegir_articulo', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id_tienda' => $id_tienda,
        ]);
    }
}

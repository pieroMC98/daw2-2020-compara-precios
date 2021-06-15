<?php

namespace app\controllers;

use Yii;
use app\models\Articulos;
use app\models\ArticulosSearch;
use app\models\Avisosusuarios;

use app\models\Categorias;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Tiendas;
use app\models\TiendasSearch;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
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
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['view', 'create', 'delete','update'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['view', 'create', 'delete','update'],
                        'roles' => ['admin', 'sysadmin'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','view'],
                        'roles' => ['?', '@'],
                    ],
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

        $imagen = new UploadForm();
        //Si venimos del submit del formulario 
        if ($model->load(Yii::$app->request->post())) {
             // añadi todo eso 
        //     $model->imagen_id = $imagen->imageFile;
             $imagen->imageFile = UploadedFile::getInstance($imagen, 'imageFile');
             if ($imagen->upload()) {
                 //$extension = //substr($imagen->imageFile->name,-4);
                 $extension = substr($imagen->imageFile->name,strrpos($imagen->imageFile->name,"."));
                 rename("../web/uploads/".$imagen->imageFile->name,"../web/iconos/articulos/".$model->nombre.$extension);
                  $model->imagen_id = $model->nombre.$extension;
                }
            
            $model->crea_usuario_id = 0;
            $model->modi_usuario_id= 0;
            $model->crea_fecha = date('Y-m-d h:i:s');
            $model->modi_fecha = NULL;

           if($model->save())
            return $this->redirect(['view', 'id' => $model->id]);

        }
        $cargarCategorias = \yii\helpers\ArrayHelper::map(Categorias::find()->all(), 'id', 'nombre');
        return $this->render('create', [ 
            'model' => $model,'categorias'=>$cargarCategorias,'imagen'=>$imagen

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

        $imagen = new UploadForm();

        if ($model->load(Yii::$app->request->post())) {
            // añadi todo eso 
       //     $model->imagen_id = $imagen->imageFile;
            $imagen->imageFile = UploadedFile::getInstance($imagen, 'imageFile');
            if ($imagen->upload()) {
                //$extension = //substr($imagen->imageFile->name,-4);
                $extension = substr($imagen->imageFile->name,strrpos($imagen->imageFile->name,"."));
                rename("../web/uploads/".$imagen->imageFile->name,"../web/iconos/articulos/".$model->nombre.$extension);
                 $model->imagen_id = $model->nombre.$extension;
               }

            $model->modi_fecha = date('Y-m-d h:i:s');
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $cargarCategorias = \yii\helpers\ArrayHelper::map(Categorias::find()->all(), 'id', 'nombre');
        return $this->render('update', [
            'model' => $model,'categorias'=>$cargarCategorias,'imagen'=>$imagen
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
	
	public function actionElegir_articulo($modo=0,$id_tienda=null)
    {
		$modo=(int)$modo;
		
        if (Tiendas::findOne($id_tienda) === null) {
            $dev=null;
			($modo===0) ? $dev=$this->redirect(['tiendas/elegir_tienda','modo'=>2]) : $dev=$this->redirect(['tiendas/elegir_tienda','modo'=>1]);
            return $dev;

        }
		
		if($modo===1)
        {
			$searchModel = new ArticulosSearch();
			$searchModel->visible = 1;
			$searchModel->cerrado = 0;
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

			return $this->render('elegir_articulo_com', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'id_tienda' => $id_tienda,
			]);
		}

		if($modo===0)
        {
			$searchModel = new ArticulosSearch();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

			return $this->render('elegir_articulo', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'id_tienda' => $id_tienda,
			]);
		}
		
		return $this->goHome();
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

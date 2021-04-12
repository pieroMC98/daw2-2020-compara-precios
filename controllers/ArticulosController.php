<?php

namespace app\controllers;

use Yii;
use app\models\Articulos;
use app\models\ArticulosSearch;
use app\models\Categorias;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\filters\AccessControl;


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
                'dataProvider' => $dataProvider
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
        $model = $this->findModel($id);
        
        return $this->render('view', [
            'model' => $model
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
}

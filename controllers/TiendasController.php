<?php

namespace app\controllers;

use Yii;
use yii\db\Expression;
use app\models\Avisosusuarios;
use app\models\Tiendas;
use app\models\TiendasSearch;
use app\models\Usuarios;
use app\models\UsuariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

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
            ],/*
            'access' => [
              'class' => AccessControl::className(),
              'rules' => [
                  [
                      'allow' => true,
                      'actions' => ['index', 'view', 'update', 'bloqueo', 'quitabloqueo', 'propietarios', 'propietarios_view', 'propietarios_update',''],
                      'roles' => ['admin','moderador', 'sysadmin'],
                  ],
                  [
                      'allow' => true,
                      'actions' => ['delete', 'create', 'propietarios_delete', 'elegir_tienda', 'crear_propietario'],
                      'roles' => ['admin', 'sysadmin'],
                  ],
                  [
                      'allow' => true,
                      'actions' => ['denuncia'],
                      'roles' => ['admin', 'sysadmin','moderador', 'normal'],
                  ],
              ],
            ],*/
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

    public function actionPropietarios()
    {
        $searchModel = new TiendasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('propietarios', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPropietarios_view($id)
    {
        return $this->render('propietarios_view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionPropietarios_update($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['propietarios_view', 'id' => $model->id]);
        }

        return $this->render('propietarios_update', [
            'model' => $model,
        ]);
    }

    public function actionPropietarios_delete($id)
    {
        $var_delete=$this->findModel($id);

        $var_delete->deletePropietario();
        return $this->redirect(['propietarios']);
    }

    public function actionElegir_tienda($modo=0)
    {	$modo=(int)$modo;
        $searchModel = new TiendasSearch();
		
		//viene desde articulos-tienda y va a usuarios 
		if($modo===2)
		{
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
			return $this->render('elegir_tienda_articulo', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);
		}
		
       
		if($modo===1)
		{
			$searchModel->cerrada = 0;
			$searchModel->bloqueada = 0;
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
			return $this->render('elegir_tienda_com', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);
		}
		
		if($modo===0)
		{
			$searchModel->usuario_id = 0;
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
			return $this->render('elegir_tienda', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);
		}
		
		return $this->goHome();
        
    }

    public function actionCrear_propietario()
    {
        $model = $this->findModel(Yii::$app->request->get('id_tienda'));
        $modelousuario = new Usuarios();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['propietarios_view', 'id' => $model->id]);
        }
		
        $modelousuario=Usuarios::findOne(Yii::$app->request->get('id_usuario'));

        if ($model === null || $modelousuario === null) {
            
            return $this->redirect(['elegir_tienda']);

        }

        $model->usuario_id= $modelousuario->id;
        $model->nombre = $modelousuario->nombre;
        $model->apellidos = $modelousuario->apellidos;
        $model->direccion = $modelousuario->direccion;
        $model->region_id = $modelousuario->region_id;
        $model->telefono_contacto = $modelousuario->telefono_contacto;
        
        return $this->render('crear_propietario', [
            'model' => $model,
        ]);
    }

        public function actionBloqueo($id)
    {
        $model = $this->findModel($id);

        $model->scenario='bloqueo';

        if($model->bloqueada!=0){

              return $this->redirect(['view', 'id' => $model->id]);
        }

        if ($model->load(Yii::$app->request->post())) {
            
            $model->bloqueada=2;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('bloqueos', [
            'model' => $model,
        ]);
    }

    public function actionDenuncia($id)
    {
       $model = $this->findModel($id);

        $aviso = new Avisosusuarios();

        if ($model->load(Yii::$app->request->post()) || $aviso->load(Yii::$app->request->post())) {

          

          $aviso->clase_aviso='D';
          $aviso->fecha_aviso=new Expression('NOW()');
          $aviso->tienda_id=$model->id;
          
          $model->num_denuncias=$model->num_denuncias+1;

          /*El numero maximo de denuncias es 10 */
          if($model->num_denuncias===10){

            //$model->num_denuncias=$model->num_denuncias+1;
              $model->bloqueada=1;
              $model->fecha_bloqueo=new Expression('NOW()');
          }

          

          if($model->num_denuncias===1){
			$model->fecha_denuncia1=new Expression('NOW()');
            $aviso->texto=$model->notas_denuncia;
          }
		  
		  $model->save();
          $aviso->save();

          return $this->goHome();
        }

        if($model->num_denuncias===0){

            return $this->render('denuncias', [
              'model' => $model, 'aviso' => $aviso
            ]);

        }else{
           return $this->render('denuncias2', [
              'model' => $model, 'aviso' => $aviso
            ]);
        }
        
    }

    public function actionQuitabloqueo($id)
    {
        $model = $this->findModel($id);

        if($model===NULL){
            return $this->redirect(['view', 'id' => $model->id]);
        }

        if($model->bloqueada!=0){

            $model->bloqueada=0;
            $model->notas_denuncia=NULL;
            $model->num_denuncias=0;
            $model->notas_denuncia=NULL;
            $model->fecha_bloqueo=NULL;
            $model->notas_bloqueo=NULL;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        };
    }
}

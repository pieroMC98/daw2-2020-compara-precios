<?php

namespace app\controllers;

use Yii;
use app\models\Tiendas;
use app\models\TiendasSearch;
use app\models\Usuarios;
use app\models\UsuariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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

    public function actionElegir_tienda()
    {
        $searchModel = new TiendasSearch();
        $searchModel->scenario='elegir_tienda';
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('elegir_tienda', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionElegir_usuario()
    {
        if (Tiendas::findOne($id_tienda=Yii::$app->request->get('id_tienda')) === null) {
            
            return $this->redirect(['elegir_tienda']);

        }

        $searchModel = new UsuariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('elegir_usuario', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id_tienda' => $id_tienda,
        ]);
    }

    public function actionCrear_propietario()
    {
        $model = new Tiendas();
        $modelousuario = new Usuarios();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $model=Tiendas::findOne(Yii::$app->request->get('id_tienda'));
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
}

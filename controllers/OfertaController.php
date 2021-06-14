<?php

namespace app\controllers;

use Yii;
use app\models\Oferta;
use app\models\OfertaSearch;
use app\models\Avisosusuarios;
use app\models\HistoricoPrecios;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * OfertaController implements the CRUD actions for Oferta model.
 */
class OfertaController extends Controller
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
                'only' => ['index', 'view', 'create', 'recuperar', 'delete'],
                'rules' => [
                    /* DESCOMENTAR CUANDO ESTE EL CONTROL DE PERMISOS 
                    [
                        'allow' => true,
                        'actions' => ['view', 'create', 'delete'],
                        'roles' => ['admin', 'sysadmin', 'propietario'],
                    ],*/
                    [
                        'allow' => true,
                        // DESCOMENTAR CUANDO ESTE EL CONTROL DE PERMISOS 'actions' => ['index', 'public'],
                        'roles' => ['?', '@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['seguimiento', 'quitarseguimiento'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Oferta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OfertaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Oferta model.
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
     * Creates a new Oferta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Oferta();
        $aviso = new Avisosusuarios();
        $historico = new HistoricoPrecios();

        $aviso->clase_aviso = 'N';
        $aviso->fecha_aviso = new Expression('NOW()');
        $aviso->texto = 'Aviso del sistema: nueva oferta';
        $aviso->tienda_id = $model->tienda_id;
        $aviso->articulo_id = $model->articulo_id;

        $historico->articulo_id = $model->articulo_id;
        $historico->tienda_id = $model->tienda_id;
        $historico->fecha = new Expression('NOW()');
        $historico->precio = $model->precio_oferta;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $aviso->save();
            $historico->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Oferta model.
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
     * Deletes an existing Oferta model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        $aviso = new Avisosusuarios();

        $aviso->clase_aviso = 'N';
        $aviso->fecha_aviso = new Expression('NOW()');
        $aviso->texto = 'Aviso del sistema: oferta eliminada';
        $aviso->origen_usuario_id = 0;
        //$aviso->tienda_id = $model->tienda_id;
        //$aviso->articulo_id = $model->articulo_id;

        return $this->redirect(['index']);
    }

    /**
     * Finds the Oferta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Oferta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Oferta::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new Seguimiento usuarios model from the articulo.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionSeguimiento($id)
    {
        if (Yii::$app->user->getId() != NULL) {
            return $this->redirect(['seguimientos-usuario/seguimiento', 'id_articulo' => '', 'id_tienda' => '', 'id_oferta' => $id]);
        } else {
            return $this->redirect(['site/login', 'error' => 'No se puede seguir una oferta si no estas conectado']);
        }
    }

    /**
     * Creates a new Seguimiento usuarios model from the articulo.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionQuitarseguimiento($id)
    {
        if (Yii::$app->user->getId() != NULL) {
            return $this->redirect(['seguimientos-usuario/quitarseguimiento', 'id' => $id]);
        } else {
            return $this->redirect(['site/login', 'error' => 'No se puede seguir un articulo si no estas conectado']);
        }
    }
}

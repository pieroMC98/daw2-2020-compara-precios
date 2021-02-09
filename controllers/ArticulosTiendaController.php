<?php

namespace app\controllers;

use Yii;
<<<<<<< HEAD
use app\models\Articulostienda;
use app\models\ArticulostiendaSearch;
=======
use app\models\articulostienda;
use app\models\articulostiendaSearch;
>>>>>>> 4f292c02449476aa1046f6afaba692881f2a80ca
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
<<<<<<< HEAD
 * ArticulostiendaController implements the CRUD actions for Articulostienda model.
=======
 * ArticulostiendaController implements the CRUD actions for articulostienda model.
>>>>>>> 4f292c02449476aa1046f6afaba692881f2a80ca
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
<<<<<<< HEAD
     * Lists all Articulostienda models.
=======
     * Lists all articulostienda models.
>>>>>>> 4f292c02449476aa1046f6afaba692881f2a80ca
     * @return mixed
     */
    public function actionIndex()
    {
<<<<<<< HEAD
        $searchModel = new ArticulostiendaSearch();
=======
        $searchModel = new articulostiendaSearch();
>>>>>>> 4f292c02449476aa1046f6afaba692881f2a80ca
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
<<<<<<< HEAD
     * Displays a single Articulostienda model.
=======
     * Displays a single articulostienda model.
>>>>>>> 4f292c02449476aa1046f6afaba692881f2a80ca
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
<<<<<<< HEAD
     * Creates a new Articulostienda model.
=======
     * Creates a new articulostienda model.
>>>>>>> 4f292c02449476aa1046f6afaba692881f2a80ca
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
<<<<<<< HEAD
        $model = new Articulostienda();
=======
        $model = new articulostienda();
>>>>>>> 4f292c02449476aa1046f6afaba692881f2a80ca

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
<<<<<<< HEAD
     * Updates an existing Articulostienda model.
=======
     * Updates an existing articulostienda model.
>>>>>>> 4f292c02449476aa1046f6afaba692881f2a80ca
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
<<<<<<< HEAD
     * Deletes an existing Articulostienda model.
=======
     * Deletes an existing articulostienda model.
>>>>>>> 4f292c02449476aa1046f6afaba692881f2a80ca
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
<<<<<<< HEAD
     * Finds the Articulostienda model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Articulostienda the loaded model
=======
     * Finds the articulostienda model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return articulostienda the loaded model
>>>>>>> 4f292c02449476aa1046f6afaba692881f2a80ca
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
<<<<<<< HEAD
        if (($model = Articulostienda::findOne($id)) !== null) {
=======
        if (($model = articulostienda::findOne($id)) !== null) {
>>>>>>> 4f292c02449476aa1046f6afaba692881f2a80ca
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

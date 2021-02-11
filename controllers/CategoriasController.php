<?php

namespace app\controllers;

use Yii;
use app\models\Categorias;
use app\models\CategoriasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;

/**
 * CategoriasController implements the CRUD actions for Categorias model.
 */
class CategoriasController extends Controller
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
     * Lists all Categorias models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategoriasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Categorias models.
     * @return mixed
     */
    public function actionPublic()
    {
        $searchModel = new CategoriasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('public', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Categorias model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'subcategorias' => $this->getSubcategorias($id),
            'articulos' => $this->getArticulos($id)
        ]);
    }

    /**
     * Creates a new Categorias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Categorias();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Categorias model.
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
     * Deletes an existing Categorias model.
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
     * Finds the Categorias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Categorias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categorias::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    //Devuelve las subcategor�as de una categor�a
    public function getSubcategorias($id)
    {
        $query = new Query;
        $rows=array();
        $i = 1;
        $j =0;
        // compose the query
        $query->select('id, nombre')
            ->from('categorias')
            ->where(['=', 'categoria_id', $id]);

        $hijoSiguiente = sprintf("hijo-%d-%d",$j,$i);
        // build and execute the query
        $rows['hijos'.$j][$hijoSiguiente] = $query->all();
        $rows['numeroHijos'.$j] = $i;
        $j++;
       
        do{
            $i=1;
            foreach ($rows['hijos'.$j-1]['hijo-'.($j-1).'-'.$i] as $row)
            {
                //var_dump($row);
                $query->select('id, nombre')
                ->from('categorias')
                ->where(['=', 'categoria_id', $row['id']]);

                $hijoSiguiente = sprintf("hijo-%d-%d",$j,$i);
                $rows['hijos'.$j][$hijoSiguiente] = $query->all();
                $i++;
            }
            $rows['numeroHijos'.$j] = $i-1;
            $j++;
        }while(!empty($rows['hijos'.$j-1]) );
        $rows['numeroNiveles']=$j;

        return $rows;
    }

    //Devuelve los articulos de una categor�a
    public function getArticulos($id)
    {
        $query = new Query;
        // compose the query
        $query->select('id, nombre')
            ->from('articulos')
            ->where(['=', 'categoria_id', $id]);
        // build and execute the query
        $rows = $query->all();

        return $rows;
    }
}

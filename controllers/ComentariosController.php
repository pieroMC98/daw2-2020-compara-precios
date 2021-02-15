<?php

namespace app\controllers;

use Yii;
use yii\db\Expression;
use app\models\Comentarios;
use app\models\ComentariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Tiendas;
use app\models\TiendasSearch;
use app\models\Articulos;
use app\models\ArticulosSearch;
use app\models\Articulostienda;
use app\models\ArticulostiendaSearch;
use app\models\Avisosusuarios;

/**
 * ComentariosController implements the CRUD actions for Comentarios model.
 */
class ComentariosController extends Controller
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
     * Lists all Comentarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ComentariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Comentarios model.
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
     * Creates a new Comentarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($tienda_id,$articulo_id=null,$comentario_id=null)
    {
        $model = new Comentarios(['scenario'=>'crear']);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			
			//actualizar votos
			$modelAT=Articulostienda::findOne(['tienda_id' => $model->tienda_id, 'articulo_id' => $model->articulo_id]);
			if($modelAT!==null){
				$modelAT->actualizarVotos();
			}
			
			$modelT=Tiendas::findOne($model->tienda_id);
			if($modelT!==null){
				$modelT->actualizarVotos();
			}
			
            return $this->redirect(['view', 'id' => $model->id]);
        }
		
		$model->tienda_id=$tienda_id;
		$model->articulo_id=$articulo_id;
		$model->comentario_id=$comentario_id;

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Comentarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			
			//actualizar votos
			$modelAT=Articulostienda::findOne(['tienda_id' => $model->tienda_id, 'articulo_id' => $model->articulo_id]);
			if($modelAT!==null){
				$modelAT->actualizarVotos();
			}
			
			$modelT=Tiendas::findOne($model->tienda_id);
			if($modelT!==null){
				$modelT->actualizarVotos();
			}
			
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Comentarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    /*
		Funcion para mostrar un comentario como eliminado con un mensaje pero realmente sigue en la base de datos, por lo que en la vista publica los hijos se muestran.
    */
		
    public function actionDelete($id)
    {
        $var_delete=$this->findModel($id);

        $var_delete->deleteComentario();

        //actualizar votos
		$modelAT=Articulostienda::findOne(['tienda_id' => $var_delete->tienda_id, 'articulo_id' => $var_delete->articulo_id]);
		if($modelAT!==null){
			$modelAT->actualizarVotos();
		}
		
		$modelT=Tiendas::findOne($var_delete->tienda_id);
		if($modelT!==null){
			$modelT->actualizarVotos();
		}

        return $this->redirect(['index']);
    }

    /*
		Funcion interna para el progrmador por si quiere eliminar un comentario de la Base de Datos completamente (dejando sus hijos)
    */
    public function actionDelete_padre($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /*
		Funcion interna para que el programador pueda eliminar un comentario y los hijos de este completamente de la base de datos 
    */

    public function actionDelete_all($id)
    {
		if($id===null || $id==0) return;
		
    	$this->findModel($id)->delete();

    	$hijos=Comentarios::findAll(['comentario_id'=>$id]);

    	foreach ($hijos as $coment) {
			
			
			$this->actionDelete_all($coment->id);
    		$coment->delete();
    	}

        return $this->redirect(['index']);
    }


    /**
     * Finds the Comentarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comentarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comentarios::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	public function actionElegir_comentario($modo=0, $tienda_id=null, $articulo_id=null)
    {
		
        if (Tiendas::findOne($tienda_id) === null) {
            
            return $this->redirect(['tiendas/elegir_tienda','modo'=>1]);
        }
		
		if (Articulos::findOne($articulo_id) === null) {
            $articulo_id=null;
        }
		
		$tiene_articulo=null;
		if($articulo_id===null)
		{
			$tiene_articulo=0;
		}
		else
		{
			$tiene_articulo=$articulo_id;
		}

		$searchModel = new ComentariosSearch();
		$searchModel->tienda_id=$tienda_id;
		$searchModel->articulo_id=$tiene_articulo;
		$searchModel->cerrado=0;
		$searchModel->bloqueado=0;
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('elegir_comentario', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
			'tienda_id' => $tienda_id,
			'articulo_id' => $articulo_id,
		]);
    }

    public function actionBloqueo($id)
    {
        $model = $this->findModel($id);

        $model->scenario='bloqueo';

        if($model->bloqueado!=0){

        	  return $this->redirect(['view', 'id' => $model->id]);
        }

        if ($model->load(Yii::$app->request->post())) {
			
			$model->bloqueado=2;
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
	        $aviso->comentario_id=$model->id;
	        

	        $model->num_denuncias=$model->num_denuncias+1;

	        /*El numero maximo de denuncias es 10 */
	        if($model->num_denuncias===10){

	        	//$model->num_denuncias=$model->num_denuncias+1;
	        	$model->bloqueado=1;
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

        if($model->bloqueado!=0){

        	$model->bloqueado=0;
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

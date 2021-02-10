<?php

namespace app\controllers;

use Yii;
use app\models\CopiasSeg;
use app\models\CopiasSegSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CopiasSegController implements the CRUD actions for CopiasSeg model.
 */
class CopiasSegController extends Controller
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
                    'recuperar' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all CopiasSeg models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CopiasSegSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CopiasSeg model.
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
     * Creates a new CopiasSeg model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CopiasSeg();

        $tablas = array("articulos","articulos_etiquetas","articulos_tienda","avisos_usuarios",
               "categorias","clasificadores","comentarios","configuraciones","etiquetas",
               "historico_precios","moderadores","ofertas","regiones","regiones_moderador",
               "registros_aplicacion","seguimientos_usuario","tiendas","tiendas_etiquetas","usuarios", "copias_seg");

        // datos de la tabla
        $model['fecha'] = date('Y-m-d-H-i-s');
        $model['ruta'] = 'BackUp'.date('Y-m-d-H-i-s').'';
        
        if ($model->save()){
            $ruta= "backups/".$model['ruta']."";
            // compruebo que existe la carpeta para guardar las copias, si no existe la creo.
            if (!is_dir('../backups'))  
                mkdir('../backups', 0777);
            
            mkdir('../'.$ruta, 0777);

            foreach($tablas as $tabla)
            {
                //Indico mi consulta a obtener
                $command = Yii::$app->db->createCommand("SELECT * INTO OUTFILE '../../htdocs/daw2-2020-compara-precios/{$ruta}/{$tabla}.bk' FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' FROM {$tabla}");
                //Acciono el query del $command
                $dataReader = $command->query();
            }
            //
            if( is_dir('../'.$ruta) ){
                
                    return $this->redirect(['view', 'id' => $model->id]);  
            }
        }

    }

    public function actionRecuperar($id)
    {
        //$model = new CopiasSeg();

        $ruta="backups/".$this->findModel($id)->buscaRuta($id);

        $tablas = array("articulos","articulos_etiquetas","articulos_tienda","avisos_usuarios",
               "categorias","clasificadores","comentarios","configuraciones","etiquetas",
               "historico_precios","moderadores","ofertas","regiones","regiones_moderador",
               "registros_aplicacion","seguimientos_usuario","tiendas","tiendas_etiquetas","usuarios", "copias_seg");

        foreach($tablas as $tabla)
        {
            //Indico mi consulta a obtener
            $command = Yii::$app->db->createCommand("DELETE FROM {$tabla}");
            $dataReader = $command->query();
            $command = Yii::$app->db->createCommand("LOAD DATA INFILE '../../htdocs/daw2-2020-compara-precios/{$ruta}/{$tabla}.bk' INTO TABLE {$tabla} FIELDS TERMINATED BY ','  LINES TERMINATED BY '\\n'");
            //Acciono el query del $command
            $dataReader = $command->query();
            
        }
        return $this->redirect(['index']);
    }


    /**
     * Deletes an existing CopiasSeg model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $ruta=$this->findModel($id)->buscaRuta($id);
        //$this->buscaRuta($id);
        chdir('../backups/'.$ruta);
        $directorio=dir ('.');

        while ($entrada = $directorio->read()) {
            if(!is_dir($entrada)){
                unlink($entrada);
            }
        }
        rmdir('../'.$ruta); 
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CopiasSeg model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CopiasSeg the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CopiasSeg::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

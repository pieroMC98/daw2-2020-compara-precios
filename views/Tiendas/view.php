<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\db\Query;

function enSeguimiento($model_id){
    
    $query = new Query;
    $query->select('id')
        ->from('seguimientos_usuario')
        ->where(['=', 'tienda_id', $model_id])
        ->andWhere(['=', 'usuario_id', Yii::$app->user->getId()]);
    $rows = $query->all();

    return $rows;
}


/* @var $this yii\web\View */
/* @var $model app\models\Tiendas */

$this->title = $model->nombre_tienda;
$this->params['breadcrumbs'][] = ['label' => 'Tiendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tiendas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar datos', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
        if($model->bloqueada===0){

            echo Html::a('Bloquear', ['bloqueo', 'id' => $model->id], ['class' => 'btn btn-warning']); 
        }

        if($model->bloqueada!==0){

            echo Html::a('Quitar bloqueo', ['quitabloqueo', 'id' => $model->id], ['class' => 'btn btn-warning']); 
        }

        ?>
        <?= Html::a('Eliminar tienda', ['delete', 'id' => $model->id], [ 'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        
        <?php
        $res = enSeguimiento($model->id);
        if(count($res)===0)
        {?>
            <?=Html::a('Seguir', ['seguimiento', 'id' => $model->id], ['class' => 'btn btn-primary'])?>
        <?php }
        else{?>
            <?=Html::a('Dejar de seguir', ['quitarseguimiento', 'id' => $res[0]['id']],[
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estas seguro de que quieres dejar de seguir esta tienda?',
                'method' => 'post',
            ],
            ]) ?>
        <?php } ?>

        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

        <?php /*Boton para probar la denuncia publica echo Html::a('Denuncia?', ['denuncia', 'id' => $model->id], ['class' => 'btn btn-primary'])*/?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre_tienda:ntext',
            'descripcion_tienda:ntext',
            'lugar_tienda:ntext',
            'url_tienda:url',
            'direccion_tienda:ntext',
            'region_id_tienda',
            'telefono_tienda',
            'clasificacion_id',
            'imagen_id',
            'sumaValores',
            'totalVotos',
            'visible',
            'cerrada',
            'num_denuncias',
            'fecha_denuncia1',
            'notas_denuncia:ntext',
            'bloqueada',
            'fecha_bloqueo',
            'notas_bloqueo:ntext',
            'cerrado_comentar',
            'usuario_id',
            'nif_cif',
            'nombre',
            'apellidos',
            'razon_social',
            'direccion:ntext',
            'region_id',
            'telefono_contacto',
            'crea_usuario_id',
            'crea_fecha',
            'modi_usuario_id',
            'modi_fecha',
            'notas_admin:ntext',
            'etiquetaId',
        ],
    ]) ?>

    

</div>

<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\db\Query;

function enSeguimiento($model_id){
    
    $query = new Query;
    $query->select('id')
        ->from('seguimientos_usuario')
        ->where(['=', 'articulo_id', $model_id])
        ->andWhere(['=', 'usuario_id', Yii::$app->user->getId()]);
    $rows = $query->all();

    return $rows;
}


/* @var $this yii\web\View */
/* @var $model app\models\Articulos */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Articulos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="articulos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        
        <?php
        $res = enSeguimiento($model->id);
        if(count($res)===0)
        {?>
            <?=Html::a('Seguir', ['seguimiento', 'id' => $model->id], ['class' => 'btn btn-primary'])?>
        <?php }
        else{?>
            <?=Html::a('Dejar de seguir', ['quitarseguimiento', 'id' => $res[0]['id']], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estas seguro de que quieres dejar de seguir este artículo?',
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
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre:ntext',
            'descripcion:ntext',
            'categoria_id',
            'imagen_id',
            'visible',
            'cerrado',
            'comun',
            'crea_usuario_id',
            'crea_fecha',
            'modi_usuario_id',
            'modi_fecha',
            'notas_admin:ntext',
        ],
    ]) ?>

</div>

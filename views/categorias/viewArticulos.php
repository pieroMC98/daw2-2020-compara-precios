<?php
use yii\helpers\Html;
use yii\grid\GridView;
//ArticulosSearch%5Bcategoria_id%5D='.$array[$i]['id'].'
function recorrerCategorias($array, $display){
    $n_hijos=count($array);
    for( $i=0; $i<$n_hijos; $i++){
        
        if($display==1){
            echo '</br>';
            echo "<a href='index.php?ArticulosSearch%5Bcategoria_id%5D=".$array[$i]['id']."&r=categorias%2Fviewarticulos&id=".$array[$i]['id']."'><span class='tam-".$display."'>".$array[$i]['nombre']."</span></a>  ";
            echo '<div class="row">';
        }
        else if($display==2){
            echo '<div class="col-md-4">';
            echo "<a href='index.php?ArticulosSearch%5Bcategoria_id%5D=".$array[$i]['id']."&r=categorias%2Fviewarticulos&id=".$array[$i]['id']."'><span class='tam-".$display."'>".$array[$i]['nombre']."</span></a>  ";
        }else{
            echo "<a href='index.php?ArticulosSearch%5Bcategoria_id%5D=".$array[$i]['id']."&r=categorias%2Fviewarticulos&id=".$array[$i]['id']."'><span class='tam-".$display."'>".$array[$i]['nombre']."</span></a>  ";
        }
        
        if(!empty($array[$i]['hijos'])){
            recorrerCategorias( $array[$i]['hijos'], $display+1);
        }

        if($display==1){
            echo '</div>';
            echo '<hr>';
        }
        else if($display==2){
            echo '</div>'; 
        }
    }
}

/* @var $this yii\web\View */
/* @var $model app\models\Categorias */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Categorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="categorias-view">

    <h1><?= Html::encode($model->nombre) ?></h1>
    <p><?php echo $model['descripcion']; ?></p>
    <?php
    if(!empty($subcategorias)){
        echo '<h2>Subcategorias</h2>';
        recorrerCategorias($subcategorias, 1);
    }
    ?>
    <h2>Productos</h2>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nombre:ntext',
            'descripcion:ntext',
            //'categoria_id',
            'categoriaNombre',
            //'imagen_id',
            //'visible',
            //'cerrado',
            //'comun',
            //'crea_usuario_id',
            //'crea_fecha',
            //'modi_usuario_id',
            //'modi_fecha',
            //'notas_admin:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

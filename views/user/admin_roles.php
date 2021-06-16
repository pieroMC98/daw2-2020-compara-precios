<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Administrar Roles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);
     ?>

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'email:email',
            //'password',
            'nick',
            'nombre',
            //'apellidos',
            //'fecha_nacimiento',
            //'direccion:ntext',
            //'zona_id',
            //'fecha_registro',
            //'confirmado',
            //'fecha_acceso',
            //'num_accesos',
            //'bloqueado',
            //'fecha_bloqueo',
            //'notas_bloqueo:ntext',
            [
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'value' => function ($dataProvider) 
                {

                    $userRole = Yii::$app->authManager->getRolesByUser($dataProvider->id);

                    if ($userRole) {

                        foreach ($userRole as $role) {
                           $roles[] = $role->name;
                        }

                        // if user have 1 role then $userRole will be a string containing it
                        // othewhise let $userRole be an array containing them all

                        $userRole = count($roles) === 1 ? $roles[0] : $roles ;
                    }

                    return $userRole; 
                },
                'label' => 'Rol',

            ],

            [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{ascender}',  // your custom button
            'buttons' => [
                    'ascender' => function ($dataProvider) {
                        $id=substr($dataProvider,-2);

                        $userRole = Yii::$app->authManager->getRolesByUser($id);

                        if ($userRole) 
                        {

                            foreach ($userRole as $role) {
                               $roles[] = $role->name;
                            }

                            // if user have 1 role then $userRole will be a string containing it
                            // othewhise let $userRole be an array containing them all

                            $userRole = count($roles) === 1 ? $roles[0] : $roles ;
                        }

                        if ($userRole=='sysadmin') return 'No se puede ascender';
                        else return Html::a('Ascender', ['usuarios/admin', 'id'=>$id, 'opcion'=>'ascender', 'rol'=>$userRole]);
                    },
                ]
            
             ],


             [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{degradar}',  // your custom button
            'buttons' => [
                    'degradar' => function ($dataProvider) {
                        $id=substr($dataProvider,-2);

                        $userRole = Yii::$app->authManager->getRolesByUser($id);

                        if ($userRole) 
                        {

                            foreach ($userRole as $role) {
                               $roles[] = $role->name;
                            }

                            // if user have 1 role then $userRole will be a string containing it
                            // othewhise let $userRole be an array containing them all

                            $userRole = count($roles) === 1 ? $roles[0] : $roles ;
                        }

                        if ($userRole=='usuario') return 'No se puede degradar';
                        else return Html::a('Degradar', ['usuarios/admin', 'id'=>$id, 'opcion'=>'degradar', 'rol'=>$userRole]);
                    },
                ]
            
             ],

             [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{proveedor}',  // your custom button
            'buttons' => [
                    'proveedor' => function ($dataProvider) {
                        $id=substr($dataProvider,-2);

                        $userRole = Yii::$app->authManager->getRolesByUser($id);

                        if ($userRole) 
                        {

                            foreach ($userRole as $role) {
                               $roles[] = $role->name;
                            }

                            // if user have 1 role then $userRole will be a string containing it
                            // othewhise let $userRole be an array containing them all

                            $userRole = count($roles) === 1 ? $roles[0] : $roles ;
                        }

                        if ($userRole=='patrocinador') return 'El usuario ya es proveedor';
                        else return Html::a('Ampliar a proveedor', ['proveedores/create', 'id'=>$id]);
                    },
                ]
            
             ],
              

             
    
            
            
        ],

    ]); ?>
</div>
<?php

 namespace app\widgets;

 use yii\bootstrap\Widget;
 use yii\bootstrap\Tabs;
 use Yii;

 class Tab extends Widget
 {
     public function run()
     {
         echo Tabs::widget([
             'items' => [
                 [
                     'label' => 'Tiendas',
                     'content' => 'Tiendas de ' . Yii::$app->user->identity->username,
                     'active' => true
                 ],
                 [
                     'label' => 'Productos',
                     'content' => 'Productos de ' . Yii::$app->user->identity->username,
                     'active' => true
                 ],
                 [
                     'label' => 'Alertas',
                     'content' => 'Alertas de ' . Yii::$app->user->identity->username,
                 ],
             ],

         ]);
     }
 }
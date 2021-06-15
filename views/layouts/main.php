<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>

<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />

    <link rel="stylesheet" href="css/prueba.css">

    <?php $this->registerCsrfMetaTags() ?>

    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head(); ?>
</head>
<body>
<?php $this->beginBody(); ?>

<div class="wrap">
    <?php
    NavBar::begin([
    	'brandLabel' => Yii::$app->name,
    	'brandUrl' => Yii::$app->homeUrl,
    	'options' => ['class' => 'navbar-inverse navbar-fixed-top'],
    ]);

    echo Nav::widget([
    	'options' => ['class' => 'navbar-nav navbar-right'],
    	'items' => [
            ['label' => 'Inicio', 'url' => ['/site/index']],
            ['label' => 'Tiendas', 'url' => ['/tiendas']],
            ['label' => 'Artículos', 'url' => ['/articulos']],
            ['label' => 'Categorías', 'url' => ['/categorias']],
            ['label' => 'Histórico', 'url' => ['/historico-precios']],
            ['label' => 'Avisos', 'url' => ['/avisos-usuarios']],

            Yii::$app->user->isGuest
    			? ['label' => 'Iniciar Sesión / Registrarse', 'url' => ['/user/login']]
    			: [
    				'label' => Yii::$app->user->identity->nick,
    				'items' => [
    					[
    						'label' => 'Cuenta',
    						'url' => ['user/get'],
    						'id' => Yii::$app->user->identity->id,
    					],
    					['label' => 'logout', 'url' => ['/user/logout']],
						
						Yii::$app->user->identity->rol == 'admin' ? 
    					['label' => 'Mantenimiento', 'url' => ['/usuarios']] : "",

                        Yii::$app->user->identity->rol == 'admin' ? 
    					['label' => 'Administración', 'url' => ['/site/menu_admin']] : "",

    				],
    			],
        ],
    ]);    

    NavBar::end();
    ?>
	<?php if (isset($this->params['msg']) && $this->params['msg'] != ''): ?>
		<div class="container">
				<div class="alert alert-warning" role="alert">
					<strong>
						<?= $this->params['msg'] ?>
					</strong>
				</div>
		</div>
	<?php endif; ?>
  <div class="container">
        <?= Breadcrumbs::widget([
        	'links' => isset($this->params['breadcrumbs'])
        		? $this->params['breadcrumbs']
        		: [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>

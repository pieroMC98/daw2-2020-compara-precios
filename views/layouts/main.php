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
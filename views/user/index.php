<?php

use app\widgets\Tab;
use yii\helpers\Url;

$this->title = 'Usuario | ' . Yii::$app->user->identity->username;
?>

<div class="container">
    <div class="main-body">

        <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= Url::base(); ?>">Inicio</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Usuario</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo Yii::$app->user->identity->username; ?></li>
            </ol>
        </nav>



        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h4><?php echo Yii::$app->user->identity->username; ?></h4>
                                <p class="text-secondary mb-1">?Adminr</p>
                                <p class="text-muted font-size-sm">?info</p>
                                <button class="btn btn-primary">Seguir</button>
                                <button class="btn btn-outline-primary">Mensaje</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col">
                <?= Tab::widget() ?>
            </div>
        </div>
    </div>
</div>
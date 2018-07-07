<?php

/* @var $this \yii\web\View */
/* @var $content string */

//use app\widgets\Alert;
use kartik\widgets\Growl;
use yii\helpers\Html;
use yii\helpers\Url;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<html lang="<?= Yii::$app->language ?>">
<head>

    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode(Yii::$app->name) ?></title>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
<?php
if(Yii::$app->session->hasFlash('success')):
    echo Growl::widget([
        'type' => Growl::TYPE_SUCCESS,
        'icon' => 'glyphicon glyphicon-ok-sign',
        'title' => Yii::$app->session->getFlash('success'),
        'showSeparator' => false,
        //'body' => Yii::$app->session->getFlash('success'),
    ]);
endif;
?>

<?php
if(Yii::$app->session->hasFlash('error')):
    echo Growl::widget([
        'type' => Growl::TYPE_DANGER,
        'icon' => 'glyphicon glyphicon-remove-sign',
        //'title' => Yii::$app->session->getFlash('error'),
        'showSeparator' => false,

        'body' => Yii::$app->session->getFlash('error'),
        'pluginOptions' => [
            'delay' => false,

        ]
    ]);
endif;
?>
<nav class="navbar navbar-default navbar-fixed-top" style="z-index:99;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><img src="/images/lcm.png" style="margin:-9px 5px;" height="40px">LCM
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">

            <ul class="nav navbar-nav navbar-right">

                <?php if (Yii::$app->user->can('lcm_admin')):?>
                <li><a href='<?=Url::to(['admin/default']);?>' title="<?=Yii::t( 'admin_page', 'Admin part')?>"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a></li>
                <?php endif;?>
                <li><a href="<?=Url::to(['site/form']);?>" title="<?=Yii::t( 'menu_title', 'Create')?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></li>
                <li><a href="<?=Url::to(['attach/']);?>" title="<?=Yii::t( 'menu_title', 'Attach')?>"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span></a></li>
                <?php if(Yii::$app->params['search']):?>
                <li><a class="search_btn" title="<?=Yii::t( 'menu_title', 'Search')?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></li>
                <?php endif;?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>
                    <ul class="dropdown-menu">
                        <li><?=Yii::$app->user->identity->username?></li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="<?=Url::to(['site/logout/']);?>"><span class="glyphicon glyphicon-off" aria-hidden="true"></span><?=Yii::t( 'app', 'Exit' );?>
                            </a></li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<div class="container-fluid content_bl"<?php if(Yii::$app->request->get('filter')){?> style="padding-top: 116px;" <?php }?>>
<?= $content ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

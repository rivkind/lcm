<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'LCM';
?>
<div class='all_block'><div class='title_bl'><img src='/images/lcm.png' height='40px'/><?=$this->title;?></div>
    <div id='opacity_block'></div>
    <div class='form_block'>

        <?php $form = ActiveForm::begin(['enableClientValidation' => false]); ?>

        <?= $form->errorSummary($model, ['header' => '']) ?>


        <div class="inner-addon left-addon">
            <?= $form->field($model, 'username',['template' => "{input}"])->textInput(['autofocus' => true,'class' => 'form-control','placeholder' => Yii::t( 'login_page', 'Login' )])->label(false) ?>
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
        </div>
        <div class="inner-addon left-addon">
        <?= $form->field($model, 'password',['template' => "{input}"])->passwordInput(['class' => 'form-control','placeholder' => Yii::t( 'login_page', 'Password' )])->label(false) ?>
            <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
        </div>
        <div class="checkbox">
        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "{label}{input}",
        ])->label(Yii::t( 'login_page', 'Remember Me' )) ?>
        </div>
        <?= Html::submitButton(Yii::t( 'login_page', 'Enter' ), ['class' => 'btn btn-lg btn-primary btn-block', 'name' => 'login-button']) ?>
        <?php ActiveForm::end(); ?>



    </div>
</div>
<div id="particles-js"></div>



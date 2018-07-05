<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Network */

?>
<div class="network-update">


    <h1>
        <?php if($model->network_name):?>
            Обновление Network:<?= Html::encode($model->network_name) ?>
        <?php else:?>
            Создание Network
        <?php endif;?>
    </h1>

    <div class="node-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'network_name')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
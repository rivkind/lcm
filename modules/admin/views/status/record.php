<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Status */

?>
<div class="status-update">


    <h1>
        <?php if($model->status_name):?>
            Обновление Status:<?= Html::encode($model->status_name) ?>
        <?php else:?>
            Создание Status
        <?php endif;?>
    </h1>

    <div class="status-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'status_name')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
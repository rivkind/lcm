<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Type */

?>
<div class="type-update">


    <h1>
        <?php if($model->type_name):?>
            Обновление Type:<?= Html::encode($model->type_name) ?>
        <?php else:?>
            Создание Type
        <?php endif;?>
    </h1>

    <div class="type-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'type_name')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
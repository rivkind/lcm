<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Vendor */

?>
<div class="vendor-update">


    <h1>
        <?php if($model->vendor_name):?>
            Обновление Vendor:<?= Html::encode($model->vendor_name) ?>
        <?php else:?>
            Создание Vendor
        <?php endif;?>
    </h1>

    <div class="vendor-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'vendor_name')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t( 'app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
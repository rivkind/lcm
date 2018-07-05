<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Node */

$this->title = 'LCM Admin';
?>
<div class="node-update">


    <h1>
        <?php if($model->node_name):?>
        Обновление Node:<?= Html::encode($model->node_name) ?>
        <?php else:?>
        Создание Node
        <?php endif;?>
    </h1>

    <div class="node-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'node_name')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
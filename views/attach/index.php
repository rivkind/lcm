<?php

use kartik\editable\Editable;
use kartik\widgets\Growl;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>


<table class="table table-hover header_table" id="header_table" style="margin-top:-19px;">
    <thead>
        <tr class="tablesorter-filter-row tablesorter-ignoreRow">
            <th data_id="0" class="header" style="width: 266px;">File name</th>
            <th data_id="1" class="header" style="width: 253px;">Description</th>
            <th data_id="2" class="header" style="width: 353px;">Owner</th>
            <th data_id="3" class="header" style="width: 338px;">Date added</th>
            <th data-sorter="false" class="header" style="width: 216px;"><button class="btn btn-sm attch_btn">Attach</button></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($attaches as $attach):?>
        <tr class="link_bts">
            <td><a href="<?=Url::to(['attach/view','key'=>$attach->attachment_key]);?>"><?=$attach->attachment_name;?></a></td>
            <td>
                <?php
                $editable = Editable::begin([
                        //'editableValueOptions'=>'qwer',
                    'preHeader' => '<i class="glyphicon glyphicon-edit"></i> ',
                    'name'=>'descr',
                    'asPopover' => true,
                    'displayValue' => $attach->attachment_descr,
                    'inputType' => Editable::INPUT_TEXTAREA,
                    'value' => $attach->attachment_descr,
                    'header' => 'Редактирование описания',
                    'valueIfNull' => '[не задано]',
                    'submitOnEnter' => false,
                    'size'=>'lg',
                    'options' => ['class'=>'form-control', 'rows'=>3, 'placeholder'=>'Введите описание...']
                ]);
                $form = $editable->getForm();
                echo Html::hiddenInput('key', $attach->attachment_key);
                Editable::end()
                ?>

            </td>
            <td><?=$attach->user->username;?></td>
            <td><?= Yii::$app->formatter->asDatetime($attach->created_at, Yii::$app->params['dateFormat']);?></td>
            <td>
                <a title="Delete" class="delete_attach" href="<?=Url::to(['attach/delete','key'=>$attach->attachment_key]);?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>


            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
<div class="attchWindow">
    <div class="attchHeader">
        <button type="button" class="close attchClose" aria-label="Close"><span aria-hidden="true">×</span></button>Attach
    </div>

    <?php $form = ActiveForm::begin([
            'action' =>['attach/add'],
            'options' => ['class' => 'attchBody'],
            'fieldConfig' => [
                'options' => [
                    'tag' => false,
                    'label' => false,
                ],
                'template' => "{input}",
        ],
    ]);?>
    <div class="attchInputFile">
        <?= $form->field($model, 'upload_file')->fileInput()->label(false) ?>
    </div>
    <div>
        <?= $form->field($model, 'attachment_descr')->textarea(['class'=>'attch_comment','placeholder'=>'Комментарий'])->label(false) ?>
    </div>
    <div class="attchFooter">
        <button type="submit" class="btn btn-sm upload">Attach</button>
    </div>
    <?php ActiveForm::end(); ?>
</div>




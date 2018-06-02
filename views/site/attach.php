<?php

use yii\widgets\ActiveForm;
?>




<table class="table table-hover header_table" id="header_table" style="margin-top:-19px;">
    <thead>
    <tr class="tablesorter-filter-row tablesorter-ignoreRow">
        <th data_id="0" class="header" style="width: 266px;">File name
        </th>
        <th data_id="1" class="header" style="width: 253px;">Description
        </th>
        <th data_id="2" class="header" style="width: 353px;">Owner
        </th>
        <th data_id="3" class="header" style="width: 338px;">Date added
        </th>
        <th data-sorter="false" class="header" style="width: 216px;"><button class="btn btn-sm attch_btn">Attach
            </button></th>
    </tr>

    </thead>
    <tbody>
    <tr class="link_bts">
        <td>log_sd_3.png</td>
        <td>123</td>
        <td>dzhegutanov feliks</td>
        <td>2018-05-28 12:20</td>
        <td><a title="Delete" class="delete_attach" href="/attach/?delete=17"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a><span data-id="17" data-toggle="modal" data-target="#myModal" class="glyphicon glyphicon-pencil edit_attach" aria-hidden="true"></span></td>
    </tr>
    </tbody>
</table>
<div class="attchWindow">
    <div class="attchHeader">
        <button type="button" class="close attchClose" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        Attach
    </div>

    <?php $form = ActiveForm::begin(['options' => ['class' => 'attchBody']]) ?>
    <div class="attchInputFile">
    <?= $form->field($model, 'imageFile')->fileInput()->label(false) ?>
    </div><div>
    <?= $form->field($model, 'commentFile')->textarea(['class'=>'attch_comment','placeholder'=>'Комментарий'])->label(false) ?>
    </div>
    <div class="attchFooter">
        <button type="submit" class="btn btn-sm upload">Attach
        </button>
    </div>

    <?php ActiveForm::end() ?>



</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Редактировение</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label id="label_attach"></label>
                        <textarea id="comment_edit" name="comment_edit" class="form-control" placeholder="Комментарий
"></textarea>
                    </div>
                    <input name="data_id" id="data_id" value="" type="hidden">

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Сохранить изменения</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>

</script>
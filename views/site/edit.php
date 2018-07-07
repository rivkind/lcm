<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View
 * @var $item \app\models\Items
 */
?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="row">
<?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'options' => [
                'label' => false,
            ],
            'template' => "{input}\n{error}",
        ],
    ]); ?>
    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tbody>
        <tr>
            <th class="rved-label"><?=$item->getAttributeLabel('user_resp')?></th>
            <td class="rved-values">
                <?= $form->field($item, 'user_resp')->dropDownList($userAd, ['prompt' => '---- '.$item->getAttributeLabel('user_resp').' ----','class'=>'form-control input-sm'])?>
            </td>
            <th class="rved-label"><?=$item->getAttributeLabel('user_owner')?></th>
            <td class="rved-values">
                <?= $form->field($item, 'user_owner')->dropDownList($userAd, ['prompt' => '---- '.$item->getAttributeLabel('user_owner').' ----','class'=>'form-control input-sm'])?>
            </td>
        </tr>
        <tr>
            <th class="rved-label"><?=$item->getAttributeLabel('network_id')?></th>
            <td class="rved-values">
                <?= $form->field($item, 'network_id')->dropDownList($network, ['prompt' => '---- '.$item->getAttributeLabel('network_id').' ----','class'=>'form-control input-sm'])?>

            </td>
            <th class="rved-label"><?=$item->getAttributeLabel('node_id')?></th>
            <td class="rved-values">
                <?= $form->field($item, 'node_id')->dropDownList($node, ['prompt' => '---- '.$item->getAttributeLabel('node_id').' ----','class'=>'form-control input-sm'])?>
            </td>
        </tr>
        <tr>
            <th class="rved-label"><?=$item->getAttributeLabel('vendor_id')?></th>
            <td class="rved-values">

                <?= $form->field($item, 'vendor_id')->dropDownList($vendor, ['prompt' => '---- '.$item->getAttributeLabel('vendor_id').' ----','class'=>'form-control input-sm'])?>

            </td>
            <th class="rved-label"><?=$item->getAttributeLabel('general_availability')?></th>
            <td class="rved-values">
                <?= $form->field($item, 'general_availability')->dropDownList($quater, ['class'=>'form-control input-sm'])?>

            </td>
        </tr>
        <tr>
            <th class="rved-label"><?=$item->getAttributeLabel('type_id')?></th>
            <td class="rved-values">
                <?= $form->field($item, 'type_id')->dropDownList($hwsw, ['prompt' => '---- '.$item->getAttributeLabel('type_id').' ----','class'=>'form-control input-sm'])?>
            </td>
            <th class="rved-label"><?=$item->getAttributeLabel('date_marketing')?></th>
            <td class="rved-values">
                <?= $form->field($item, 'date_marketing')->dropDownList($quater, ['class'=>'form-control input-sm'])?>
            </td>
        </tr>
        <tr>
            <th class="rved-label"><?=$item->getAttributeLabel('hw_type')?></th>
            <td class="rved-values">
                <?= $form->field($item,'hw_type')->textInput(['placeholder' => $item->getAttributeLabel('hw_type'),'class'=>'form-control input-sm']);?>

            </td>
            <th class="rved-label"><?=$item->getAttributeLabel('date_spare_parts')?></th>
            <td class="rved-values">
                <?= $form->field($item, 'date_spare_parts')->dropDownList($quater, ['class'=>'form-control input-sm'])?>
            </td>
        </tr>
        <tr>
            <th class="rved-label"><?=$item->getAttributeLabel('product_name')?></th>
            <td class="rved-values">
                <?= $form->field($item,'product_name')->textInput(['placeholder' => $item->getAttributeLabel('product_name'),'class'=>'form-control input-sm']);?>
            <th class="rved-label"><?=$item->getAttributeLabel('date_full_support')?></th>
            <td class="rved-values">
                <?= $form->field($item, 'date_full_support')->dropDownList($quater, ['class'=>'form-control input-sm'])?>
            </td>
        </tr>
        <tr>
            <th class="rved-label"><?=$item->getAttributeLabel('product_type')?></th>
            <td class="rved-values"><?= $form->field($item,'product_type')->textInput(['placeholder' => $item->getAttributeLabel('product_type'),'class'=>'form-control input-sm']);?></td>
            <th class="rved-label"><?=$item->getAttributeLabel('date_service')?></th>
            <td class="rved-values">
                <?= $form->field($item, 'date_service')->dropDownList($quater, ['class'=>'form-control input-sm'])?>

            </td>
        </tr>
        <tr>
            <th class="rved-label"><?=$item->getAttributeLabel('item_description')?></th>
            <td class="rved-values"><?= $form->field($item,'item_description')->textarea(['placeholder' => $item->getAttributeLabel('item_description'),'class'=>'form-control input-sm']);?></td>
            <th class="rved-label"><?=$item->getAttributeLabel('date_spms')?></th>
            <td class="rved-values">
                <?= $form->field($item, 'date_spms')->dropDownList($quater, ['class'=>'form-control input-sm'])?>
            </td>
        </tr>
        <tr>
            <th class="rved-label"><?=$item->getAttributeLabel('bom_code')?></th>
            <td class="rved-values"><?= $form->field($item,'bom_code')->textInput(['placeholder' => $item->getAttributeLabel('bom_code'),'class'=>'form-control input-sm']);?></td>
            <th class="rved-label"><?=$item->getAttributeLabel('status_id')?></th>
            <td class="rved-values">
                <?= $form->field($item, 'status_id')->dropDownList($status, ['class'=>'form-control input-sm'])?>
            </td>
        </tr>
        <tr>
            <th class="rved-label"><?=Yii::t( 'header_table', 'Attach')?></th>
            <td class="rved-values" colspan="3">
                <div class='attchBlock'>
                    <?php foreach ($attach_item as $ai):?>
                        <div class='row_attach'>
                            <span class='glyphicon glyphicon-remove delete_attach' aria-hidden='true'></span>
                            <?=$ai->attachment_name;?>
                            <input type='hidden' name='n[]' id='n[]' value='<?=$ai->attachment_name;?>' />
                            <input type='hidden' name='c[]' id='c' value='<?=$ai->attachment_id;?>' />
                        </div>
                    <?php endforeach;?>

                </div>
                <button class='btn btn-sm attch_btn_form'><?=Yii::t( 'btn_form', 'Attach')?></button>
                <div class='attchWindowForm'>
                    <div class='attchHeader'>
                        <button type="button" class="close attchClose" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <?=Yii::t( 'attach_window', 'Attach title')?>
                    </div>
                    <div class='attchBody'>

                        <div>
                            <select class="form-control">
                                <option value='0'><?=Yii::t( 'attach_window', 'Choose file')?></option>
                                <?php foreach($attach as $att):?>
                                    <option value='<?=$att->attachment_id?>'><?=$att->attachment_name?></option>
                                <?php endforeach;?>
                            </select>
                            <p></p>
                        </div>
                        <div class='attchFooter'>
                            <button type="button" class="btn btn-sm upload"><?=Yii::t( 'attach_window', 'Attach button')?></button>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan='4' class='text-center bottomBtnSubmitBlock'>
                <?= Html::submitButton(Yii::t( 'app', 'Save'), ['class' => 'btn btn-default btn-sm', 'name' => 'add_doc']) ?>
                <a href="<?=Yii::$app->request->referrer?>" class='btn btn-default btn-sm'><?=Yii::t( 'app', 'Cancel')?></a>
            <td>
        </tr>
        </tbody>
    </table>
<?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


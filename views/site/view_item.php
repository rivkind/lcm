<?php

use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View
 * @var $item \app\models\Items
 */
?><a href="<?=Url::to(['site/form/','id'=>$item->item_id]);?>" class="btn btn-default btn-sm viewBtnEdit" title="<?=Yii::t( 'btn_form_title', 'Edit')?>">
    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
</a>
<?php if($item->checkUpdate()):?>
<a href='<?=Url::to(['site/update/','id'=>$item->item_id]);?>' class="btn btn-default btn-sm viewBtnUpdate" title='<?=Yii::t( 'btn_form_title', 'Update')?>'>⊜</a>
<?php endif;?>
<a href="<?=Yii::$app->request->referrer?>" class="btn btn-default btn-sm" style="float:right; font-size:16px; margin-right:10px;" title="<?=Yii::t( 'btn_form_title', 'Back')?>"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></a>						<form method="post">
    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tbody>
        <tr>
            <th class="rved-label"><?=$item->getAttributeLabel('user_resp')?></th>
            <td class="rved-values"><?=$item->user_resp;?></td>
            <th class="rved-label"><?=$item->getAttributeLabel('user_owner')?></th>
            <td class="rved-values"><?=$item->user_owner;?></td>
        </tr>
        <tr>
            <th class="rved-label"><?=$item->getAttributeLabel('network_id')?></th>
            <td class="rved-values"><?=$item->network->network_name;?></td>
            <th class="rved-label"><?=$item->getAttributeLabel('node_id')?></th>
            <td class="rved-values"><?=$item->node->node_name;?></td>
        </tr>
        <tr>
            <th class="rved-label"><?=$item->getAttributeLabel('vendor_id')?></th>
            <td class="rved-values">
                <?=Html::img($item->vendor->getPathImages(), [
                    'title' => $item->vendor->vendor_name,
                    'alt' => $item->vendor->vendor_name,
                    'width' => '20px',
                    'style' => 'margin-right:5px;'
                ]);?>
                <?=$item->vendor->vendor_name;?>
            </td>
            <th class="rved-label"><?=$item->getAttributeLabel('general_availability')?></th>
            <td class="rved-values">
                <div class="label label-<?=$item->getQuarterClass($item->general_availability);?>">
                    <?=$item->getQuarter($item->general_availability);?>
                </div>
            </td>
        </tr>
        <tr>
            <th class="rved-label"><?=$item->getAttributeLabel('type_id')?></th>
            <td class="rved-values"><?=$item->type->type_name;?></td>
            <th class="rved-label"><?=$item->getAttributeLabel('date_marketing')?></th>
            <td class="rved-values">
                <div class="label label-<?=$item->getQuarterClass($item->date_marketing);?>">
                    <?=$item->getQuarter($item->date_marketing);?>
                </div>
            </td>
        </tr>
        <tr>
            <th class="rved-label"><?=$item->getAttributeLabel('hw_type')?></th>
            <td class="rved-values"><?=$item->hw_type;?></td>
            <th class="rved-label"><?=$item->getAttributeLabel('date_spare_parts')?></th>
            <td class="rved-values">
                <div class="label label-<?=$item->getQuarterClass($item->date_spare_parts);?>">
                    <?=$item->getQuarter($item->date_spare_parts);?>
                </div>
            </td>
        </tr>
        <tr>
            <th class="rved-label"><?=$item->getAttributeLabel('product_name')?></th>
            <td class="rved-values"><?=$item->product_name;?></td>
            <th class="rved-label"><?=$item->getAttributeLabel('date_full_support')?></th>
            <td class="rved-values">
                <div class="label label-<?=$item->getQuarterClass($item->date_full_support);?>">
                    <?=$item->getQuarter($item->date_full_support);?>
                </div>
            </td>
        </tr>
        <tr>
            <th class="rved-label"><?=$item->getAttributeLabel('product_type')?></th>
            <td class="rved-values"><?=$item->product_type;?></td>
            <th class="rved-label"><?=$item->getAttributeLabel('date_service')?></th>
            <td class="rved-values">
                <div class="label label-<?=$item->getQuarterClass($item->date_service);?>">
                    <?=$item->getQuarter($item->date_service);?>
                </div>
            </td>
        </tr>
        <tr>
            <th class="rved-label"><?=$item->getAttributeLabel('item_description')?></th>
            <td class="rved-values"><?=$item->item_description;?></td>
            <th class="rved-label"><?=$item->getAttributeLabel('date_spms')?></th>
            <td class="rved-values">
                <div class="label label-<?=$item->getQuarterClass($item->date_spms);?>">
                    <?=$item->getQuarter($item->date_spms);?>
                </div>
            </td>
        </tr>
        <tr>
            <th class="rved-label"><?=$item->getAttributeLabel('bom_code')?></th>
            <td class="rved-values"><?=$item->bom_code;?></td>
            <th class="rved-label"><?=$item->getAttributeLabel('status_id')?></th>
            <td class="rved-values"><?=$item->status->status_name;?></td>
        </tr>
        <tr>
            <th class="rved-label"><?=Yii::t( 'header_table', 'Attach')?></th>
            <td class="rved-values" colspan='3'>
                <?php foreach($attach_item as $attach):?>
                <div class='row_attach'>
                    <a href='<?=Url::to(['attach/view','key'=>$attach->attachment_key]);?>'>
                        <span class="glyphicon glyphicon-file" aria-hidden="true" style='color:#ccc;margin-right:5px;'></span>
                        <?=$attach->attachment_name?>
                    </a>
                </div>
                <?php endforeach;?>
            </td>
        </tr>

        </tbody>
    </table>
</form>
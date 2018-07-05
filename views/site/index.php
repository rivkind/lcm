<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View
 * @var $item \app\models\Items
 */

$this->title = 'LCM - Главная страница';
Yii::$app->params['search'] = true;
?>

<table class="table table-hover header_table" id="header_table" style="width: auto !important;">
    <thead>
        <tr class="tablesorter-filter-row tablesorter-ignoreRow">
            <?=$this->render('header_cell_table')?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $item):?>
        <tr ondblclick="window.location.href='<?=Url::to(['site/view','id'=>$item->item_id]);?>'; return false" class="link_bts">
            <td class="resp_cell"><?=$item->getSurname($item->user_resp);?></td>
            <td class="owner_cell"><?=$item->getSurname($item->user_owner);?></td>
            <td class="network_cell"><?=$item->network->network_name;?></td>
            <td class="node_cell"><?=$item->node->node_name;?></td>
            <td class="vendor_cell">
                <span><?=$item->vendor->vendor_name;?></span>
                <?=Html::img($item->vendor->getPathImages(), [
                    'title' => $item->vendor->vendor_name,
                    'alt' => $item->vendor->vendor_name,
                    'width' => '20px'
                ]);?>
            </td>
            <td class="hwcw_cell"><?=$item->type->type_name;?></td>
            <td class="hwtype_cell">
                <div class="hwtype_cell hwtype_cell_data" title="<?=$item->hw_type;?>"><?=$item->hw_type;?></div>
            </td>
            <td class="product_cell">
                <div class="product_cell product_cell_data" title="<?=$item->product_name;?>"><?=$item->product_name;?></div>
            </td>
            <td class="product_type_cell">
                <div class="product_type_cell product_type_cell_data" title="<?=$item->product_type;?>"><?=$item->product_type;?></div>
            </td>
            <td class="bom_cell bom_cell_data"><?=$item->bom_code;?></td>
            <td class="descr_cell">
                <div class="descr_cell descr_cell_data" title="<?=$item->item_description;?>"><?=$item->item_description;?></div>
            </td>
            <td class="q_cell date_cell">
                <div class="label label-<?=$item->getQuarterClass($item->general_availability);?>">
                    <?=$item->getQuarter($item->general_availability);?>
                </div>
            </td>
            <td class="q_cell date_cell">
                <div class="label label-<?=$item->getQuarterClass($item->date_marketing);?>">
                    <?=$item->getQuarter($item->date_marketing);?>
                </div>

            </td>
            <td class="q_cell date_cell">
                <div class="label label-<?=$item->getQuarterClass($item->date_spare_parts);?>">
                    <?=$item->getQuarter($item->date_spare_parts);?>
                </div>
            </td>
            <td class="q_cell date_cell">
                <div class="label label-<?=$item->getQuarterClass($item->date_full_support);?>">
                    <?=$item->getQuarter($item->date_full_support);?>
                </div>

            </td>
            <td class="q_cell date_cell">
                <div class="label label-<?=$item->getQuarterClass($item->date_service);?>">
                    <?=$item->getQuarter($item->date_service);?>
                </div>

            </td>
            <td class="q_cell">
                <div class="label label-<?=$item->getQuarterClass($item->date_spms);?>">
                    <?=$item->getQuarter($item->date_spms);?>
                </div>
            </td>
            <td class="update_cell"><?= Yii::$app->formatter->asDatetime($item->updated_at, Yii::$app->params['dateFormatDay']);?></td>
            <td><?=$item->status->status_name;?></td>

        </tr>
        <? endforeach;?>
    </tbody>
</table>

<form class="s" id="header_div">

    <table class="table table-hover header_table1" id="header_table1">
        <thead>
        <tr class="">
            <?=$this->render('header_cell_table')?>
        </tr>
        <tr class="search_field tablesorter-filter-row tablesorter-ignoreRow"<?php if(Yii::$app->request->get("filter")){?> style="display: table-row;" <?php }?>>
            <td><input class="resp_cell_search form-control input-sm form_search" name="r" value="<?=Yii::$app->request->get("r")?>" type="text"></td>
            <td><input class="owner_cell_search form-control input-sm form_search" name="ow" value="<?=Yii::$app->request->get("ow")?>" type="text"></td>
            <td><input class="network_cell_search form-control input-sm form_search" name="n" value="<?=Yii::$app->request->get("n")?>" type="text"></td>
            <td><input class="node_cell_search form-control input-sm form_search" name="nd" value="<?=Yii::$app->request->get("nd")?>" type="text"></td>
            <td><input class="vendor_cell_search form-control input-sm form_search" name="v" value="<?=Yii::$app->request->get("v")?>" type="text"></td>
            <td><input class="hwcw_cell_search form-control input-sm form_search" name="t" value="<?=Yii::$app->request->get("t")?>" type="text"></td>
            <td><input class="hwtype_cell_search form-control input-sm form_search" name="hw" value="<?=Yii::$app->request->get("hw")?>" type="text"></td>
            <td><input class="product_cell_search form-control input-sm form_search" name="p" value="<?=Yii::$app->request->get("p")?>" type="text"></td>
            <td><input class="product_type_cell_search form-control input-sm form_search" name="pt" value="<?=Yii::$app->request->get("pt")?>" type="text"></td>
            <td><input class="bom_cell_search form-control input-sm form_search" name="b" value="<?=Yii::$app->request->get("b")?>" type="text"></td>
            <td><input class="descr_cell_search form-control input-sm form_search" name="d" value="<?=Yii::$app->request->get("d")?>" type="text"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><input class="status_cell_search form-control input-sm form_search" name="s" value="<?=Yii::$app->request->get("s")?>" type="text"><input value="1" name="filter" type="hidden"></td>
        </tr>
        </thead>
    </table>
</form>


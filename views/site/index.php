<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View
 * @var $item \app\models\Items
 */

$this->title = 'LCM - Главная страница';
?>

<table class="table table-hover header_table" id="header_table" style="width: auto !important;">
    <thead>
        <tr class="tablesorter-filter-row tablesorter-ignoreRow">
            <th data_id="0" class="resp_cell header">Responsible for planning</th>
            <th data_id="1" class="owner_cell header">Technical owner</th>
            <th data_id="2" class="network_cell header">Network type</th>
            <th data_id="3" class="node_cell header">Node type</th>
            <th data_id="4" class="vendor_cell header">Vendor</th>
            <th data_id="5" class="hwcw_cell header">HW SW</th>
            <th data_id="6" class="hwtype_cell header">HW Type</th>
            <th data_id="7" class="product_cell header">Product Name</th>
            <th data_id="8" class="product_type_cell header">Product Type</th>
            <th data_id="9" class="bom_cell header">BOM Code</th>
            <th data_id="10" class="descr_cell header">Technical description</th>
            <th data_id="11" class="q_cell header">GA</th>
            <th data_id="12" class="q_cell header">EOM</th>
            <th data_id="13" class="q_cell header">LDSP</th>
            <th data_id="14" class="q_cell header">EOFS</th>
            <th data_id="15" class="q_cell header">EOS</th>
            <th data_id="16" class="q_cell header">SPMS</th>
            <th data_id="17" class="update_cell header">Last update</th>
            <th data_id="18" class="header">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $item):?>
        <tr ondblclick="window.location.href='<?=Url::to(['site/view/','id'=>$item->item_id]);?>'; return false" class="link_bts">
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
            <td class="update_cell">2018.05.11</td>
            <td><?=$item->status->status_name;?></td>

        </tr>
        <? endforeach;?>
    </tbody>
</table>

<form class="s" id="header_div">

    <table class="table table-hover header_table1" id="header_table1">
        <thead>
        <tr class="">
            <th data_id="0" class="resp_cell">Responsible for planning</th>
            <th data_id="1" class="owner_cell">Technical owner</th>
            <th data_id="2" class="network_cell">Network type</th>
            <th data_id="3" class="node_cell">Node type</th>
            <th data_id="4" class="vendor_cell">Vendor</th>
            <th data_id="5" class="hwcw_cell">HW SW</th>
            <th data_id="6" class="hwtype_cell">HW Type</th>
            <th data_id="7" class="product_cell">Product Name</th>
            <th data_id="8" class="product_type_cell">Product Type</th>
            <th data_id="9" class="bom_cell">BOM Code
            </th>
            <th data_id="10" class="descr_cell">Technical description</th>
            <th data_id="11" class="q_cell" title="General Availability">GA</th>
            <th data_id="12" class="q_cell" title="End Of Marketing Date">EOM</th>
            <th data_id="13" class="q_cell" title="Last Order Date of Spare Parts">LDSP</th>
            <th data_id="14" class="q_cell" title="End Of Full Support">EOFS</th>
            <th data_id="15" class="q_cell" title="End Of Service Date">EOS</th>
            <th data_id="16" class="q_cell" title="Last date can be included in SPMS contract">SPMS</th>
            <th data_id="17" class="update_cell">Last update
            </th>
            <th data_id="18" class="status_cell">Status
            </th>
        </tr>
        <tr class="search_field tablesorter-filter-row tablesorter-ignoreRow">
            <td><input class="resp_cell_search form-control input-sm form_search" name="r" value="" type="text"></td>
            <td><input class="owner_cell_search form-control input-sm form_search" name="ow" value="" type="text"></td>
            <td><input class="network_cell_search form-control input-sm form_search" name="n" value="" type="text"></td>
            <td><input class="node_cell_search form-control input-sm form_search" name="nd" value="" type="text"></td>
            <td><input class="vendor_cell_search form-control input-sm form_search" name="v" value="" type="text"></td>
            <td><input class="hwcw_cell_search form-control input-sm form_search" name="t" value="" type="text"></td>
            <td><input class="hwtype_cell_search form-control input-sm form_search" name="hw" value="" type="text"></td>
            <td><input class="product_cell_search form-control input-sm form_search" name="p" value="" type="text"></td>
            <td><input class="product_type_cell_search form-control input-sm form_search" name="pt" value="" type="text"></td>
            <td><input class="bom_cell_search form-control input-sm form_search" name="b" value="" type="text"></td>
            <td><input class="descr_cell_search form-control input-sm form_search" name="d" value="" type="text"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><input class="status_cell_search form-control input-sm form_search" name="s" value="" type="text"><input value="1" name="filter" type="hidden"></td>
        </tr>
        </thead>
    </table>
</form>


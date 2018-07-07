<?php
/* @var $this yii\web\View
 * @var $entry \app\models\Log
 *
 */
$formatter = \Yii::$app->formatter;
?>
<table class="table table-striped tbl_hstr">
    <thead>
    <tr>
        <th><?=Yii::t( 'history_tab', 'Date')?></th>
        <th><?=Yii::t( 'history_tab', 'User')?></th>
        <th><?=Yii::t( 'history_tab', 'Changes')?></th>
    </tr>
    </thead>
    <tbody>
    <? foreach ($history as $entry):?>
    <tr>
        <td><?=$formatter->format($entry->log_time, 'date');?></td>
        <td><?=$entry->user->getUsernameCN($entry->user->username);?></td>
        <td><?=$entry->getDescription();?></td>
    </tr>
    <? endforeach;?>
    </tbody>
</table>
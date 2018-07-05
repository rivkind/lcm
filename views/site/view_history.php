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
        <th>Дата</th>
        <th>Пользователь</th>
        <th>Изменения</th>
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
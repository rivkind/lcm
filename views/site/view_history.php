<?php
/* @var $this yii\web\View
 * @var $entry \app\models\Log
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
        <td><?=$entry->user->user_name;?></td>
        <td>Удалено прикрепление</td>
    </tr>
    <? endforeach;?>
    </tbody>
</table>
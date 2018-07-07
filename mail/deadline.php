<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
Dear <?=$name_user?><br><br>
<?php foreach($data_send as $data):?>
<div>In LCM record <?= Html::a($data[0], Url::to(['site/view','id'=>$data[1]], true)) ?> <?=$data[3]?>
<?php if($data[2] != 0):?> is less then <?=$data[2]?> days.
<?php else:?> has <span style="color:red;">expired</span>.
<?php endif;?>
</div>
<?php endforeach;?>

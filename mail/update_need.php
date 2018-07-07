<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
Dear <?=$name_user?>
<br>
<br>
<?php foreach($data_send as $data):?>
    <div>In LCM record <?= Html::a($data[1], Url::to(['site/view','id'=>$data[0]], true)) ?> needs your revision. Please fix neccessary periods or press [⊜] button if record is actual.</div>
<?php endforeach;?>
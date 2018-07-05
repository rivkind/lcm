<?php
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */

?>
Dear <?=$name_user?>
<br>
<br>
In LCM record <?= Html::a($product_name, Url::to(['site/view','id'=>$id], true)) ?> changes have been made. Please look at the record history.

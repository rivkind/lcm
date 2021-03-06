<?php

use kartik\widgets\Growl;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View
 * @var $item \app\models\Items
 * @var $history \app\models\Log
 */

?>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="row">
            <?
            try {
                echo Tabs::widget([
                    'encodeLabels' => false,
                    'items' => [
                        [
                            'label' => Yii::t( 'view_item', 'Form'),
                            'content' =>  $this->render('view_item', ['item' => $item,'attach_item' => $attach_item]),
                            'active' => true
                        ],
                        [
                            'label' => Yii::t( 'view_item', 'Changes history').'<span class="badge">'.$history_count.'</span>',
                            'content' => $this->render('view_history', ['history' => $history])
                        ]
                    ]
                ]);
            } catch (Exception $e) {}
            ?>
        </div>
    </div>
</div>

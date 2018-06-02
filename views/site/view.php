<?php
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
                            'label' => 'Форма',
                            'content' =>  $this->render('view_item', ['item' => $item]),
                            'active' => true
                        ],
                        [
                            'label' => 'История изменений<span class="badge">'.$history_count.'</span>',
                            'content' => $this->render('view_history', ['history' => $history])
                        ]
                    ]
                ]);
            } catch (Exception $e) {}
            ?>
        </div>
    </div>
</div>

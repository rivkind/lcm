<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\Items;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";

        return ExitCode::OK;
    }

    public function actionTest()
    {



        Yii::$app->mailer->compose()
            ->setTo('alexey.rivkind@life.com.by')
            ->setSubject('Тема сообщения')
            ->setTextBody('Текст сообщения')
            ->send();
        echo 'a';

        return ExitCode::OK;
    }

    public function actionNotification(){
        Yii::$app->mailer->compose()
            ->setTo('alexey.rivkind@life.com.by')
            ->setSubject('Тема сообщения')
            ->setTextBody('Текст сообщения')
            ->send();
        //Items::oldItemNotification();
        return ExitCode::OK;
    }

    public function actionDeadline(){
        Yii::$app->mailer->compose()
            ->setTo('alexey.rivkind@life.com.by')
            ->setSubject('Тема сообщения')
            ->setTextBody('Текст сообщения')
            ->send();
        //Items::notifyDeadline();
        return ExitCode::OK;

    }
}

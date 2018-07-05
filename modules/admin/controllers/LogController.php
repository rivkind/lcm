<?php
/**
 * Created by PhpStorm.
 * User: Alexey.Rivkind
 * Date: 21.06.2018
 * Time: 13:31
 */

namespace app\modules\admin\controllers;


use app\models\Log;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class LogController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Log::find()
                ->joinWith(['user','logtype'])
                ->orderBy(['log_time'  => SORT_DESC]),
            //->asArray(),

        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Alexey.Rivkind
 * Date: 31.05.2018
 * Time: 18:15
 */

namespace app\controllers\admin;
use Yii;
use app\models\Network;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class IndexController extends Controller
{
    public $layout = 'admin';

    public function actionIndex()
    {

        echo 'a';
        die();
    }
}
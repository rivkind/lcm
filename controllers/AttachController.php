<?php
/**
 * Created by PhpStorm.
 * User: Alexey.Rivkind
 * Date: 13.06.2018
 * Time: 10:11
 */

namespace app\controllers;


use app\models\Attachment;
use app\models\Items;
use app\models\ItemsToAttachment;
use app\models\Log;
use app\models\Logtype;
use app\models\LogValue;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;

class AttachController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),

                'rules' => [
                    [
                        'actions' => ['index','view','delete','click','add'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['get'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {

        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $attach = Attachment::findOne(['attachment_key'=>Yii::$app->request->post('key')]);
            $attach->attachment_descr =Yii::$app->request->post('descr');
            $attach->save();
            return ['output'=>$attach->attachment_descr, 'message'=>''];
        }

        $model = new Attachment();

        $attaches = Attachment::find()
            ->joinWith(['user'])
            ->where(['isDelete' => 0])
            ->orderBy(['attachment_name' => SORT_ASC])
            ->all();

        return $this->render('index', [
            'model' => $model,
            'attaches' => $attaches,
        ]);
        // }

    }


    public function actionView($key)
    {
        $attach = Attachment::findOne(['attachment_key'=>$key]);
        return Yii::$app->response->sendFile(Yii::$app->params['fileUploadUrl'].$attach->attachment_name, $attach->attachment_name, ['inline'=>true]);
    }

    public function actionAdd(){
        $model = new Attachment();

        if ($model->load(Yii::$app->request->post())) {

            if ($model->upload() && $model->save()) {

                $model->renameFile();

                $model->save();
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
    }
    public function actionDelete($key)
    {
        $attach = Attachment::findOne(['attachment_key'=>$key]);

        if($attach){
            $items = ItemsToAttachment::find()
                ->with(['item'])
                ->where(['attachment_id' => $attach->attachment_id])
                ->all();

            if(!$items){
                $log = LogValue::find()
                    ->where(['log_value'=>'attach_added'])
                    ->orWhere(['log_value'=>'attach_deleted'])
                    ->andwhere(['current_value'=>$attach->attachment_id])
                    ->one();
                if(!$log){
                    $attach->deleteFile();
                    $attach->delete();
                }else{
                    $attach->isDelete = 1;
                    $attach->save();
                }
                Yii::$app->getSession()->setFlash('success', 'Файл успешно удален');
            }else{
                $error_text = 'Файл используется в следующих документах:<br>';
                foreach ($items as $item){
                    $error_text.="<a href='".Url::to(['site/form','id'=>$item->item_id])."'>{$item->item->product_name}</a><br>";
                }
                Yii::$app->getSession()->setFlash('error', $error_text);
            }
        }else{
            Yii::$app->getSession()->setFlash('error', 'Данного файла не существует!');
        }


        if(Yii::$app->request->referrer){
            return $this->redirect(Yii::$app->request->referrer);
        }else{
            return $this->redirect('/attach');
        }


    }
}
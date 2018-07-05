<?php

namespace app\controllers;

use app\models\Attachment;
use app\models\Items;

use app\models\ItemsToAttachment;
use app\models\Log;
use app\models\Logtype;
use app\models\LogValue;
use app\models\Network;
use app\models\Node;
use app\models\Status;
use app\models\Type;
use app\models\User;
use app\models\Vendor;
use Edvlerblog\Adldap2\model\UserDbLdap;
use Yii;

use yii\db\Expression;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\UploadForm;
use yii\web\UploadedFile;

class SiteController extends Controller
{


    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                /*'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],*/

                'only' => ['logout', 'index', 'view', 'form', 'update'],
                'rules' => [
                    [
                        'actions' => ['logout', 'index', 'view', 'form', 'update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    /*[
                        'allow' => true,
                        'actions' => ['contact'],
                        'roles' => ['permissionToUseContanctPage'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['permissionToSeeHome'],
                    ],*/
                ],


            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(Yii::$app->request->get('filter')){
            $items = Items::filterItems(Yii::$app->request->get());
        }else{
            $items = Items::find()
                ->joinWith(['network', 'node', 'vendor', 'status', 'type'])
                ->all();
        }

        


        return $this->render('index', [
            'items' => $items,
        ]);
    }

    /**
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        $item = Items::find()
            ->joinWith(['network', 'node', 'vendor', 'status', 'type'])
            ->where(['item_id' => $id])
            ->one();

        $attach_item = Attachment::find()
            ->joinWith(['itemsToAttachments'])
            ->where(['item_id' => $id])
            ->all();

        $history = Log::find()
            ->joinWith(['user','logtype'])
            ->where(['item_id' => $id])
            ->orderBy(['log_time'  => SORT_DESC])
            ->all();

        $history_count = count($history) - 1;

        if ($history_count == 0) $history_count = '';

        return $this->render('view', [
            'item' => $item,
            'history' => $history,
            'history_count' => $history_count,
            'attach_item' => $attach_item,
        ]);
    }


    public function actionForm($id = 0)
    {

        if ($id == 0){$item = Items::getItemNew();}
        else {$item = Items::getItemInfo($id);}
        if(Yii::$app->request->post('c')){
            $item->attach = Yii::$app->request->post('c');
        }

        if ($item->load(Yii::$app->request->post()) && $item->save()) {
            return $this->redirect(array('site/view', 'id' => $item->item_id));
        }

        $users = User::getUserAD();

        $network = Network::allNetwork();

        $node = Node::allNode();

        $vendor = Vendor::allVendor();

        $status = Status::allStatus();

        $hwsw = Type::allType();

        $listQuater = Items::allListQuater();

        $attach_item = Attachment::find()
            ->joinWith(['itemsToAttachments'])
            ->where(['item_id' => $id])
            ->all();

        $attach = Attachment::find()->all();


        return $this->render('edit', [
            'item' => $item,
            'userAd' => $users,
            'network' => $network,
            'node' => $node,
            'vendor' => $vendor,
            'hwsw' => $hwsw,
            'status' => $status,
            'quater' => $listQuater,
            'attach' => $attach,
            'attach_item' => $attach_item,

        ]);
    }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'login';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $model->logLogin();
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        $log_type = Logtype::findOne(['logtype_ident' => 'lcm_logout']);
        $log = new Log();
        $log->logtype_id = $log_type->logtype_id;
        $log->item_id = null;

        $log->save();

        Yii::$app->user->logout();


        return $this->goHome();
    }

    public function actionUpdate($id=null){
        if($id){
            $item = Items::findOne($id);
            if($item->checkUpdate() && $item->timeUpdate()){
                Yii::$app->getSession()->setFlash('success', 'Данные обновлены!');
            }else{
                Yii::$app->getSession()->setFlash('error', 'Обновить данную запись невозможно!');
            }
            if(Yii::$app->request->referrer){
                return $this->redirect(Yii::$app->request->referrer);
            }else{
                return $this->redirect('site/index');
            }
        }
    }
}

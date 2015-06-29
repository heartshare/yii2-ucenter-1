<?php
namespace chenyuzou\ucenter\controllers;

use chenyuzou\ucenter\components\Client;
use chenyuzou\ucenter\tools\XML;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use chenyuzou\ucenter\components\Note;

class ApiController extends Controller
{

    public $enableCsrfValidation = false;

    private $ucActionList = [
        'test',
        'synlogin',
        'synlogout',
        'deleteuser',
        'renameuser',
        'gettag',
        'updatepw',
        'updatebadwords',
        'updatehosts',
        'updateapps',
        'updateclient',
        'updatecredit',
        'getcreditsettings',
        'updatecreditsettings'
    ];

    public function actionUc($code)
    {
        $get = $post = [];
        defined('MAGIC_QUOTES_GPC') || define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
        parse_str(Client::authcode($code, 'DECODE', Yii::$app->uc->key), $get);

        Yii::trace($get);
        $get = Client::stripslashes($get);

//        $timestamp = time();
//        if($timestamp - $get['time'] > 3600) {
//            exit('Authracation has expiried');
//        }

        if(empty($get)) {
            exit('Invalid Request');
        }
        $postStr = Yii::$app->request->rawBody;
        $post = XML::unserialize($postStr);
        Yii::trace($post);

        if(in_array($get['action'], $this->ucActionList)) {
            call_user_func([Note::className(),$get['action']], $get, $post);
            return Note::API_RETURN_SUCCEED;
        }
        return Note::API_RETURN_FAILED;
    }

}
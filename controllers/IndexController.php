<?php
namespace chenyuzou\ucenter\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use chenyuzou\ucenter\components\Client;
use chenyuzou\ucenter\components\Note;

class IndexController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {

        if(!Yii::$app->cache->get(Note::CACHE_NAME_APPS)){
            return 'UCenter 应用列表设置缓存尚未设置！请到UCenter后台中发送通知';
        }
//        var_dump (Yii::$app->uc->user_login('admin','123'));
//        echo '<hr>' .Note::CACHE_NAME_APPS;
//        var_export(Yii::$app->cache->get(Note::CACHE_NAME_APPS));
//        echo '<hr>' .Note::CACHE_NAME_CREDITSETTINGS;
//        var_dump(Yii::$app->cache->get(Note::CACHE_NAME_CREDITSETTINGS));
//        echo '<hr>' .Note::CACHE_NAME_CLIENT;
//        var_dump(Yii::$app->cache->get(Note::CACHE_NAME_CLIENT));
//        echo '<hr>' .Note::CACHE_NAME_HOSTS;
//        var_dump(Yii::$app->cache->get(Note::CACHE_NAME_HOSTS));
//        echo '<hr>' .Note::CACHE_NAME_BADWORDS;
//        var_dump(Yii::$app->cache->get(Note::CACHE_NAME_BADWORDS));
//        return (Yii::$app->uc->user_synlogin(2));
//        $str = '567bWGxRiaI2XRhbio8lvnBnyuoEzPpDqW1FSHF25y4D7044aY74iKz42NbrWRHG4luRzRXAfdYpfPYjuW0';
//        var_dump(Client::authcode($str,'DECODE','16S4c9Ban9w7D2f0j2e34ep6v6oah321xcO3j5L0u3H7obM446U0o7W4Ab9bY6xd'));

//        var_dump(method_exists(Yii::$app->uc->ideentityClass,'deleteUser'));

//        var_dump(Yii::$app->user->identityClass);
    }

}


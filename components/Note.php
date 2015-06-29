<?php
namespace chenyuzou\ucenter\components;

use Yii;
use yii\base\Component;
use chenyuzou\ucenter\tools\XML;

class Note extends Component
{

    const UC_CLIENT_VERSION = '1.5.0';	//note UCenter 版本标识
    const UC_CLIENT_RELEASE = '20081031';
    
    const API_DELETEUSER = 1;		//note 用户删除 API 接口开关
    const API_RENAMEUSER = 1;		//note 用户改名 API 接口开关
    const API_GETTAG = 1;		//note 获取标签 API 接口开关
    const API_SYNLOGIN = 1;		//note 同步登录 API 接口开关
    const API_SYNLOGOUT = 1;		//note 同步登出 API 接口开关
    const API_UPDATEPW = 1;		//note 更改用户密码 开关
    const API_UPDATEBADWORDS = 1;	//note 更新关键字列表 开关
    const API_UPDATEHOSTS = 1;		//note 更新域名解析缓存 开关
    const API_UPDATEAPPS = 1;		//note 更新应用列表 开关
    const API_UPDATECLIENT = 1;		//note 更新客户端缓存 开关
    const API_UPDATECREDIT = 1;		//note 更新用户积分 开关
    const API_GETCREDITSETTINGS = 1;	//note 向 UCenter 提供积分设置 开关
    const API_GETCREDIT = 1;		//note 获取用户的某项积分 开关
    const API_UPDATECREDITSETTINGS = 1;	//note 更新应用积分设置 开关

    const CACHE_NAME_HOSTS = 'uc.hosts';
    const CACHE_NAME_APPS = 'uc.apps';
    const CACHE_NAME_CLIENT = 'uc.client';
    const CACHE_NAME_BADWORDS = 'uc.badword';
    const CACHE_NAME_CREDITSETTINGS = 'uc.creditsettings';

    const API_RETURN_SUCCEED = '1';
    const API_RETURN_FAILED = '-1';
    const API_RETURN_FORBIDDEN = '-2';

    public function init() {

    }

    public static function test($get, $post) {
        return self::API_RETURN_SUCCEED;
    }

    public static function synlogin($get, $post) {
        if(!self::API_SYNLOGIN) {
            return self::API_RETURN_FORBIDDEN;
        }
        $uid = $get['uid'];
//        $username = $get['username'];
        $identityClass = Yii::$app->user->identityClass;
        $user = $identityClass::findIdentity($uid);
        Yii::$app->user->login($user);
        return self::API_RETURN_SUCCEED;
    }

    public static function synlogout($get, $post) {
        if(!self::API_SYNLOGOUT) {
            return self::API_RETURN_FORBIDDEN;
        }
        if(!Yii::$app->user->isGuest)
            Yii::$app->user->logout();
        return self::API_RETURN_SUCCEED;
    }

    public static function deleteuser($get, $post) {
        $uids = $get['ids'];
        !self::API_DELETEUSER && exit(self::API_RETURN_FORBIDDEN);

        return self::API_RETURN_SUCCEED;
    }

    public static function renameuser($get, $post) {
        $uid = $get['uid'];
        $usernameold = $get['oldusername'];
        $usernamenew = $get['newusername'];
        if(!self::API_RENAMEUSER) {
            return self::API_RETURN_FORBIDDEN;
        }
        return self::API_RETURN_SUCCEED;
    }

    public static function gettag($get, $post1) {
        $name = $get['id'];
        if(!self::API_GETTAG) {
            return self::API_RETURN_FORBIDDEN;
        }

        $return = array();
        return XML::serialize($return, 1);
    }

    public static function updatepw($get, $post) {
        if(!self::API_UPDATEPW) {
            return self::API_RETURN_FORBIDDEN;
        }
        $username = $get['username'];
        $password = $get['password'];
        return self::API_RETURN_SUCCEED;
    }

    public static function updatebadwords($get, $post) {
        if(!self::API_UPDATEBADWORDS) {
            return self::API_RETURN_FORBIDDEN;
        }
        Yii::$app->cache->set(self::CACHE_NAME_BADWORDS,$post);
        return self::API_RETURN_SUCCEED;
    }

    public static function updatehosts($get, $post) {
        if(!self::API_UPDATEHOSTS) {
            return self::API_RETURN_FORBIDDEN;
        }
        Yii::$app->cache->set(self::CACHE_NAME_HOSTS,$post);
        return self::API_RETURN_SUCCEED;
    }

    public static function updateapps($get, $post) {
        if(!self::API_UPDATEAPPS) {
            return self::API_RETURN_FORBIDDEN;
        }
        Yii::$app->cache->set(self::CACHE_NAME_APPS,$post);
        return self::API_RETURN_SUCCEED;
    }

    public static function updateclient($get, $post) {
        if(!self::API_UPDATECLIENT) {
            return self::API_RETURN_FORBIDDEN;
        }
        Yii::$app->cache->set(self::CACHE_NAME_CLIENT,$post);
        return self::API_RETURN_SUCCEED;
    }

    public static function updatecredit($get, $post) {
        if(!self::API_UPDATECREDIT) {
            return self::API_RETURN_FORBIDDEN;
        }
        $credit = $get['credit'];
        $amount = $get['amount'];
        $uid = $get['uid'];
        return self::API_RETURN_SUCCEED;
    }

    public static function getcredit($get, $post) {
        if(!self::API_GETCREDIT) {
            return self::API_RETURN_FORBIDDEN;
        }
    }

    public static function getcreditsettings($get, $post) {
        if(!self::API_GETCREDITSETTINGS) {
            return self::API_RETURN_FORBIDDEN;
        }
        $credits = array();
        return XML::serialize($credits);
    }

    public static function updatecreditsettings($get, $post) {
        if(!self::API_UPDATECREDITSETTINGS) {
            return self::API_RETURN_FORBIDDEN;
        }
        Yii::$app->cache->set(self::CACHE_NAME_CREDITSETTINGS,$post);
        return self::API_RETURN_SUCCEED;
    }
}
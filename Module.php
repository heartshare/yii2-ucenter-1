<?php

namespace chenyuzou\ucenter;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'chenyuzou\ucenter\controllers';

    public $defaultRoute = 'index';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }


}
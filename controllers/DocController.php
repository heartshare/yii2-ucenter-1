<?php
namespace chenyuzou\ucenter\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use chenyuzou\ucenter\bundles\DocAsset;

class DocController extends Controller
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
        $view = $this->getView();
        $view->defaultExtension = 'htm';
        $asset = DocAsset::register($view);
        $content = $this->renderPartial(Yii::$app->request->get('action'));
        $content = str_replace('href="images/', 'href="'.$asset->baseUrl.'/doc/images/', $content);
        $content = str_replace('src="javascript/', 'src="'.$asset->baseUrl.'/doc/javascript/', $content);
        $content = str_replace('src="images/', 'src="'.$asset->baseUrl.'/doc/images/', $content);
        return $content;
    }

}


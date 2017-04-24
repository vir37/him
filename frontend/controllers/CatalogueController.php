<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 22.04.2017
 * Time: 16:44
 */

namespace frontend\controllers;

use common\helpers\TreeHelper;
use common\models\Catalogue;
use common\models\Category;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\components\UrlManagerCityBehavior;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CatalogueController extends Controller{

    public $layout = "new";

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            [
                'class' => UrlManagerCityBehavior::className(),
            ],
        ];
    }

    public function beforeAction($action){
        if (!parent::beforeAction($action))
            return false;
        // восстановление текущего каталога из сессии
        return true;
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($id) {
        if (($catalogue = Catalogue::findOne($id)) == null)
            throw new NotFoundHttpException();
        if (($current_category = \Yii::$app->request->get('category', null)) !== null){
            $current_category = Category::findOne($current_category);
        }
        $catDataProvider = new ActiveDataProvider();
        $catDataProvider->query = $catalogue->getCategories();
        $categoryTree = TreeHelper::createTree($catDataProvider);
        return $this->render('view', [
            'categories' => $categoryTree,
            'catalogue' => $id,
            'catalogue_type1' => 1,     // ИД каталога общего типа
            'catalogue_type2' => 2,     // ИД отраслевого каталога
            'current_category' => $current_category,
        ]);
    }
} 
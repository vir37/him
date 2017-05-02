<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.04.2017
 * Time: 10:47
 */

namespace frontend\controllers;
use yii\filters\VerbFilter;
use frontend\components\UrlManagerCityBehavior;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Product,
    common\models\Category,
    common\models\Catalogue;
use yii\data\ActiveDataProvider;
use common\helpers\TreeHelper;

class ProductController extends Controller {
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


    public function actionView($parent_id, $id){
        $category = Category::findOne($parent_id);
        $model = Product::findOne($id);

        if (!$model or !$category)
            throw new NotFoundHttpException();

        $catDataProvider = new ActiveDataProvider();
        $catDataProvider->query = $category->catalogue->getCategories();
        return $this->render('view', [
            'model' => $model,
            'categories' => TreeHelper::createTree($catDataProvider),
            'catalogue' => $category->catalogue->id,
            'catalogue_type1' => Catalogue::CATALOGUE_TYPE1,     // ИД каталога общего типа
            'catalogue_type2' => Catalogue::CATALOGUE_TYPE2,     // ИД отраслевого каталога
            'current_category' => $category,
       ]);
    }
}
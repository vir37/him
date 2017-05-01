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
use common\models\Product;


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


    public function actionView($id){
        if (($model = Product::findOne($id)) !== null)
            return $this->render('view', [ 'model' => $model]);
        else
            throw new NotFoundHttpException();
    }
}
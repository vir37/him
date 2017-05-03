<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 03.05.2017
 * Time: 17:45
 */

namespace frontend\controllers;
use yii\web\Controller,
    yii\web\Response;

use common\models\City,
    common\models\Catalogue,
    common\models\Category,
    common\models\Product;


class SitemapController  extends Controller {

    const FREQ_ALWAYS = 'always';
    const FREQ_HOURLY = 'hourly';
    const FREQ_DAILY = 'daily';
    const FREQ_WEEKLY = 'weekly';
    const FREQ_MONTHLY = 'monthly';
    const FREQ_YEARLY = 'yearly';
    const FREQ_NEVER = 'never';

    public function beforeAction($action){
        if (!parent::beforeAction($action))
            return false;
        \Yii::$app->response->formatters = [
            Response::FORMAT_XML => [
                'class' => 'frontend\components\SitemapXmlResponseFormatter',
                'rootNS' => 'http://www.sitemaps.org/schemas/sitemap/0.9',
            ],
        ];
        \Yii::$app->response->format = \yii\web\Response::FORMAT_XML;

        return true;
    }

    public function actionIndex() {
        $cities = City::find()->all();
        $catalogues = Catalogue::find()->all();
        $categories = Category::find()->all();
        $products = Product::find()->all();
        $baseUri = \Yii::$app->request->getHostName();

        return $this->renderPartial('index', [
            'baseUri' => $baseUri,
            'cities' => $cities,
            'catalogues' => $catalogues,
            'categories' => $categories,
            'products' => $products,
        ]);
    }
} 
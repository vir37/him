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
                'itemTag' => 'url',
            ],
        ];
        \Yii::$app->response->format = \yii\web\Response::FORMAT_XML;

        return true;
    }

    public function actionIndex() {
        $urlManager = \Yii::$app->urlManager;
        $lastmod = date(DATE_W3C);
        $items = [];
        // Цикл по городам
        foreach (City::find()->all() as $city) {
            $items[] = ['loc' => $urlManager->createAbsoluteUrl(['site/index', 'city' => $city->uri_name]),
                'lastmod' => $lastmod,
                'changefreq' => self::FREQ_WEEKLY,
                'priority' => 0.5 ];

            // контакты
            $items[] = [ 'loc' => $urlManager->createAbsoluteUrl(['site/contacts', 'city' => $city->uri_name]),
                'lastmod' => $lastmod,
                'changefreq' => self::FREQ_MONTHLY,
                'priority' => 0.5 ];

            // цикл по каталогам
            foreach (Catalogue::find()->all() as $catalogue) {
                /*
                $items[] = ['loc' => $urlManager->createAbsoluteUrl(['category/list', 'city' => $city->uri_name, 'id' => $catalogue->id]),
                    'lastmod' => $lastmod,
                    'changefreq' => self::FREQ_WEEKLY,
                    'priority' => 0.5 ];
                */
                // цикл по категориям
                foreach ($catalogue->categories as $category) {
                    $items[] = [
                        'loc' => $urlManager->createAbsoluteUrl(['category/view', 'city' => $city->uri_name, 'id' => $category->id]),
                        'lastmod' => $lastmod,
                        'changefreq' => self::FREQ_WEEKLY,
                        'priority' => 0.9 ];

                    // цикл по товарам
                    foreach ($category->product as $product)
                        $items[] = [
                            'loc' => $urlManager->createAbsoluteUrl([
                                'product/view', 'city' => $city->uri_name, 'id' => $product->id, 'parent_id' => $category->id
                            ]),
                            'lastmod' => $lastmod,
                            'changefreq' => self::FREQ_WEEKLY,
                            'priority' => 0.8 ];
                }
            }
        }
        // дополнительные странички
        return $items;
    }
}
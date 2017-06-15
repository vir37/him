<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 03.05.2017
 * Time: 17:45
 * Контроллер формирования sitemap.xml
 * структура такая:
 * сначала идут все ссылки городов
 * потом ссылки на категории в городах
 * потом ссылки на товары в категориях в городах
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
        // Выводим все города
        $cities = City::find()->all();
        foreach ($cities as $city) {
            $items[] = ['loc' => $urlManager->createAbsoluteUrl(['site/index', 'city' => $city->uri_name]),
                'lastmod' => $lastmod,
                'changefreq' => self::FREQ_WEEKLY,
                'priority' => 0.5];

            // контакты
            $items[] = ['loc' => $urlManager->createAbsoluteUrl(['site/contacts', 'city' => $city->uri_name]),
                'lastmod' => $lastmod,
                'changefreq' => self::FREQ_MONTHLY,
                'priority' => 0.5];
        }
        $catalogues = Catalogue::find()->all();
        // Выводим все категории
        foreach ($cities as $city) {
            // цикл по каталогам
            foreach ($catalogues as $catalogue) {
                // цикл по категориям
                foreach ($catalogue->getCategories()->orderBy([ 'parent_id' => SORT_DESC, 'list_position' => SORT_ASC ])->all() as $category)
                    $items[] = [
                        'loc' => $urlManager->createAbsoluteUrl(['category/view', 'city' => $city->uri_name, 'id' => $category->id]),
                        'lastmod' => $lastmod,
                        'changefreq' => self::FREQ_WEEKLY,
                        'priority' => 0.9 ];
            }
        }
        // выводим все товары
        foreach ($cities as $city) {
            // цикл по каталогам
            foreach ($catalogues as $catalogue) {
                // цикл по категориям
                foreach ($catalogue->categories as $category) {
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
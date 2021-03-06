<?php

namespace backend\controllers;

class DirectoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $elements = [
            [
                'header' => [ 'text' => 'Сотрудники', 'link' => 'employee/'],
                'icon' => 'fa-vcard-o',
                'description' => 'Модуль управления сотрудниками организации ...',
                'short_links'=> [
                    [ 'text' => 'Новый сотрудник', 'link' => 'employee/create'],
                ],
            ],
            [
                'header' => [ 'text' => 'Единицы измерения', 'link' => 'uom/' ],
                'icon' => 'fa-thermometer-half',
                'description' => 'Модуль настройки единиц измерения',
                'short_links' => [
                    [ 'text' => 'Новая единица измерения', 'link' => 'uom/create' ],
                ],
            ],
            [
                'header' => [ 'text' => 'Характеристики товаров', 'link' => 'feature/' ],
                'icon' => 'fa-sliders',
                'description' => 'Модуль управления характеристиками товаров',
                'short_links' => [
                    [ 'text' => 'Новая характеристика', 'link' => 'feature/create'],
                 ],
            ],
            [
                'header' => [ 'text' => 'Города', 'link' => 'city/' ],
                'icon' => 'fa-map-o',
                'description' => 'Модуль управления городами',
                'short_links' => [
                    [ 'text' => 'Новый город', 'link' => 'city/create'],
                ]
            ],
            [
                'header' => [ 'text' => 'Статьи', 'link' => 'article/' ],
                'icon' => 'fa-file-text',
                'description' => 'Модуль управления текстовыми статьями',
                'short_links' => [
                    [ 'text' => 'Новая статья', 'link' => 'article/create'],
                ]
            ],
            [
                'header' => [ 'text' => 'Склады поставщиков', 'link' => 'warehouse/' ],
                'icon' => 'fa-file-text',
                'description' => 'Модуль управления складами поставщиков',
                'short_links' => [
                    [ 'text' => 'Новая склад', 'link' => 'warehouse/create'],
                ]
            ],
        ];
        return $this->render('index', [ 'elements' => $elements ]);
    }

}

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
            ]
        ];
        return $this->render('index', [ 'elements' => $elements ]);
    }

}

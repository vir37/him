<?php

namespace backend\controllers;

class CatalogueController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate() {
        return null;
    }

    public function actionList() {
        return $this->render('list');
    }
}

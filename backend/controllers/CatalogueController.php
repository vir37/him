<?php

namespace backend\controllers;

class CatalogueController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}

<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 01.03.2017
 * Time: 16:21
 */

namespace backend\controllers;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\CategoryImg;

class CategoryImgController extends Controller {

    public $defaultAction = 'error';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['GET'],
                ],
            ],
        ];
    }

    public function actionError() {
        throw new NotFoundHttpException("Page not found");
    }
}
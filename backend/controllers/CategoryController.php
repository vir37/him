<?php

namespace backend\controllers;

use common\models\Catalogue;
use yii\db\Expression;

class CategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $e = new Expression('CONCAT("#?", id) as url');
        $items = Catalogue::find()->asArray()->select(["id", "name as label", $e])->all();
        return $this->render('index', [
            'filter_items' => $items,
        ]);
    }

}

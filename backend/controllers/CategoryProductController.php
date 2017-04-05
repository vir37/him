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
use common\models\CategoryProduct;
use yii\bootstrap\Alert;

class CategoryProductController extends Controller {

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

    public function actionDelete($category_id, $product_id) {
        $model = CategoryProduct::findOne(['category_id' => $category_id, 'product_id' =>$product_id]);
        if (!$model)
            $alert = ['type' => 'danger', 'body' => 'Ошибка выполнения операции E01'];
        elseif (!$model->delete())
            $alert = ['type' => 'danger', 'body' => 'Ошибка выполнения операции E02'];
        else {
            $alert = ['type' => 'success', 'body' => 'Операция выполнена успешно'];
            CategoryProduct::resortPositions($category_id);
        }
        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $result = Alert::widget([
                        'options' => ['id' => 'alerter', 'class' => "alert-{$alert['type']}",],
                        'body' => $alert['body'],
                    ]);
;           return ['status' => $alert['type'], 'response' => $result];
        }
        return $this->redirect(['index']);
    }

    public function actionChangePosition($category_id, $product_id, $new_position) {
        $model = CategoryProduct::findOne(['category_id' => $category_id, 'product_id' =>$product_id]);
        if (!$model)
            $alert = ['type' => 'danger', 'body' => 'Ошибка выполнения операции'];
        else {
            $model->changePosition($new_position);
            $alert = ['type' => 'success', 'body' => 'Операция выполнена успешно'];
        }

        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $result = Alert::widget([
                'options' => ['id' => 'alerter', 'class' => "alert-{$alert['type']}",],
                'body' => $alert['body'],
            ]);
            return ['status' => $alert['type'], 'response' => $result];
        }
        return $this->redirect(['index']);
    }

    public function actionList($category_id, $product_id) {
        $result = CategoryProduct::find()->where(['category_id' => $category_id])
            ->select(['list_position'])->all() or [];
        if (\Yii::$app->request->isAjax) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $result;
        } else
            throw new NotFoundHttpException("Page not found");
    }
}
<?php

namespace backend\controllers;

use Yii;
use common\models\Warehouse;
use common\models\WarehouseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\ErrorException;
use yii\helpers\Json;
use yii\web\Response;
use yii\web\ServerErrorHttpException;
use backend\behaviors\LayoutBehavior;


/**
 * WarehouseController implements the CRUD actions for Warehouse model.
 */
class WarehouseController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            [
                'class' => LayoutBehavior::className(),
                'assigns' => [ 'fancybox' => 'fancybox' ],
            ],
        ];
    }

    /**
     * Lists all Warehouse models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WarehouseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Warehouse model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Warehouse model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Warehouse();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (!Yii::$app->request->isAjax)
                Yii::$app->session->setFlash('success', 'Запись успешно сохранена');
            if (array_key_exists('save_n_stay', Yii::$app->request->post()))
                return $this->redirect(['update', 'id' => $model->id]);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $supplier_id = \Yii::$app->request->get('supplier_id', Null);
            if ($supplier_id)
                $model->supplier_id = (int) $supplier_id;
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Warehouse model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (!Yii::$app->request->isAjax)
                Yii::$app->session->setFlash('success', 'Запись успешно обновлена');
            if (!array_key_exists('save_n_stay', Yii::$app->request->post()))
                return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [ 'model' => $model, ]);
    }

    /**
     * Deletes an existing Warehouse model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $result = $this->findModel($id)->delete();
        if (Yii::$app->request->isAjax)
            return $this->returnJSON((object)$result);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Warehouse model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Warehouse the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Warehouse::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLinkContact($id, $contact_id) {
        $model = $this->findModel($id);
        $result = $model->addContact($contact_id);
        if (Yii::$app->request->isAjax)
            return $this->returnJSON((object)$result);
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUnlinkContact($id, $contact_id) {
        $model = $this->findModel($id);
        $result = $model->removeContact($contact_id);
        if (Yii::$app->request->isAjax)
            return $this->returnJSON((object)$result);
        return $this->render('update', [
            'model' => $model,
        ]);

    }

    /**
     * Возвращает ответ в виде JSON
     * @param $content
     * @return Response
     * @throws ServerErrorHttpException
     */
    public function returnJSON($content) {
        $response = new Response;
        $response->format = Response::FORMAT_JSON;
        $response->statusCode = 200;
        try {
            $response->content = Json::encode($content);
            return $response;

        } catch (ErrorException $e) {
            throw new ServerErrorHttpException($e->getMessage());
        }
    }

}

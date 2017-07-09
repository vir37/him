<?php

namespace backend\controllers;

use Yii;
use common\models\Supplier;
use common\models\SupplierSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * SupplierController implements the CRUD actions for Supplier model.
 */
class SupplierController extends Controller
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
        ];
    }

    /**
     * Lists all Supplier models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SupplierSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Supplier model.
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
     * Creates a new Supplier model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Supplier();

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'logo');
            if ($file && $file->tempName)
                $model->logo = file_get_contents($file->tempName);

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Новый поставщик успешно создан');
                if (array_key_exists('save_n_stay', Yii::$app->request->post()))
                    return $this->redirect(['update', 'id' => $model->id]);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [ 'model' => $model,  ]);
    }

    /**
     * Updates an existing Supplier model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if (($file = UploadedFile::getInstance($model, 'logo')))
                $model->logo = file_get_contents($file->tempName);

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Запись успешно обновлена');
                if (!array_key_exists('save_n_stay', Yii::$app->request->post()))
                    return $this->redirect(['view', 'id' => $model->id]);
                return $this->render('update', [ 'model' => $model, ]);
            }
        }
        return $this->render('update', [ 'model' => $model, ]);
    }

    /**
     * Deletes an existing Supplier model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Supplier model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Supplier the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Supplier::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

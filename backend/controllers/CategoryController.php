<?php

namespace backend\controllers;

use Yii;
use common\models\Catalogue,
    common\models\Category,
    common\models\CategorySearch;
use backend\models\ImageUploadForm;
use yii\web\UploadedFile;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class CategoryController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'image-upload' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex($catalogue_id=0)
    {
        $e = new Expression('CONCAT("?catalogue_id=", id) as url');
        $items = Catalogue::find()->asArray()->select(["id", "name as label", $e])->all();
        $catalogue = Catalogue::findOne($catalogue_id);
        $model = new CategorySearch();
        $params = Yii::$app->request->queryParams;
        if (!array_key_exists($model->formName(), $params))
            $params[$model->formName()] = [ 'catalogue_id' => $catalogue_id ];
        $dataProvider = $model->search($params);

        return $this->render('index', [
            'model' => $model,
            'filter_items' => $items,
            'catalogue' => $catalogue,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();
        $imageUploader = new ImageUploadForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (array_key_exists('create_n_stay', Yii::$app->request->post()))
                return $this->redirect(['update', 'id' => $model->id]);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'imageUploader' => $imageUploader,
            ]);
        }
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $imageUploader = new ImageUploadForm();
        $imageUploader->objectId = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'imageUploader' => $imageUploader,
            ]);
        }
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $catalogue_id = $model->catalogue_id;
        $model->delete();
        if ($catalogue_id)
            return $this->redirect(['index', 'catalogue_id' => $catalogue_id]);
        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionList($catalogue_id){
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $data = Category::find()->asArray()
                ->where(['catalogue_id' => $catalogue_id ])->select(['id', 'name'])->all();
            return $data;
        } else {
            throw new NotFoundHttpException('The request page does not exist');
        }
    }

    public function actionImageUpload(){
        $imageModel = new ImageUploadForm();
        $imageModel->load(Yii::$app->request->post());
        $model = Category::findOne($imageModel->objectId);
        $imageModel->imageFile = UploadedFile::getInstance($imageModel, 'imageFile');
        $file_name = hash('md5', $model->name).'_'.
            (count($model->categoryImgs) + 1).'.'.
            explode('.', $imageModel->imageFile->name)[1];
        if ($imageModel->upload(Yii::getAlias("@images/$file_name"))) {
            return $this->renderPartial('_images', [
                'model' => $imageModel,
                'linkModel' => $model,
            ]);
        }
    }
}

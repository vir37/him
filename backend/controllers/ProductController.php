<?php

namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use common\models\Catalogue,
    common\models\Product,
    common\models\ProductSearch;
use common\models\ProductImg;
use backend\models\ImageUploadForm;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;


class ProductController extends \yii\web\Controller
{
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

    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $imageUploader = new ImageUploadForm('common\models\ProductImg', 'product_id');

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
     * Displays a single Product model.
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
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $imageUploader = new ImageUploadForm('common\models\ProductImg', 'product_id');
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
        $model->delete();
        return $this->redirect(['index']);
    }


    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionImageUpload(){
        $imageModel = new ImageUploadForm('common\models\ProductImg', 'product_id');
        $imageModel->load(Yii::$app->request->post());
        $model = Product::findOne($imageModel->objectId);
        $imageModel->imageFile = UploadedFile::getInstance($imageModel, 'imageFile');
        $file_name = hash('md5', $model->name).'_'.
            (count($model->images) + 1).'.'.
            explode('.', $imageModel->imageFile->name)[1];
        if ($imageModel->upload(Yii::getAlias("@images/$file_name"))) {
            // тут надо сохранить запись в БД
            if (($res = $model->addImage($file_name, $imageModel->isMain)) === true )
                $alert = [ 'type' => 'success', 'body' => 'Изображение успешно добавлено' ];
            else
                $alert = [ 'type' => 'danger', 'body' => $res ];
        } else {
            $alert = [ 'type' => 'danger', 'body' => implode('\n', $imageModel->firstErrors) ];
        }
        return $this->renderPartial('/common/_images', [
            'model' => $imageModel,
            'linkModel' => $model,
            'alert' => $alert,
        ]);
    }

    public function actionImageDelete($image_id, $object_id) {
        if (Yii::$app->request->isAjax) {
            $model = $this->findModel($object_id);
            $image = $model->getImages()->where([ 'id' => $image_id])->one();
            if ($image && unlink(Yii::getAlias("@images/{$image->name}")) && $image->delete())
                $alert = ['type' => 'success', 'body' => 'Изображение успешно удалено'];
            else
                $alert = ['type' => 'danger', 'body' => 'Ошибка удаления изображения'];
            #$model = $this->findModel($object_id);
            $imageUploader = new ImageUploadForm($model->className(), 'product_id');
            $imageUploader->objectId = $object_id;
            return $this->renderPartial('/common/_images', [
                'model' => $imageUploader,
                'linkModel' => $model,
                'alert' => $alert,
            ]);
        } else
            $this->redirect(['update', 'id' => $object_id]);
    }

    public function actionImageSetMain($image_id, $object_id) {
        if (Yii::$app->request->isAjax) {
            $model = $this->findModel($object_id);
            $image = $model->getImages()->where([ 'id' => $image_id])->one();
            if ($image && $image->setMain())
                $alert = ['type' => 'success', 'body' => 'Операция выполнена успешно'];
            else
                $alert = ['type' => 'danger', 'body' => 'Ошибка выполнения операции'];
            $imageUploader = new ImageUploadForm($model->className(), 'product_id');
            $imageUploader->objectId = $object_id;
            return $this->renderPartial('/common/_images', [
                'model' => $imageUploader,
                'linkModel' => $model,
                'alert' => $alert,
            ]);
        } else
            $this->redirect(['update', 'id' => $object_id]);
    }

}

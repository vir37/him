<?php

namespace backend\controllers;

use common\models\CategoryProduct;
use common\models\Product;
use Yii;
use common\models\Catalogue,
    common\models\Category,
    common\models\CategorySearch,
    common\models\CategoryImg;
use yii\base\ErrorException;
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
        $dataProvider->query->orderBy([ 'list_position' => SORT_ASC ]);
        $dataProvider->setPagination(false);

        return $this->render('index', [
            'model' => $model,
            'filter_items' => $items,
            'catalogue_id' => $catalogue ? $catalogue->id : 0,
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
        $imageUploader = new ImageUploadForm('common\models\CategoryImg', 'category_id');
        if ($model->load(Yii::$app->request->post())) {
            if (($file = UploadedFile::getInstance($model, 'icon')))
                $model->icon = file_get_contents($file->tempName);
            if ($model->save())
                if (array_key_exists('create_n_stay', Yii::$app->request->post()))
                    return $this->redirect(['update', 'id' => $model->id]);
                return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->catalogue_id = Yii::$app->request->get('catalogue_id', null);
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
        $imageUploader = new ImageUploadForm('common\models\CategoryImg', 'category_id');
        $imageUploader->objectId = $id;

        if ($model->load(Yii::$app->request->post())) {
            if (($file = UploadedFile::getInstance($model, 'icon')))
                $model->icon = file_get_contents($file->tempName);
            if ($model->save())
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

    /**
     * Выдает список категорий по заданным параметрам
     * @param $catalogue_id - идентификатор каталога, для которого необходимо отобрать категории
     * @param null $product_id - идентификатор продукта, для которого необходимо отобрать категории
     * @param bool $include - отобрать категории, которые удовлетворяют параметру product_id или наоборот
     * @throws NotFoundHttpException
     */
    public function actionList($catalogue_id, $product_id = null, $include = true){
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $data = Category::find()->asArray()->where("1");
            if (isset($catalogue_id))
                $data = $data->andWhere(['catalogue_id' => $catalogue_id ]);
            if (isset($product_id)) {
                $subQuery = CategoryProduct::find()->where(['product_id' => $product_id ])->select(['category_id']);
                //$data = $data->joinWith(CategoryProduct::tableName(), true, 'LEFT JOIN');
                if ($include)
                    $data = $data->andWhere(['in', 'id', $subQuery ]);
                else
                    $data = $data->andWhere(['not in', 'id', $subQuery]);
            }
            return $data->select(['id', 'name'])->all();
        } else {
            throw new NotFoundHttpException('The request page does not exist');
        }
    }

    public function actionImageUpload(){
        $imageModel = new ImageUploadForm('common\models\CategoryImg', 'category_id');
        $imageModel->load(Yii::$app->request->post());
        $model = Category::findOne($imageModel->objectId);
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
            if ($image && $image->delete()) {
                try {
                    unlink(Yii::getAlias("@images/{$image->name}"));
                } catch (ErrorException $e) { };
                $alert = ['type' => 'success', 'body' => 'Изображение успешно удалено'];
            } else
                $alert = ['type' => 'danger', 'body' => 'Ошибка удаления изображения'];
            $imageUploader = new ImageUploadForm($model->className(), 'category_id');
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
            $model = $this->findModel($object_id);
            $imageUploader = new ImageUploadForm($model->className(), 'category_id');
            $imageUploader->objectId = $object_id;
            return $this->renderPartial('/common/_images', [
                'model' => $imageUploader,
                'linkModel' => $model,
                'alert' => $alert,
            ]);
        } else
            $this->redirect(['update', 'id' => $object_id]);
    }

    public function actionPosition($direction, $id) {
        $catalogue_id = \Yii::$app->request->get('catalogue_id');
        if (\Yii::$app->request->isPjax) {
            $model = $this->findModel($id);
            if ( ($model = $this->findModel($id)) == null )
                throw new NotFoundHttpException();
            switch (strtolower($direction)){
                case 'up': $step = -1; break;
                case 'down': $step = 1; break;
                default: throw new \HttpInvalidParamException();
            }
            $model->list_position = is_null($model->list_position) ? 1 : $model->list_position;
            $model->changePosition($model->list_position + $step);
            return $this->actionIndex($catalogue_id);
        }
        return $this->redirect(['category/index', 'catalogue_id' => $catalogue_id]);
    }

}

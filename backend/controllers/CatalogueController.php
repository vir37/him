<?php

namespace backend\controllers;
use Yii;
use common\models\Catalogue;
use common\models\CatalogueSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/**
 * CatalogueController implements the CRUD actions for Catalogue model.
 */
class CatalogueController extends Controller
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
     * Lists all Catalogue models.
     * @return mixed
     */
    public function actionIndex()
    {
        $elements = [
            [
                'header' => [ 'text' => 'Категории товаров', 'link' => 'category/'],
                'icon' => 'fa-server',
                'description' => 'Модуль управления категориями: добавление, удаление, привязка ...',
                'short_links'=> [
                    [ 'text' => 'Новая категория', 'link' => 'category/create'],
                ],
            ],
            [
                'header' => [ 'text' => 'Товары', 'link' => 'product/'],
                'icon' => 'fa-cubes',
                'description' => 'Модуль управления товарами: добавление, удаление, привязка к категориям ...',
                'short_links'=> [
                    [ 'text' => 'Новый товар', 'link' => 'product/create'],
                ],
            ],
            [
                'header' => [ 'text' => 'Товарные предложения', 'link' => 'offer/'],
                'icon' => 'fa-shopping-basket',
            ],
            [
                'header' => [ 'text' => 'Поставщики', 'link' => 'supplier/'],
                'icon' => 'fa-truck',
            ],
            [
                'header' => [ 'text' => 'Производители', 'link' => 'manufacturer/'],
                'icon' => 'fa-industry',
                'description' => 'Модуль управления поставщиками: добавление, удаление, редактирование ...',
                'short_links'=> [
                    [ 'text' => 'Новый производитель', 'link' => 'manufacturer/create'],
                ],
            ],
        ];

        return $this->render('index', ['elements' => $elements]);
    }

    /**
     * Creates a new Catalogue model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Catalogue();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Updates an existing Catalogue model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Deletes an existing Catalogue model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['list']);
    }
    /**
     * Finds the Catalogue model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Catalogue the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Catalogue::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionList() {
        $searchModel = new CatalogueSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(false);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Catalogue model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
}

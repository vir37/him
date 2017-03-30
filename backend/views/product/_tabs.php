<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 26.03.2017
 * Time: 22:40
 */
use yii\bootstrap\Tabs;
use common\models\CategoryProduct;

if (!isset($mode))
    $mode = 'view';
if (!isset($containerClass))
    $containerClass = 'product-view';
?>
<?= Tabs::widget([
    'items' => [
        [
            'label' => 'Основная информация',
            'content' => $this->render('_tab1', [
                'mode' => $mode,
                'model' => $model,
                'imageUploader' => $imageUploader,
            ]),
        ],
        [
            'label' => 'Характеристики',
            'content' => $this->render('_tab2', [
                'mode' => $mode,
            ]),
        ],
        [
            'label' => 'Категории',
            'content' => $this->render('_tab3', [
                'mode' => $mode,
                'model' => new CategoryProduct(),
                'product_id' => $model->id,
            ]),
        ],
    ],
]) ?>

<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21.04.2017
 * Time: 15:53
 */
use yii\helpers\Html;
$img = strlen($category->icon) > 10 ? 'data:image/jpeg;charset=utf-8;base64,' . base64_encode($category->icon) : '/icons/no_logo.png';
?>
<div class="<?= $elem_class ?>">
    <img src="<?= $img ?>" alt="NO PHOTO"/>
    <p><?= Html::a($product->name, ['/product/view', 'city' => \Yii::$app->params['city']->uri_name,
            'id' => $product->id, 'parent_id' => $category->id ]) ?></p>
</div>
<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.06.2017
 * Time: 11:01
 */

use yii\helpers\Html;
?>

<?= $this->render('_form', [
    'model' => $model,
    'viewMode' => isset($viewMode) ? $viewMode : false,
]) ?>

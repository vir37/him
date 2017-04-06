<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Управление каталогами';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="body-content">
    <div class="container catalogue-menu">
        <div class="row">
            <h5><?= Html::a('Виды каталогов', ['catalogue/list'],[ 'class' => 'btn btn-default'])?></h5>
        </div>
        <div class="row">
            <?php
            if (isset($elements) && is_array($elements)) {
                foreach ($elements as $element) {
                    echo $this->render('/common/directory_elem', $element);
                }
            };
            ?>
        </div>
    </div>
</div>
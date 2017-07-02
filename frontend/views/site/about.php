<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'О нас';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <header>
        <h1><?= Html::encode($this->title) ?></h1>
    </header>

    <article class="row ql-editor"><?= $model->body ?></article>
</div>

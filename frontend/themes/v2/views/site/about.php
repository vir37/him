<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'О нас - компания "ТЕРА-ИНВЕСТ"';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'description', 'content' => 'Информация о компании "ТЕРА-ИНВЕСТ", её миссии, направлениях деятельности и партнерах'])
?>
<div class="site-about">
    <header>
        <h1><?= Html::encode($this->title) ?></h1>
    </header>

    <article class="row ql-editor"><?= $model->body ?></article>
</div>

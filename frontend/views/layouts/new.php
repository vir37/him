<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
/* новый дизайн*/
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\NewAppAsset;
use common\widgets\Alert;

NewAppAsset::register($this);
$city = \Yii::$app->params['city'];
$phone = \Yii::$app->params['phone']; //TODO: сохранять в настройках, дергать оттуда
?>
<?php $this->beginPage() ?>
<html lang="<?= Yii::$app->language ?>">
<head>
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'ООО "ТЕРА-ИНВЕСТ"',
        'brandOptions' => [ 'class' => 'navbar-brand-tera'],
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-default navbar-fixed-top navbar-tera',
        ],
    ]);
    $menuItems = [
        [ 'label' => $city->name, 'url' => '#', 'linkOptions' => ['data-cities' => '.city-choose'], 'options' => [ 'class' => 'city-chooser']],
        $this->render('_city_choose'),
        '<li><a href="tel:'.$phone.'"><span class="phone">'.$phone.'</span></a><span class="subline">Звонок по России бесплатный</span></li>',
        [ 'label' => 'КОНТАКТЫ', 'url' => ['/site/contacts', 'city' => $city->uri_name ], 'options' => [ 'class' => 'navbar-link']],
        [ 'label' => 'НАЙТИ', 'url' => '#' , 'options' => [ 'class' => 'search navbar-link']],
    ];
    /*
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }*/
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right navbar-nav-tera'],
        'items' => $menuItems,
    ]);
    //echo $this->render('city_choose');
    NavBar::end();
    ?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'homeLink' => [ 'label' => 'Главная', 'url' => Yii::$app->homeUrl ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; ООО "ТЕРА-ИНВЕСТ" <?= date('Y') ?></p>
        <address class="pull-right"><?= $city->index.', '.$city->fake_address ?></address>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

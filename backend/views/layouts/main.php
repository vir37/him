<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
if (!isset($this->params['background_class']))
    $background_class= '';
else
    $background_class= $this->params['background_class'];
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script type="text/javascript">
        baseUrl="<?= Yii::$app->request->baseUrl ?>";
    </script>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap <?= $background_class ?>">
    <?php
    NavBar::begin([
        'brandLabel' => '<i class="fa fa-home fa-2x"></i>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Главная', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Вход', 'url' => ['/site/login']];
    } else {
        array_push($menuItems,
            [
                'label' => 'Каталог',
                //'visible' => !is_null(Yii::$app->authManager->getAssignment('manager', Yii::$app->user->getId())),
                'visible' => Yii::$app->user->can('manager'),
                'url' => ['catalogue/']
            ],
            [
                'label' => 'Справочники',
                'visible' => Yii::$app->user->can('manager'),
                'url' => ['directory/']
            ],
            [
                'label' => 'Настройки',
                'visible' => Yii::$app->user->can('manager'),
                'url' => ['setting/']
            ]
        );
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Выход (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'homeLink' => [ 'label' => 'Главная', 'url' => Yii::$app->homeUrl ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget([]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

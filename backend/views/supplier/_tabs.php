<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 18.06.2017
 * Time: 23:18
 */
use yii\bootstrap\Tabs;

?>
<?=
    Tabs::widget([
        'items' => [
            [
                'label' => 'Основная информация',
                'content' => $this->render('_tab1', [
                    'model' => $model,
                ]),
            ],
            [
                'label' => 'Склады',
            ],
            [
                'label' => 'Товары и цены',
            ]
        ],
    ])
?>
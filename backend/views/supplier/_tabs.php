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
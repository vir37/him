<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.04.2017
 * Time: 23:55
 */
use common\models\City;
use yii\helpers\Html;
?>
<div class="city-choose">
    <?php
        foreach (City::find()->all() as $city ){
            echo Html::a($city->name, [ "", 'city' => $city->uri_name]);
        }
    ?>
</div>
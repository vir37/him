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
<div class="city-choose col-lg-4 col-md-4 col-sm-4 col-xs-4" style="display: none; z-index: 9999; position: absolute;">
    <div id="cities">
    <?php
        foreach (City::find()->all() as $city ){
            echo Html::a($city->name, [ "site/index", 'city' => $city->uri_name], [
                'style' => 'white-space: nowrap; display: inline-block;',
                'class' => 'col-lg-6 col-md-6 col-sm-6 col-xs-6']);
        }
    ?>
    </div>
</div>
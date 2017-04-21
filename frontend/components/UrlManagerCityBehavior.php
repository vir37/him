<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12.04.2017
 * Time: 11:35
 */

namespace frontend\components;
use yii\base\Behavior;
use yii\base\Controller;
use Yii;
use common\models\City;
use yii\helpers\Url;


class UrlManagerCityBehavior extends Behavior{

    public $def_city = 'kzn';

    public function events(){
        return [
            Controller::EVENT_BEFORE_ACTION => 'assignCity',
        ];
    }

    public function assignCity($event){
        $request = Yii::$app->request;
        $session = Yii::$app->session;
        if (!($city = $request->get('city')) || $city == "?")
            $city = $session->get('city');
        else
            $session->set('city', $city);
        if (!($model = City::findOne(['uri_name' => $city]))) {
            $model = City::findOne([ 'uri_name' => $this->def_city]);
            $event->isValid = false;
        }
        Yii::$app->setHomeUrl(Url::to(['site/index', 'city' => $city]));
        Yii::$app->params['city'] = $model;

        return;
    }
} 
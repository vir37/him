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
        if (!($city = $request->get('city')) || $city == "?") {
            $session_city = $session->get('city');
            if (!$session_city) {
                $url = Url::to(['site/index', 'city' => $this->def_city]);
            } else {
                $url = Url::to(['site/index', 'city' => $session_city]);
            }
        } else {
            $session->set('city', $city);
            Yii::$app->params['city'] = $city;
        }
    }
} 
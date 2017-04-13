<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.04.2017
 * Time: 10:45
   Специальное правило для переброски всех неподходящих запросов на дефолтный роут
 */

namespace frontend\components;

use yii\web\UrlNormalizerRedirectException,
    yii\web\UrlNormalizer,
    yii\web\UrlRule;
use Yii;


class RedirectUrlRule extends UrlRule {
    public function parseRequest($manager, $request){
        $session = Yii::$app->session;
        // восстановление города из сессии
        $route = isset($session['city']) ? $session['city'] : $this->route;
        $suffix = (string)($this->suffix === null ? $manager->suffix : $this->suffix);
        $result = parent::parseRequest($manager, $request);
        if ($result)
            throw new UrlNormalizerRedirectException($route.$suffix, UrlNormalizer::ACTION_REDIRECT_TEMPORARY);
        return $result;
    }
} 
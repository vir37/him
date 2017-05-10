<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10.05.2017
 * Time: 11:04
 */

namespace frontend\components;
use Yii;
use yii\web\Response;
use yii\helpers\Url;

class CaptchaAction extends \yii\captcha\CaptchaAction {
    public function run()
    {
        if (Yii::$app->request->getQueryParam(self::REFRESH_GET_VAR) !== null) {
            // AJAX request for regenerating code
            $code = $this->getVerifyCode(true);
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'hash1' => $this->generateValidationHash($code),
                'hash2' => $this->generateValidationHash(strtolower($code)),
                // we add a random 'v' parameter so that FireFox can refresh the image
                // when src attribute of image tag is changed
                'url' => Url::to([$this->id, 'v' => uniqid(), 'city' => Yii::$app->params['city']->uri_name]),
            ];
        } else {
            $this->setHttpHeaders();
            Yii::$app->response->format = Response::FORMAT_RAW;
            return $this->renderImage($this->getVerifyCode());
        }
    }

} 
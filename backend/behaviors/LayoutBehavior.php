<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 23.06.2017
 * Time: 10:51
 *
 * Поведение для контроллеров. Меняет layout вьюх в зависимости от наличия определенных куки
 * соответвие задается в параметре $assigns
 * $assigns - ассоциативный массив, где ключ - это наименование куки, а значение - название layout
 *
 */

namespace backend\behaviors;

use yii\base\Behavior;
use Yii;
use yii\base\Controller;


class LayoutBehavior extends Behavior {

    public $assigns = [];

    public function events(){
        return [
            Controller::EVENT_BEFORE_ACTION => 'assignLayout',
        ];
    }

    public function assignLayout($event){
        $controller = $this->owner;

        foreach ($this->assigns as $cookie => $layout) {
            if (array_key_exists($cookie, $_COOKIE)) {
                $controller->layout = $layout;
                return true;
            }
        }
        return true;
    }
}
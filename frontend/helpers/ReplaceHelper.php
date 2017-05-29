<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.05.2017
 * Time: 15:43
 */
namespace frontend\helpers;

class ReplaceHelper {

    /*
     * Функция заменят специальные поля в строке, заданные %field%, на их значения из ассоциативного массива replacements
     */
    public static function replaceSpecFields($baseStr, $replacements ) {
        $searchs = array_map(function($e){ return "%$e%"; }, array_keys($replacements));
        return str_replace($searchs, array_values($replacements), $baseStr);
    }

} 
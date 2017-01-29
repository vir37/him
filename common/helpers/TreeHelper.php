<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 28.01.2017
 * Time: 23:10
 */
namespace common\helpers;

class TreeHelper
{
    private static function recurcion($rootId, &$arr, $id = 'id', $parent = 'parent_id', $name = 'name', $replacement=[]){
        $result = []; # потомки, элемент children
        foreach ($arr as $key=>$value) {
            if ($value->{$parent} == $rootId) {
                $_id = $value->{$id};
                $_name = $value->{$name};
                unset($arr[$key]);
                $_children = TreeHelper::recurcion($_id, $arr, $id, $parent, $name);
                $el = [ 'id' => $_id, 'name' => $_name ];
                if (sizeof($_children) > 0)
                    $el['children'] = $_children;
                foreach($replacement as $_key=>$_value){
                    if (array_key_exists($_key, $el)) {
                        $el[$_value] = $el[$_key];
                        unset($el[$_key]);
                    }
                }
                $result[] = $el;
            }
        }
        return $result;
    }


    public static function createTree($dataProvider, $id = 'id', $parent = 'parent_id', $name = 'name', $replacement=[])
    {

        $result = [];
        $arr = $dataProvider->getModels();

        foreach ($arr as $key=>$value) {
            if (!$value->{$parent}) {
                $_id = $value->{$id};
                $_name = $value->{$name};
                unset($arr[$key]);
                $_children = TreeHelper::recurcion($_id, $arr, $id, $parent, $name, $replacement);
                $el = [ 'id' => $_id, 'name' => $_name ];
                if (sizeof($_children) > 0)
                    $el['children'] = $_children;
                foreach($replacement as $_key=>$_value){
                    if (array_key_exists($_key, $el)) {
                        $el[$_value] = $el[$_key];
                        unset($el[$_key]);
                    }
                }
                $result[] = $el;
            }
        }
        return $result;
    }
}
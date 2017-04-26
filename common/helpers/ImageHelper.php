<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 26.04.2017
 * Time: 10:30
 */

namespace common\helpers;


class ImageHelper {
    public static $image_path = '/images/';
    public static $no_photo = '/icons/no_photo.png';
    public static $no_image = '/icons/no_image.png';
    public static $no_logo = '/icons/no_logo.png';

    public static function getImagePath($img){
        if (is_string($img) && file_exists(\Yii::getAlias("@images/$img")))
            return self::$image_path.$img;
        //TODO: надо еще такой механизм реализовать
        //$img = strlen($model->photo) > 10 ? 'data:image/jpeg;charset=utf-8;base64,' . base64_encode($model->photo) : '/icons/no_photo.png'
        return self::$no_image;
    }
} 
<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 05.02.2017
 * Time: 22:27
 */

namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class ImageUploadForm extends Model{
    public $objectId;
    public $isMain;
    public $imageFile;

    public function rules(){
        return [
            [ 'objectId', 'required' ],
            [ 'isMain', 'boolean'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function attributeLabels(){
        return [
            'objectId' => 'Идентификатор объекта',
            'isMain' => 'Главное изображение',
            'imageFile' => 'Файл с изображением',
        ];
    }

    public function upload($file_name){
        if ($this->validate()){
            $this->imageFile->saveAs($file_name);
            return true;
        } else {
            return false;
        }
    }
} 
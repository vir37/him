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
    public $imageFile;

    public function rules(){
        return [
            [ 'objectId', 'required' ],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload(){
        if ($this->validate()){
            $this->imageFile->saveAs();
            return true;
        } else {
            return false;
        }
    }
} 
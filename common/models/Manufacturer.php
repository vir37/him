<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "manufacturer".
 *
 * @property string $id
 * @property string $name
 * @property resource $logo
 * @property string $web_site
 *
 * @property Product[] $products
 */
class Manufacturer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manufacturer';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['logo'], 'string'],
            [['name'], 'string', 'max' => 255],
            ['web_site', 'url', 'defaultScheme' => 'http' ],
            [['web_site'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Наименование'),
            'logo' => Yii::t('app', 'Логотип'),
            'web_site' => Yii::t('app', 'WEB-сайт'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['manufacturer_id' => 'id']);
    }

    public function load( $data, $formName = null){
        try {
            // исключаем из автоматической загрузки
            unset($data[$this->formName()]['logo']);
        } catch (Exception $e) {}

        return parent::load($data, $formName);
    }
}

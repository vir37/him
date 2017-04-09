<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property string $id
 * @property string $region_id
 * @property string $name
 * @property string $uri_name
 * @property string $index
 * @property string $latitude
 * @property string $longitude
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_id', 'name', 'uri_name', 'index'], 'required'],
            [['region_id', 'index'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['name', 'uri_name'], 'string', 'max' => 32],
            [['index'], 'unique'],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'region_id' => 'Код региона',
            'name' => 'Наименование города',
            'uri_name' => 'Наименование города для URL',
            'index' => 'Почтовый индекс',
            'latitude' => 'Широта',
            'longitude' => 'Долгота',

        ];
    }

    public function getRegion(){
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }
}

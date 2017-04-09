<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property string $id
 * @property string $code
 * @property string $name
 * @property string $capital
 * @property string $district
 *
 * @property City[] $cities
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name', 'capital', 'district'], 'required'],
            [['code'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['capital', 'district'], 'string', 'max' => 32],
            [['code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Код региона',
            'name' => 'Название региона',
            'capital' => 'Столица',
            'district' => 'Округ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::className(), ['region_id' => 'id']);
    }
}

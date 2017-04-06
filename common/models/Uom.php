<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "uom".
 *
 * @property string $id
 * @property string $short_name
 * @property string $name
 *
 * @property Feature[] $features
 */
class Uom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'uom';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['short_name'], 'required'],
            [['short_name'], 'string', 'max' => 64],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'short_name' => Yii::t('app', 'Краткое наименование единицы измерения'),
            'name' => Yii::t('app', 'Наименование единицы измерения'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeatures()
    {
        return $this->hasMany(Feature::className(), ['uom_id' => 'id']);
    }
}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_feature".
 *
 * @property string $id
 * @property string $feature_id
 * @property string $product_id
 * @property double $value_numeric
 * @property string $value_string
 * @property string $upd_date
 *
 * @property Feature $feature
 * @property Product $product
 */
class ProductFeature extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_feature';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['feature_id', 'product_id'], 'required'],
            [['feature_id', 'product_id'], 'integer'],
            [['value_numeric'], 'number'],
            [['upd_date'], 'safe'],
            [['value_string'], 'string', 'max' => 255],
            [['product_id'], 'unique'],
            [['product_id', 'feature_id'], 'unique', 'targetAttribute' => ['product_id', 'feature_id'], 'message' => 'The combination of Ссылка на характеристику and Ссылка на товар has already been taken.'],
            [['feature_id'], 'exist', 'skipOnError' => true, 'targetClass' => Feature::className(), 'targetAttribute' => ['feature_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'feature_id' => Yii::t('app', 'Ссылка на характеристику'),
            'product_id' => Yii::t('app', 'Ссылка на товар'),
            'value_numeric' => Yii::t('app', 'Числовое значение'),
            'value_string' => Yii::t('app', 'Строковое значение'),
            'upd_date' => Yii::t('app', 'Дата обновления'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeature()
    {
        return $this->hasOne(Feature::className(), ['id' => 'feature_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}

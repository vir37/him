<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "feature".
 *
 * @property string $id
 * @property string $short_name
 * @property string $name
 * @property string $type_id
 * @property string $uom_id
 *
 * @property FeatureType $type
 * @property Uom $uom
 * @property ProductFeature[] $productFeatures
 * @property Product[] $products
 */
class Feature extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feature';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['short_name', 'name', 'type_id'], 'required'],
            [['type_id', 'uom_id'], 'integer'],
            [['short_name'], 'string', 'max' => 64],
            [['name'], 'string', 'max' => 255],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => FeatureType::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['uom_id'], 'exist', 'skipOnError' => true, 'targetClass' => Uom::className(), 'targetAttribute' => ['uom_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'short_name' => Yii::t('app', 'Краткое наименование'),
            'name' => Yii::t('app', 'Наименование'),
            'type_id' => Yii::t('app', 'Тип значения свойства'),
            'uom_id' => Yii::t('app', 'ID единицы измерения'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(FeatureType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUom()
    {
        return $this->hasOne(Uom::className(), ['id' => 'uom_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductFeatures()
    {
        return $this->hasMany(ProductFeature::className(), ['feature_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('product_feature', ['feature_id' => 'id']);
    }
}

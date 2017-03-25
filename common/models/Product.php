<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property string $id
 * @property integer $list_position
 * @property string $category_id
 * @property string $name
 * @property string $description
 * @property string $meta_desc
 * @property string $meta_keys
 * @property string $manufacturer_id
 *
 * @property Offer[] $offers
 * @property Manufacturer $manufacturer
 * @property ProductImg[] $productImgs
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['list_position', 'category_id', 'manufacturer_id'], 'integer'],
            [['category_id', 'name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['meta_desc', 'meta_keys'], 'string', 'max' => 128],
            [['manufacturer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Manufacturer::className(), 'targetAttribute' => ['manufacturer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'list_position' => Yii::t('app', 'Позиция товара в списке'),
            'category_id' => Yii::t('app', 'Ссылка на id категории'),
            'name' => Yii::t('app', 'Наименование товара'),
            'description' => Yii::t('app', 'Описание'),
            'meta_desc' => Yii::t('app', 'SEO описание'),
            'meta_keys' => Yii::t('app', 'SEO ключевые слова'),
            'manufacturer_id' => Yii::t('app', 'Идентификатор производителя'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffers()
    {
        return $this->hasMany(Offer::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManufacturer()
    {
        return $this->hasOne(Manufacturer::className(), ['id' => 'manufacturer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductImgs()
    {
        return $this->hasMany(ProductImg::className(), ['product_id' => 'id']);
    }
}

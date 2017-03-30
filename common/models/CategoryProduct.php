<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category_product".
 *
 * @property string $category_id
 * @property string $product_id
 * @property string $list_position
 *
 * @property Category $category
 * @property Product $product
 */
class CategoryProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'product_id'], 'required'],
            [['category_id', 'product_id', 'list_position'], 'integer'],
            [['category_id', 'product_id'], 'unique', 'targetAttribute' => ['category_id', 'product_id'], 'message' => 'The combination of ID категории and ID  товара has already been taken.'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => Yii::t('app', 'ID категории'),
            'product_id' => Yii::t('app', 'ID  товара'),
            'list_position' => Yii::t('app', 'Позиция товара в списке категории'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "catalogue".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 *
 * @property Category[] $categories
 */
class Catalogue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalogue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'description' => 'Описание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories() {
        return $this->hasMany(Category::className(), ['catalogue_id' => 'id'])->orderBy(['list_position' => SORT_ASC]);
    }


    public function getPopulateProducts($limit = 1){
        $result = [];
        $categories = $this->getCategories()->limit($limit)->all();
        foreach ($categories as $category) {
            $product = $category->getProduct()->limit(1)->all();
            if ($product) {
                $result[] = [ 'product' => $product, 'category' => $category];
            }
        }
        return $result;
    }
}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $name
 * @property string $description
 * @property string $meta_desc
 * @property string $meta_keys
 *
 * @property CategoryImg[] $categoryImgs
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['name', 'meta_desc', 'meta_keys'], 'required'],
            [['description'], 'string'],
            [['name', 'meta_desc', 'meta_keys'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Родительская категория',
            'name' => 'Наименование',
            'description' => 'Описание',
            'meta_desc' => 'SEO описание',
            'meta_keys' => 'SEO ключевые слова',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryImgs()
    {
        return $this->hasMany(CategoryImg::className(), ['category_id' => 'id']);
    }
}

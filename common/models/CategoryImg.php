<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category_img".
 *
 * @property string $id
 * @property string $category_id
 * @property string $name
 * @property integer $is_main
 * @property string $date_add
 * @property string $date_upd
 *
 * @property Category $category
 */
class CategoryImg extends \yii\db\ActiveRecord
{
    const STATUS_MAIN = 1;
    const STATUS_DEFAULT = 0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_img';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'name'], 'required'],
            [['category_id', 'is_main'], 'integer'],
            ['is_main', 'validateOnlyOne'],
            [['date_add', 'date_upd'], 'safe'],
            [['name'], 'string', 'max' => 128],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Идентификатор категории',
            'name' => 'Наименование файла изображения',
            'is_main' => 'Признак главного изображения',
            'date_add' => 'Дата создания',
            'date_upd' => 'Дата обновления',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function validateOnlyOne($attribute, $params){
        if (self::find()->where(['category_id' => $this->category_id, 'is_main' => self::STATUS_MAIN])->count() > 0 &&
            $this->{$attribute} == self::STATUS_MAIN)
            $this->addError($attribute, "Может быть только одна главная фотография");
    }

    public function setMain() {
        try {
            self::updateAll(['is_main' => self::STATUS_DEFAULT]);
            $this->is_main = self::STATUS_MAIN;
            return $this->save();
        } catch (\Exception $e) {
            return false;
        }
    }
}

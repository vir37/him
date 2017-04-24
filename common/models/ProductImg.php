<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "product_img".
 *
 * @property string $id
 * @property string $product_id
 * @property string $name
 * @property integer $is_main
 * @property string $date_add
 * @property string $date_upd
 *
 * @property Product $product
 */
class ProductImg extends ActiveRecord
{

    const STATUS_MAIN = 1;
    const STATUS_DEFAULT = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_img';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date_add', 'date_upd'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['date_upd'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'name'], 'required'],
            [['product_id', 'is_main'], 'integer'],
            ['is_main', 'validateOnlyOne'],
            [['date_add', 'date_upd'], 'safe'],
            [['name'], 'string', 'max' => 128],
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
            'product_id' => Yii::t('app', 'Идентификатор товара'),
            'name' => Yii::t('app', 'Наименование файла изображения'),
            'is_main' => Yii::t('app', 'Признак главной фотографии'),
            'date_add' => Yii::t('app', 'Дата создания'),
            'date_upd' => Yii::t('app', 'Дата обновления'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    public function validateOnlyOne($attribute, $params){
        if (self::find()->where(['product_id' => $this->product_id, 'is_main' => self::STATUS_MAIN])->count() > 0 &&
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

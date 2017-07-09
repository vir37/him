<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord,
    yii\db\Expression;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "article".
 *
 * @property string $id
 * @property string $create_dt
 * @property string $update_dt
 * @property string $name
 * @property string $title
 * @property string $body
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_dt', 'update_dt'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_dt'],
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
            [['name'], 'required'],
            [['create_dt', 'update_dt'], 'safe'],
            [['body'], 'string'],
            [['name'], 'string', 'max' => 32],
            ['name', 'match', 'pattern' => '/^[A-Za-z0-9]*$/i', 'message' => 'Некорректно! Допустимы латинские буквы и цифры'],
            [['title'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'create_dt' => 'Дата создания',
            'update_dt' => 'Дата обновления',
            'name' => 'Краткое наименование',
            'title' => 'Заголовок',
            'body' => 'Текст',
        ];
    }
}

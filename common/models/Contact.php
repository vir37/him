<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord,
    yii\db\Expression;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "contact".
 *
 * @property string $id
 * @property string $create_dt
 * @property string $update_dt
 * @property string $FIO
 * @property string $phones
 * @property string $emails
 */
class Contact extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_dt', 'update_dt'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_dy'],
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
            [['FIO', 'phones', 'emails'], 'required'],
            [['create_dt', 'update_dt'], 'safe'],
            [['FIO'], 'string', 'max' => 150],
            [['phones'], 'string', 'max' => 64],
            [['emails'], 'string', 'max' => 255],
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
            'FIO' => 'ФИО',
            'phones' => 'Телефоны',
            'emails' => 'Адреса электронной почты',
        ];
    }
}

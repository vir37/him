<?php

namespace common\models;

use Yii;
use common\models\User;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "employee".
 *
 * @property string $id
 * @property string $user_id
 * @property string $fio
 * @property resource $photo
 * @property string $post
 * @property string $email
 * @property string $phone
 * @property integer $is_chief
 * @property string $create_dt
 */
class Employee extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_dt'],
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
            [['user_id'], 'integer'],
            [['fio'], 'required'],
            ['is_chief', 'boolean'],
            ['is_chief', 'default', 'value' => false ],
            [['photo'], 'image', 'extensions' => 'png, jpg'],
            [['create_dt'], 'safe'],
            [['fio', 'post'], 'string', 'max' => 255],
            ['email', 'email'],
            ['email', 'string', 'max' => 128],
//            ['phone', 'string', 'max' => 64],
            ['phone', 'match', 'pattern' => '/^[0-9-()\+]*$/i'],
            ['user_id', 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ID пользователя',
            'fio' => 'ФИО сотрудника',
            'photo' => 'Фотография',
            'post' => 'Должность сотрудника',
            'email' => 'Адрес электронной почты',
            'phone' => 'Телефон',
            'is_chief' => 'Признак руководителя',
            'create_dt' => 'Время создания',
        ];
    }

    public function load( $data, $formName = null){
        try {
            // исключаем из автоматической загрузки
            unset($data[$this->formName()]['photo']);
        } catch (Exception $e) {}

        return parent::load($data, $formName);
    }

    public function getUser() {
        if ($this->user_id)
            return $this->hasOne(User::className(), [ 'id' => 'user_id' ]);
        return null;
    }
}

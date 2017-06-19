<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord,
    yii\db\Expression;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "supplier".
 *
 * @property string $id
 * @property string $create_dt
 * @property string $update_dt
 * @property string $name
 * @property string $description
 * @property string $INN
 * @property string $OGRN
 * @property string $jur_address_id
 * @property string $fact_address_id
 * @property string $post_address_id
 * @property string $logo
 * @property string $phone
 * @property string $email
 * @property string $site
 * @property string $note
 *
 * @property Offer[] $offers
 * @property Address $jurAddress
 * @property Address $factAddress
 * @property Address $postAddress
 */
class Supplier extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'supplier';
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
            [['create_dt', 'update_dt', 'name', 'description', 'INN', 'OGRN', 'email', 'note'], 'required'],
            [['create_dt', 'update_dt'], 'safe'],
            [['description', 'note'], 'string'],
            [['jur_address_id', 'fact_address_id', 'post_address_id'], 'integer'],
            [['name', 'logo', 'email'], 'string', 'max' => 128],
            [['INN'], 'string', 'max' => 12],
            [['OGRN'], 'string', 'max' => 13],
            [['phone'], 'string', 'max' => 16],
            [['site'], 'string', 'max' => 64],
            [['INN'], 'unique'],
            [['jur_address_id'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['jur_address_id' => 'id']],
            [['fact_address_id'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['fact_address_id' => 'id']],
            [['post_address_id'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['post_address_id' => 'id']],
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
            'name' => 'Наименование поставщика',
            'description' => 'Описание оставщика',
            'INN' => 'ИНН',
            'OGRN' => 'ОГРН',
            'jur_address_id' => 'Юридический адрес',
            'fact_address_id' => 'Фактический адрес',
            'post_address_id' => 'Почтовый адрес',
            'logo' => 'Файл логотипа',
            'phone' => 'Основной телефон',
            'email' => 'Адрес электронной почты',
            'site' => 'WEB-сайт',
            'note' => 'Примечание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffers()
    {
        return $this->hasMany(Offer::className(), ['supplier_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJurAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'jur_address_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFactAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'fact_address_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'post_address_id']);
    }
}

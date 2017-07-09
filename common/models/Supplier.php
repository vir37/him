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
    const CONTACT_LINK_OBJECT_TYPE = 1;

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
            [['name', 'description', 'INN', 'OGRN'], 'required'],
            [['create_dt', 'update_dt'], 'safe'],
            [['description', 'note'], 'string'],
            [['jur_address_id', 'fact_address_id', 'post_address_id'], 'integer'],
            [['name', 'email'], 'string', 'max' => 128],
            [['logo'], 'image', 'extensions' => 'png, jpg'],
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
            'logo' => 'Логотип',
            'phone' => 'Основной телефон',
            'email' => 'Адрес электронной почты',
            'site' => 'WEB-сайт',
            'note' => 'Примечание',
        ];
    }

    public function load( $data, $formName = null){
        try {
            // исключаем из автоматической загрузки
            unset($data[$this->formName()]['logo']);
        } catch (Exception $e) {}

        return parent::load($data, $formName);
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

    public function getWarehouse() {
        return $this->hasMany(Warehouse::className(), ['supplier_id' => 'id']);
    }

    public function getContact() {
        return $this->hasMany(Contact::className(), ['id' => 'contact_id'])
            ->viaTable(ContactLinks::tableName(), [ 'object_id' => 'id' ], function($query) { $query->where([ 'object_type' => self::CONTACT_LINK_OBJECT_TYPE ]); });
    }

    public function addContact($contact_id){
        $model = new ContactLinks();
        $model->contact_id = $contact_id;
        $model->object_type = self::CONTACT_LINK_OBJECT_TYPE;
        $model->object_id = $this->id;
        $result = [ 'result' => $model->save()];
        if ($result)
            return [ 'result' => $result, 'errors' => $model->errors ];
        return [ 'result' => $result];
    }

    public function removeContact($contact_id) {
        $model = ContactLinks::findOne([ 'object_type' => self::CONTACT_LINK_OBJECT_TYPE, 'object_id' => $this->id, 'contact_id' => $contact_id]);
        if (!$model)
            return [ 'result' => false, 'errors' => [ 'Model not found' ] ];
        $result = $model->delete();
        if ($result)
            return [ 'result' => $result, 'errors' => $model->errors ];
        return [ 'result' => $result];
    }

}

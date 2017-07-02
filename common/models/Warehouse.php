<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord,
    yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use common\models\Contact,
    common\models\ContactLinks;


/**
 * This is the model class for table "warehouse".
 *
 * @property string $id
 * @property string $create_dt
 * @property string $update_dt
 * @property string $supplier_id
 * @property string $address_id
 * @property string $work_hours
 * @property string $note
 *
 * @property Supplier $supplier
 * @property Address $address
 */
class Warehouse extends ActiveRecord
{
    const CONTACT_LINK_OBJECT_TYPE = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warehouse';
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
            [['supplier_id', 'work_hours', 'note'], 'required'],
            [['create_dt', 'update_dt'], 'safe'],
            [['supplier_id', 'address_id'], 'integer'],
            [['note'], 'string'],
            [['work_hours'], 'string', 'max' => 255],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::className(), 'targetAttribute' => ['supplier_id' => 'id']],
            [['address_id'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['address_id' => 'id']],
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
            'supplier_id' => 'ID поставщика',
            'address_id' => 'ID адреса',
            'work_hours' => 'Режим работы',
            'note' => 'Примечание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Supplier::className(), ['id' => 'supplier_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'address_id']);
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

}

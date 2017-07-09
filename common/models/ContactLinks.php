<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contact_links".
 *
 * @property string $id
 * @property string $object_type
 * @property string $object_id
 * @property string $contact_id
 *
 * @property Contact $contact
 */
class ContactLinks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact_links';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['object_type', 'object_id', 'contact_id'], 'required'],
            [['object_type', 'object_id', 'contact_id'], 'integer'],
            [['contact_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contact::className(), 'targetAttribute' => ['contact_id' => 'id']],
            ['object_type', 'unique', 'targetAttribute' => ['object_type', 'object_id', 'contact_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'object_type' => 'Тип объекта',
            'object_id' => 'ID объекта',
            'contact_id' => 'ID контакта',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContact()
    {
        return $this->hasOne(Contact::className(), ['id' => 'contact_id']);
    }
}

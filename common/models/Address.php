<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "address".
 *
 * @property string $id
 * @property string $region_id
 * @property string $index
 * @property string $settlement
 * @property string $street
 * @property string $house
 * @property string $corp
 * @property integer $apartment
 *
 * @property Supplier[] $suppliers
 * @property Supplier[] $suppliers0
 * @property Supplier[] $suppliers1
 */
class Address extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_id', 'index', 'settlement', 'street', 'house'], 'required'],
            [['region_id', 'index', 'apartment'], 'integer'],
            [['settlement', 'street'], 'string', 'max' => 64],
            [['house', 'corp'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'region_id' => 'Код региона',
            'index' => 'Индекс',
            'settlement' => 'Населённый пункт',
            'street' => 'Улица',
            'house' => 'Дом',
            'corp' => 'Корпус',
            'apartment' => 'Офис/квартира',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuppliers()
    {
        return $this->hasMany(Supplier::className(), ['jur_address_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuppliers0()
    {
        return $this->hasMany(Supplier::className(), ['fact_address_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuppliers1()
    {
        return $this->hasMany(Supplier::className(), ['post_address_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion(){
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }


    public function makeAddress(){
        return $this->region->name.', '.
               $this->index.', '.
               $this->settlement.', '.
               $this->street.
               $this->house ? ', '.$this->house : ''.
               $this->corp ? ', '.$this->corp : ''.
               $this->apartment ? ', '.$this->apartment : '';
    }
}

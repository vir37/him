<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "offer".
 *
 * @property string $id
 * @property string $product_id
 * @property string $supplier_id
 * @property string $warehouse_id
 * @property string $update_dt
 * @property string $price
 * @property string $uom_count
 * @property string $uom_id
 *
 * @property Product $product
 * @property Supplier $supplier
 * @property Warehouse $warehouse
 * @property Uom $uom
 */
class Offer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'offer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'supplier_id', 'warehouse_id', 'update_dt', 'price', 'uom_count'], 'required'],
            [['product_id', 'supplier_id', 'warehouse_id', 'uom_id'], 'integer'],
            [['update_dt'], 'safe'],
            [['price', 'uom_count'], 'number'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::className(), 'targetAttribute' => ['supplier_id' => 'id']],
            [['warehouse_id'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouse::className(), 'targetAttribute' => ['warehouse_id' => 'id']],
            [['uom_id'], 'exist', 'skipOnError' => true, 'targetClass' => Uom::className(), 'targetAttribute' => ['uom_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'ID товара',
            'supplier_id' => 'ID поставщика',
            'warehouse_id' => 'ID склада',
            'update_dt' => 'Дата последнего обновления',
            'price' => 'Цена',
            'uom_count' => 'Количество единиц измерения',
            'uom_id' => 'Единица измерения',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
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
    public function getWarehouse()
    {
        return $this->hasOne(Warehouse::className(), ['id' => 'warehouse_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUom()
    {
        return $this->hasOne(Uom::className(), ['id' => 'uom_id']);
    }
}

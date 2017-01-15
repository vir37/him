<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "setting".
 *
 * @property string $id
 * @property string $param
 * @property string $value
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['param', 'value'], 'required'],
            [['param'], 'string', 'max' => 64],
            [['value'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'param' => 'Наименование настройки',
            'value' => 'Значение настройки',
        ];
    }
}

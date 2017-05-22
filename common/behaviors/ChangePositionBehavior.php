<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 22.05.2017
 * Time: 16:50
 */

namespace common\behaviors;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class ChangePositionBehavior extends Behavior {
    /*
     *@var string Атрибут, хранящий информацию о позиции записи
     * Значение по-умолчанию  - list_position
     */
    public $positionField = 'list_position';

    /*
     *@var array Список атрибутов для ограничения расчета уникальной позиции
     * например, для категории позиция должна быть уникальной в рамках одинакового каталога и одинаковой родительской категории
     */
    public $restrictFields = [];


    public function events(){
        return [
            ActiveRecord::EVENT_AFTER_DELETE => 'resortPositions',
        ];
    }

    public function resortPositions($event) {
        $pos = 1;
        $model = $this->owner;
        $query = $model->find()->where('1=1');
        foreach ($this->restrictFields as $field)
            $query->andWhere([ $field => $model->{$field} ]);

        foreach ($query->orderBy([$this->positionField => SORT_ASC])->all() as $rec){
            $rec->{$this->positionField} = $pos;
            $rec->save();
            $pos++;
        }
    }

    public function changePosition($newPosition) {
        if (!($model = $this->owner))
            return;
        $step = $model->{$this->positionField} > $newPosition ? 1 : -1;
        $min = $step > 0 ? (int) $newPosition : (int) $model->{$this->positionField} - $step;
        $max = $step > 0 ? (int) $model->{$this->positionField} - $step : (int) $newPosition;
        $query = $model->find()->where('1=1');
        foreach ($this->restrictFields as $field)
            $query->andWhere([ $field => $model->{$field} ]);

        $query->andWhere(['between', $this->positionField, $min, $max])
            ->orderBy([$this->positionField => SORT_ASC]);

        $model->{$this->positionField} = 0;
        $model->save();

        foreach ($query->all() as $rec) {
            $rec->{$this->positionField} += $step;
            $rec->save();
        }
        $model->{$this->positionField} = $newPosition;
        $model->save();
    }

} 
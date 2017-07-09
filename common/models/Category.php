<?php

namespace common\models;

use Yii;
use yii\db\IntegrityException;
use common\behaviors\ChangePositionBehavior;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "category".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $name
 * @property string $description
 * @property string $meta_desc
 * @property string $meta_keys
 *
 * @property CategoryImg[] $categoryImgs
 */
class Category extends ActiveRecord
{
    private $oldParent;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['catalogue_id', 'parent_id'], 'integer'],
            [['catalogue_id', 'name', 'meta_desc', 'meta_keys'], 'required'],
            ['list_position', 'default', 'value' => function($model, $attribute) {
                $query = self::find()->where([ 'parent_id' => $model->parent_id ? $model->parent_id : null,
                                               'catalogue_id' => $model->catalogue_id]);
                return ($query->max($attribute) + 1);
            }],
            [['description'], 'string'],
            [['name', 'meta_keys'], 'string', 'max' => 128],
            [['meta_desc'], 'string', 'max' => 160],
            [['icon'], 'image', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'catalogue_id' => 'ID каталога',
            'parent_id' => 'Родительская категория',
            'name' => 'Наименование',
            'description' => 'Описание',
            'meta_desc' => 'SEO описание',
            'meta_keys' => 'SEO ключевые слова',
            'icon' => 'Иконка',
        ];
    }


    public function behaviors(){
        return [
            [
                'class' => ChangePositionBehavior::className(),
                'restrictFields' => [ 'parent_id', 'catalogue_id' ],
            ],
        ];
    }

    public function init(){
        parent::init();
        $this->on(self::EVENT_BEFORE_UPDATE, [$this, 'saveParentCategory']);
        $this->on(self::EVENT_AFTER_UPDATE, [$this, 'resortParent']);
    }


    public function saveParentCategory(){
        $this->oldParent = $this->getOldAttribute('parent_id');
        if ($this->parent_id == $this->oldParent)
            return;
        $this->list_position = self::find()->where([ 'parent_id' => $this->parent_id ? $this->parent_id : null, 'catalogue_id' => $this->catalogue_id])
                                           ->max('list_position') + 1;
    }

    public function resortParent(){
        if ($this->parent_id == $this->oldParent)
            return;
        $pos = 1;
        $query = self::find()->where(['catalogue_id' => $this->catalogue_id, 'parent_id' => $this->oldParent]);
        foreach ($query->orderBy([ 'list_position' => SORT_ASC])->all() as $rec){
            $rec->list_position = $pos;
            $rec->save();
            $pos++;
        }
    }

    public function load( $data, $formName = null){
        try {
            // исключаем из автоматической загрузки
            unset($data[$this->formName()]['icon']);
        } catch (Exception $e) {}

        return parent::load($data, $formName);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(CategoryImg::className(), ['category_id' => 'id'])->orderBy(['is_main' => SORT_DESC]);
    }


    /**
     * Как бы отношение, но при неинициализированной записи, выдает весь список каталогов
     * Удобно при рендеринге форм ввода и редактировани записи
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogue() {
        return $this->hasOne(Catalogue::className(), [ 'id' => 'catalogue_id' ]);
    }

    public function getProduct(){
        return $this->hasMany(Product::className(), [ 'id' => 'product_id'])
            ->viaTable('category_product', [ 'category_id' => 'id']);
    }

    public function getCategory_product(){
        return $this->hasMany(CategoryProduct::className(), ['category_id' => 'id']);
    }

    public function addImage($file_name, $isMain) {
        $image = new CategoryImg();
        $image->category_id = $this->id;
        $image->name = $file_name;
        $image->is_main = $isMain;
        try {
            if ($image->save())
                return true;
        } catch (IntegrityException $e) {
            return $e;
        }
    }

    /**
     * Возвращает массив хлебных крошек к текущей категории
     * @return array
     */
    public function buildBreadcrumbs() {
        $result = [];
        $result[] = [ 'label' => $this->name, 'url' => [ 'category/view', 'id' => $this->id ]];
        $parent = self::findOne($this->parent_id);
        while ($parent){
            $result[] = [ 'label' => $parent->name, 'url' => [ 'category/view', 'id' => $parent->id ]];
            $parent = self::findOne($parent->parent_id);
        }
        return array_reverse($result);
    }
}

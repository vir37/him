<?php

namespace common\models;

use Yii;
use yii\base\Exception,
    yii\db\IntegrityException;
use common\models\Product;

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
class Category extends \yii\db\ActiveRecord
{
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
            [['description'], 'string'],
            [['name', 'meta_desc', 'meta_keys'], 'string', 'max' => 128],
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
        ];
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
        if (is_null($this->catalogue_id)) {
            #$res = Catalogue::find();
            #return $res->all();
            return Catalogue::find();
        }
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

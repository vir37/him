<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 28.01.2017
 * Time: 12:42
 */

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider,
    yii\data\ArrayDataProvider;
use common\models\Category;
use common\helpers\TreeHelper;

class CategorySearch extends Category {

    const SCENARIO_FRONTOFFICE = 'front';
    const SCENARIO_BACKOFFICE = 'back';

    public function rules() {
        return [
            [['id', 'catalogue_id', 'parent_id'], 'integer'],
            [['name', 'description', 'meta_desc', 'meta_keys'], 'safe'],
        ];
    }

    public function scenarios() {
        $scens = Model::scenarios();
        return $scens;
    }

    public function search($params) {
        $query = Category::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'catalogue_id' => $this->catalogue_id,
            'parent_id' => $this->parent_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'meta_desc', $this->meta_desc])
            ->andFilterWhere(['like', 'meta_keys', $this->meta_keys]);

        return $dataProvider;
    }

    public function makeTree($dataProvider, $addit_params = [], $selected=0) {
        # $result = new ArrayDataProvider();
        $adata = TreeHelper::createTree($dataProvider, $id='id', $parent='parent_id', $name='name',
                                        $replacement=['name' => 'text', 'children' => 'nodes'],
                                        $addit_params, $selected);
        return $adata;

    }
} 
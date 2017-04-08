<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Feature;

/**
 * FeatureSearch represents the model behind the search form about `common\models\Feature`.
 */
class FeatureSearch extends Feature
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['id', 'type_id', 'uom_id'], 'integer'],
            [['short_name', 'name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Feature::find();

        // add conditions that should always apply here

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
  /*      $query->andFilterWhere([
            'id' => $this->id,
            'type_id' => $this->type_id,
            'uom_id' => $this->uom_id,
        ]);
  */
        $query->andFilterWhere(['like', 'short_name', $this->short_name])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}

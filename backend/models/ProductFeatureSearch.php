<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProductFeature;

/**
 * ProductFeatureSearch represents the model behind the search form about `common\models\ProductFeature`.
 */
class ProductFeatureSearch extends ProductFeature
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'feature_id', 'product_id'], 'integer'],
            [['value_numeric'], 'number'],
            [['value_string', 'upd_date'], 'safe'],
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
        $query = ProductFeature::find();

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
        $query->andFilterWhere([
            'id' => $this->id,
            'feature_id' => $this->feature_id,
            'product_id' => $this->product_id,
            'value_numeric' => $this->value_numeric,
            'upd_date' => $this->upd_date,
        ]);

        $query->andFilterWhere(['like', 'value_string', $this->value_string]);

        return $dataProvider;
    }
}

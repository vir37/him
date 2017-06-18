<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Address;

/**
 * AddressSearch represents the model behind the search form about `common\models\Address`.
 */
class AddressSearch extends Address
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'region_id', 'index', 'apartment'], 'integer'],
            [['settlement', 'street', 'house', 'corp'], 'safe'],
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
        $query = Address::find();

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
            'region_id' => $this->region_id,
            'index' => $this->index,
            'apartment' => $this->apartment,
        ]);

        $query->andFilterWhere(['like', 'settlement', $this->settlement])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'house', $this->house])
            ->andFilterWhere(['like', 'corp', $this->corp]);

        return $dataProvider;
    }
}

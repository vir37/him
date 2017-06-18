<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Supplier;

/**
 * SupplierSearch represents the model behind the search form about `common\models\Supplier`.
 */
class SupplierSearch extends Supplier
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'jur_address_id', 'fact_address_id', 'post_address_id'], 'integer'],
            [['create_dt', 'update_dt', 'name', 'description', 'INN', 'OGRN', 'logo', 'phone', 'email', 'site', 'note'], 'safe'],
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
        $query = Supplier::find();

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
            'create_dt' => $this->create_dt,
            'update_dt' => $this->update_dt,
            'jur_address_id' => $this->jur_address_id,
            'fact_address_id' => $this->fact_address_id,
            'post_address_id' => $this->post_address_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'INN', $this->INN])
            ->andFilterWhere(['like', 'OGRN', $this->OGRN])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'site', $this->site])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}

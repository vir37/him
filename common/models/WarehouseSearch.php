<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Warehouse;

/**
 * WarehouseSearch represents the model behind the search form about `common\models\Warehouse`.
 */
class WarehouseSearch extends Warehouse
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'supplier_id', 'address_id'], 'integer'],
            [['create_dt', 'update_dt', 'work_hours', 'note'], 'safe'],
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
        $query = Warehouse::find();

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
            'supplier_id' => $this->supplier_id,
            'address_id' => $this->address_id,
        ]);

        $query->andFilterWhere(['like', 'work_hours', $this->work_hours])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}

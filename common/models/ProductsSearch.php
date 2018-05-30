<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\products;

/**
 * ProductsSearch represents the model behind the search form about `common\models\products`.
 */
class ProductsSearch extends products
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_category', 'status', 'data_3', 'CB', 'UB'], 'integer'],
            [['product_titile', 'sub_title', 'big_image', 'small_image', 'big_content', 'small_content', 'view_more_link', 'data_1', 'data_2', 'DOC', 'DOU'], 'safe'],
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
        $query = products::find();

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
            'product_category' => $this->product_category,
            'status' => $this->status,
            'data_3' => $this->data_3,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'product_titile', $this->product_titile])
            ->andFilterWhere(['like', 'sub_title', $this->sub_title])
            ->andFilterWhere(['like', 'big_image', $this->big_image])
            ->andFilterWhere(['like', 'small_image', $this->small_image])
            ->andFilterWhere(['like', 'big_content', $this->big_content])
            ->andFilterWhere(['like', 'small_content', $this->small_content])
            ->andFilterWhere(['like', 'view_more_link', $this->view_more_link])
            ->andFilterWhere(['like', 'data_1', $this->data_1])
            ->andFilterWhere(['like', 'data_2', $this->data_2]);

        return $dataProvider;
    }
}

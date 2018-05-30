<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProductCategory;

/**
 * ProductCategorySearch represents the model behind the search form about `common\models\ProductCategory`.
 */
class ProductCategorySearch extends ProductCategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'data_3', 'CB', 'UB'], 'integer'],
            [['category_name', 'big_image', 'small_image', 'big_content', 'small_content', 'data_1', 'data_2', 'DOC', 'DOU'], 'safe'],
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
        $query = ProductCategory::find();

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
            'status' => $this->status,
            'data_3' => $this->data_3,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'category_name', $this->category_name])
            ->andFilterWhere(['like', 'big_image', $this->big_image])
            ->andFilterWhere(['like', 'small_image', $this->small_image])
            ->andFilterWhere(['like', 'big_content', $this->big_content])
            ->andFilterWhere(['like', 'small_content', $this->small_content])
            ->andFilterWhere(['like', 'data_1', $this->data_1])
            ->andFilterWhere(['like', 'data_2', $this->data_2]);

        return $dataProvider;
    }
}

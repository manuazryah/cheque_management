<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Content;

/**
 * ContentSearch represents the model behind the search form about `common\models\Content`.
 */
class ContentSearch extends Content
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sort_order', 'status', 'CB', 'UB', 'field1', 'field2', 'field3'], 'integer'],
            [['content_name', 'heading', 'sub_heading', 'small_content', 'large_content', 'banner_image', 'small_image', 'large_image', 'DOC', 'DOU'], 'safe'],
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
        $query = Content::find();

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
            'sort_order' => $this->sort_order,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
            'field1' => $this->field1,
            'field2' => $this->field2,
            'field3' => $this->field3,
        ]);

        $query->andFilterWhere(['like', 'content_name', $this->content_name])
            ->andFilterWhere(['like', 'heading', $this->heading])
            ->andFilterWhere(['like', 'sub_heading', $this->sub_heading])
            ->andFilterWhere(['like', 'small_content', $this->small_content])
            ->andFilterWhere(['like', 'large_content', $this->large_content])
            ->andFilterWhere(['like', 'banner_image', $this->banner_image])
            ->andFilterWhere(['like', 'small_image', $this->small_image])
            ->andFilterWhere(['like', 'large_image', $this->large_image]);

        return $dataProvider;
    }
}

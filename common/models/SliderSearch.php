<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Slider;

/**
 * SliderSearch represents the model behind the search form about `common\models\Slider`.
 */
class SliderSearch extends Slider
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'Slider_category', 'sort_order', 'status', 'CB', 'UB', 'field1', 'field2', 'field3', 'field4'], 'integer'],
            [['image', 'caption', 'sub_caption', 'readmore_link', 'DOC', 'DOU'], 'safe'],
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
        $query = Slider::find();

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
            'Slider_category' => $this->Slider_category,
            'sort_order' => $this->sort_order,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
            'field1' => $this->field1,
            'field2' => $this->field2,
            'field3' => $this->field3,
            'field4' => $this->field4,
        ]);

        $query->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'caption', $this->caption])
            ->andFilterWhere(['like', 'sub_caption', $this->sub_caption])
            ->andFilterWhere(['like', 'readmore_link', $this->readmore_link]);

        return $dataProvider;
    }
}

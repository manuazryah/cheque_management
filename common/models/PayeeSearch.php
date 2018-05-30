<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Payee;

/**
 * PayeeSearch represents the model behind the search form about `common\models\Payee`.
 */
class PayeeSearch extends Payee
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'phone', 'status'], 'integer'],
            [['payee_name', 'city', 'email', 'pan_number', 'upload_pan_copy', 'date'], 'safe'],
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
        $query = Payee::find();

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
            'user_id' => $this->user_id,
            'phone' => $this->phone,
            'status' => $this->status,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'payee_name', $this->payee_name])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'pan_number', $this->pan_number])
            ->andFilterWhere(['like', 'upload_pan_copy', $this->upload_pan_copy]);

        return $dataProvider;
    }
}

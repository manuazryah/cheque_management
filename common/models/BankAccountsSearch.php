<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BankAccounts;

/**
 * BankAccountsSearch represents the model behind the search form about `common\models\BankAccounts`.
 */
class BankAccountsSearch extends BankAccounts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'bank_id', 'number_of_cheques', 'status'], 'integer'],
            [['bank_name', 'branch', 'city', 'account_name', 'account_number', 'cheque_series_starting_number', 'date'], 'safe'],
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
        $query = BankAccounts::find();

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
            'bank_id' => $this->bank_id,
            'number_of_cheques' => $this->number_of_cheques,
            'status' => $this->status,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'bank_name', $this->bank_name])
            ->andFilterWhere(['like', 'branch', $this->branch])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'account_name', $this->account_name])
            ->andFilterWhere(['like', 'account_number', $this->account_number])
            ->andFilterWhere(['like', 'cheque_series_starting_number', $this->cheque_series_starting_number]);

        return $dataProvider;
    }
}

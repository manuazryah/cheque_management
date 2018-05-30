<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ChequePrint;

/**
 * ChequePrintSearch represents the model behind the search form about `common\models\ChequePrint`.
 */
class ChequePrintSearch extends ChequePrint {

public $created_at_range;

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['id', 'bank_account_id', 'cheque_design_id', 'user_id', 'payee_id', 'currency_type', 'cheque_type', 'not_over_status', 'print_status'], 'integer'],
                       [['cheque_number', 'cheque_date', 'cheque_amount', 'remarks', 'cheque_amount_words', 'date', 'current_print_status'], 'safe'],
[['created_at_range'], 'safe']
                ];
        }

        /**
         * @inheritdoc
         */
        public function scenarios() {
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
    public function search($params) {
               //		$query = ChequePrint::find()->orderBy([
//		    'date' => SORT_DESC,
//		]);
$query = ChequePrint::find();

                // add conditions that should always apply here

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
'sort' => ['attributes' => ['id', 'bank_account_id', 'cheque_date', 'cheque_number', 'payee_id', 'cheque_amount']],
                ]);

                $this->load($params);

                if (!$this->validate()) {
                        // uncomment the following line if you do not want to return any records when validation fails
                        // $query->where('0=1');
                        return $dataProvider;
                }

if (!empty($this->created_at_range) && strpos($this->created_at_range, '-') !== false) {
			list($start_date, $end_date) = explode(' - ', $this->created_at_range);

			$query->andFilterWhere(['between', 'date(cheque_print.cheque_date)', $start_date, $end_date]);
			$this->created_at_range = "";
		}

                // grid filtering conditions
                $query->andFilterWhere([
                    'id' => $this->id,
                    'bank_account_id' => $this->bank_account_id,
                    'cheque_design_id' => $this->cheque_design_id,
                    'user_id' => $this->user_id,
                   // 'cheque_date' => $this->cheque_date,
                    'cheque_date_hyphen' => $this->cheque_date_hyphen,
                    'payee_id' => $this->payee_id,
                    'currency_type' => $this->currency_type,
                    'date' => $this->date,
                    'cheque_type' => $this->cheque_type,
                    'not_over_status' => $this->not_over_status,
                    'print_status' => $this->print_status,
                    'current_print_status' => $this->current_print_status,
                ]);

                $query->andFilterWhere(['like', 'cheque_number', $this->cheque_number])
                        ->andFilterWhere(['like', 'cheque_amount', $this->cheque_amount])
                        ->andFilterWhere(['like', 'cheque_amount_words', $this->cheque_amount_words])
                        ->andFilterWhere(['like', 'cheque_type', $this->cheque_type])
 ->andFilterWhere(['like', 'remarks', $this->remarks]);

                return $dataProvider;
        }

}

<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ChequeDesigns;

/**
 * ChequeDesignsSearch represents the model behind the search form about `common\models\ChequeDesigns`.
 */
class ChequeDesignsSearch extends ChequeDesigns {

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['id', 'user_id', 'bank_accounts_id', 'status'], 'integer'],
			[['cheque_image', 'cheque_date', 'name', 'rupee_word', 'rupee_num', 'acc_num', 'bearer', 'field_7', 'date'], 'safe'],
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
		$query = ChequeDesigns::find();

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
		    'bank_accounts_id' => $this->bank_accounts_id,
		    'date' => $this->date,
		    'status' => $this->status,
		]);

		$query->andFilterWhere(['like', 'cheque_image', $this->cheque_image])
			->andFilterWhere(['like', 'cheque_date', $this->cheque_date])
			->andFilterWhere(['like', 'name', $this->name])
			->andFilterWhere(['like', 'rupee_word', $this->rupee_word])
			->andFilterWhere(['like', 'rupee_num', $this->rupee_num])
			->andFilterWhere(['like', 'acc_num', $this->acc_num])
			->andFilterWhere(['like', 'bearer', $this->bearer])
			->andFilterWhere(['like', 'field_7', $this->field_7]);

		return $dataProvider;
	}

}

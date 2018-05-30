<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MasterBank;

/**
 * MasterBankSearch represents the model behind the search form about `common\models\MasterBank`.
 */
class MasterBankSearch extends MasterBank {

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['id', 'country_id', 'status', 'CB', 'UB'], 'integer'],
			[['bank_name', 'design', 'DOC', 'DOU'], 'safe'],
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
		$query = MasterBank::find();

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
		    'country_id' => $this->country_id,
		    'status' => $this->status,
		    'CB' => $this->CB,
		    'UB' => $this->UB,
		    'DOC' => $this->DOC,
		    'DOU' => $this->DOU,
		]);

		$query->andFilterWhere(['like', 'bank_name', $this->bank_name])
			->andFilterWhere(['like', 'country_id', $this->country_id])
			->andFilterWhere(['like', 'design', $this->design]);

		return $dataProvider;
	}

}

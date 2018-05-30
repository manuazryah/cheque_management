<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserPlans;

/**
 * UserPlansSearch represents the model behind the search form about `common\models\UserPlans`.
 */
class UserPlansSearch extends UserPlans {

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['id', 'user_id', 'plan_id', 'valid_days', 'status', 'CB', 'UB'], 'integer'],
                        [['plan_name', 'amount', 'date', 'DOC', 'DOU'], 'safe'],
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
                $query = UserPlans::find()->orderBy(['id' => SORT_DESC]);

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
                    'plan_id' => $this->plan_id,
                    'valid_days' => $this->valid_days,
                    'date' => $this->date,
                    'status' => $this->status,
                    'CB' => $this->CB,
                    'UB' => $this->UB,
                    'DOC' => $this->DOC,
                    'DOU' => $this->DOU,
                ]);

                $query->andFilterWhere(['like', 'plan_name', $this->plan_name])
                        ->andFilterWhere(['like', 'amount', $this->amount]);

                return $dataProvider;
        }

}

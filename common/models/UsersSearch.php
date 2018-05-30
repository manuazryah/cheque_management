<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Users;

/**
 * UsersSearch represents the model behind the search form about `common\models\Users`.
 */
class UsersSearch extends Users {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'plan', 'status', 'CB', 'UB'], 'integer'],
            [['company_name', 'owners_name', 'email_id', 'password', 'address', 'country', 'last_login', 'state', 'city', 'mobile', 'plan_end_date', 'app_id', 'DOC', 'DOU','remarks'], 'safe'],
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
        $query = Users::find()->orderBy(['id' => SORT_DESC]);

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
            'plan' => $this->plan,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'company_name', $this->company_name])
                ->andFilterWhere(['like', 'owners_name', $this->owners_name])
                ->andFilterWhere(['like', 'email_id', $this->email_id])
                ->andFilterWhere(['like', 'password', $this->password])
->andFilterWhere(['like', 'app_id', $this->app_id])
                ->andFilterWhere(['like', 'address', $this->address])
                ->andFilterWhere(['like', 'country', $this->country])
                ->andFilterWhere(['like', 'state', $this->state])
                ->andFilterWhere(['like', 'city', $this->city])
                ->andFilterWhere(['like', 'mobile', $this->mobile])
                ->andFilterWhere(['like', 'plan_end_date', $this->plan_end_date]);

        return $dataProvider;
    }

}

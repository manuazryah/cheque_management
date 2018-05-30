<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MasterChequeDesign;

/**
 * MasterChequeDesignSearch represents the model behind the search form about `common\models\MasterChequeDesign`.
 */
class MasterChequeDesignSearch extends MasterChequeDesign
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'master_bank_id', 'status', 'CB', 'UB'], 'integer'],
            [['cheque_image', 'cheque_datas', 'date', 'DOC', 'DOU'], 'safe'],
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
        $query = MasterChequeDesign::find();

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
            'master_bank_id' => $this->master_bank_id,
            'date' => $this->date,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'cheque_image', $this->cheque_image])
            ->andFilterWhere(['like', 'cheque_datas', $this->cheque_datas]);

        return $dataProvider;
    }
}

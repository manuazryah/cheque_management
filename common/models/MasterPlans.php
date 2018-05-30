<?php

namespace common\models;

use Yii;
use common\models\Employee;

/**
 * This is the model class for table "master_plans".
 *
 * @property integer $id
 * @property string $plan_name
 * @property integer $valid_days
 * @property string $amount
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class MasterPlans extends \yii\db\ActiveRecord {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'master_plans';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['plan_name', 'valid_days', 'amount', 'status'], 'required', 'on' => 'create'],
			[['valid_days', 'status', 'CB', 'UB'], 'integer'],
			[['DOC', 'DOU'], 'safe'],
			[['plan_name'], 'string', 'max' => 50],
			[['amount'], 'string', 'max' => 100],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
		    'id' => 'ID',
		    'plan_name' => 'Plan Name',
		    'valid_days' => 'Valid Days',
		    'amount' => 'Amount',
		    'status' => 'Status',
		    'CB' => 'Cb',
		    'UB' => 'Ub',
		    'DOC' => 'Doc',
		    'DOU' => 'Dou',
		];
	}

	public function getCreator() {
		return $this->hasOne(Employee::className(), ['id' => 'CB']);
	}

	public function getUpdatedby() {
		return $this->hasOne(Employee::className(), ['id' => 'UB']);
	}

}

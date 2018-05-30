<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_plans".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $plan_id
 * @property integer $plan_name
 * @property integer $valid_days
 * @property string $amount
 * @property string $date
 */
class UserPlans extends \yii\db\ActiveRecord {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'user_plans';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['plan_id', 'plan_name', 'valid_days', 'amount'], 'required'],
			[['plan_id', 'valid_days'], 'integer'],
			[['date'], 'safe'],
			[['amount'], 'string', 'max' => 100],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
		    'id' => 'ID',
		    'user_id' => 'User ID',
		    'plan_id' => 'Plan ID',
		    'plan_name' => 'Plan Name',
		    'valid_days' => 'Valid Days',
		    'amount' => 'Amount',
		    'date' => 'Date',
		];
	}

}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_plans".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $plan_name
 * @property integer $plan_id
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
                        [['valid_days', 'amount', 'date'], 'required'],
                        [['user_id', 'plan_id', 'valid_days', 'status', 'CB', 'UB'], 'integer'],
                        [['date', 'DOC', 'DOU', 'plan_end_date'], 'safe'],
                        [['plan_name', 'amount'], 'string', 'max' => 100],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'user_id' => 'User ID',
                    'plan_name' => 'Plan Name',
                    'plan_id' => 'Plan ID',
                    'valid_days' => 'Valid Days',
                    'amount' => 'Amount',
                    'date' => 'Date',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }
public function getUsername() {

		return $this->hasOne(Users::className(), ['id' => 'user_id']);
	}

}

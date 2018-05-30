<?php

namespace common\models;

use common\models\BankAccounts;
use Yii;

/**
 * This is the model class for table "cheques".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $bank_id
 * @property string $cheque_series_starting_number
 * @property integer $number_of_cheques
 * @property integer $cheques_left
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class Cheques extends \yii\db\ActiveRecord {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'cheques';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['bank_id', 'cheque_series_starting_number', 'number_of_cheques', 'status'], 'required'],
			[['bank_id', 'number_of_cheques', 'cheques_left', 'status', 'CB', 'UB'], 'integer'],
			[['DOC', 'DOU'], 'safe'],
			[['cheque_series_starting_number'], 'string', 'max' => 100],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
		    'id' => 'ID',
		    'user_id' => 'User ID',
		    'bank_id' => 'Bank ID',
		    'cheque_series_starting_number' => 'Cheque Series Starting Number',
		    'number_of_cheques' => 'Number Of Cheques',
		    'cheques_left' => 'Cheques Left',
		    'status' => 'Status',
		    'CB' => 'Cb',
		    'UB' => 'Ub',
		    'DOC' => 'Doc',
		    'DOU' => 'Dou',
		];
	}

	public function getbank() {
		return $this->hasOne(BankAccounts::className(), ['id' => 'bank_id']);
	}

}

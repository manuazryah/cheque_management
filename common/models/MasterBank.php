<?php

namespace common\models;

use Yii;
use common\models\Employee;
use common\models\Country;

/**
 * This is the model class for table "master_bank".
 *
 * @property integer $id
 * @property string $bank_name
 * @property string $country_id
 * @property string $design
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class MasterBank extends \yii\db\ActiveRecord {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'master_bank';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['bank_name', 'country_id'], 'required', 'on' => 'create'],
			[['country_id', 'status', 'CB', 'UB'], 'integer'],
			[['DOC', 'DOU'], 'safe'],
			[['bank_name'], 'string', 'max' => 100],
			[['design'], 'string', 'max' => 50],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
		    'id' => 'ID',
		    'bank_name' => 'Bank Name',
		    'design' => 'Design',
		    'country_id' => 'Country',
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

	public function getCountry() {
		return $this->hasOne(Country::className(), ['id' => 'country_id']);
	}

}

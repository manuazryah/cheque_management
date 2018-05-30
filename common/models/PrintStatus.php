<?php

namespace common\models;

use Yii;
use common\models\Employee;

/**
 * This is the model class for table "print_status".
 *
 * @property integer $id
 * @property string $status
 * @property string $status_name
 * @property integer $CB
 * @property integer $UB
 * @property integer $DOC
 * @property string $DOU
 */
class PrintStatus extends \yii\db\ActiveRecord {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'print_status';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['status_name'], 'required'],
//			[['CB', 'UB', 'DOC'], 'integer'],
//			[['DOU'], 'safe'],
//			[['status', 'field_1'], 'string', 'max' => 100],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
		    'id' => 'ID',
		    'status_name' => 'Status Name',
		    'status' => 'Status',
		    'CB' => 'Cb',
		    'UB' => 'Ub',
		    'DOC' => 'Doc',
		    'DOU' => 'Dou',
		];
	}

	public function getCreator() {
		return $this->hasOne(Users::className(), ['id' => 'CB']);
	}

	public function getUpdatedby() {
		return $this->hasOne(Users::className(), ['id' => 'UB']);
	}

}

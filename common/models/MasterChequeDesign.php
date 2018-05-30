<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "master_cheque_design".
 *
 * @property integer $id
 * @property integer $master_bank_id
 * @property string $cheque_image
 * @property string $cheque_datas
 * @property string $date
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class MasterChequeDesign extends \yii\db\ActiveRecord {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'master_cheque_design';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['master_bank_id', 'cheque_image', 'cheque_datas', 'date', 'status'], 'required'],
			[['master_bank_id', 'status', 'CB', 'UB'], 'integer'],
			[['master_bank_id'], 'unique'],
			[['cheque_datas'], 'string'],
			[['date', 'DOC', 'DOU'], 'safe'],
			[['cheque_image'], 'string', 'max' => 100],
[['cheque_image'], 'file', 'extensions' => 'jpg, gif, png'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
		    'id' => 'ID',
		    'master_bank_id' => 'Master Bank ID',
		    'cheque_image' => 'Cheque Image',
		    'cheque_datas' => 'Cheque Datas',
		    'date' => 'Date',
		    'status' => 'Status',
		    'CB' => 'Cb',
		    'UB' => 'Ub',
		    'DOC' => 'Doc',
		    'DOU' => 'Dou',
		];
	}

	public function getMasterBank() {
		return $this->hasOne(MasterBank::className(), ['id' => 'master_bank_id']);
	}

}

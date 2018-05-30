<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property integer $id
 * @property string $country_name
 * @property string $currency_code
 * @property integer $status
 * @property string $value
 * @property string $decimal_value
 * @property integer $format
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class Country extends \yii\db\ActiveRecord {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'country';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['country_name', 'status', 'value', 'decimal_value', 'currency_code', 'format'], 'required'],
			[['status', 'format', 'CB', 'UB'], 'integer'],
			[['DOC', 'DOU'], 'safe'],
			[['country_name'], 'string', 'max' => 100],
			[['value'], 'string', 'max' => 50],
			[['decimal_value'], 'string', 'max' => 11],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
		    'id' => 'ID',
		    'country_name' => 'Country Name',
		    'currency_code' => 'Currency Code',
		    'status' => 'Status',
		    'value' => 'Value',
		    'decimal_value' => 'Decimal Value',
		    'format' => 'Format',
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

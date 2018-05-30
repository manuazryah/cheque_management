<?php

namespace common\models;

use Yii;
use common\models\MasterBank;

/**
 * This is the model class for table "bank_accounts".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $bank_id
 * @property string $bank_name
 * @property string $branch
 * @property string $city
 * @property string $account_name
 * @property string $account_number
 * @property string $cheque_series_starting_number
 * @property integer $number_of_cheques
 * @property integer $status
 * @property string $date
 */
class BankAccounts extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'bank_accounts';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                       [['bank_id', 'country_id', 'account_name', 'account_number', 'cheque_series_starting_number', 'number_of_cheques', 'bank_name'], 'required', 'on' => 'create'],
                        [['country_id'], 'integer'],
                        [['cheque_series_starting_number'], 'integer'],
                    //[['date'], 'safe'],
                    [['branch', 'account_name', 'account_number'], 'string', 'max' => 100],
                        [['city'], 'string', 'max' => 50],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'user_id' => 'User ID',
                    'bank_id' => 'Bank',
                    'bank_name' => 'Bank Name',
                    'branch' => 'Branch',
                    'city' => 'City',
                    'account_name' => 'Account Name',
                    'account_number' => 'Account Number',
                    'cheque_series_starting_number' => 'Cheque Series Starting Number',
                    'number_of_cheques' => 'Number Of Cheques',
                    'status' => 'Status',
                    'date' => 'Date',
                ];
        }

        public function getBanks() {
                return $this->hasOne(MasterBank::className(), ['id' => 'bank_id']);
        }

}

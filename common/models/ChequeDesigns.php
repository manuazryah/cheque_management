<?php

namespace common\models;

use Yii;
use common\models\BankAccounts;

/**
 * This is the model class for table "cheque_designs".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $bank_accounts_id
 * @property string $cheque_image
 * @property string $cheque_date_hyphen
 * @property string $name
 * @property string $rupee_word
 * @property string $rupee_num
 * @property string $acc_num
 * @property string $bearer
 * @property string $field_7
 * @property string $date
 * @property integer $status
 */
class ChequeDesigns extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'cheque_designs';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['user_id', 'cheque_image', 'date', 'status'], 'required', 'on' => 'create'],
//                        [['bank_accounts_id'], 'unique', 'message' => 'Bank already used'],
                    [['user_id', 'bank_accounts_id', 'status'], 'integer'],
                        //[['date'], 'safe'],
[['cheque_image'], 'required', 'on' => 'updatecheque'],
			[['cheque_image'], 'file', 'extensions' => 'jpg, png'],
                        //[['cheque_image', 'field_1', 'field_2', 'field_3', 'field_4', 'field_5', 'field_6', 'field_7'], 'string', 'max' => 100],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'user_id' => 'User ID',
                    'bank_accounts_id' => 'Bank Name',
                    'cheque_image' => 'Cheque Image',
                    'cheque_date_hyphen' => 'Cheque Date Hyphen',
                    'name' => 'Name',
                    'rupee_word' => 'Rupee Word',
                    'rupee_num' => 'Rupee Num',
                    'acc_num' => 'Acc Num',
                    'bearer' => 'Bearer',
                    'field_7' => 'Field 7',
                    'date' => 'Date',
                    'status' => 'Status',
                ];
        }

        public function getBank() {
                return $this->hasOne(BankAccounts::className(), ['id' => 'bank_accounts_id']);
        }

}

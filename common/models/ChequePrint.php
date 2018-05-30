<?php

namespace common\models;

use Yii;
use common\models\BankAccounts;
use common\models\PrintStatus;

/**
 * This is the model class for table "cheque_print".
 *
 * @property integer $id
 * @property integer $bank_account_id
 * @property integer $cheque_design_id
 * @property integer $user_id
 * @property string $cheque_number
 * @property string $cheque_book_id
 * @property string $cheque_date
 * @property string $cheque_date_hyphen
 * @property integer $payee_id
 * @property integer $currency_type
* @property integer $currency
 * @property string $cheque_amount
 * @property string $cheque_amount_words
 * @property string $date
 * @property integer $cheque_type
 * @property integer $ot_over_status
 * @property integer $print_status
 * @property integer $remarks
 * @property integer $no_of_emi_cheques
 * @property integer $cheque_position
 * @property integer $print_type
 */
class ChequePrint extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'cheque_print';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['bank_account_id', 'cheque_design_id', 'user_id', 'cheque_number', 'cheque_date', 'payee_id', 'currency_type', 'cheque_amount'], 'required'],
            // [['bank_account_id', 'cheque_design_id', 'user_id', 'payee_id', 'currency_type', 'field_1', 'field_2', 'field_3', 'field_4'], 'integer'],
            [['decrement_check_status', 'current_print_status', 'print_status'], 'safe'],
                //[['cheque_number', 'cheque_amount'], 'string', 'max' => 100],
//                    [['cheque_number'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'bank_account_id' => 'Bank Account',
            'cheque_design_id' => 'Cheque Design ID',
            'user_id' => 'User ID',
            'cheque_number' => 'Cheque Number',
            'cheque_book_id' => 'Cheque Book ID',
            'cheque_date' => 'Cheque Date',
            'cheque_date_hyphen' => 'Cheque Date Hyphen',
            'payee_id' => 'Payee',
            'currency_type' => 'Currency Type',
'currency' => 'Currency',
            'cheque_amount' => 'Cheque Amount',
            'cheque_amount_words' => 'Cheque Amount Words',
            'date' => 'Date',
            'cheque_type' => 'Cheque Type',
            'not_over_status' => 'ADD NOT OVER THAN',
            'print_status' => 'Status',
            'remarks' => 'Remarks',
            'no_of_emi_cheques' => 'No Of EMI Cheques',
            'current_print_status' => 'Cheque Status',
            'cheque_position' => 'Cheque Position',
            'print_type' => 'Cheque Print Type',
        ];
    }

    public function getPayee() {
        return $this->hasOne(Payee::className(), ['id' => 'payee_id']);
    }

    public function getBank() {
        return $this->hasOne(BankAccounts::className(), ['id' => 'bank_account_id']);
    }

    public function getStatus() {
        return $this->hasOne(PrintStatus::className(), ['id' => 'print_status']);
    }
public function getUsername() {

		return $this->hasOne(Users::className(), ['id' => 'user_id']);
	}

}

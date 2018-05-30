<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "emi_cheques".
 *
 * @property integer $id
 * @property integer $cheque_print_id
 * @property integer $user_id
 * @property string $cheuqe_date
 * @property string $cheque_amount
 * @property string $cheque_num
 * @property integer $status
 * @property string $date
 */
class EmiCheques extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'emi_cheques';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            // [['id', 'cheque_print_id', 'user_id', 'cheuqe_date', 'cheque_amount', 'cheque_num', 'status', 'date'], 'required'],
            [['id', 'cheque_print_id', 'user_id', 'status'], 'integer'],
            [['cheuqe_date'], 'safe'],
            [['cheque_amount', 'cheque_num', 'date'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'cheque_print_id' => 'Cheque Print ID',
            'user_id' => 'User ID',
            'cheuqe_date' => 'Cheuqe Date',
            'cheque_amount' => 'Cheque Amount',
            'cheque_num' => 'Cheque Num',
            'status' => 'Status',
            'date' => 'Date',
        ];
    }

}

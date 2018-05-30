<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "payee".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $payee_name
 * @property string $city
 * @property integer $phone
 * @property string $email
 * @property string $pan_number
 * @property string $upload_pan_copy
 * @property integer $status
 * @property string $date
 */
class Payee extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'payee';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                       [['payee_name'], 'required', 'on' => 'create'],
                        [['user_id', 'phone', 'status'], 'integer'],
                        [['date'], 'safe'],
                        [['email'], 'email'],
                        [['payee_name'], 'string', 'max' => 50],
                        [['city', 'email', 'upload_pan_copy'], 'string', 'max' => 100],
                        [['pan_number'], 'string', 'max' => 1000],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'user_id' => 'User ID',
                    'payee_name' => 'Payee Name',
                    'city' => 'City',
                    'phone' => 'Phone',
                    'email' => 'Email',
                    'pan_number' => 'Pan Number',
                    'upload_pan_copy' => 'Upload Pan Copy',
                    'status' => 'Status',
                    'date' => 'Date',
                ];
        }

}

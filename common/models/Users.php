<?php

namespace common\models;

use Yii;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $company_name
 * @property string $owners_name
 * @property string $email_id
 * @property string $password
 * @property string $app_id
 * @property string $address
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $mobile
 * @property integer $plan
 * @property integer $status
 * @property integer $last_login
 * @property string $plan_end_date
 * @property string $email_verification
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class Users extends ActiveRecord implements IdentityInterface {

        private $_user;
        public $rememberMe = true;
        public $created_at;
        public $updated_at;

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'users';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['company_name', 'email_id', 'password', 'mobile','country'], 'required', 'on' => 'create'],
                        [['email_id', 'password'], 'required', 'on' => 'login'],
                        [['address'], 'string'],
                        [['email_id'], 'email'],
                        [['email_id'], 'unique', 'on' => 'create'],
                        [['status', 'email_verification', 'CB', 'UB'], 'integer'],
                        [['DOC', 'DOU', 'plan','remarks'], 'safe'],
                        [['company_name', 'owners_name'], 'string', 'max' => 30],
                        [['email_id'], 'string', 'max' => 100],
                        [['password'], 'string', 'max' => 300],
                        [['country', 'state', 'city'], 'string', 'max' => 20],
                        [['mobile'], 'string', 'max' => 15],
                        // [['password'], 'validatePassword', 'on' => 'login'],
                ];
        }

        public function validatePassword($attribute, $params) {
                if (!$this->hasErrors()) {
                        $user = $this->getUser();
//			$password = Yii::$app->security->generatePasswordHash($this->password);
                        if (!$user || !Yii::$app->security->validatePassword($this->password, $user->password)) {
                                $this->addError($attribute, 'Incorrect username or password.');
                        }
                }
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'company_name' => 'Name',
                    'owners_name' => 'Owners Name',
                    'email_id' => 'Email ID',
                    'password' => 'Password',
'app_id' => 'App Id',
                    'address' => 'Address',
                    'country' => 'Country',
                    'state' => 'State',
                    'city' => 'City',
                    'mobile' => 'Mobile',
                    'plan' => 'Plan',
                    'remarks' => 'Remarks',
                    'status' => 'Status',
                    'last_login' => 'Last Login',
                    'plan_end_date' => 'Plan Expired On',
                    'email_verification' => 'Email verification',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

        public function getPlans() {

                return $this->hasOne(MasterPlans::className(), ['id' => 'plan']);
        }

        public function login() {
                if ($this->validate()) {
                        return Yii::$app->user->login($this->getUser(), /* $this->rememberMe ? 3600 * 24 * 30 : */ 0);
                } else {
                        return false;
                }
        }

        protected function getUser() {

                if ($this->_user === null) {

                        $this->_user = static::find()->where('email_id = :email_id and status = :stat', ['email_id' => $this->email_id, 'stat' => '1'])->one();
                }

                return $this->_user;
        }

        public function validatedata($data) {

                if ($data == '') {
                        $this->addError('password', 'Incorrect username or password');
                        return true;
                }
        }

        /**
         * Finds user by username
         *
         * @param string $username
         * @return static|null
         */
        public static function findByUsername($username) {
                return static::findOne(['email_id' => $username, 'status' => 1]);
        }

        /**
         * @inheritdoc
         */
        public static function findIdentity($id) {
                return static::findOne(['id' => $id, 'status' => 1]);
        }

        /**
         * @inheritdoc
         */
        public static function findIdentityByAccessToken($token, $type = null) {
                throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
        }

        public function getId() {
                return $this->getPrimaryKey();
        }

        /**
         * @inheritdoc
         */
        public function getAuthKey() {
                return $this->auth_key;
        }

        /**
         * @inheritdoc
         */
        public function validateAuthKey($authKey) {
                return $this->getAuthKey() === $authKey;
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getPost() {
                return $this->hasOne(AdminPosts::className(), ['id' => 'post_id']);
        }
public function getCountries() {
		return $this->hasOne(Country::className(), ['id' => 'country']);
	}

}

<?php

namespace frontend\controllers;

use yii\rest\ActiveController;
use common\models\Users;
use common\models\ChequePrint;
use common\models\BankAccounts;
use common\models\Payee;
use common\models\Country;

class ApiController extends ActiveController {

	public $modelClass = 'common\models\Users';

	public function actionLogin() {
		//return Users::findOne($_POST['id']);
		$model = Users::find()->where(['email_id' => $_POST['emailid'], 'password' => $_POST['password']])->one();
		if (!empty($model)) {
			$encrypted_id = $this->encryptor("encrypt", $model->id);
			//$cheque_details = $this->chequedetails($model->id, 1);
			$return_data = ['status' => 1, 'session_key' => $encrypted_id, 'name' => $model->company_name];
			//$return_data['cheque_details'] = $cheque_details;
		} else {
			$return_data = ['status' => 0, 'error_message' => 'Invalid Username Or Password'];
		}
		return $return_data;
	}

	public function actionReports($session_key, $page) {
		$user_id = $this->encryptor('decrypt', $session_key);

		$data = $this->chequedetails($user_id, $page);
		return $data;
	}

	public function actionReportsByStatus($session_key, $page, $status) {
		$user_id = $this->encryptor('decrypt', $session_key);
		$data = $this->chequedetails($user_id, $page, $status);
		return $data;
	}

	public function actionStatus($session_key, $status, $reports_id) {
		$user_id = $this->encryptor('decrypt', $session_key);
		$cheque_data = ChequePrint::find()->where(['user_id' => $user_id, 'id' => $reports_id])->one();
		if (!empty($cheque_data)) {
			$cheque_data->print_status = $status;
			$cheque_data->update();
			$data = ['status' => 1, 'success_message' => 'Status Updated Suceessfully'];
//			$data[] = ['id' => $cheque_data->id, 'bank_name' => $cheque_data->bank->bank_name, 'cheque_number' => $cheque_data->cheque_number, 'cheque_date' => $cheque_data->cheque_date,
//			    'payee_name' => $cheque_data->payee->payee_name, 'status' => $cheque_data->print_status];
		} else {
			$data = ['status' => 0, 'error_message' => 'Inavlid Data Entered'];
		}
		return $data;
	}
public function actionReportCount($session_key, $type) {
		$user_id = $this->encryptor('decrypt', $session_key);
		$data = $this->cheques($user_id, $type);
		return $data;
	}

public function actionDetailedView($session_key, $data_id) {
		$user_id = $this->encryptor('decrypt', $session_key);
		$data = $this->Details($user_id, $data_id);
		return $data;
	}

/*
	 * in order to save app id users table
	 */

	public function actionSaveAppId($app_id, $session_key) {
		$user_id = $this->encryptor('decrypt', $session_key);
		$user_model = Users::find()->where(['id' => $user_id])->one();
		if (!empty($user_model)) {
			$user_model->app_id = $app_id;
			$user_model->update();
			$return_data = ['status' => 1, 'success_message' => 'Successfully updated'];
		} else {
			$return_data = ['status' => 0, 'error_message' => 'No valid user'];
		}
		return $return_data;
	}


	public function encryptor($action, $string) {
		$output = false;

		$encrypt_method = "AES-256-CBC";
		//pls set your unique hashing key
		$secret_key = 'cheque';
		$secret_iv = 'cheque123';

		// hash
		$key = hash('sha256', $secret_key);

		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);

		//do the encyption given text/string/number
		if ($action == 'encrypt') {
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		} else if ($action == 'decrypt') {
			//decrypt the given text/string/number
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}

		return $output;
	}

	public function chequedetails($user_id, $page, $status = null) {

		$offset = (($page - 1) * 20) + 0;
		if (!empty($status)) {
			$printed_cheques = ChequePrint::find()->where(['user_id' => $user_id, 'print_status' => $status])->orderBy('cheque_date ASC')->limit(20)->offset($offset)->all();
			//$count = count($printed_cheques);
		} else {
			$printed_cheques_outstanding = ChequePrint::find()->where(['user_id' => $user_id, 'print_status' => '3'])->orderBy('cheque_date ASC')->limit(20)->offset($offset)->all();
			$printed_cheques_upcoming = ChequePrint::find()->where(['user_id' => $user_id, 'print_status' => '2'])->orderBy('cheque_date ASC')->limit(20)->offset($offset)->all();
			$printed_cheques = array_merge($printed_cheques_outstanding, $printed_cheques_upcoming);
		}
		if (!empty($printed_cheques)) {
			foreach ($printed_cheques as $cheques) {
				$bank_details = BankAccounts::find()->where(['id' => $cheques->bank_account_id])->one();
				$payee_details = Payee::find()->where(['id' => $cheques->payee_id])->one();

if(empty($cheques->currency)){
					$currency = Country::find()->where(['id' => $cheques->currency_type])->one();
				}else{
					$currency = Country::find()->where(['id' => $cheques->currency])->one();
				}

				$date = $this->CheckDate($cheques);
$formated_amount =  number_format($cheques->cheque_amount, 2, '.', ',');

				$data[] = ['id' => $cheques->id, 'bank_name' => $bank_details->bank_name, 'cheque_number' => $cheques->cheque_number, 'cheque_date' => $cheques->cheque_date,
				    'payee_name' => $payee_details->payee_name, 'print_status' => $cheques->print_status, 'cheque_amount' => $formated_amount , 'currency_type' => $currency->currency_code, 'date' => $date];
			}
		} else {
			$data = ['status' => 0, 'error_message' => 'No Result Found'];
		}
		return $data;
	}

	public function CheckDate($cheques) {
		if ($cheques->print_status == 1 || $cheques->print_status == 2) {
			$now = time(); // or your date as well

			$your_date = strtotime($cheques->cheque_date);

			if ($your_date > $now)
				$datediff = $your_date - $now;
			else
				$datediff = $now - $your_date;

			$diff = floor($datediff / (60 * 60 * 24));
			if (date('Y-m-d') == $cheques->cheque_date)
				return 'Due On : Today';
			else {
				return 'Due in ' . $diff . ' Days';
			}
		} elseif ($cheques->print_status == 3) {
			return 'Submitted on ' . $cheques->cheque_date;
		} elseif ($cheques->print_status == 4) {
			return 'Cancelled';
		} elseif ($cheques->print_status == 5) {
			return 'Cleared on ' . $cheques->cheque_date;
		}
	}
public function Cheques($user_id, $status) {
		$printed_cheques = ChequePrint::find()->where(['user_id' => $user_id, 'print_status' => $status])->all();

		if (!empty($printed_cheques)) {
			$data = $printed_cheques;
return count($data);
		} else {
			$data = ['status' => 0, 'error_message' => 'No Result Found'];
return $data;
		}
		
	}
public function Details($user_id, $data_id) {
		$cheque_details = ChequePrint::find()->where(['user_id' => $user_id, 'id' => $data_id])->one();

		$payee_details = Payee::find()->where(['id' => $cheque_details->payee_id])->one();
		if (empty($cheque_details->currency)) {
			$currency = Country::find()->where(['id' => $cheque_details->currency_type])->one();
		} else {
			$currency = Country::find()->where(['id' => $cheque_details->currency])->one();
		}
		$formated_amount = number_format($cheque_details->cheque_amount, 2, '.', ',');
		if (!empty($cheque_details)) {
			$data[] = ['date' => $cheque_details->cheque_date, 'cheque_no' => $cheque_details->cheque_number, 'payee_name' => $payee_details->payee_name
			    , 'cheque_amount' => $formated_amount, 'currency_type' => $currency->currency_code, 'remarks' => $cheque_details->remarks, 'print_status' => $cheque_details->print_status];
		} else {
			$data = ['status' => 0, 'error_message' => 'No Result Found'];
		}

		return $data;

}
}

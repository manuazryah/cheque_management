<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\db\Expression;

/**
 * ExpensesController implements the CRUD actions for Expenses model.
 */
class TestController extends Controller {

	public function actionIndex() {
		$today_date_time = date('Y-m-d H:i:s');
		$today = date("Y-m-d");
		$today_day = date("l");
		$today_date = date("j");

		/*
		 * Ever Day
		 */
		$qArray = ['1', '2', '3'];
		$printed_cheques = \common\models\ChequePrint::find()->where(['print_status' => $qArray])->all();

		foreach ($printed_cheques as $cheque) {
			$c_date = $cheque->cheque_date;
			$date = $today;
			if ($c_date > $date) {
				$now = time(); // or your date as well
				$your_date = strtotime($c_date);
				$datediff = $your_date - $now;
				$diff = floor($datediff / (60 * 60 * 24));
				if ($diff > 2) {
					$cheque->print_status = 1; //1->'post dated'
				} else {
					$cheque->print_status = 2; // 2->'upcoming'
				}
			} else {
				if ($c_date == $date) {
					$cheque->print_status = 2; // 2->'upcoming'
				} else {
					$cheque->print_status = 3; // 3->'Overdue'
				}
			}
			$cheque->save();
			
		}
	}

}

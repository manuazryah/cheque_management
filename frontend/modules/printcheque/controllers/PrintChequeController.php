<?php

namespace frontend\modules\printcheque\controllers;

use common\models\ChequeDesigns;
use common\models\Cheques;
use common\models\Country;
use common\models\ChequePrint;
use common\models\ChequePrintSearch;
use Yii;
use common\models\BankAccounts;
use arturoliveira\ExcelView;
use kartik\export\ExportMenu;

class PrintChequeController extends \yii\web\Controller {

    public $layout = '@app/views/layouts/dashboard';
    public $enableCsrfValidation = false;

    public function beforeAction($action) {
        if (!parent::beforeAction($action)) {
            return false;
        }
        $useragent = $_SERVER['HTTP_USER_AGENT'];
        if (preg_match('/android|avantgo|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
            echo 'Kindly Download Mobile Application';
            exit;
        }

        if (empty(Yii::$app->session['user_session']) || Yii::$app->session['user_session'] == NULL) {
            $this->redirect(['/site/login']);
            return false;
        }

        return true;
    }

    public function actionIndex($id) {
 
        $model = ChequeDesigns::find()->where(['bank_accounts_id' => $id])->one();

        if (empty($model)) {
            Yii::$app->session['message'] = 1;
            return $this->redirect(['/dashboard/new-design', 'id' => $id]);
        } elseif ($model->status == 1) {
            Yii::$app->session['message'] = 2;
            return $this->redirect(['/dashboard/set-design', 'id' => $id]);
        } elseif ($model->status == 2) {
            Yii::$app->session['message'] = 3;
            return $this->redirect(['/dashboard/check-design', 'id' => $id]);
        } elseif ($model->status == 3) {

            return $this->redirect(['/dashboard/print-cheque', 'id' => $id]);
        }
    }

    public function actionRePrint($id) {

        $print_dats = ChequePrint::find()->where(['id' => $id])->one();

        $design = ChequeDesigns::find()->where(['id' => $print_dats->cheque_design_id])->one();
        $originalDate = $print_dats->cheque_date;
        if ($print_dats->cheque_date_hyphen == 1) {
            $newDate = date("d-m-Y", strtotime($originalDate));
        } else {
            $newDate = date("dmY", strtotime($originalDate));
        }
        $amount_number = '****' . number_format($print_dats->cheque_amount, 2);
        echo $this->renderPartial('new_print', ['print_dats' => $print_dats, 'design' => $design, 'newDate' => $newDate, 'amount_number' => $amount_number]);
        exit;
    }

    public function actionUpdatePrint($id) {
        $model = $this->findModel($id);

        if (!empty(Yii::$app->session['current_status'])) {
            $status = Yii::$app->session['current_status'];
        }
        if ($model->load(Yii::$app->request->post())) {

            $model->bank_account_id = Yii::$app->request->post()['bank_id'];
            $model->payee_id = Yii::$app->request->post()['ChequePrint']['payee_id'];
            $model->remarks = Yii::$app->request->post()['ChequePrint']['remarks'];
            $model->cheque_amount_words = $this->AmountWords($model->cheque_amount, $model->bank_account_id, $model->currency) . ' ONLY';
            $model->print_status = Yii::$app->request->post()['ChequePrint']['print_status'];
            if ($model->print_status == 2 && $model->remarks == '') {

                Yii::$app->getSession()->setFlash('error_remark', 'remarks not found');
                return $this->redirect(Yii::$app->request->referrer);
            }

            $model->cheque_date = $this->ChangeFormat(Yii::$app->request->post()['ChequePrint']['cheque_date']);
            if ($model->print_status != 4 && $model->print_status != 5 && $model->print_status != 6) {
                $model->print_status = $this->CheckPrintStatus($model);
            }
            $model->decrement_check_status = 0;

            $model->save();
//                        if ($model->print_status != 2) {
//                                $this->UpdateCheque($model);
//                        }
            if (!empty(Yii::$app->session['current_status'])) {
                unset(Yii::$app->session['current_status']);
                return $this->redirect(['print-all', 'current_print_status' => $status]);
            } elseif (!empty(Yii::$app->session['reports_update'])) {
                unset(Yii::$app->session['reports_update']);
                return $this->redirect(['reports']);
            } else {
                return $this->redirect(['prints', 'id' => $model->bank_account_id]);
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /*
     * Decrement the check count when print status not equal to Not printed.
     */

//        protected function UpdateCheque($model) {
//                $cheque_data = Cheques::find()->where(['bank_id' => $model->bank_account_id])->one();
//                if ($model->decrement_check_status == 0) {
//                        $cheque_data->cheques_left -= 1;
//                        $cheque_data->save();
//                        $model->decrement_check_status = 1;
//                        $model->save();
//                }
//                return true;
//        }

    public function actionPrints($id) {
        unset(Yii::$app->session['current_status']);
        $check_prints = ChequePrint::find()->where(['bank_account_id' => $id])->all();
        //if (!empty($check_prints)) {
        //  foreach ($check_prints as $check_print) {
        //   $this->CheckPrintStatus($check_print);
        // }
        // }
        $bank_details = BankAccounts::find()->where(['id' => $id])->one();
        $searchModel = new ChequePrintSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['user_id' => Yii::$app->session['user_session']['id']]);
        $dataProvider->query->andWhere(['bank_account_id' => $id]);
        $dataProvider->pagination->pageSize = 20;

        return $this->render('prints', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'bank_details' => $bank_details,
        ]);
    }

    public function actionPrint($id) {

        $chequePrint = $this->findModel($id);

        if (Yii::$app->request->post()) {


            $check_count = 0;
            for ($i = 1; $i <= $chequePrint->no_of_emi_cheques; $i++) {

                if (Yii::$app->request->post()["cheque_num"][$i] != $chequePrint->cheque_number . '_' . $chequePrint->cheque_book_id) {

                    $model = new ChequePrint();
                    $check_count++;
                } else {

                    $model = ChequePrint::findOne(['id' => $id]);
                }
                $model->bank_account_id = $chequePrint->bank_account_id;
                $model->cheque_design_id = $chequePrint->cheque_design_id;
                $model->user_id = Yii::$app->session['user_session']['id'];
                $cheque_number = explode('_', Yii::$app->request->post()["cheque_num"][$i]);

                $model->cheque_book_id = $cheque_number[1];
                $model->cheque_number = $cheque_number[0];
                $model->cheque_date = $this->ChangeFormat(Yii::$app->request->post()["cheuqe_date"][$i]);
                $model->cheque_amount = Yii::$app->request->post()["cheque_amount"][$i];
                //$model->cheque_number = Yii::$app->request->post()["cheque_num"][$i];
                $model->payee_id = $chequePrint->payee_id;

                $model->currency_type = $chequePrint->currency_type;

                //$model->cheque_amount_words = strtoupper($this->Test($model->cheque_amount, $chequePrint->bank_account_id, $model->currency_type));
                $model->cheque_amount_words = $chequePrint->cheque_amount_words;

                $model->cheque_type = $chequePrint->cheque_type;
                $model->print_status = $chequePrint->print_status;
                $model->no_of_emi_cheques = $chequePrint->no_of_emi_cheques;
                $model->decrement_check_status = $chequePrint->decrement_check_status;
                $model->date = date('Y-m-d');


                $model->save();
            }

            $this->UpdateCheque($chequePrint->bank_account_id, $check_count);
            return $this->redirect(['prints', 'id' => $model->bank_account_id]);
        } else {

            return $this->render('_emi_cheques', [
                        'model' => $chequePrint,
            ]);
        }
    }

    protected function UpdateCheque($bannk_id, $check_count) {
        $cheque_data = Cheques::find()->where(['bank_id' => $bannk_id])->one();
        $cheque_data->cheques_left -= $check_count;
        $cheque_data->save(false);
        return true;
    }

    protected function findModel($id) {
        if (($model = ChequePrint::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /* value: amout_num, bank_id: bank_id, currrency: currency_option */

    public function Test($valuee, $bank_id, $currrency) {
        if (!empty($currrency)) {
            $currency = Country::find()->where(['id' => $currrency])->one();
        } /* elseif (!empty($data['bank_id'])) {
          $bank_details = BankAccounts::find()->where(['id' => $data['bank_id'], 'user_id' => Yii::$app->session['user_session']['id']])->one();
          $currency = Country::find()->where(['id' => $bank_details->country_id])->one();
          } */
        if (!empty($currency)) {

            if ($currency->format == 1) {
                $dictionary = array(
                    0 => 'zero', 1 => 'one', 2 => 'two', 3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six', 7 => 'seven', 8 => 'eight',
                    9 => 'nine', 10 => 'ten', 11 => 'eleven', 12 => 'twelve', 13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
                    16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen', 19 => 'nineteen', 20 => 'twenty', 30 => 'thirty', 40 => 'fourty',
                    50 => 'fifty', 60 => 'sixty', 70 => 'seventy', 80 => 'eighty', 90 => 'ninety', 100 => 'hundred', 1000 => 'thousand', 100000 => 'lakh',
                    10000000 => 'crore', 1000000000 => 'hundred crore', 100000000000 => 'ten thousand crore');
            } else {
                $dictionary = array(
                    0 => 'zero', 1 => 'one', 2 => 'two', 3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six', 7 => 'seven', 8 => 'eight',
                    9 => 'nine', 10 => 'ten', 11 => 'eleven', 12 => 'twelve', 13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
                    16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen', 19 => 'nineteen', 20 => 'twenty', 30 => 'thirty', 40 => 'fourty',
                    50 => 'fifty', 60 => 'sixty', 70 => 'seventy', 80 => 'eighty', 90 => 'ninety', 100 => 'hundred', 1000 => 'thousand', 1000000 => 'million',
                    1000000000 => 'billion', 1000000000000 => 'trillion', 1000000000000000 => 'quadrillion', 1000000000000000000 => 'quintillion');
            }
            $d = explode('.', $valuee);
            if (empty($d[1])) {
                $value = $this->ConvertNumberToWords($d[0], $currency, $dictionary);
//                                echo $value . ' ' . $currency->value;
//                                exit;
                return $value;
            } else {

                $value = $this->ConvertNumberToWords($d[0], $currency, $dictionary) . ' ' . $currency->value;
                $decimal = $this->decimal($d[1], $currency, $dictionary);
                $result_value = $value . ' and  ' . $decimal;
                return $result_value;
            }
//				echo $this->ConvertNumberToWords($data['value'], $currency);
//				exit;
        }
    }

    public function ConvertNumberToWords($number, $currency, $dictionary) {

        $hyphen = ' ';
        $conjunction = ' and ';
        $separator = ' ';
        $negative = 'negative ';
        $decimal = ' and ';




        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
// overflow
            trigger_error(
                    'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . $this->ConvertNumberToWords(abs($number), $currency, $dictionary);
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }


        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens = ((int) ($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . $this->ConvertNumberToWords($remainder, $currency, $dictionary);
                }
                break;

            default:
                if ($currency->format == 1) {
                    $baseUnit = 10 * pow(100, floor(log($number / 10, 100))); // Thanks to rici and Patashu
                    $numBaseUnits = (int) ($number / $baseUnit);

                    $remainder = $number % $baseUnit;
                    $string = $this->ConvertNumberToWords($numBaseUnits, $currency, $dictionary) . ' ' . $dictionary[$baseUnit];
                    if ($remainder) {
                        $string .= $remainder < 100 ? $conjunction : $separator;
                        $string .= $this->ConvertNumberToWords($remainder, $currency, $dictionary);
                    }
                    break;
                } else {
                    $baseUnit = pow(1000, floor(log($number, 1000)));

                    $numBaseUnits = (int) ($number / $baseUnit);
                    $remainder = $number % $baseUnit;

                    $string = $this->ConvertNumberToWords($numBaseUnits, $currency, $dictionary) . ' ' . $dictionary[$baseUnit];

                    if ($remainder) {
                        $string .= $remainder < 100 ? $conjunction : $separator;
                        $string .= $this->ConvertNumberToWords($remainder, $currency, $dictionary);
                    }
                    break;
                }
        }

//$result = $this->decimal($fraction, $decimal, $number, $string, $currency, $dictionary);

        return $string;
    }

    public function decimal($fraction, $currency, $dictionary) {
        if (null !== $fraction && is_numeric($fraction)) {
//$string .= ' ' . $currency->value . $decimal;

            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string = $this->ConvertNumberToWords($fraction, $currency, $dictionary) . '  ' . $currency->decimal_value;

            return $string;
        }
    }

    public function ChangeFormat($data) {
        $originalDate = $data;
        $newDate = date("Y-m-d", strtotime($originalDate));
        return $newDate;
    }

    //	public function actionExport($id) {
//		$print_list = ChequePrint::find()->where(['bank_account_id' => $id])->all();
//		\kartik\grid\GridView::widget([
//		    'dataProvider' => $dataProvider,
//		    'filterModel' => $searchModel,
//		    'columns' => $gridColumns
//		]);
//	}
    public function CheckPrintStatus($model) {

        $date = date('Y-m-d');
        if ($model->cheque_date > $date) {

            $now = time(); // or your date as well
            $your_date = strtotime($model->cheque_date);

            $datediff = $your_date - $now;
            $diff = floor($datediff / (60 * 60 * 24));
            if ($diff > 2) {
                return 1; //1->'post dated'
            } else {
                return 2; // 2->'upcoming'
            }
        } else {

            if ($model->cheque_date == $date) {

                return 2; // 2->'upcoming'
            } else {

                return 3; // 3->'Overdue'
            }
        }
    }

    public function actionPrintAll($current_print_status) {


        $bank_details = BankAccounts::find()->where(['user_id' => Yii::$app->session['user_session']['id']])->one();
        $searchModel = new ChequePrintSearch();
        $searchModel->print_status = $current_print_status;
        $new_search = Yii::$app->request->queryParams;
        if (!empty($new_search))
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        else {
            $dataProvider->query->andWhere(['print_status' => $current_print_status]);
        }
        $dataProvider->query->andWhere(['user_id' => Yii::$app->session['user_session']['id']]);
        $dataProvider->pagination->pageSize = 20;
        Yii::$app->session['dataprovider'] = $dataProvider;
        Yii::$app->session['current_status'] = $current_print_status;
        return $this->render('print_all', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'bank_details' => $bank_details,
        ]);
    }

    public function actionExportPrintResult($print_status = NULL) {
        $searchModel = new ChequePrintSearch();
        $dataProvider = Yii::$app->session['dataprovider'];

//		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//		$dataProvider->query->andWhere(['user_id' => Yii::$app->session['user_session']['id']]);
//		$dataProvider->query->andWhere(['print_status' => $print_status]);
        return ExcelView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'fullExportType' => 'xlsx', //can change to html,xls,csv and so on
                    'grid_mode' => 'export',
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'bank_account_id',
                        'cheque_number',
                        'cheque_date',
                        [
                            'attribute' => 'payee_id',
                        ],
                        'cheque_amount',
                        'print_status',
                    ],
        ]);
    }

    public function actionExport($id) {
        $searchModel = new ChequePrintSearch();
        $queryparams = Yii::$app->session['printparams'];
        if (!empty($queryparams)) {
            $dataProvider = $searchModel->search($queryparams);
        } else {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }
        $dataProvider = $searchModel->search($queryparams);
        $dataProvider->query->andWhere(['user_id' => Yii::$app->session['user_session']['id']]);
        $dataProvider->query->andWhere(['bank_account_id' => $id]);
        return ExcelView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'fullExportType' => 'xlsx', //can change to html,xls,csv and so on
                    'grid_mode' => 'export',
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'bank_account_id',
                        'cheque_number',
                        'cheque_date',
                        [
                            'attribute' => 'payee_id',
                        ],
                        'cheque_amount',
                        'print_status',
                    ],
        ]);
    }

    public function actionDelete($id) {
        $chequeprint = $this->findModel($id);
        if (!empty($chequeprint)) {

            $cheque_book_data = Cheques::find()->where(['id' => $chequeprint->cheque_book_id])->one();

            if (!empty($cheque_book_data) && $chequeprint->delete()) {
                $cheque_book_data->cheques_left += 1;
                $cheque_book_data->update();
                Yii::$app->getSession()->setFlash('success', 'succuessfully deleted');
            } else {
                Yii::$app->getSession()->setFlash('error', "Can't delete the Cheque");
            }
        } else {
            return $this->redirect(['site/error']);
        }
        return $this->redirect(['prints', 'id' => $chequeprint->bank_account_id]);
    }

    public function actionReports() {
        $searchModel = new ChequePrintSearch();
        $new_search = Yii::$app->request->queryParams;
        if (!empty($new_search))
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        else {
            $dataProvider->query->andWhere(['user_id' => Yii::$app->session['user_session']['id']]);
        }
        $dataProvider->query->andWhere(['user_id' => Yii::$app->session['user_session']['id']]);
        $dataProvider->pagination->pageSize = 20;
        Yii::$app->session['dataprovider'] = $dataProvider;
        Yii::$app->session['reports_update'] = 1;

        return $this->render('reports', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                        //'bank_details' => $bank_details,
        ]);
    }

    public function AmountWords($amount, $bank_id, $currency_option) {

        if (!empty($currency_option)) {
            $currency = Country::find()->where(['id' => $currency_option])->one();
        } else {
            $currency = Country::find()->where(['id' => 1])->one();
        }

        /* elseif (!empty($data['bank_id'])) {
          $bank_details = BankAccounts::find()->where(['id' => $data['bank_id'], 'user_id' => Yii::$app->session['user_session']['id']])->one();
          $currency = Country::find()->where(['id' => $bank_details->country_id])->one();
          } */
        if (!empty($currency)) {

            if ($currency->format == 1) {
                $dictionary = array(
                    0 => 'zero', 1 => 'one', 2 => 'two', 3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six', 7 => 'seven', 8 => 'eight',
                    9 => 'nine', 10 => 'ten', 11 => 'eleven', 12 => 'twelve', 13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
                    16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen', 19 => 'nineteen', 20 => 'twenty', 30 => 'thirty', 40 => 'fourty',
                    50 => 'fifty', 60 => 'sixty', 70 => 'seventy', 80 => 'eighty', 90 => 'ninety', 100 => 'hundred', 1000 => 'thousand', 100000 => 'lakh',
                    10000000 => 'crore', 1000000000 => 'hundred crore', 100000000000 => 'ten thousand crore');
            } else {
                $dictionary = array(
                    0 => 'zero', 1 => 'one', 2 => 'two', 3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six', 7 => 'seven', 8 => 'eight',
                    9 => 'nine', 10 => 'ten', 11 => 'eleven', 12 => 'twelve', 13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
                    16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen', 19 => 'nineteen', 20 => 'twenty', 30 => 'thirty', 40 => 'fourty',
                    50 => 'fifty', 60 => 'sixty', 70 => 'seventy', 80 => 'eighty', 90 => 'ninety', 100 => 'hundred', 1000 => 'thousand', 1000000 => 'million',
                    1000000000 => 'billion', 1000000000000 => 'trillion', 1000000000000000 => 'quadrillion', 1000000000000000000 => 'quintillion');
            }
//				echo $data['value'];
//				exit;

            $d = explode('.', $amount);


            if ((empty($d[1])) || ($d[1] == "00")) {

                $value = $this->ConvertNumberToWords($d[0], $currency, $dictionary);
                return $value . ' ' . $currency->value;
            } else {



                $value = $this->ConvertNumberToWords($d[0], $currency, $dictionary) . ' ' . $currency->value;

                $decimal = $this->decimal($d[1], $currency, $dictionary);


                $result_value = $value . ' and  ' . $decimal;

                return $result_value;
            }
//				echo $this->ConvertNumberToWords($data['value'], $currency);
//				exit;
        }
    }

    /**
     * This function print each printed cheque details.
     * @param integer $id
     * @return mixed
     */
    public function actionReport($id) {
        $check_prints = ChequePrint::find()->where(['id' => $id])->one();
        echo $this->renderPartial('_print_report', [
            'check_prints' => $check_prints,
        ]);
        exit;
    }

}

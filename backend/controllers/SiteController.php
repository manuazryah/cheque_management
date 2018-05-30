<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Employee;
use common\models\AdminPosts;
use common\models\ForgotPasswordTokens;
use kartik\mpdf\Pdf;
use common\models\Users;
use common\models\UsersSearch;

/**
 * Site controller
 */
class SiteController extends Controller {

        /**
         * @inheritdoc
         */
        public function behaviors() {
                return [
                    'access' => [
                        'class' => AccessControl::className(),
                        'rules' => [
                                [
                                'actions' => ['login', 'error', 'index', 'home', 'report', 'forgot', 'new-password', 'currency'],
                                'allow' => true,
                            ],
                                [
                                'actions' => ['logout', 'index', 'Home', 'forgot'],
                                'allow' => true,
                                'roles' => ['@'],
                            ],
                        ],
                    ],
                    'verbs' => [
                        'class' => VerbFilter::className(),
                        'actions' => [
                            'logout' => ['post'],
                        ],
                    ],
                ];
        }

        /**
         * @inheritdoc
         */
        public function actions() {
                return [
                    'error' => [
                        'class' => 'yii\web\ErrorAction',
                    ],
                ];
        }



        /**
         * Displays homepage.
         *
         * @return string
         */
        public function actionIndex() {

                if (!Yii::$app->user->isGuest) {

                        return $this->redirect(array('site/home'));
                }
                $this->layout = 'login';
                $model = new Employee();
                $model->scenario = 'login';
                if ($model->load(Yii::$app->request->post()) && $model->login() && $this->setSession()) {
                        return $this->redirect(array('site/home'));
                } else {
                        return $this->render('login', [
                                    'model' => $model,
                        ]);
                }
        }

        public function setSession() {
                $post = AdminPosts::findOne(Yii::$app->user->identity->post_id);
                Yii::$app->session['post'] = $post->attributes;

                return true;
        }

        public function actionHome() {
                if (isset(Yii::$app->session['post'])) {
			if (Yii::$app->user->isGuest) {
				return $this->redirect(array('site/index'));
			}
			$searchModel = new UsersSearch();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
			return $this->render('index', [
				    'searchModel' => $searchModel,
				    'dataProvider' => $dataProvider,
			]);
		} else {
			return $this->redirect(array('site/index'));
		}
        }

        /**
         * Login action.
         *
         * @return string
         */
        public function actionLogin() {
                $this->layout = 'login';
                if (!Yii::$app->user->isGuest) {
                        return $this->goHome();
                }

                $model = new LoginForm();
                if ($model->load(Yii::$app->request->post()) && $model->login()) {
                        return $this->goBack();
                } else {
                        return $this->render('login', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Logout action.
         *
         * @return string
         */
        public function actionLogout() {
                Yii::$app->user->logout();
                unset(Yii::$app->session['post']);
                return $this->goHome();
        }

        public function actionForgot() {
                $this->layout = 'login';
                $model = new Employee();
                if ($model->load(Yii::$app->request->post())) {
                        $check_exists = Employee::find()->where("user_name = '" . $model->user_name . "' OR email = '" . $model->user_name . "'")->one();
                        if (!empty($check_exists)) {
                                $token_value = $this->tokenGenerator();
                                $token = $check_exists->id . '_' . $token_value;
                                $val = base64_encode($token);
                                $token_model = new ForgotPasswordTokens();
                                $token_model->user_id = $check_exists->id;
                                $token_model->token = $token_value;
                                $token_model->date = date('Y-m-d');
                                $token_model->save();
                                $this->sendMail($val);
                                Yii::$app->getSession()->setFlash('success', 'A mail has been sent');
                        } else {
                                Yii::$app->getSession()->setFlash('error', 'Invalid username');
                        }
                        return $this->render('forgot-password', [
                                    'model' => $model,
                        ]);
                } else {
                        return $this->render('forgot-password', [
                                    'model' => $model,
                        ]);
                }
        }

        public function tokenGenerator() {

                $length = rand(1, 1000);
                $chars = array_merge(range(0, 9));
                shuffle($chars);
                $token = implode(array_slice($chars, 0, $length));
                return $token;
        }

        public function sendMail($val) {

//        echo '<a href="' . Yii::$app->homeUrl . 'site/new-password?token=' . $val . '">Click here change password</a>';
//        exit;
                $to = 'surumi@azryah.com';

// subject
                $subject = 'Change password';

// message
               $message = '
<html>
<head>
  <title>Forgot Password</title>
</head>
<body>
  <p>Change Password</p>
  <table>

    <tr>
      <td><a href="http://eazycheque.com/admin/site/new-password?token=' . $val . '">Click here change password</a></td>
    </tr>

  </table>
</body>
</html>
';
              

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
mail($to, $subject, $message, $headers);
        }

        public function actionNewPassword($token) {
                $this->layout = 'login';
                $data = base64_decode($token);
                $values = explode('_', $data);
                $token_exist = ForgotPasswordTokens::find()->where("user_id = " . $values[0] . " AND token = " . $values[1])->one();
                if (!empty($token_exist)) {
                        $model = Employee::find()->where("id = " . $token_exist->user_id)->one();
                        if (Yii::$app->request->post()) {
                                if (Yii::$app->request->post('new-password') == Yii::$app->request->post('confirm-password')) {
                                        Yii::$app->getSession()->setFlash('success', 'password changed successfully');
                                        $model->password = Yii::$app->security->generatePasswordHash(Yii::$app->request->post('confirm-password'));
                                        $model->update();
                                        $token_exist->delete();
                                        $this->redirect('index');
                                } else {
                                        Yii::$app->getSession()->setFlash('error', 'password mismatch  ');
                                }
                        }
                        return $this->render('new-password', [
                        ]);
                } else {

                }
        }

        public function actionCurrency() {
                $number = $_POST['rupees'];
                echo $number;
                exit;
                $this->ConvertNumberToWords($number);
                return $this->render('currency', [
                ]);
        }

        public function ConvertNumberToWords($number) {
                $hyphen = ' ';
                $conjunction = ' and ';
                $separator = ' ';
                $negative = 'negative ';
                $decimal = ' and ';
                $dictionary = array(
                    0 => 'zero',
                    1 => 'one',
                    2 => 'two',
                    3 => 'three',
                    4 => 'four',
                    5 => 'five',
                    6 => 'six',
                    7 => 'seven',
                    8 => 'eight',
                    9 => 'nine',
                    10 => 'ten',
                    11 => 'eleven',
                    12 => 'twelve',
                    13 => 'thirteen',
                    14 => 'fourteen',
                    15 => 'fifteen',
                    16 => 'sixteen',
                    17 => 'seventeen',
                    18 => 'eighteen',
                    19 => 'nineteen',
                    20 => 'twenty',
                    30 => 'thirty',
                    40 => 'fourty',
                    50 => 'fifty',
                    60 => 'sixty',
                    70 => 'seventy',
                    80 => 'eighty',
                    90 => 'ninety',
                    100 => 'hundred',
                    1000 => 'thousand',
                    //Instead of the following values I would like to have Indian counting system values
                    /*
                      1000000             => 'million',
                      1000000000          => 'billion',
                      1000000000000       => 'trillion',
                      1000000000000000    => 'quadrillion',
                      1000000000000000000 => 'quintillion'
                     */
                    100000 => 'lakh',
                    10000000 => 'crore',
                    1000000000 => 'hundred crore',
                    100000000000 => 'ten thousand crore'
                );

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
                        return $negative . $this->ConvertNumberToWords(abs($number));
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
                                        $string .= $conjunction . $this->ConvertNumberToWords($remainder);
                                }
                                break;
                        default:
                                $baseUnit = 10 * pow(100, floor(log($number / 10, 100))); // Thanks to rici and Patashu
                                $numBaseUnits = (int) ($number / $baseUnit);
                                $remainder = $number % $baseUnit;
                                $string = $this->ConvertNumberToWords($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                                if ($remainder) {
                                        $string .= $remainder < 100 ? $conjunction : $separator;
                                        $string .= $this->ConvertNumberToWords($remainder);
                                }
                                break;
                }

                if (null !== $fraction && is_numeric($fraction)) {
                        $string .= $decimal;
                        $words = array();
                        foreach (str_split((string) $fraction) as $number) {
                                $words[] = $dictionary[$number];
                        }
                        $string .= $this->ConvertNumberToWords($fraction) . " Paise";
                }

                return $string;
        }

}

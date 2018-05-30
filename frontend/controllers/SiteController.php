<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Users;
use common\models\ChequePrint;
use common\models\MasterPlans;
use common\models\UserPlans;
use common\models\ForgotPasswordTokens;
use yii\db\Expression;
use common\models\UserPlanHistory;
use common\models\Contact;

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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        $model = new Users();
        unset(Yii::$app->session['return']);
        $model->setScenario('create');
        return $this->render('index', [
                    'model' => $model,
        ]);
    }

    public function actionMobile() {
        $useragent = $_SERVER['HTTP_USER_AGENT'];
        if (preg_match('/android|avantgo|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
            echo "mobile";
            exit;
        } else {
            echo "desktop view";
            exit;
        }
    }

    public function actionMobileApp() {
        return $this->render('mob-app');
    }

    //	public function actionDashboard() {
//		$user_detais = Users::find()->where(['id' => $_GET['id']])->one();
//		if (!empty($user_detais)) {
//			if ($user_detais->email_verification == 0) {
//				Yii::$app->session->setFlash('success', 'Your Email is not varified.Please check Your mail');
//				return $this->redirect(['site/login']);
//			} else {
//				$model = ChequePrint::find()->all();
//				$this->layout = 'dashboard';
//				return $this->render('dashboard', [
//					    'model' => $model,
//				]);
//			}
//		} else {
//			$model = ChequePrint::find()->all();
//			$this->layout = 'dashboard';
//			return $this->render('dashboard', [
//				    'model' => $model,
//			]);
//		}
//	}

    public function actionRegister() {
        unset(Yii::$app->session['return']);
        unset(Yii::$app->session['data']);
        $model = new Users();
        $modellog = new Users();
        $model->setScenario('create');
        if ($model->load(Yii::$app->request->post())) {
            $model->status = 1;
            $model->DOC = date('Y-m-d');
            //$plans = MasterPlans::find()->where(['id' => $model->plan])->one();
            // $days = $plans->valid_days;
            //  $model->plan_end_date = date('Y-m-d', strtotime("+" . $days . " days"));
            $model->email_verification = 0;

            if ($model->save()) {
                $this->addplan($model);
                $this->sendMail($model);
//                                Yii::$app->session['return'] = 1;
                Yii::$app->session->setFlash('success', 'Thanku for registering with us.. a mail has been sent to your mail id (check your spam folder too)');
                $model = new Users();
                //return $this->redirect(['pricing', 'us_id' => $model->id]);
                return $this->render('log', [
                            'model' => $model, 'modellog' => $modellog]);
            } else {

                Yii::$app->session['return'] = 1;
                Yii::$app->session['data'] = $model;
                Yii::$app->session->setFlash('error', 'complete the registration');
                // return $this->redirect(Yii::$app->request->referrer);
                return $this->render('log', [
                            'model' => $model, 'modellog' => $modellog]);
            }
        } else {

            Yii::$app->session['return'] = 1;
            Yii::$app->session['data'] = $model;
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionPlans($id) {
        $master_plans = MasterPlans::find()->orderBy(['id' => SORT_DESC])->where(['status' => 1])->all();
        return $this->render('plans', [
                    'master_plans' => $master_plans,
                    'id' => $id,
        ]);
    }

    public function actionSaveUpgrade($upgrade_id, $user_id) {

//                $upgrade_id = $_POST['upgrade_plan'];
//                $user_id = $_POST['user_id'];
        $master_plans = MasterPlans::find()->where(['id' => $upgrade_id])->one();
        $current_plan = UserPlans::find()->where(['user_id' => $user_id])->one();
        $userdetails = Users::find()->where(['id' => $user_id])->one();
        if (!empty($current_plan) && !empty($master_plans)) {
            $current_plan->plan_name = $master_plans->plan_name;
            $current_plan->plan_id = $master_plans->id;
            $current_plan->valid_days = $master_plans->valid_days;
            $current_plan->amount = $master_plans->amount;
            $current_plan->date = date('Y-m-d');
            $start = $current_plan->date;
            $valid = $current_plan->valid_days;
            $newdate = strtotime('+' . $valid . 'days', strtotime($start));
            $current_plan->plan_end_date = date('Y-m-j', $newdate);
            $current_plan->save();
            if (!empty($userdetails)) {
                $userdetails->plan = $current_plan->plan_id;
                $userdetails->plan_end_date = date('Y-m-j', $newdate);
                $userdetails->save();
                $this->planhistory($current_plan);
            }
            Yii::$app->session->setFlash('success', 'your plan is renewed');
            if (!empty(Yii::$app->session['user_session']))
                return $this->redirect(['dashboard/dashboard']);
            else
                return $this->redirect(['site/login']);
        }
        else {
            return $this->redirect(['site/login']);
        }
    }

    public function sendMail($model) {

//        echo '<a href="' . Yii::$app->homeUrl . 'site/new-password?token=' . $val . '">Click here change password</a>';
//        exit;
        $to = $model->email_id;

// subject
        $subject = 'Email verification';

// message
        $message = '
<html>
<head>

  <title>Email verification</title>
</head>
<body>
  <p>Thank you very much for signing up at www.eazycheque.com !</p></br>
<p>Please click on the below link to verify your email address:</p>
  <table>

    <tr>
     <td style="padding: 30px 0px 30px 0px;"><a style=" background: #3498db; color: #ffffff;
  font-size: 16px;
  padding: 10px 20px 10px 20px;
  text-decoration: none; background-image: -webkit-linear-gradient(top, #3498db, #2980b9); background-image: -moz-linear-gradient(top, #3498db, #2980b9);background-image: -ms-linear-gradient(top, #3498db, #2980b9);background-image: -o-linear-gradient(top, #3498db, #2980b9);background-image: linear-gradient(to bottom, #3498db, #2980b9);-webkit-border-radius: 28;-moz-border-radius: 28;" href="http://' . Yii::$app->getRequest()->serverName . Yii::$app->homeUrl . 'site/email-verification?token=' . Yii::$app->EncryptDecrypt->Encrypt('encrypt', $model->id) . '" >Click here</a></td>
    </tr>

  </table>
<p> For any queries/ support kindly email to info@gulfproaccountants.com</p>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
                "From: 'info@eazycheque.com";
        mail($to, $subject, $message, $headers);
        return true;
    }

    public function addplan($data) {
        $model = new UserPlans();
        $model->user_id = $data->id;
        $plan_details = MasterPlans::find()->where(['id' => 1])->one();
        $model->plan_name = $plan_details->plan_name;
        $model->plan_id = $plan_details->id;
        $model->valid_days = $plan_details->valid_days;
        $model->amount = $plan_details->amount;
        $model->date = date('Y-m-d');
        $start = $model->date;
        $valid = $model->valid_days;
        $newdate = strtotime('+' . $valid . 'days', strtotime($start));
        $model->plan_end_date = date('Y-m-j', $newdate);
        $model->status = 1;
        if ($model->save()) {
            $this->planhistory($model);
            $data->plan = $plan_details->id;
            $data->plan_end_date = $model->plan_end_date;
            $data->save();
        }
        return true;
    }

    public function planhistory($data) {
        $model = new UserPlanHistory();
        $model->user_id = $data->user_id;
        $model->plan_id = $data->plan_id;
        $model->plan_date = $data->date;
        $model->plan_end_date = $data->plan_end_date;
        $model->save();
        return TRUE;
    }

    public function actionEmailVerification($token) {
        $token = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $token);
        $user_data = Users::find()->where(['id' => $token])->one();
        if (!empty($user_data)) {
            $user_data->email_verification = 1;
            $user_data->update();
            Yii::$app->session['return'] = 1;
            Yii::$app->session->setFlash('success', 'your email id verified');
            $model = new Users();
            $model->setScenario('create');
            $modellog = new Users();
            $modellog->scenario = 'login';
            return $this->render('log', [
                        'model' => $model,
                        'modellog' => $modellog,
            ]);
        } else {
            unset(Yii::$app->session['return']);
            $this->redirect('login');
        }
    }

    public function actionLoginUser() {

        unset(Yii::$app->session['return']);
        unset(Yii::$app->session['log_data']);
        $model = new Users();
        $modellog = new Users();
        $modellog->setScenario('login');
        if ($modellog->load(Yii::$app->request->post()) && $modellog->validate()) {


            $check_exists = Users::find()->where(['email_id' => $modellog->email_id, 'password' => $modellog->password, 'status' => 1, 'email_verification' => 1])->one();

            if (!empty($check_exists)) {

                $check_date = UserPlans::find()->where(['user_id' => $check_exists->id])->one();

                if (date('Y-m-d') > $check_date->plan_end_date) {
                    Yii::$app->session['return'] = 1;
                    Yii::$app->session->setFlash('log-error', 'Your Plan is expired please renew');
                    Yii::$app->session->setFlash('log-error', 'Your Plan is expired please renew &nbsp <a href="' . Yii::$app->homeUrl . 'site/pricing?us_id=' . $check_exists->id . '">click here to renew</a>');
                    return $this->redirect(Yii::$app->request->referrer);
                } else {
                    $this->setsession($check_exists);
                    $check_exists->last_login = date('Y-m-d');
                    $qArray = ['1', '2', '3'];
                    $printed_cheques = ChequePrint::find()->where(['user_id' => $check_exists->id, 'print_status' => $qArray])->all();
                    $this->CheckPrintStatus($printed_cheques);
                    $check_exists->update();
                    return $this->redirect(['dashboard/dashboard']);
                }
            } else {

                Yii::$app->session['return'] = 1;

                $check_login = Users::find()->where(['email_id' => $modellog->email_id, 'password' => $modellog->password])->one();


                if (empty($check_login)) {
                    Yii::$app->session->setFlash('log-error', 'Invalid User-Name or Password');
                } else {
                    if ($check_login->status == 0) {
                        Yii::$app->session->setFlash('log-error', 'Your Account has been deactivated please contact Admin');
                    } else {
                        Yii::$app->session->setFlash('log-error', 'Your Email ID is not verified.Please Check Your  Mail');
                    }
                }



                return $this->redirect(Yii::$app->request->referrer);
            }
        } else {

            Yii::$app->session['return'] = 1;
            Yii::$app->session['log_data'] = $modellog;
            return $this->render('log', ['model' => $model, 'modellog' => $modellog]);
        }
    }

    public function setsession($model) {
        Yii::$app->session['user_session'] = $model;
    }

    public function CheckPrintStatus($printed_cheques) {
        foreach ($printed_cheques as $cheque) {
            $c_date = $cheque->cheque_date;
            $date = date('Y-m-d');
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

    public function actionForgot() {
        $model = new Users();
        if ($model->load(Yii::$app->request->post())) {
            $check_exists = Users::find()->where("email_id = '" . $model->email_id . "' ")->one();
            if (!empty($check_exists)) {
                $token_value = $this->tokenGenerator();
                $token = $check_exists->id . '_' . $token_value;
                $val = base64_encode($token);
                $token_model = new ForgotPasswordTokens();
                $token_model->user_id = $check_exists->id;
                $token_model->token = $token_value;
                $token_model->date = date('Y-m-d');
                $token_model->save();
                $this->sentEmail($val, $check_exists);
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

    public function actionContact() {
        $model = new Contact();
        if ($model->load(Yii::$app->request->post())) {
            $this->sendContactMail($model);
        }
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

    public function sendContactMail($model) {

        $to = "info@gulfproaccountants.com";
        $subject = $model->subject;

        $message = "
<html>
<head>

</head>
<body>
<p><b>Enquiry Received From Website</b></p>
<table>
<tr>
<th>Name</th>
<th>:-</th>

<td>" . $model->name . "</td>
    </tr>

    <tr>

<th>Email</th>
<th>:-</th>
<td>" . $model->email . "</td>
         </tr>
    <tr>

<th>Subject</th>
<th>:-</th>
<td>" . $model->subject . "</td>
         </tr>
                 <tr>

<th>Message</th>
<th>:-</th>
<td>" . $model->message . "</td>

</tr>
<tr>


</table>
</body>
</html>
";

//    exit();
// Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
        $headers .= 'From: <' . $model->email . '/>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

        mail($to, $subject, $message, $headers);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

    public function actionLogin() {

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new Users();
        $modellog = new Users();
        $modellog->scenario = 'login';
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('log', [
                        'model' => $model, 'modellog' => $modellog]);
        }
    }

    public function actionLogoutUser() {
        //Yii::$app->user->logout();
        unset(Yii::$app->session['user_session']);
        return $this->redirect('index');
    }

    public function tokenGenerator() {

        $length = rand(1, 1000);
        $chars = array_merge(range(0, 9));
        shuffle($chars);
        $token = implode(array_slice($chars, 0, $length));
        return $token;
    }

    public function actionNewPassword($token) {
        $data = base64_decode($token);
        $values = explode('_', $data);
        $token_exist = ForgotPasswordTokens::find()->where("user_id = " . $values[0] . " AND token = " . $values[1])->one();
        if (!empty($token_exist)) {
            $model = Users::find()->where("id = " . $token_exist->user_id)->one();
            if (Yii::$app->request->post()) {
                if (Yii::$app->request->post('new-password') == Yii::$app->request->post('confirm-password')) {
                    Yii::$app->getSession()->setFlash('success', 'password changed successfully');
                    $model->password = Yii::$app->request->post('confirm-password');
                    $model->update();
                    $token_exist->delete();
                    $this->redirect('login');
                } else {
                    Yii::$app->getSession()->setFlash('error', 'password mismatch  ');
                }
            }
            return $this->render('new-password', [
            ]);
        } else {

        }
    }

    public function sentEmail($val, $check_exists) {

//        echo '<a href="' . Yii::$app->homeUrl . 'site/new-password?token=' . $val . '">Click here change password</a>';
//        exit;
        $to = $check_exists->email_id;

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
<p>Please click on the below link to reset your password:</p>
  <table>

    <tr>
    <td style="padding: 30px 0px 30px 0px;"><a style=" background: #3498db; color: #ffffff;
  font-size: 16px;
  padding: 10px 20px 10px 20px;
  text-decoration: none; background-image: -webkit-linear-gradient(top, #3498db, #2980b9); background-image: -moz-linear-gradient(top, #3498db, #2980b9);background-image: -ms-linear-gradient(top, #3498db, #2980b9);background-image: -o-linear-gradient(top, #3498db, #2980b9);background-image: linear-gradient(to bottom, #3498db, #2980b9);-webkit-border-radius: 28;-moz-border-radius: 28;" href="http://' . Yii::$app->getRequest()->serverName . Yii::$app->homeUrl . 'site/new-password?token=' . $val . '">Click here</a></td>
    </tr>

  </table>
<p>  For any queries/ support kindly email to info@gulfproaccountants.com</p>

</body>
</html>
';

// To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
                "From: 'info@eazycheque.com";
        mail($to, $subject, $message, $headers);
        return true;
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout() {
        return $this->render('about');
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionFeatures() {
        return $this->render('features');
    }

    /**
     * Displays privacy policy page.
     *
     * @return mixed
     */
    public function actionPrivacyPolicy() {
        return $this->render('privacy_policy');
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionPricing($us_id = NULL) {
        $master_plans = MasterPlans::find()->where(['status' => 1])->all();
        return $this->render('pricing', [
                    'master_plans' => $master_plans,
        ]);
    }

    public function actionApiNotification($profile = "eazychequeprod", $notification = "Hello World") {
        if (isset($_POST['token'])) {
            $yourApiSecret = "YOUR API SECRET";
            $androidAppId = "e2c77770";
            $data = array(
                "tokens" => $_POST['token'],
                "profile" => $profile,
                "notification" => $notification
            );
            $data_string = json_encode($data);
            $ch = curl_init('https://push.ionic.io/api/v1/push');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'X-Ionic-Application-Id: ' . $androidAppId,
                'Content-Length: ' . strlen($data_string),
                'Authorization: Basic ' . base64_encode($yourApiSecret)
                    )
            );

            $result = curl_exec($ch);
            var_dump($result);
        }
        return $this->render('token_form');
    }

}

<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\ChequeDesigns;
use common\models\ChequeDesignsSearch;
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\imagine\Image;
use Imagine\Image\Box;
use common\models\Cheques;
use common\models\ChequePrint;
use common\models\ChequePrintSearch;
use common\models\BankAccounts;
use common\models\Country;
use common\models\Users;
use common\models\UserPlans;
use common\models\MasterPlans;
use common\models\UserPlanHistorySearch;

class DashboardController extends Controller {

	public $layout = '@app/views/layouts/dashboard';

	public function beforeAction($action) {
		if (!parent::beforeAction($action)) {
			return false;
		}
		$useragent = $_SERVER['HTTP_USER_AGENT'];
		if (preg_match('/android|avantgo|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
			return $this->redirect(['site/mobile-app']);
		}
		if (empty(Yii::$app->session['user_session']) || Yii::$app->session['user_session'] == NULL) {
			$this->redirect(['/site/login']);
			return false;
		}

		return true;
	}

	public function actionIndex() {
		return $this->render('index');
	}

	public function actionDashboard() {
		$user_detais = Users::find()->where(['id' => Yii::$app->session['user_session']['id']])->one();
		if (!empty($user_detais)) {
			if ($user_detais->email_verification == 0) {
				Yii::$app->session->setFlash('success', 'Your Email is not varified.Please check Your mail');
				return $this->redirect(['site/login']);
			} else {
				$model = ChequePrint::find()->all();
				$this->layout = 'dashboard';
				return $this->render('dashboard', [
					    'model' => $model,
				]);
			}
		} else {
			$model = ChequePrint::find()->all();
			$this->layout = 'dashboard';
			return $this->render('dashboard', [
				    'model' => $model,
			]);
		}
	}

	public function actionEditProfile() {
		$model = Users::find()->where(['id' => Yii::$app->session['user_session']['id']])->one();
		$user_plans = UserPlans::find()->where(['user_id' => Yii::$app->session['user_session']['id']])->one();
		if ($model->load(Yii::$app->request->post())) {
			$model->plan = $user_plans->plan_id;
			$model->save(false);
			return $this->redirect(Yii::$app->request->referrer);
		} else {
			Yii::$app->getSession()->setFlash('success', '(To Delete/Close your account kindly send email to info@gulfproaccountants.com)');
			return $this->render('edit_profile', [
				    'model' => $model,
			]);
		}
	}

	public function actionPlanDetails() {
		$model = UserPlans::find()->where(['user_id' => Yii::$app->session['user_session']['id']])->one();
		$searchModel = new UserPlanHistorySearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere(['user_id' => Yii::$app->session['user_session']['id']]);
		$master_plans = MasterPlans::find()->where(['status' => 1])
				->andWhere(['!=', 'id', 1])->all();
		return $this->render('plan_details', [
			    'model' => $model,
			    'dataProvider' => $dataProvider,
			    'master_plans' => $master_plans,
		]);
	}

	public function actionChequeDesigns() {

		$searchModel = new ChequeDesignsSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere(['user_id' => Yii::$app->session['user_session']['id']]);
		$dataProvider->query->andWhere(['status' => 1]);
		return $this->render('cheque_designs', [
			    'searchModel' => $searchModel,
			    'dataProvider' => $dataProvider,
		]);
	}

	public function actionNewDesign($id) {

		$model = new ChequeDesigns;
		$model->setScenario('create');
		$bank_details = BankAccounts::find()->where(['id' => $id, 'user_id' => Yii::$app->session['user_session']['id']])->one();
		$check_designs = ChequeDesigns::find()->where(['bank_accounts_id' => $id])->all();
        foreach ($check_designs as $check_design) {
            $check_design->delete();
        }

		if (!empty($bank_details)) {


			if ($model->load(Yii::$app->request->post()) && $bank_details->status != 0) {

				$image = UploadedFile::getInstance($model, 'cheque_image');
				$model = $this->CreateLayout($model, $id, $image);


				if ($model->validate()) {

					$model->save();


					$image->saveAs('img/cheque-images/' . $model->id . '.' . $model->cheque_image);


					$path = \Yii::$app->basePath . '/../img/cheque-images/';


					$cropped_image = \Yii::$app->basePath . '/../img/cheque-images/' . $model->id . '.' . $model->cheque_image;

					$width = '750px';
					$height = '340px';
					$this->ImageResize($width, $height, $path, $model, $cropped_image);


					return $this->redirect(['set-design', 'id' => $model->bank_accounts_id]);
				} else {
					return $this->redirect(Yii::$app->request->referrer);
				}
			} else {
				if ($bank_details->status == 0)
					Yii::$app->getSession()->setFlash('error', 'Bank  Account is Disabled');
				if (Yii::$app->session['message'] == 1) {
					Yii::$app->getSession()->setFlash('error', 'please upload a cheque image');
				}
				return $this->render('new-designs', [
					    'model' => $model,
					    'bank_details' => $bank_details,
				]);
			}
		} else {

			return $this->redirect('/site/error', 302);
		}
	}

	public function CreateLayout($model, $id, $image) {

		$model->bank_accounts_id = $id;
		$model->cheque_image = $image->extension;
		$model->user_id = Yii::$app->session['user_session']['id'];
		$model->date = date('Y-m-d');
		$data = [];
		$data['font'] = ['size' => '12'];
		$data['image_size'] = ['width' => '18.79', 'height' => '8.47'];
		$data['cheque_date'] = ['top' => '10%', 'left' => '50%', 'letter-spacing' => '10'];
		$data['cheque_name'] = ['top' => '69px', 'left' => '83px'];
		$data['rupee_word'] = ['top' => '76px', 'left' => '150px', 'text-indent' => '40', 'line-height' => '20', 'width' => '520px'];
		$data['rupee_num'] = ['top' => '146px', 'left' => '584px', 'text-index' => ''];
		$data['acc_num'] = ['top' => '103px', 'left' => '135px', 'text-index' => ''];
		$data['bearer'] = ['top' => '139px', 'left' => '77px', 'text-index' => ''];
		$data['ac_center'] = ['top' => '50px', 'left' => '200px', 'text-indent' => '', 'width' => '200px'];
		\Yii::$app->response->format = 'json';
		$model->field_7 = Json::encode($data);
$model->cheque_date_hyphen = 0;
		$model->status = 1; /* status one means design is uploadeed */
		return $model;
	}

	public function actionSaveLayout() {
		$model = $this->findModel(Yii::$app->request->post()['model_id']);
		$bank_details = BankAccounts::find()->where(['id' => $model->bank_accounts_id])->one();
		if ($bank_details->status == 0) {
			Yii::$app->getSession()->setFlash('error', 'Bank  Account is Disabled');
			return $this->redirect(Yii::$app->request->referrer);
		} else {
			$model_data = Json::decode($model->field_7);
			$result = Yii::$app->request->post();
			$data = [];
			$model = $this->UpdateLayout($model, $model_data, $result, $data);
		}
		return $this->redirect(['print-cheque', 'id' => $model->bank_accounts_id]);
//                return $this->redirect(Yii::$app->request->referrer);
	}

	public function UpdateLayout($model, $model_data, $result, $data) {


		if (!empty($result['design_width']) || (!empty($result['design_height']))) {
			$data['image_size'] = ['width' => $result['design_width'], 'height' => $result['design_height']];
		} else {
			$data['image_size'] = ['width' => $model_data['image_size']['width'], 'height' => $model_data['image_size']['height']];
		}
		if (!empty($result['font_size'])) {
			$data['font'] = ['size' => $result['font_size']];
		} else {
			$data['font'] = ['size' => $model_data['font']['size']];
		}


		if (!empty($result['date_y']) || (!empty($result['date_x']))) {
			$data['cheque_date'] = ['top' => $result['date_y'], 'left' => $result['date_x'], 'letter-spacing' => $result['letter-spacing']];
		} else {
			$data['cheque_date'] = ['top' => $model_data['cheque_date']['top'], 'left' => $model_data['cheque_date']['left'], 'letter-spacing' => $model_data['cheque_date']['letter-spacing']];
		}
		if (!empty($result['name_y']) || (!empty($result['name_x'])))
			$data['cheque_name'] = ['top' => $result['name_y'], 'left' => $result['name_x']];
		else
			$data['cheque_name'] = ['top' => $model_data['cheque_name']['top'], 'left' => $model_data['cheque_name']['left']];

		if (!empty($result['rupee_word_y']) || (!empty($result['rupee_word_x'])) || (!empty($result['rupee_word_width'])))
			$data['rupee_word'] = ['top' => $result['rupee_word_y'], 'left' => $result['rupee_word_x'], 'text-indent' => $result['rupee_word_text_indent'], 'line-height' => $result['rupee_word_line_height'], 'width' => $result['rupee_word_width']];
		else {
			$data['rupee_word'] = ['top' => $model_data['rupee_word']['top'], 'left' => $model_data['rupee_word']['left'], 'text-indent' => $model_data['rupee_word']['text-indent'], 'line-height' => $model_data['rupee_word']['line-height'], 'width' => $model_data['rupee_word']['width']];
		}

		if (!empty($result['ac_center_y']) || (!empty($result['ac_center_x'])) || (!empty($result['ac_center_width'])))
			$data['ac_center'] = ['top' => $result['ac_center_y'], 'left' => $result['ac_center_x'], 'text-indent' => '', 'width' => $result['ac_center_width']];
		else {
			$data['ac_center'] = ['top' => $model_data['ac_center']['top'], 'left' => $model_data['ac_center']['left'], 'text-indent' => '', 'width' => $model_data['ac_center']['width']];
		}

		if (!empty($result['rupee_num_y']) || (!empty($result['rupee_num_x'])))
			$data['rupee_num'] = ['top' => $result['rupee_num_y'], 'left' => $result['rupee_num_x'], 'text-index' => ''];
		else
			$data['rupee_num'] = ['top' => $model_data['rupee_num']['top'], 'left' => $model_data['rupee_num']['left'], 'text-index' => ''];
		if (!empty($result['accnt_num_y']) || (!empty($result['accnt_num_x'])))
			$data['acc_num'] = ['top' => $result['accnt_num_y'], 'left' => $result['accnt_num_x'], 'text-index' => ''];
		else
			$data['acc_num'] = ['top' => $model_data['acc_num']['top'], 'left' => $model_data['acc_num']['left'], 'text-index' => ''];

		if (!empty($result['letter-spacing'])) {
			if (!empty($result['date_y']) || (!empty($result['date_x']))) {
				$data['cheque_date'] = ['top' => $result['date_y'], 'left' => $result['date_x'], 'letter-spacing' => $result['letter-spacing']];
			} else {
				$data['cheque_date'] = ['top' => $model_data['cheque_date']['top'], 'left' => $model_data['cheque_date']['left'], 'letter-spacing' => $result['letter-spacing']];
			}
		}
		if (!empty($result['rupee_word_width'])) {
			if (!empty($result['rupee_word_y']) || (!empty($result['rupee_word_x'])))
				$data['rupee_word'] = ['top' => $result['rupee_word_y'], 'left' => $result['rupee_word_x'], 'text-indent' => $result['rupee_word_text_indent'], 'line-height' => $result['rupee_word_line_height'], 'width' => $result['rupee_word_width']];
			else
				$data['rupee_word'] = ['top' => $model_data['rupee_word']['top'], 'left' => $model_data['rupee_word']['left'], 'text-indent' => $model_data['rupee_word']['text-indent'], 'line-height' => $model_data['rupee_word']['line-height'], 'width' => $result['rupee_word_width']];
		}
		if (!empty($result['bearer_y']) || (!empty($result['bearer_x'])))
			$data['bearer'] = ['top' => $result['bearer_y'], 'left' => $result['bearer_x'], 'text-index' => ''];
		else
			$data['bearer'] = ['top' => $model_data['bearer']['top'], 'left' => $model_data['bearer']['left'], 'text-index' => ''];
		\Yii::$app->response->format = 'json';
		$model->field_7 = Json::encode($data);
		$model->cheque_date_hyphen = $result['hyphen'];
		$model->status = 3; /* status 3 indicates design layout setted */
		$model->update();
		return $model;
	}

	public function actionSetDesign($id) {
		/* $id is bank account id */
		//$model = $this->findModel($id);
		$model = ChequeDesigns::find()->where(['bank_accounts_id' => $id])->one();
		//$model = ChequeDesigns::find()->where(['bank_accounts_id' => $id])->orderBy(['id' => SORT_DESC])->one();
		$bank_details = BankAccounts::find()->where(['id' => $model->bank_accounts_id, 'user_id' => Yii::$app->session['user_session']['id']])->one();
		$path = Yii::$app->homeUrl . 'img/cheque-images/' . $model->id . '.' . $model->cheque_image;

		if (!empty($bank_details)) {
			if ($bank_details->status == 0)
				Yii::$app->getSession()->setFlash('error', 'Bank  Account is Disabled');
			if (Yii::$app->session['message'] == 2) {
				Yii::$app->getSession()->setFlash('error', 'please crop the uploaded image');
			}
			return $this->render('set_image', [
				    'path' => $path,
				    'model' => $model,
				    'bank_details' => $bank_details,
			]);
		} else {
			return $this->redirect(['error']);
		}
	}

	public function actionAjaxcrop() {

		$request = Yii::$app->request;
		$x1 = $request->post('imageId_x');
		$x2 = $request->post('imageId_x2');
		$y1 = $request->post('imageId_y');
		$y2 = $request->post('imageId_y2');

		$h = $request->post('imageId_h');
		$w = $request->post('imageId_w');

//$image_source = Yii::$app->basePath . '/../admin/uploads/images/slide-corporate-1.jpg';
		$image_source = $request->post('path');

		$model = $request->post('model');
$extension = $request->post('extension');



//$image_height = $request->post('image_height');
//$image_width = $request->post('image_width');

		if (empty($w)) {
//nothing selected
			return;
		}
		if ($extension == 'jpg') {
			$image = imagecreatefromjpeg($image_source);
		} elseif ($extension == 'png') {
			$image = imagecreatefrompng($image_source);
		} else {
			$image = imagecreatefromjpeg($image_source);
		}

		$width = imagesx($image);
		$height = imagesy($image);

		echo $resized_width = ((int) $x2) - ((int) $x1);
		echo $resized_height = ((int) $y2) - ((int) $y1);

		$resized_image = imagecreatetruecolor($resized_width, $resized_height);
		imagecopyresampled($resized_image, $image, 0, 0, (int) $x1, (int) $y1, $width, $height, $width, $height);
		imagejpeg($resized_image, $image_source);





//return $this->redirect(['more-details', 'id' => $model->id]);
	}

	public function actionMoreDetails($id) {
		/* $id is bankaccount id */
		$new_design = new ChequeDesigns();
		//$model = $this->findModel($id);
		$model = ChequeDesigns::find()->where(['bank_accounts_id' => $id])->one();
		$bank_details = BankAccounts::find()->where(['id' => $model->bank_accounts_id, 'user_id' => Yii::$app->session['user_session']['id']])->one();
		if ($bank_details->status == 0) {

			Yii::$app->getSession()->setFlash('error', 'Bank  Account is Disabled');
			return $this->render('more_details', [
				    'model' => $model,
				    'new_design' => $new_design,
			]);
		} else {
			if ($model->status == 1) {
				$model->status = 2;
				$model->update();
			}

			$cropped_image = \Yii::$app->basePath . '/../img/cheque-images/' . $model->id . '.' . $model->cheque_image;
			if (!file_exists($cropped_image)) {
				return $this->redirect(['/dashboard/new-design', 'id' => $model->bank_accounts_id]);
			}
			$path = \Yii::$app->basePath . '/../img/cheque-images/';
			$width = '750px';
			$height = '340px';
			$this->ImageResize($width, $height, $path, $model, $cropped_image);
			if (Yii::$app->session['message'] == 3 && $model->status != 3) {
				Yii::$app->getSession()->setFlash('error', 'please set the layout');
			}
			return $this->render('more_details', [
				    'model' => $model,
				    'new_design' => $new_design,
			]);
		}
	}

	public function ImageResize($width, $height, $path, $model, $cropped_image) {

		$savePath = $path . $model->id . '.' . $model->cheque_image;
		$fileName = $path . $model->id . '.' . $model->cheque_image;
		Image::getImagine()->open($fileName)->thumbnail(new Box($width, $height))->save($savePath, ['quality' => 90]);
	}

	public function actionCheckDesign($id) {
		$bankAcoount = BankAccounts::find()->where(['id' => $id, 'user_id' => Yii::$app->session['user_session']['id']])->one();
		if (!empty($bankAcoount)) {
			$model = ChequeDesigns::find()->where(['bank_accounts_id' => $id])->one();

			if (empty($model)) {
				return $this->redirect(['new-design', 'id' => $id]);
			} elseif ($model->status == 1) {
				return $this->redirect(['set-design', 'id' => $id]);
			} else {
				return $this->redirect(['more-details', 'id' => $id]);
			}
		} else {
			Yii::$app->getSession()->setFlash('error', 'You have no permission access this page');
		}
	}

	public function actionPrintCheque($id) {

		$model = ChequeDesigns::find()->where(['bank_accounts_id' => $id])->one();

		$new_design = new ChequeDesigns();
		$cheques = Cheques::find()->where(['bank_id' => $id, 'status' => 1])->one();
		
$prints = ChequePrint::find()->where(['bank_account_id' => $id])->all();

		$model_new = new ChequePrint();
		if (empty($model)) {

			return $this->redirect(['new-design', 'id' => $id]);
		} else {
			unset(Yii::$app->session['message']);

			return $this->render('print-design', [
				    'model' => $model,
				    'cheques' => $cheques,
				    'model_new' => $model_new,
				    'new_design' => $new_design,
				    'prints' => $prints,
                                    'bank_accounts_id' => $id,
			]);
		}
	}

	public function actionSavePrint($id) {
	
		$design = ChequeDesigns::find()->where(['bank_accounts_id' => $id])->one();
		$cheques = Cheques::find()->where(['bank_id' => $id, 'status' => 1])->one();
		$prints = ChequePrint::find()->where(['bank_account_id' => $id])->all();
		$model = new ChequePrint();
		$model->bank_account_id = $id;
		$model->cheque_design_id = $design->id;
		$model->user_id = Yii::$app->session['user_session']['id'];
		$cheque_book_id = preg_split("/[_]/", Yii::$app->request->post()['cheque-number']);
		$model->cheque_number = $cheque_book_id[1];
		$model->cheque_book_id = $cheque_book_id[0];
		$originalDate = Yii::$app->request->post()['c_date'];
		$newDate = date("Y-m-d", strtotime($originalDate));
		$model->cheque_date = $newDate;
		$model->cheque_date_hyphen = Yii::$app->request->post()['hyphen'];
		$model->payee_id = Yii::$app->request->post()['ChequePrint']['payee_id'];
		$model->cheque_type = $_POST['cheque_type'];
		$model->currency_type = Yii::$app->request->post()['currency_type'];
$model->currency = Yii::$app->request->post()['currency'];
		$model->cheque_amount = Yii::$app->request->post()['ChequePrint']['cheque_amount'];
		$model->cheque_amount_words = Yii::$app->request->post()['ChequePrint']['cheque_amount_words'];
//                $model->cheque_type = Yii::$app->request->post()['payment_mode'];
//                $model->not_over_status = Yii::$app->request->post()['notoveramount'];
		$model->print_status = $this->CheckPrintStatus($model);
		$model->remarks = Yii::$app->request->post()['remarks'];
		$model->no_of_emi_cheques = Yii::$app->request->post()['ChequePrint']['no_of_emi_cheques'];
		$model->date = date('y-m-d');
		$model->cheque_position = Yii::$app->request->post()['cheque-position'];
		$model->print_type = Yii::$app->request->post()['print-type'];
		$model->decrement_check_status = 0;
		if ($model->no_of_emi_cheques > $cheques->cheques_left) {
		var_dump($id);
		 
			Yii::$app->getSession()->setFlash('error', 'Insufficent cheque leafs');
			return $this->redirect(Yii::$app->request->referrer);
		}
        
		if ($model->validate()) {

			$model->save();
			$this->UpdateCheque($model);
			if (Yii::$app->request->post('print-submit') == 'save_print') {
				//echo "<script>window.open('about:blank','print_popup','width=1200,height=740')</script>";
				echo '<script>var strWindowFeatures = "location=yes,height=750,width=600,scrollbars=yes,status=yes";var URL = "' . \Yii::$app->homeUrl . 'dashboard/reports?id=' . $model->id . '"+location.href;
	var win = window.open(URL, "_blank", strWindowFeatures);</script>';
				Yii::$app->getSession()->setFlash('success', 'your data is saved for printing');
			} else {
				//  $model->print_status = 1;
				$model->save();
				Yii::$app->getSession()->setFlash('success', 'your data is saved for printing');
				if ($model->no_of_emi_cheques == 0) {
//                                        echo '<script>var strWindowFeatures = "location=yes,height=750,width=600,scrollbars=yes,status=yes";var URL = "' . \Yii::$app->homeUrl . 'dashboard/reports?id=' . $model->id . '"+location.href;
//	var win = window.open(URL, "_blank", strWindowFeatures);</script>';
					return $this->redirect(['printcheque/print-cheque/prints', 'id' => $model->bank_account_id]);
				} else {
					return $this->redirect(['printcheque/print-cheque/print', 'id' => $model->id]);
				}
			}
		} else {

			return $this->redirect(Yii::$app->request->referrer);
		}

		//return $this->redirect(['reports', 'id' => $model->id]);
	}

	public function CheckPrintStatus($model) {
		$date = date('Y-m-d');
		if ($model->cheque_date > $date) {
			$now = time(); // or your date as well
			$your_date = strtotime($model->cheque_date);
			$datediff = $your_date - $now;
			$diff = floor($datediff / (60 * 60 * 24));
			if ($diff > 3) {
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

	protected function UpdateCheque($model) {
		$cheque_data = Cheques::find()->where(['bank_id' => $model->bank_account_id, 'id' => $model->cheque_book_id])->one();
		if (!empty($cheque_data)) {
			$cheque_data->cheques_left -= 1;
			$cheque_data->save(false);
			$model->save();
		}
//		if ($model->decrement_check_status == 0) {
//			$cheque_data->cheques_left -= 1;
//			$cheque_data->save(false);
//			$model->decrement_check_status = 1;
//			$model->save();
//		}
		return true;
	}

	public function actionPrints($id) {
		$bank_details = BankAccounts::find()->where(['id' => $id])->one();
		$searchModel = new ChequePrintSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere(['user_id' => Yii::$app->session['user_session']['id']]);
		$dataProvider->query->andWhere(['bank_account_id' => $id]);

		return $this->render('prints', [
			    'searchModel' => $searchModel,
			    'dataProvider' => $dataProvider,
			    'bank_details' => $bank_details,
		]);
	}

	public function actionReports($id) {
		$print_dats = ChequePrint::find()->where(['id' => $id])->one();
		$design = ChequeDesigns::find()->where(['id' => $print_dats->cheque_design_id])->one();
		$originalDate = $print_dats->cheque_date;
		if ($print_dats->cheque_date_hyphen == 1) {
			$newDate = date("d-m-Y", strtotime($originalDate));
		} else {
			$newDate = date("dmY", strtotime($originalDate));
		}
		if (!empty($print_dats->no_of_emi_cheques)) {
			$emi_cheques = \common\models\EmiCheques::find()->where(['cheque_print_id' => $id, 'status' => 1])->all();
			echo $this->renderPartial('_emi_reports', ['print_dats' => $print_dats, 'design' => $design, 'newDate' => $newDate, 'emi_cheques' => $emi_cheques]);
			exit;
		} else {
			echo $this->renderPartial('new_print', ['print_dats' => $print_dats, 'design' => $design, 'newDate' => $newDate]);
			exit;
		}
	}

	public function actionTest() {
		if (Yii::$app->request->isAjax) {
			$data = Yii::$app->request->post();
			if (!empty($data['currrency'])) {
				$currency = Country::find()->where(['id' => $data['currrency']])->one();
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

				$d = explode('.', $data['value']);

				if ((empty($d[1])) || ($d[1] == "00")) {
					$value = $this->ConvertNumberToWords($d[0], $currency, $dictionary);
					echo $value . ' ' . $currency->value;
					exit;
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
$decimal_data =  $this->ConvertNumberToWords($fraction, $currency, $dictionary);


			$string = $decimal_data . '  ' . $currency->decimal_value;


			return $string;
		}
	}

	public function actionNewChequeDesign($id) {

		$bank_details = BankAccounts::find()->where(['id' => $id, 'user_id' => Yii::$app->session['user_session']['id']])->one();
		$cheque_design = ChequeDesigns::find()->where(['bank_accounts_id' => $id, 'user_id' => Yii::$app->session['user_session']['id']])->one();

		$model = new ChequeDesigns();
$model->scenario = 'updatecheque';
		if ($model->load(Yii::$app->request->post()) && $bank_details->status != 0) {
			$image = UploadedFile::getInstance($model, 'cheque_image');
			if (!empty($image)){
					$cheque_design->cheque_image = $image->extension;

		
//                                $cheque_design->delete();
				$cheque_design->save();
				if (!empty($image)) {

					$image->saveAs('img/cheque-images/' . $cheque_design->id . '.' . $cheque_design->cheque_image);
					$path = \Yii::$app->basePath . '/../img/cheque-images/';
					$cropped_image = \Yii::$app->basePath . '/../img/cheque-images/' . $cheque_design->id . '.' . $cheque_design->cheque_image;
					$width = '750px';
					$height = '340px';
					$this->ImageResize($width, $height, $path, $cheque_design, $cropped_image);
					Yii::$app->getSession()->setFlash('success', 'your cheque design is successfully uploaded');
					return $this->redirect(['set-design', 'id' => $cheque_design->bank_accounts_id]);
				}
			} else {
				Yii::$app->getSession()->setFlash('error2', 'Please upload an image');
					return $this->redirect(Yii::$app->request->referrer);
			}
		} else {
			if ($bank_details->status == 0)
				Yii::$app->getSession()->setFlash('error', 'Bank  Account is Disabled');
			return $this->redirect(Yii::$app->request->referrer);
		}
	}

	public function actionEmiCheques() {

		if (Yii::$app->request->isAjax) {
			$data = Yii::$app->request->post();
			$numbers = $data['num'];
//			for() {
//				echo "dkjghdfjk";
////				echo '<div class="form-group "><label class="control-label">DATE:</label></div><br>';
//			}
//			exit;
			echo '<div class="form-group "><label class="control-label">DATE:</label></div>';
			exit;
		}
	}

	public function actionError() {
		return $this->render('error', [
		]);
	}

	protected function findModel($id) {
		if (($model = ChequeDesigns::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	public function actionUpgradePlan() {
		$master_plans = MasterPlans::find()->where(['status' => 1])
				->andWhere(['!=', 'id', 1])->all();
		return $this->render('_upgrade_plan', [
			    'master_plans' => $master_plans,
		]);
	}

	public function actionPlanHistory() {
		$searchModel = new UserPlanHistorySearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere(['user_id' => Yii::$app->session['user_session']['id']]);
		return $this->render('_plan_history', [
			    'searchModel' => $searchModel,
			    'dataProvider' => $dataProvider,
		]);
	}

//        public function actionSaveUpgrade() {
//                $upgrade_id = $_POST['upgrade_plan'];
//                $master_plans = MasterPlans::find()->where(['id' => $upgrade_id])->one();
//                $current_plan = UserPlans::find()->where(['user_id' => Yii::$app->session['user_session']['id']])->one();
//                $current_plan->plan_name = $master_plans->plan_name;
//                $current_plan->plan_id = $master_plans->id;
//                $current_plan->valid_days = $master_plans->valid_days;
//                $current_plan->amount = $master_plans->amount;
//                $current_plan->date = date('Y-m-d');
//                $start = $current_plan->date;
//                $valid = $current_plan->valid_days;
//                $newdate = strtotime('+' . $valid . 'days', strtotime($start));
//                $current_plan->plan_end_date = date('Y-m-j', $newdate);
//                $current_plan->save();
//                return $this->redirect(Yii::$app->request->referrer);
//        }
	public function actionSaveUpgrade($upgrade_id, $user_id) {
//                $upgrade_id = $_POST['upgrade_plan'];
//                $user_id = $_POST['user_id'];
		$master_plans = MasterPlans::find()->where(['id' => $upgrade_id])->one();
		$current_plan = UserPlans::find()->where(['user_id' => $user_id])->one();
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
		return $this->redirect(['site/dashboard', 'id' => $user_id]);
	}

	public function actionChangePassword($id) {

		$model = Users::find()->where(['id' => $id])->one();

		if (Yii::$app->request->post()) {

			if (Yii::$app->request->post('old-password') == $model->password) {
				if (Yii::$app->request->post('new-password') == Yii::$app->request->post('confirm-password')) {
					Yii::$app->getSession()->setFlash('success', 'password changed successfully');
					$model->password = Yii::$app->request->post('confirm-password');
					$model->update();
					return $this->redirect(Yii::$app->request->referrer);
				} else {
					Yii::$app->getSession()->setFlash('error', 'password mismatch');
				}
			} else {
				Yii::$app->getSession()->setFlash('error', 'incorrect old password');
			}
		}
		return $this->render('new-password', [
			    'model' => $model,
		]);
	}
	
	/**
         * Remove printed cheque history.
         * @parameters from_date,to_date and user id
         */
        public function actionRemoveCheque() {
                if (isset($_POST['submit'])) {
                        $from_date = $_POST['from_date'];
                        $to_date = $_POST['to_date'];
                        $model = ChequePrint::find()->where(['BETWEEN', 'cheque_date', $from_date, $to_date])->andwhere(['user_id' => Yii::$app->session['user_session']['id']])->all();
                        if (!empty($model)) {
                                foreach ($model as $data) {
                                        $data->delete();
                                }
                        }
                        Yii::$app->getSession()->setFlash('success', 'Successfully Removed');
                }
                return $this->render('remove_cheque');
        }

}

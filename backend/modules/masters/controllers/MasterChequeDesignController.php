<?php

namespace backend\modules\masters\controllers;

use Yii;
use common\models\MasterChequeDesign;
use common\models\MasterChequeDesignSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\MasterBank;
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\imagine\Image;
use Imagine\Image\Box;

/**
 * MasterChequeDesignController implements the CRUD actions for MasterChequeDesign model.
 */
class MasterChequeDesignController extends Controller {

	 public function beforeAction($action) {
		if (!parent::beforeAction($action)) {
			return false;
		}
		

		if (empty(Yii::$app->session['post']) || Yii::$app->session['post'] == NULL) {
			$this->redirect(['/site/index']);
			return false;
		}

		return true;
	}

	public function actionCheckDesign($id) {
		$masterBanks = MasterBank::find()->where(['id' => $id])->one();

		if (!empty($masterBanks)) {
			$model = MasterChequeDesign::find()->where(['master_bank_id' => $id])->one();
//			var_dump($model);
//			exit;
			if (empty($model)) {
				return $this->redirect(['new-design', 'id' => $id]);
			} elseif ($model->status == 1) {
				return $this->redirect(['set-design', 'id' => $model->id]);
			} else {
				return $this->redirect(['more-details', 'id' => $model->id]);
			}
		} else {
			Yii::$app->getSession()->setFlash('error', 'You have no permission access this page');
		}
	}

	public function actionNewDesign($id) {
		$model = new MasterChequeDesign;
		$bank_details = MasterBank::find()->where(['id' => $id])->one();
		if (!empty($bank_details)) {
			if ($model->load(Yii::$app->request->post()) && $bank_details->status != 0) {
				$image = UploadedFile::getInstance($model, 'cheque_image');
				$model = $this->CreateLayout($model, $id, $image);
				if ($model->validate()) {
					$model->save();
					if (!empty($image)) {

						$root = \Yii::$app->basePath . '/../admin/uploads/cheque-images';

						if (!is_dir($root)) {
							mkdir($root);
						}
						$image->saveAs($root . '/' . $model->id . '.' . $image->extension);
						$path = \Yii::$app->basePath . '/../admin/uploads/cheque-images/';
						$cropped_image = \Yii::$app->basePath . '/../admin/uploads/cheque-images/' . $model->id . '.' . $model->cheque_image;
						$width = '750px';
						$height = '340px';
						$this->ImageResize($width, $height, $path, $model, $cropped_image);
						return $this->redirect(['set-design', 'id' => $model->id]);
					}
				} else {
					return $this->redirect(Yii::$app->request->referrer);
				}
			} else {

				return $this->render('new-designs', [
					    'model' => $model,
					    'bank_details' => $bank_details,
				]);
			}
		} else {
			return $this->redirect('site/error');
		}
	}

	public function CreateLayout($model, $id, $image) {

		$model->master_bank_id = $id;
		$model->cheque_image = $image->extension;
		$model->CB = Yii::$app->user->identity->id;
		$model->date = date('Y-m-d');
		$data = [];
		$data['font'] = ['size' => '12'];
		$data['image_size'] = ['width' => '18.79', 'height' => '8.47'];
		$data['cheque_date'] = ['top' => '10%', 'left' => '50%', 'letter-spacing' => '10'];
		$data['cheque_name'] = ['top' => '69px', 'left' => '83px'];
		$data['rupee_word'] = ['top' => '76px', 'left' => '150px', 'text-indent' => '40', 'line-height' => '20', 'width' => '556px'];
		$data['rupee_num'] = ['top' => '146px', 'left' => '584px', 'text-index' => ''];
		$data['acc_num'] = ['top' => '103px', 'left' => '135px', 'text-index' => ''];
		$data['bearer'] = ['top' => '139px', 'left' => '77px', 'text-index' => ''];
		$data['ac_center'] = ['top' => '50px', 'left' => '200px', 'text-indent' => '', 'width' => '200px'];
		\Yii::$app->response->format = 'json';
		$model->cheque_datas = Json::encode($data);
		$model->status = 1; /* status one means design is uploadeed */
		return $model;
	}

	public function actionSetDesign($id) {

		$model = MasterChequeDesign::find()->where(['id' => $id, 'CB' => Yii::$app->user->identity->id])->one();

		$bank_details = MasterBank::find()->where(['id' => $model->master_bank_id])->one();
		$path = Yii::$app->homeUrl . 'uploads/cheque-images/' . $model->id . '.' . $model->cheque_image;
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
			echo "dflkjh";
			exit;
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
		$model = MasterChequeDesign::find()->where(['id' => $id])->one();
		$bank_details = MasterBank::find()->where(['id' => $model->master_bank_id])->one();
		if ($bank_details->status == 0) {
			Yii::$app->getSession()->setFlash('error', 'Bank  Account is Disabled');
			return $this->render('more_details', [
				    'model' => $model,
			]);
		} else {
			if ($model->status == 1) {
				$model->status = 2;
				$model->update();
			}

			$cropped_image = \Yii::$app->basePath . '/../admin/uploads/cheque-images/' . $model->id . '.' . $model->cheque_image;
			$path = \Yii::$app->basePath . '/../admin/uploads/cheque-images/';
			$width = '750px';
			$height = '340px';
			$this->ImageResize($width, $height, $path, $model, $cropped_image);
			if (Yii::$app->session['message'] == 3 && $model->status != 3) {
				Yii::$app->getSession()->setFlash('error', 'please set the layout');
			}
			return $this->render('more_details', [
				    'model' => $model,
			]);
		}
	}

	public function ImageResize($width, $height, $path, $model, $cropped_image) {

		$savePath = $path . $model->id . '.' . $model->cheque_image;
		$fileName = $path . $model->id . '.' . $model->cheque_image;
		Image::getImagine()->open($fileName)->thumbnail(new Box($width, $height))->save($savePath, ['quality' => 90]);
	}

	public function actionSaveLayout() {
		$model = MasterChequeDesign::find()->where(['id' => Yii::$app->request->post()['model_id']])->one();
		$bank_details = MasterBank::find()->where(['id' => $model->master_bank_id])->one();
		if ($bank_details->status == 0) {
			Yii::$app->getSession()->setFlash('error', 'Bank  Account is Disabled');
			return $this->redirect(Yii::$app->request->referrer);
		} else {

			$model_data = Json::decode($model->cheque_datas);
			$result = Yii::$app->request->post();
			$data = [];
			$model = $this->UpdateLayout($model, $model_data, $result, $data);
		}

		return $this->redirect(Yii::$app->request->referrer);
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

		if (!empty($result['rupee_num_y']) || (!empty($result['rupee_num_x'])))
			$data['rupee_num'] = ['top' => $result['rupee_num_y'], 'left' => $result['rupee_num_x'], 'text-index' => ''];
		else
			$data['rupee_num'] = ['top' => $model_data['rupee_num']['top'], 'left' => $model_data['rupee_num']['left'], 'text-index' => ''];
		if (!empty($result['accnt_num_y']) || (!empty($result['accnt_num_x'])))
			$data['acc_num'] = ['top' => $result['accnt_num_y'], 'left' => $result['accnt_num_x'], 'text-index' => ''];
		else
			$data['acc_num'] = ['top' => $model_data['acc_num']['top'], 'left' => $model_data['acc_num']['left'], 'text-index' => ''];
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
		if (!empty($result['ac_center_y']) || (!empty($result['ac_center_x'])) || (!empty($result['ac_center_width'])))
			$data['ac_center'] = ['top' => $result['ac_center_y'], 'left' => $result['ac_center_x'], 'text-indent' => '', 'width' => $result['ac_center_width']];
		else {
			$data['ac_center'] = ['top' => $model_data['ac_center']['top'], 'left' => $model_data['ac_center']['left'], 'text-indent' => '', 'width' => $model_data['ac_center']['width']];
		}
		\Yii::$app->response->format = 'json';
		$model->cheque_datas = Json::encode($data);
		$model->status = 3; /* status 3 indicates design layout setted */
		$model->update();
		return $model;
	}
/* to change master cheque image */

	public function actionChangeChequeImage($id) {
		$bank_details = MasterBank::find()->where(['id' => $id])->one();
		$model = MasterChequeDesign::find()->where(['master_bank_id' => $id])->one();
		if (!empty($bank_details)) {
			if ($model->load(Yii::$app->request->post()) && $bank_details->status != 0) {

				$image = UploadedFile::getInstance($model, 'cheque_image');
				$model = $this->CreateLayout($model, $id, $image);
				if ($model->validate()) {

					$model->save();
					if (!empty($image)) {
						$image->saveAs('uploads/cheque-images/' . $model->id . '.' . $image->extension);
						return $this->redirect(['set-design', 'id' => $model->id]);
					}
				} else {
					return $this->redirect(Yii::$app->request->referrer);
				}
			} else {

				return $this->render('new-designs', [
					    'model' => $model,
					    'bank_details' => $bank_details,
				]);
			}
		} else {
			return $this->redirect('site/error');
		}
		return $this->render('new-designs', [
			    'model' => $model,
			    'bank_details' => $bank_details,
		]);
	}


	/**
	 * Finds the MasterChequeDesign model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return MasterChequeDesign the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = MasterChequeDesign::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}

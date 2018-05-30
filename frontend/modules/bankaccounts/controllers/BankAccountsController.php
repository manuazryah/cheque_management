<?php

namespace frontend\modules\bankaccounts\controllers;

use Yii;
use common\models\BankAccounts;
use common\models\BankAccountsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Cheques;
use common\models\ChequeDesigns;
use common\models\MasterBank;
use common\models\ChequePrint;
use arturoliveira\ExcelView;

/**
 * BankAccountsController implements the CRUD actions for BankAccounts model.
 */
class BankAccountsController extends Controller {

        public $layout = '@app/views/layouts/dashboard';

        /**
         * @inheritdoc
         */
        public function behaviors() {
                return [
                    'verbs' => [
                        'class' => VerbFilter::className(),
                        'actions' => [
                            'delete' => ['POST'],
                        ],
                    ],
                ];
        }

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

        /**
         * Lists all BankAccounts models.
         * @return mixed
         */
        public function actionIndex() {

                if (!empty($_GET['id'])) {
                        $model = $this->findModel($_GET['id']);
                } else {
                        $model = new BankAccounts();
                        $model->setScenario('create');
                }
                if (!empty(Yii::$app->session['user_session'])) {

                        if ($model->load(Yii::$app->request->post())) {
                                $data = Yii::$app->request->post();
                                $model = $this->SaveBankDetails($model, $data);
                                return $this->redirect(Yii::$app->homeUrl . 'dashboard/check-design?id=' . $model->id);
                        } else {
                                return $this->ListBanks($model);
                        }
                } else {
                        $this->redirect('site/dashboard');
                }
        }

        public function SaveBankDetails($model, $data) {
                if ($data['BankAccounts']['bank_id'] == "Other") {
                        $model->bank_name = $data['BankAccounts']['bank_name'];
                        $model->country_id = $data['BankAccounts']['country_id'];
                } else {
                        $model->bank_id = $data['BankAccounts']['bank_id'];
                        $model->bank_name = $model->banks->bank_name;
                }
                $model->user_id = Yii::$app->session['user_session']['id'];
                $model->date = date('Y-m-d');
                $model->status = 1;
                if ($model->save()) {
                        $this->ChequeDetails($model); /* to add cheque book details to cheques table */
                        if ($model->bank_id != 0) {
                                $id = $model->id; /* bank account id */
                                $this->SaveDesignData($id); /* save design to cheque design from master cheque design table */
                        }
                }
                return $model;
        }

        public function ListBanks($model) {
               unset(Yii::$app->session['queryparams']);
		$searchModel = new BankAccountsSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		Yii::$app->session['queryparams'] = Yii::$app->request->queryParams;
		$dataProvider->query->andWhere(['user_id' => Yii::$app->session['user_session']['id']])->orderBy(['id' => SORT_DESC]);
$dataProvider->pagination->pageSize = 20;
		return $this->render('index', [
			    'searchModel' => $searchModel,
			    'dataProvider' => $dataProvider,
			    'model' => $model
		]);
        }

        /**
         * Updates an existing BankAccounts model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post()) /* && $model->save() */) {
                        //$model->status = Yii::$app->request->post()['BankAccounts']['status'];
$model->bank_name = Yii::$app->request->post()['BankAccounts']['bank_name'];
                        $model->status = 1;
                        if ($model->save())
                                return $this->redirect(['index']);
                } else {
                        return $this->render('update', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Deletes an existing BankAccounts model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
             $model = $this->findModel($id);
		if (!empty($model)) {
			$cheques = Cheques::find()->where(['bank_id' => $id])->all();
			$cheque_desig = ChequeDesigns::find()->where(['bank_accounts_id' => $id])->one();
			$modelprints = ChequePrint::find()->where(['bank_account_id' => $id])->all();
			if (empty($modelprints)) {
				if (!empty($cheques)) {
					foreach ($cheques as $cheque) {
						$cheque->delete();
					}
				}
				if (!empty($cheque_desig)) {
					$path = 'img/cheque-images/' . $cheque_desig->id . '.' . $cheque_desig->cheque_image;
					if (file_exists($path)) {
						unlink($path);
					}
					$cheque_desig->delete();
					Yii::$app->getSession()->setFlash('success', 'succuessfully deleted');
				}

				$model->delete();
			} else {
				Yii::$app->getSession()->setFlash('error', "Can't delete the Bank Account");
			}
		}

		return $this->redirect(['index']);
        }

        /**
         * Finds the BankAccounts model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return BankAccounts the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        public function ChequeDetails($model) {
                $cheque = new Cheques();
                $cheque->user_id = Yii::$app->session['user_session']['id'];
                $cheque->bank_id = $model->id;
                $cheque->cheque_series_starting_number = $model->cheque_series_starting_number;
                $cheque->number_of_cheques = $model->number_of_cheques;
                $cheque->cheques_left = $model->number_of_cheques;
                $cheque->status = 1;
                $cheque->CB = Yii::$app->session['user_session']['id'];
                $cheque->DOC = date('y-m-d');
                $cheque->save();
        }

        public function SaveDesignData($id) {
                $model = $this->findModel($id); /* $model implies bank account model insatnce */
                $bank_details = \common\models\MasterBank::find()->where(['id' => $model->bank_id])->one();
                $master_cheque_design = \common\models\MasterChequeDesign::find()->where(['master_bank_id' => $bank_details->id])->one();
               if (empty($master_cheque_design)) {
			return $this->redirect(Yii::$app->homeUrl . 'dashboard/new-design?id=' . $model->id);
		} else {
			$image_path = \Yii::$app->basePath . '/../admin/uploads/cheque-images/' . $master_cheque_design->id . '.' . $master_cheque_design->cheque_image;
		}
                if ((!empty($bank_details)) && (!empty($master_cheque_design))) {
                        $new_design = new ChequeDesigns;
                        $new_design->user_id = Yii::$app->session['user_session']['id'];
                        $new_design->bank_accounts_id = $id;
                        $new_design->cheque_image = $master_cheque_design->cheque_image;
                        $new_design->field_7 = $master_cheque_design->cheque_datas;
                        $new_design->status = 3; /* status one means design is uploadeed */
                        $new_design->date = date('Y-m-d');

                        $image_path = \Yii::$app->basePath . '/../admin/uploads/cheque-images/' . $master_cheque_design->id . '.' . $master_cheque_design->cheque_image;
                        if ($new_design->save()) {
                                $new_path = \Yii::$app->basePath . '/../img/cheque-images/' . $new_design->id . '.' . $new_design->cheque_image;
                                copy($image_path, $new_path);
                                return $this->redirect(Yii::$app->request->referrer);
                        }
                } else {
                        return $this->redirect('site/error');
                }
        }

public function actionExport() {
		$searchModel = new BankAccountsSearch();
		$queryparams = Yii::$app->session['queryparams'];
		if (!empty($queryparams)) {
			$dataProvider = $searchModel->search($queryparams);
		} else {
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		}
		$dataProvider = $searchModel->search($queryparams);
		$dataProvider->query->andWhere(['user_id' => Yii::$app->session['user_session']['id']]);
		return ExcelView::widget([
			    'dataProvider' => $dataProvider,
			    'filterModel' => $searchModel,
			    'fullExportType' => 'xlsx', //can change to html,xls,csv and so on
			    'grid_mode' => 'export',
			    'columns' => [
				    ['class' => 'yii\grid\SerialColumn'],
				'user_id',
				'bank_name',
				'branch',
				    [
				    'attribute' => 'country_id',
				],
				'city',
				'account_name',
				'account_number',
			    ],
		]);
	}

        protected function findModel($id) {
                if (($model = BankAccounts::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

        public function actionSelectBank() {
                if (Yii::$app->request->isAjax) {
                        $bank_id = $_POST['bank_id'];
                        if ($bank_id != 'Other')
                                $bank_name = MasterBank::findOne($bank_id)->bank_name;
                        return $bank_name;
                }
        }

}

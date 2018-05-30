<?php

namespace frontend\modules\bankaccounts\controllers;

use Yii;
use common\models\BankAccounts;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Cheques;
use common\models\ChequesSearch;
use common\models\ChequeDesigns;
use common\models\ChequePrint;

class ChequeController extends Controller {

        public $layout = '@app/views/layouts/dashboard';

        public function behaviors() {
                return [
                    'verbs' => [
                        'class' => VerbFilter::className(),
                        'actions' => [
                            //'delete' => ['POST'],
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


        public function actionCheques($id) {
                $bank_details = $this->findModel($id);
                $model = new Cheques();
                if (!empty(Yii::$app->session['user_session'])) {

                        if ($model->load(Yii::$app->request->post()) && $bank_details->status != 0) {

                                $this->SaveCheque($model, $bank_details);

                                return $this->redirect(Yii::$app->request->referrer);
                        } else {
                                if ($bank_details->status == 0) {
                                        Yii::$app->getSession()->setFlash('error', 'Bank  Account is Disabled');
                                        return $this->ChequesIndex($id, $bank_details, $model);
                                } else {
                                        return $this->ChequesIndex($id, $bank_details, $model);
                                }
                        }
                } else {
                        $this->redirect('site/index');
                }
        }

        public function ChequesIndex($id, $bank_details, $model) {
                $searchModel = new ChequesSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['user_id' => Yii::$app->session['user_session']['id']]);
                $dataProvider->query->andWhere(['bank_id' => $id]);
                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                            'model' => $model,
                            'bank_details' => $bank_details,
                ]);
        }

        public function SaveCheque($model, $bank_details) {
                $model->user_id = Yii::$app->session['user_session']['id'];
                $model->bank_id = $bank_details->id;
                $model->cheque_series_starting_number = $model->cheque_series_starting_number;
                $model->number_of_cheques = $model->number_of_cheques;
                $model->cheques_left = $model->number_of_cheques;
                $model->status = 1;
                $model->CB = Yii::$app->session['user_session']['id'];
                $model->DOC = date('y-m-d');
                $model->save();
        }

        public function actionCheckDesign($id) {

                $model = ChequeDesigns::find()->where(['bank_accounts_id' => $id])->one();

                if (empty($model)) {
                        return $this->redirect(['new-design', 'id' => $id]);
                } else {
                        return $this->redirect(['more-details', 'id' => $model->id]);
                }
        }

        public function actionNewDesign($id) {
                $model = new ChequeDesigns;
                if ($model->load(Yii::$app->request->post())) {
                        $image = UploadedFile::getInstance($model, 'cheque_image');
                        $model = $this->CreateLayout($model, $id, $image);
                        if ($model->validate()) {
                                $model->save();
                        } else {
                                return $this->render('new-designs', [
                                            'model' => $model,
                                ]);
                        }

                        if (!empty($image)) {

                                $image->saveAs('img/cheque-images/' . $model->id . '.' . $model->cheque_image);
                                return $this->redirect(['set-design', 'id' => $model->id]);
                        } else {
                                return $this->render('new-designs', [
                                            'model' => $model,
                                ]);
                        }
                } else {
                        return $this->render('new-designs', [
                                    'model' => $model,
                        ]);
                }
        }

        public function actionSetDesign($id) {
                $model = $this->findModel($id);
                $path = Yii::$app->homeUrl . 'img/cheque-images/' . $model->id . '.' . $model->cheque_image;
                return $this->render('set_image', [
                            'path' => $path,
                            'model' => $model,
                ]);
        }

        public function CreateLayout($model, $id, $image) {

                $model->bank_accounts_id = $id;
                $model->cheque_image = $image->extension;
                $model->user_id = Yii::$app->session['user_session']['id'];
                $model->date = date('y-m-d');
                $data = [];
                $data['cheque_date'] = ['top' => '10%', 'left' => '50%', 'letter-spacing' => '10'];
                $data['cheque_name'] = ['top' => '69px', 'left' => '83px'];
                $data['rupee_word'] = ['top' => '76px', 'left' => '150px', 'text-indent' => '40', 'line-height' => '20'];
                $data['rupee_num'] = ['top' => '146px', 'left' => '584px', 'text-index' => ''];
                $data['acc_num'] = ['top' => '103px', 'left' => '135px', 'text-index' => ''];
                $data['bearer'] = ['top' => '139px', 'left' => '77px', 'text-index' => ''];
                \Yii::$app->response->format = 'json';
                $model->field_7 = Json::encode($data);
                $model->status = 1;
                return $model;
        }

        protected function findModel($id) {
                if (($model = BankAccounts::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

        public function actionDelete($id) {
               
                $model = Cheques::findOne($id);
                $bank_id = $model->bank_id;
               $chequeprints = ChequePrint::find()->where(['cheque_book_id' => $id])->one();
        if (!empty($chequeprints)) {
            Yii::$app->getSession()->setFlash('error', "Can't delete the Cheque Book");
        }
        else {
            $model->delete();
        }
                return $this->redirect(['cheques', 'id' => $bank_id]);
        }

}

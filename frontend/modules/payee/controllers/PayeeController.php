<?php

namespace frontend\modules\payee\controllers;

use Yii;
use common\models\Payee;
use common\models\PayeeSearch;
use common\models\ChequePrint;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use arturoliveira\ExcelView;

/**
 * PayeeController implements the CRUD actions for Payee model.
 */
class PayeeController extends Controller {

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
         * Lists all Payee models.
         * @return mixed
         */
        public function actionIndex() {
                
                if (isset($_GET['id'])) {
                $id = $_GET['id'];
                        $model = $this->findModel($id);
                } else {
                        $model = new Payee();
                        $model->setScenario('create');
                }


                if (!empty(Yii::$app->session['user_session'])) {
                        if ($model->load(Yii::$app->request->post())) {

                                $files = UploadedFile::getInstance($model, 'upload_pan_copy');
                                $this->setvalues($model);
                                $model->user_id = Yii::$app->session['user_session']['id'];
                                $model->date = date('Y-m-d');
                                $model->status = 1;
$model->save();
                               return $this->redirect('index');
//                                if (!empty($files)) {
//                                        $model->upload_pan_copy = $files->extension;
//                                        $model->save();
//                                        $this->Upload($model, $files);
//                                        return $this->redirect('index');
//                                } else {
//                                        $update = Payee::findOne($id);
//                                        $model->upload_pan_copy = $update->upload_pan_copy;
//                                        $model->save();
//                                        return $this->redirect('index');
//                                }
                        } else {
                                return $this->conditionfails($model);
                        }
                } else {
                        $this->redirect('site/index');
                }
        }

        public function setvalues($model) {
                $model->user_id = Yii::$app->session['user_session']['id'];
                $model->date = date('Y-m-d');
                return TRUE;
        }

        public function upload($model, $files) {

                $paths = Yii::$app->basePath . '/web/uploads/pan_cards/';
                if (!is_dir($paths)) {
                        mkdir($paths);
                }
                $path = $paths . '/' . $model->id . '.' . $files->extension;
//                if (file_exists($path)) {
//                        unlink($path);
//                }
                $files->saveAs($path);
                return true;
        }

       public function conditionfails($model) {
		unset(Yii::$app->session['payeedata']);
		$searchModel = new PayeeSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		Yii::$app->session['payeedata'] = Yii::$app->request->queryParams;
		$dataProvider->query->andWhere(['user_id' => Yii::$app->session['user_session']['id']]);
$dataProvider->pagination->pageSize = 20;
		return $this->render('index', [
			    'searchModel' => $searchModel,
			    'dataProvider' => $dataProvider,
			    'model' => $model
		]);
	}

        /**
         * Displays a single Payee model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new Payee model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new Payee();

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Updates an existing Payee model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        return $this->render('update', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Deletes an existing Payee model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDel($id) {
                $model = $this->findModel($id);
		$path = Yii::$app->basePath . '/web/uploads/pan_cards/' . $model->id . '.' . $model->upload_pan_copy;
		$check_prints = ChequePrint::find()->where(['payee_id' => $id])->all();
		if (!empty($check_prints)) {
			Yii::$app->getSession()->setFlash('error', "Can't remove the payee");
		} else {
			if (file_exists($path)) {
				unlink($path);
			} $model->delete();
		}
		return $this->redirect(['index']);
        }

        /**
         * Finds the Payee model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return Payee the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = Payee::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }
public function actionExport() {
		$searchModel = new PayeeSearch();
		$queryparams = Yii::$app->session['payeedata'];
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
				'payee_name',
				'city',
				'phone',
				    [
				    'attribute' => 'email',
				],
				'pan_number',
			    ],
		]);
	}

}

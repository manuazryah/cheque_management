<?php

namespace backend\modules\masters\controllers;

use Yii;
use common\models\MasterBank;
use common\models\MasterBankSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\MasterChequeDesign;
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\imagine\Image;
use Imagine\Image\Box;

/**
 * MasterBankController implements the CRUD actions for MasterBank model.
 */
class MasterBankController extends Controller {

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

        /**
         * Lists all MasterBank models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new MasterBankSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single MasterBank model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new MasterBank model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new MasterBank();
                $model->setScenario('create');

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->save()) {
                        return $this->redirect(['master-cheque-design/check-design', 'id' => $model->id]);
                } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Updates an existing MasterBank model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->save()) {
                        return $this->redirect(['index']);
                } else {
                        return $this->render('update', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Deletes an existing MasterBank model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();


                return $this->redirect(['index']);
        }

        public function actionCheckDesign($id) {
                $masterBanks = $this->findModel($id);

                if (!empty($masterBanks)) {
                        $model = ChequeDesigns::find()->where(['mastre_bank_id' => $id])->one();
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

        /**
         * Finds the MasterBank model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return MasterBank the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = MasterBank::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}

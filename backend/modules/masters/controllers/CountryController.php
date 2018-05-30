<?php

namespace backend\modules\masters\controllers;

use Yii;
use common\models\Country;
use common\models\CountrySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\BankAccounts;
use common\models\MasterBank;

/**
 * CountryController implements the CRUD actions for Country model.
 */
class CountryController extends Controller {

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
         * Lists all Country models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new CountrySearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$dataProvider->pagination->pageSize = 20;

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single Country model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new Country model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new Country();

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->save()) {
                        return $this->redirect(['index']);
                } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Updates an existing Country model.
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
         * Deletes an existing Country model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
       public function actionDelete($id) {
		$model = $this->findModel($id);
		$bank_accounts = BankAccounts::find()->where(['country_id' => $id])->all();
		$master_banks = MasterBank::find()->where(['country_id' => $id])->all();
		if (!empty($bank_accounts) || !empty($master_banks)) {
			Yii::$app->getSession()->setFlash('error', "Can't delete the Country");
			return $this->redirect(['index']);
		} else {
			$model->delete();
		}

		return $this->redirect(['index']);
	}

        /**
         * Finds the Country model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return Country the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = Country::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}

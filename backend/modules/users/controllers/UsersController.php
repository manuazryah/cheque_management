<?php

namespace backend\modules\users\controllers;

use Yii;
use common\models\Users;
use common\models\UsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\UserPlans;
use common\models\Payee;
use common\models\EmiCheques;
use common\models\ChequePrint;
use common\models\ChequeDesigns;
use common\models\Cheques;
use common\models\BankAccounts;
use common\models\MasterPlans;
use common\models\UserPlanHistory;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller {

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
         * Lists all Users models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new UsersSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$dataProvider->pagination->pageSize = 20;
                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single Users model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new Users model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new Users();
                $model->setScenario('create');
                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
                        if ($model->validate()) {
                                if ($model->save()) {
                                        $this->addplan($model);
                                }
                                $model->DOC = date('Y-m-d');
                                $plans = MasterPlans::find()->where(['id' => $model->plan])->one();
                                $days = $plans->valid_days;
                                $model->plan_end_date = date('Y-m-d', strtotime("+" . $days . " days"));
                                $model->email_verification = 1;
                                $model->last_login = date('Y-m-d');
                                $model->save();
                                return $this->redirect(['view', 'id' => $model->id]);
                        } else {
                                return $this->render('create', [
                                            'model' => $model,
                                ]);
                        }
                } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Updates an existing Users model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {

                        if (Yii::$app->request->post()['Users']['plan'] != 1) {
                                $model->plan = Yii::$app->request->post()['Users']['plan'];
                                $plans = MasterPlans::find()->where(['id' => $model->plan])->one();
                                $days = $plans->valid_days;
                                $model->plan_end_date = date('Y-m-d', strtotime("+" . $days . " days"));
                                $model->update();
                                $model_plan = $this->addplan($model);
                                $model->plan_end_date = $model_plan->plan_end_date;
                                $model->save();
                                return $this->redirect(['view', 'id' => $model->id]);
                        } else {
                                $check = UserPlanHistory::find()->where(['user_id' => $id, 'plan_id' => 1])->all();
                                if (!empty($check)) {
                                        //Yii::$app->session->setFlash('error', 'standard plan has been choosed');
$model->plan = 1;
					$model->save();
                                        return $this->redirect(Yii::$app->request->referrer);
                                } else {
                                        $model->save();
                                        return $this->redirect(['view', 'id' => $model->id]);
                                }
                        }
                } else {
                        return $this->render('update', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * when a new user is created plan shoulbe be saved in user plans table for checking plan validity
         */
        public function addplan($data) {
                $model_plan = UserPlans::find()->where(['user_id' => $data->id])->one();
                if (empty($model_plan)) {
                        $model_plan = new UserPlans();
                }
                $plan_details = MasterPlans::find()->where(['id' => $data->plan])->one();
                $model_plan->plan_name = $plan_details->plan_name;
                $model_plan->user_id = $data->id;
                $model_plan->plan_id = $data->plan;
                $model_plan->valid_days = $plan_details->valid_days;
                $model_plan->amount = $plan_details->amount;
                $model_plan->date = date('Y-m-d');
                $start = $model_plan->date;
                $valid = $model_plan->valid_days;
                $newdate = strtotime('+' . $valid . 'days', strtotime($start));
                $model_plan->plan_end_date = date('Y-m-j', $newdate);
                $model_plan->status = 1;
                $model_plan->save();
                $this->planhistory($model_plan);
                return $model_plan;
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

        /**
         * Deletes an existing Users model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $modeluser = Users::findOne($id);
                $modelplan = UserPlans::find()->where(['user_id' => $modeluser->id])->one();
                $modelpayee = Payee::find()->where(['user_id' => $modeluser->id])->one();
                $modelemi = EmiCheques::find()->where(['user_id' => $modeluser->id])->one();
                $modelprint = ChequePrint::find()->where(['user_id' => $modeluser->id])->one();
                $modeldesign = ChequeDesigns::find()->where(['user_id' => $modeluser->id])->one();
                $modelcheque = Cheques::find()->where(['user_id' => $modeluser->id])->one();
                $modelbank = BankAccounts::find()->where(['user_id' => $modeluser->id])->one();



                // ...other DB operations...
// or alternatively

                $transaction = Users::getDb()->beginTransaction();
                try {
                        if (!empty($modeluser)) {
                                $modeluser->delete();
                        }
                        if (!empty($modelplan)) {
                                $modelplan->delete();
                        }
                        if (!empty($modelpayee)) {
                                $modelpayee->delete();
                        }
                        if (!empty($modelemi)) {
                                $modelemi->delete();
                        }
                        if (!empty($modelprint )) {
                                $modelprint ->delete();
                        }
                        if (!empty($modeldesign)) {
                                $modeldesign->delete();
                        }
                        if (!empty($modelcheque)) {
                                $modelcheque->delete();
                        }
                        if (!empty($modelbank)) {
                                $modelbank->delete();
                        }

                        // ...other DB operations...
                        $transaction->commit();
                } catch (\Exception $e) {
                        $transaction->rollBack();
                        throw $e;
                } catch (\Throwable $e) {
                        $transaction->rollBack();
                        throw $e;
                }
Yii::$app->getSession()->setFlash('success', 'succuessfully deleted');
		return $this->redirect(['index']);
        }

        /**
         * Finds the Users model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return Users the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = Users::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

        public function setvalues($model) {

                if ($model != null) {
                        Yii::$app->SetValues->Attributes($model);

                        $model->password = Yii::$app->security->generatePasswordHash($model->password);

                        return true;
                } else {
                        return false;
                }
        }

}

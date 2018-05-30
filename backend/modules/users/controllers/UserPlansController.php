<?php

namespace backend\modules\users\controllers;

use Yii;
use common\models\UserPlans;
use common\models\UserPlansSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\MasterPlans;
use common\models\UserPlanHistory;

/**
 * MasterPlansController implements the CRUD actions for MasterPlans model.
 */
class UserPlansController extends Controller {

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
         * Lists all MasterPlans models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new UserPlansSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$dataProvider->pagination->pageSize = 20;

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single MasterPlans model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new MasterPlans model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
//        public function actionCreate() {
//                $model = new UserPlans();
//
//                $model->setScenario('create');
//                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
//                        $model->save();
//
//                        return $this->redirect(['view', 'id' => $model->id]);
//                } else {
//                        return $this->render('create', [
//                                    'model' => $model,
//                        ]);
//                }
//        }

        /**
         * Updates an existing MasterPlans model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {

                        $startTimeStamp = strtotime($model->date);
                        $endTimeStamp = strtotime($model->plan_end_date);

                        $timeDiff = abs($endTimeStamp - $startTimeStamp);
                        $numberDays = $timeDiff / 86400;  // 86400 seconds in one day
                        $numberDays = intval($numberDays);
                        $currnt_date = date('Y-m-d');
			if ($currnt_date >= $model->plan_end_date)
				$model->valid_days = 0;
			else {
				$model->valid_days = $numberDays + 1;
			}
                        $model->save();
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        return $this->render('update', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Deletes an existing MasterPlans model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the MasterPlans model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return MasterPlans the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = UserPlans::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

        /*
         * Upgrade User Plans
         * Get user plan details from user plans and go to upgrade palan page
         * Then upgrade the existing user plan
         */

        public function actionUpgrade($id) {
                $model = $this->findModel($id);
$check = \common\models\UserPlanHistory::find()->where(['user_id' => $model->user_id, 'plan_id' => 1])->all();
		if (!empty($check)) {
			$posts = MasterPlans::find()->where(['status' => 1])->andWhere(['<>', 'id', 1])->all();
		} else {
			$posts = MasterPlans::find()->where(['status' => 1])->all();
		}
                if (Yii::$app->request->post()) {
                        $upgrade_id = Yii::$app->request->post('upgrade-plan');
                        $master_plans = MasterPlans::find()->where(['id' => $upgrade_id])->one();
                        $model->plan_name = $master_plans->plan_name;
                        $model->plan_id = $master_plans->id;
                        $model->valid_days = $master_plans->valid_days;
                        $model->amount = $master_plans->amount;
                        $model->date = date('Y-m-d');
                        $start = $model->date;
                        $valid = $model->valid_days;
                        $newdate = strtotime('+' . $valid . 'days', strtotime($start));
                        $model->plan_end_date = date('Y-m-j', $newdate);
                        if ($model->save()) {
$this->planhistory($model);
                                Yii::$app->getSession()->setFlash('success', 'Plan has updated successfully');
                        }
                        return $this->redirect(['index', 'id' => $model->id]);
                }
                return $this->render('upgrade', [
                            'model' => $model,
 'posts' => $posts,
                ]);
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

}

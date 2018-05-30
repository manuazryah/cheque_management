<?php

namespace backend\modules\masters\controllers;

use Yii;
use common\models\MasterPlans;
use common\models\MasterPlansSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MasterPlansController implements the CRUD actions for MasterPlans model.
 */
class MasterPlansController extends Controller {

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
                $searchModel = new MasterPlansSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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
        public function actionCreate() {
                $model = new MasterPlans();
                $model->setScenario('create');
                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Updates an existing MasterPlans model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->save()) {
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
              $model = $this->findModel($id);
		$plan_history = \common\models\UserPlans::find()->where(['plan_id' => $id])->all();
		if (empty($plan_history))
			$model->delete();
		else {
			Yii::$app->getSession()->setFlash('error', "Can't delete the plan");
			return $this->redirect(['index']);
		}
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
                if (($model = MasterPlans::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}

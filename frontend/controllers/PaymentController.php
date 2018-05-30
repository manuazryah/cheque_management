<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\MasterPlans;

class PaymentController extends \yii\web\Controller {

    public function actionIndex($upgrade_id, $user_id) {
        $plan_details = MasterPlans::find()->where(['id' => $upgrade_id])->one();
        $data = [$upgrade_id, $user_id, $plan_details->plan_name, $plan_details->amount];
        Yii::$app->session['payment'] = $data;
        return $this->redirect('payment');
    }

    public function actionPayment() {
         return $this->renderPartial('index');
    }
public function actionFailed() {
        return $this->render('failed');
    }

}

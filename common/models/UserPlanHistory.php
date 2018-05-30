<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_plan_history".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $plan_id
 * @property string $plan_date
 * @property string $plan_end_date
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class UserPlanHistory extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'user_plan_history';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'plan_id', 'plan_date', 'plan_end_date'], 'required'],
            [['user_id', 'plan_id', 'CB', 'UB'], 'integer'],
            [['plan_date', 'plan_end_date', 'DOC', 'DOU'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'plan_id' => 'Plan ID',
            'plan_date' => 'Plan Date',
            'plan_end_date' => 'Plan End Date',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

    public function getPlans() {

        return $this->hasOne(MasterPlans::className(), ['id' => 'plan_id']);
    }

}

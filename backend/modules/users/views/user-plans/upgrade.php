<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\MasterPlans;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\MasterPlans */

$this->title = 'Upgrade User Plans: ' . $model->username->company_name;
$this->params['breadcrumbs'][] = ['label' => 'User Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                                <div class="panel-options">
                                        <a href="#" data-toggle="panel">
                                                <span class="collapse-icon">&ndash;</span>
                                                <span class="expand-icon">+</span>
                                        </a>
                                        <a href="#" data-toggle="remove">
                                                &times;
                                        </a>
                                </div>
                        </div>
                        <div class="panel-body">
                                <div class="panel-body"><div class="user-plans-create">
                                                <?php if (Yii::$app->session->hasFlash('success')): ?>
                                                        <div class="alert alert-success" role="alert">
                                                                <?= Yii::$app->session->getFlash('success') ?>
                                                        </div>
                                                <?php endif; ?>
                                                <div class="upgrade-plan-form form-inline">
                                                        <?php
                                                        $form = ActiveForm::begin(
                                                                        [
                                                                            'id' => 'upgrade-plan',
                                                                            'method' => 'post',
                                                                        ]
                                                        );
                                                        ?>
                                                        <?php
                                                       // $posts = MasterPlans::findAll(['status' => 1]);
                                                        ?>
                                                        <div class="form-group">
                                                                <label class="control-label" for="users-plan">Plan</label>
                                                                <select id="users-plan" class="form-control" name="upgrade-plan">
                                                                        <option value="">-Choose a Plan-</option>
                                                                        <?php
                                                                        foreach ($posts as $post) {
                                                                                ?>
                                                                                <option value="<?= $post->id ?>"><?= $post->plan_name ?></option>
                                                                                <?php
                                                                        }
                                                                        ?>
                                                                </select>

                                                                <div class="help-block"></div>
                                                        </div>
                                                        <div class="form-group" style="margin-top: 18px;">
                                                                <button type="submit" class="btn btn-primary">Upgrade Plan</button></div>
                                                                <?php ActiveForm::end(); ?>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MasterPlans;
use yii\helpers\ArrayHelper;
use common\models\Country;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Users */

$this->title = 'Remove Printed Cheque History';

?>
<style>
        hr{
                margin-top: 10px;
                margin-bottom: 17px;
                border: 0;
                border-top: 3px solid rgba(39, 41, 42, 0.46);
        }
        .panel .panel-heading{
                border-bottom: none;
        }
</style>
<!--<div class="row">-->
<!--<div class="col-md-12">-->
<div class="container">
        <div class="row">
                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h1 style="font-size: 20px"><?= Html::encode($this->title) ?></h1>
                                <hr>
                                <?php if (Yii::$app->session->hasFlash('success')): ?>
                                        <div class="alert alert-success" role="alert" style="/*color: #cc3f44;border: 1px solid transparent;
                                             border-radius: 0;margin: -4px;*/">
                                             <?= Yii::$app->session->getFlash('success') ?>
                                        </div>
                                <?php endif; ?>

                        </div>

                        <div class="panel-body">

                                <div class="panel-body"><div class="users-create">
                                                <div class="users-form form-inline">

                                                        <?= Html::beginForm(['dashboard/remove-cheque'], 'post', array('id' => 'formId')) ?>

                                                        <div class="form-group ">
                                                                <label class="control-label">From Date:</label>
                                                                <?php
                                                                echo DatePicker::widget([
                                                                    'name' => 'from_date',
                                                                    'id' => 'print-from-date',
                                                                    'value' => date('Y-m-d'),
                                                                    'dateFormat' => 'yyyy-MM-dd',
                                                                    'options' => ['class' => 'form-control']
                                                                ]);
                                                                ?>
                                                        </div><div class="form-group ">
                                                                <label class="control-label"> To Date::</label>
                                                                <?php
                                                                echo DatePicker::widget([
                                                                    'name' => 'to_date',
                                                                    'id' => 'print-to-date',
                                                                    'value' => date('Y-m-d'),
                                                                    'dateFormat' => 'yyyy-MM-dd',
                                                                    'options' => ['class' => 'form-control']
                                                                ]);
                                                                ?>
                                                        </div>
                                                        <div class="form-group "></div>

                                                        <?= Html::submitButton('<span>Delete</span>', ['class' => 'btn btn-secondary', 'name' => 'submit', 'id' => 'delete-data']) ?>
                                                        <?= Html::endForm() ?>

                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>
<script>
        $(document).ready(function () {
                $("#formId").submit(function () {
                        var r = confirm("Are you sure you want to delete print cheque history?!");
                        if (r == true) {
                                return true;
                        } else {
                                return false;
                        }
                });
        });
</script>
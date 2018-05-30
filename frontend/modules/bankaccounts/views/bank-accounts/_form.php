<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MasterBank;
use yii\helpers\ArrayHelper;
use common\models\Country;

/* @var $this yii\web\View */
/* @var $model common\models\BankAccounts */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
        .another_bank{
                color: #ea1714;
                font-size: 17px;
        }


</style>

<div class="bank-accounts-form <?php if (!empty($_GET['id'])) { ?>form-inline<?php } ?>">
        <?php $form = ActiveForm::begin(); ?>

        <?php // $form->errorSummary($model);   ?>

        <?php // $form->field($model, 'user_id')->textInput()   ?>

        <?php
        if ($model->isNewRecord) {

               $banks = ArrayHelper::map(MasterBank::find()->where(['status' => 1])->orderBy('bank_name')->all(), 'id', 'bank_name');
                $banks['Other'] = 'Add Another Bank';
                //$banks = array_merge($bank, array('Other' => 'Add Another Bank'));
                echo $form->field($model, 'bank_id')->dropDownList($banks, ['prompt' => '-Choose a Bank-']);
        }
        ?>
        <!--	<div class="form-group">
        <?php // Html::a('Another Bank', $url = '#', $options = ['id' => 'another', 'class' => 'another_bank'])   ?>
                </div>-->

        <?= $form->field($model, 'bank_name', ['options' => ['class' => 'form-group', 'id' => 'test']])->textInput(['maxlength' => true]) ?>

        <?php
       $countries = ArrayHelper::map(Country::find()->where(['status' => 1])->orderBy('country_name')->all(), 'id', 'country_name');
        echo $form->field($model, 'country_id')->dropDownList($countries, ['prompt' => '-Choose a country-']);
        ?>
        <?= $form->field($model, 'branch')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'account_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'account_number')->textInput(['maxlength' => true]) ?>
        <?php if ($model->isNewRecord) {
                ?>
                <?= $form->field($model, 'cheque_series_starting_number')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'number_of_cheques')->textInput() ?>
                <?php
        }
        ?>

        <?php //$form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>
        <div class="form-group"></div>
        <div class="form-group"></div>

        <div class="form-group" style="float:right;">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

</div>

<script>

        $(document).ready(function () {
<?php if ($model->isNewRecord) { ?>
                        $('.field-bankaccounts-bank_name').hide();
                        $('.field-bankaccounts-status').hide();
<?php } ?>
                $("#another").click(function () {
                        $('.field-bankaccounts-bank_name').show();
                        $('.field-bankaccounts-bank_id').hide();
                        $('#another').hide();
                });
                $("#bankaccounts-bank_id").change(function () {
                        if ($("#bankaccounts-bank_id option:selected").val() === 'Other') {
                                $('.field-bankaccounts-bank_id').hide();
                                $('.field-bankaccounts-bank_name').show();
                        }
                });
                $("#bankaccounts-bank_id").change(function () {
                        var bank_id = $(this).val();
                        $.ajax({
                                type: 'POST',
                                cache: false,
                                data: {bank_id: bank_id},
                                url: '<?php echo Yii::$app->homeUrl . 'bankaccounts/bank-accounts/select-bank' ?>',
                                success: function (data) {
                                        if (bank_id != 'Other') {
                                                $('#bankaccounts-bank_name').val(data);
                                        } else {
                                                $('#bankaccounts-bank_name').val('');
                                        }
                                }
                        });
                });

        });
</script>

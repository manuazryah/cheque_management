<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use common\models\Cheques;
use common\models\ChequePrint;

/* @var $this yii\web\View */
/* @var $model common\models\Users */

$this->title = 'Add EMI Cheque Datas';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<style>
	hr{
                margin-top: 10px;
                margin-bottom: 28px;
                border: 0;
                border-top: 3px solid rgba(39, 41, 42, 0.46);
        }
	.index_numbering{
		font-size: 16px;
		font-weight: bold;
	}
</style>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                               <h1 style="font-size: 20px"><?= Html::encode($this->title) ?></h1>
			<hr>

                        </div>
                        <?php
                        $cheques = Cheques::find()->where(['bank_id' => $model->bank_account_id, 'status' => 1])->all();
                        $prints = ChequePrint::find()->where(['bank_account_id' => $model->bank_account_id])->all();
                        $arr = array();
                        $check_no = array();
                        foreach ($prints as $value) {
                                $check_no[] = $value->cheque_number;
                        }
                        foreach ($cheques as $cheque) {
$id = $cheque->id;
                                $i = $cheque->cheque_series_starting_number;
                                $j = 1;
                                while ($j <= $cheque->number_of_cheques) {
                                        if (!in_array($i, $check_no)) {
                                               $arr[] = $i . '_' . $id;
                                        } $i++;
                                        $j++;
                                }
                        }
                        //array_unshift($arr, (int) $model->cheque_number);
                        ?>
                        <div class="panel-body">
                                <div class="panel-body"><div class="users-create">
                                                <div class="users-form form-inline">
                                                        <form action="<?= Yii::$app->homeUrl; ?>printcheque/print-cheque/print?id=<?= $_GET['id'] ?>" method="post">
                                                                <?php
                                                                for ($i = 1; $i <= $model->no_of_emi_cheques; $i++) {
                                                                        ?>
                                                                        <span class="index_numbering"><?= $i . '.'; ?></span>
                                                                        <div class="form-group ">
                                                                                <label class="control-label" for="">Cheque Date</label>
                                                                                <?php
                                                                                echo DatePicker::widget([
                                                                                    'name' => 'cheuqe_date[' . $i . ']',
//                                                                                    'id' => 'cheuqe_date[' . $i . ']',
                                                                                    'value' => date('Y-m-d'),
                                                                                    'dateFormat' => 'dd-MM-yyyy',
                                                                                    'options' => ['class' => ' form-control '],
//                                                                                    'containerOptions' => ['class' => 'form-control'],
                                                                                ]);
                                                                                ?>
                                                                                <div class="help-block"></div>
                                                                        </div>
                                                                        <div class="form-group ">
                                                                                <label class="control-label" for="">Cheque Amount</label>
                                                                                <input type="text" name="cheque_amount[<?= $i ?>]" id="cheque_amount[<?= $i ?>]" class="form-control" value="<?= $model->cheque_amount ?>">
                                                                                <div class="help-block"></div>
                                                                        </div>

                                                                        <div class="form-group ">
                                                                                <label class="control-label">Cheque Number</label>
                                                                                <select id="cheque-number" class="form-control positionTypes" name="cheque_num[<?= $i ?>]">
                                                                                        <option value="">- Select Check Number -</option>
                                                                                        <?php
											foreach ($arr as $value) {
$str = $value;
$array =  explode('_', $str );
												
												?>
												<option value="<?= $value ?>"><?= $array[0]?></option>0
												<?php
											}
											?>
                                                                                </select>
                                                                                <!--                <label class="control-label">CHEQUE NUMBER : </label>
                                                                                                <input type="text" id="cheque-number" class="form-control" name="cheque-number"   value="">-->
                                                                        </div>
                                                                        <?php
                                                                        echo '<br>';
                                                                }
                                                                ?>
                                                                <input type="submit" value="Submit" class="btn btn-primary" name="submit">
                                                        </form>

                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>
<script>
//        $(document).ready(function () {
//
//                $("select.positionTypes").change(function () {
//                        $("select.positionTypes option[value='" + $(this).data('index') + "']").prop('disabled', false);
//                        $(this).data('index', this.value);
//                        $("select.positionTypes option[value='" + this.value + "']:not([value=''])").prop('disabled', true);
//
//                });
//
//        });

</script>

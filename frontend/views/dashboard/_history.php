<?php

use yii\helpers\Html;
?>
<?php

$date = explode("-", $model->plan_date);
$enddate = explode("-", $model->plan_end_date);
$yrdata = strtotime($model->plan_date);
$end = strtotime($model->plan_end_date);
$month = date('M', $yrdata);
$endmonth = date('M', $end);
$year = date('Y', $yrdata);
$endy = date('Y', $end);
?>
<?= '<div style="padding: 5px;"> On ' . $date[2] . ' ' . $month . ' ' . $year . ' <span style="color: green;
    text-transform: uppercase;
    font-weight: bold;">' . $model->plans->plan_name . ' </span> plan ' . ' was selected, and the plan expired / will be expired on ' . $enddate[2] . '  ' . $endmonth . '  ' . $endy . '</div>' ?>


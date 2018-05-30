<?php
/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAssetDash;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use common\models\UserPlans;

AppAssetDash::register($this);
?>
<?php $this->beginPage() ?>

<?php
$plan_details = UserPlans::find()->where(['user_id' => Yii::$app->session['user_session']->id])->one();
?>
<html lang="en">
        <head>
                <?= Html::csrfMetaTags() ?>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">

                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <meta name="description" content="Xenon Boostrap Admin Panel" />
                <link rel="shortcut icon" href="<?= Yii::$app->homeUrl ?>img/favicon.png" type="image/x-icon" />
                <meta name="author" content="" />
                <title>G CheckManagement/admin</title>
                <script src="<?= Yii::$app->homeUrl; ?>admin/js/jquery-1.11.1.min.js"></script>

                <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
                <!--[if lt IE 9]>
                        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
                <![endif]-->
                <?= Html::csrfMetaTags() ?>
                <?php $this->head() ?>
        </head>
        <style>
                .list-li{
                        margin-right: 30px !important;
                }
                .home-logout{
                        margin-right: 100px !important;
                }
                @media(min-width:1411px){
                        .user-info-navbar .user-info-menu>li>a{padding: 30px 44px !important;;}
                }
                @media(min-width:1236px) and (max-width:1410px){
                        .user-info-navbar .user-info-menu>li>a{padding: 30px 6px !important;;}
                        .logo-margin{margin-left: 40px !important;}
                        .home-logout{
                                margin-right: 75px !important;
                        }
                }
                @media(min-width:992px) and (max-width:1235px){
                        .logo-margin { margin-left: 25px !important; width: 172px !important;;
                                       margin-top: 25px !important;;}
                        .user-info-navbar .user-info-menu>li>a{padding: 30px 6px !important;;}
                        .list-li {
                                margin-right: 0px !important;
                        }
                }
                footer.main-footer .go-up {
                        /*float: none !important;*/
                        margin-bottom: 20px;
                }

        </style>
        <body class="page-body">
                <?php $this->beginBody() ?>


                <div class="page-container">
                        <div class="sidebar-menu toggle-others fixed collapsed">

                                <div class="sidebar-menu-inner"  style="position: fixed;">
                                        <header class="logo-env">
                                                <!-- logo -->
                                                <div class="logo">
                                                        <a href="" class="logo-expanded">
                                                                <?php // echo Html::img('@web/admin/images/logo.png') ?>
                                                        </a>

                                                        <a href="<?= Yii::$app->homeUrl; ?>" class="logo-collapsed">
                                                                <?php //echo Html::img('@web/img/favicon.png') ?>

                                                        </a>
                                                </div>
                                                <!-- This will toggle the mobile menu and will be visible only on mobile devices -->
                                                <div class="mobile-menu-toggle visible-xs">
                                                        <a href="#" data-toggle="user-info-menu">
                                                                <i class="fa-bell-o"></i>
                                                                <span class="badge badge-success">7</span>
                                                        </a>

                                                        <a href="#" data-toggle="mobile-menu">
                                                                <i class="fa-bars"></i>
                                                        </a>
                                                </div>
                                                <!-- This will open the popup with user profile settings, you can use for any purpose, just be creative -->



                                        </header>
                                        <ul id="main-menu" class="main-menu">
                                                <li >
                                                        <a href="">
                                                                <i class="linecons-database"></i>
                                                                <span class="title">Bank</span>
                                                        </a>
                                                        <ul>
                                                                <li>
                                                                        <?= Html::a('Bank ', ['/bankaccounts/bank-accounts/index'], ['class' => 'title']) ?>
                                                                </li>
                                                        </ul>
                                                </li>
                                        </ul>
                                        <ul id="main-menu" class="main-menu">
                                                <li >
                                                        <a href="">
                                                                <i class="linecons-user"></i>
                                                                <span class="title">Payee</span>
                                                        </a>
                                                        <ul>
                                                                <li>
                                                                        <?= Html::a('Payee Details', ['/payee/payee/index'], ['class' => 'title']) ?>
                                                                </li>



                                                        </ul>
                                                </li>
                                        </ul>
                                        <ul id="main-menu" class="main-menu">
                                                <li >
                                                        <a href="">
                                                                <i class="fa fa-pencil-square-o"></i>
                                                                <span class="title">Edit Profile</span>
                                                        </a>
                                                        <ul>
                                                                <li>
                                                                        <?= Html::a('Edit Profile', ['/dashboard/edit-profile'], ['class' => 'title']) ?>
                                                                </li>



                                                        </ul>
                                                </li>
                                        </ul>
                                        <ul id="main-menu" class="main-menu">
                                                <li >
                                                        <a href="">
                                                                <i class="fa fa-file-text"></i>
                                                                <span class="title">Plan Details</span>
                                                        </a>
                                                        <ul>
                                                                <li>
                                                                        <?= Html::a('Plan Details', ['/dashboard/plan-details'], ['class' => 'title']) ?>
                                                                </li>



                                                        </ul>
                                                </li>
                                        </ul>
                                        <!--                                        <ul id="main-menu" class="main-menu">
                                                <li >
                                                        <a href="">
                                                                <i class="fa-rocket"></i>
                                                                <span class="title">Plan Details</span>
                                                        </a>
                                                        <ul>
                                                                <li>
									<?= Html::a('Upgrade Plan', ['/dashboard/upgrade-plan'], ['class' => 'title']) ?>
                                                                </li>



                                                        </ul>
                                                </li>
                                        </ul>-->
                                        <ul id="main-menu" class="main-menu">
                                                <li >
                                                        <a href="">
                                                                <i class="fa fa-trash-o"></i>
                                                                <span class="title">Remove Printed Cheque</span>
                                                        </a>
                                                        <ul>
                                                                <li>
                                                                        <?= Html::a('Remove Printed Cheque', ['/dashboard/remove-cheque'], ['class' => 'title']) ?>
                                                                </li>



                                                        </ul>
                                                </li>
                                        </ul>
                                        <ul id="main-menu" class="main-menu">
                                                <li >
                                                        <a href="">
                                                                <i class="fa fa-power-off"></i>
                                                                <span class="title">Logout</span>
                                                        </a>
                                                        <ul>
                                                                <li>
                                                                        <?= Html::a('Logout', ['/site/logout-user'], ['class' => 'title']) ?>
                                                                </li>



                                                        </ul>
                                                </li>
                                        </ul>
                                        <!--					<ul id="main-menu" class="main-menu">
                                                                                        <li >
                                                                                                <a href="">
                                                                                                        <i class="linecons-cog"></i>
                                                                                                        <span class="title">Print</span>
                                                                                                </a>
                                                                                                <ul>
                                                                                                        <li>
                                        <?php // Html::a('Print Status', ['/printcheque/print-status/index'], ['class' => 'title'])      ?>
                                                                                                        </li>



                                                                                                </ul>
                                                                                        </li>
                                                                                </ul>-->
                                        <!--					<ul id="main-menu" class="main-menu">
                                                                                        <li >
                                                                                                <a href="">
                                                                                                        <i class="linecons-doc"></i>
                                                                                                        <span class="title">Cheque</span>
                                                                                                </a>
                                                                                                <ul>
                                                                                                        <li>
                                        <?php // Html::a('Cheque', ['/bankaccounts/cheque/index'], ['class' => 'title'])      ?>
                                                                                                        </li>
                                                                                                        <li>
                                        <?php // Html::a('cheque Design Manager', ['/dashboard/cheque-designs'], ['class' => 'title'])      ?>
                                                                                                        </li>
                                                                                                </ul>
                                                                                        </li>
                                                                                </ul>-->

                                </div>

                        </div>

                        <div class="main-content">

                                <nav class="navbar user-info-navbar"  role="navigation"><!-- User Info, Notifications and Menu Bar -->

                                        <!-- Left links for user info navbar -->
                                        <ul class="user-info-menu left-links list-inline list-unstyled" style="padding-left:18px">

                                                <li class="hidden-sm hidden-xs">
                                                        <!--                                                        <a href="#" data-toggle="sidebar">
                                                                                                                        <i class="fa-bars"></i>
                                                                                                                </a>-->
                                                </li>
                                                <li ><a href="http://eazycheque.com/dashboard/dashboard" style="padding: 0px !important"><?php echo Html::img('@web/admin/images/logo.png', ['class' => 'logo-margin', 'style' => '/*margin-top: 12px*/;margin-left: 100px;']) ?></a></li>
                                                <li class="list-li"><a style="font-size: 12px;margin-top: 16px;
                                                                       color: #27292a;">Welcome, <span style="color: #c70e2f;
                                                                         font-size: 13px;"><?= Yii::$app->session['user_session']->company_name ?></span> </a></li>
                                                <li class="list-li">
                                                        <a style="font-size: 12px;margin-top: 16px;
                                                           color: #27292a;">Plan Name: <span style="color: #c70e2f;
                                                                           font-size: 13px;"><?= $plan_details->plan_name ?></span>
                                                        </a>
                                                </li>
                                                <li>


                                                        <?php
                                                        $date = date('Y-m-d');
                                                        $expiry = $plan_details->plan_end_date;

                                                        if ($date < $expiry) {
                                                                ?>
                                                                <a style="font-size: 12px;margin-top: 16px;
                                                                   color: #27292a;">Plan Will Expire On: <span style="color: #c70e2f;
                                                                                             font-size: 13px;"><?= Yii::$app->SetValues->DateFormate($plan_details->plan_end_date); ?></span>
                                                                </a>
                                                        <?php } else {
                                                                ?>

                                                                <a style = "font-size: 12px;margin-top: 16px;
								   color: #27292a;">Plan Expired On: <span style = "color: red; font-size: 13px;"><?= Yii::$app->SetValues->DateFormate($plan_details->plan_end_date); ?></span>

								</a>
                                                        <?php }
                                                        ?>


                                                </li>


                                                <!-- Added in v1.2 -->
                                        </ul>
                                        <!-- Right links for user info navbar -->
                                        <ul class="user-info-menu right-links list-inline list-unstyled home-logout">
                                                <li>
                                                        <?= Html::a('<i class="fa fa-home" style="font-size:30px;color:black" ></i>', ['/dashboard/dashboard'], ['title' => 'Dashboard', 'width' => '25', 'height' => '25']) ?>
                                                </li>
                                                <li>
                                                        <?= Html::a('<i class="fa fa-pencil-square-o" style="font-size:30px;color:black" ></i>', ['/dashboard/edit-profile'], ['title' => 'Edit Profile', 'width' => '25', 'height' => '25']) ?>
                                                </li>
                                                <li>
                                                        <?= Html::a('<i class="fa fa-power-off" style="font-size:30px; color:red"></i>', ['/site/logout-user'], ['title' => 'LogOut', 'width' => '25', 'height' => '25']) ?>
                                                </li>
                                                <?php
//						echo '<li class="last">'
//						. Html::beginForm(['/site/logout-user'], 'post') . '<a>'
//						. Html::submitButton(
//							'<i class="fa-sign-out"></i>', ['class' => 'btn btn-link linker']
//						) . '</a>'
//						. Html::endForm()
//						. '</li>';
                                                ?>



                                        </ul>

                                </nav>
                                <div class="row">


                                        <?= $content; ?>


                                </div>
                                <div class="page-loading-overlay loaded">
                                        <div class="loader-2"></div>
                                </div>

                                <footer class="main-footer sticky footer-type-1">

                                        <div class="footer-inner">
                                                <!-- Add your copyright text here -->
                                                <div class="col-md-3" >
                                                        <div class="footer-text" style="float:left">
                                                                &copy; <?= Html::encode(date('Y')) ?>
                                                                <strong></strong>
                                                                All rights reserved.
                                                        </div>
                                                </div>
                                                <div class="col-md-4">
                                                        <div class="footer-text1" >
                                                                <strong></strong>
                                                                Powered By <a target="_blank" href="http://www.gulfproaccountants.com" style="color:#1504f5;">www.gulfproaccountants.com</a>
                                                        </div>
                                                </div>
                                                <div class="col-md-5">
                                                        <div class="footer-text1 go-up" >
                                                                <strong></strong>
                                                                For any support kindly send email to <a href="mailto:info@gulfproaccountants.com" style="color:#1504f5;">info@gulfproaccountants.com</a>
                                                        </div>
                                                </div>
                                        </div>
                                </footer>
                        </div>




                </div>

                <div class="footer-sticked-chat"><!-- Start: Footer Sticked Chat -->

                        <script type="text/javascript">
                                function toggleSampleChatWindow()
                                {
                                        var $chat_win = jQuery("#sample-chat-window");

                                        $chat_win.toggleClass('open');

                                        if ($chat_win.hasClass('open'))
                                        {
                                                var $messages = $chat_win.find('.ps-scrollbar');

                                                if ($.isFunction($.fn.perfectScrollbar))
                                                {
                                                        $messages.perfectScrollbar('destroy');

                                                        setTimeout(function () {
                                                                $messages.perfectScrollbar();
                                                                $chat_win.find('.form-control').focus();
                                                        }, 300);
                                                }
                                        }

                                        jQuery("#sample-chat-window form").on('submit', function (ev)
                                        {
                                                ev.preventDefault();
                                        });
                                }

                                jQuery(document).ready(function ($)
                                {
                                        $(".footer-sticked-chat .chat-user, .other-conversations-list a").on('click', function (ev)
                                        {
                                                ev.preventDefault();
                                                toggleSampleChatWindow();
                                        });

                                        $(".mobile-chat-toggle").on('click', function (ev)
                                        {
                                                ev.preventDefault();

                                                $(".footer-sticked-chat").toggleClass('mobile-is-visible');
                                        });
                                });
                        </script>



                        <a href="#" class="mobile-chat-toggle">
                                <i class="linecons-comment"></i>
                                <span class="num">6</span>
                                <span class="badge badge-purple">4</span>
                        </a>

                        <!-- End: Footer Sticked Chat -->
                </div>






                <!-- Imported styles on this page -->
                <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>admin/css/fonts/meteocons/css/meteocons.css">

                <!-- Bottom Scripts -->



                <!-- JavaScripts initializations and stuff -->
                <script src="<?= Yii::$app->homeUrl; ?>admin/js/xenon-custom.js"></script>
                <!--		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
        <!--		<script src="//code.jquery.com/jquery-1.10.2.js"></script>-->

                <?php $this->endBody() ?>
        </body>
</html>
<?php $this->endPage() ?>
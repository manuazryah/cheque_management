<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<html lang="en">
        <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">

                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <meta name="description" content="Xenon Boostrap Admin Panel" />
                <meta name="author" content="" />
                <link rel="shortcut icon" href="<?= Yii::$app->homeUrl; ?>favicon.png" type="image/x-icon" />
                <title>G CheckManagement/admin</title>
                <script src="<?= Yii::$app->homeUrl; ?>js/jquery-1.11.1.min.js"></script>

                <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
                <!--[if lt IE 9]>
                        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
                <![endif]-->
                <?= Html::csrfMetaTags() ?>
                <?php $this->head() ?>
        </head>
        <body class="page-body">
                <?php $this->beginBody() ?>


                <div class="page-container">
                        <div class="sidebar-menu toggle-others fixed collapsed">

                                <div class="sidebar-menu-inner">
                                        <header class="logo-env">
                                                <!-- logo -->
                                                <div class="logo">
                                                        <a href="" class="logo-expanded">
                                                                <?php echo Html::img('@web/images/logo.png') ?>
                                                        </a>

                                                        <a href="<?= Yii::$app->homeUrl; ?>" class="logo-collapsed">
                                                                <?php echo Html::img('@web/images/favicon.png') ?>

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
                                                <?php
                                                if (Yii::$app->session['post']['admin'] == 1) {
                                                        ?>
                                                        <li >
                                                                <a href="">
                                                                        <i class="linecons-cog"></i>
                                                                        <span class="title">Administration</span>
                                                                </a>
                                                                <ul>
                                                                        <li>
                                                                                <?= Html::a('Access Powers', ['/admin/admin-posts/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Employees', ['/admin/employee/index'], ['class' => 'title']) ?>
                                                                        </li>

                                                                </ul>
                                                        </li>
                                                        <?php
                                                }
                                                ?>
                                                <?php
                                                if (Yii::$app->session['post']['users'] == 1) {
                                                        ?>
                                                        <li >
                                                                <a href="">
                                                                        <i class="linecons-user"></i>
                                                                        <span class="title">Manage Users</span>
                                                                </a>
                                                                <ul>
                                                                        <li>
                                                                                <?php // Html::a('create Users', ['/users/users/create'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Users', ['/users/users/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('User Plans', ['/users/user-plans/index'], ['class' => 'title']) ?>
                                                                        </li>
<li>
										<?= Html::a('Reports', ['/reports/printed-cheques/index'], ['class' => 'title']) ?>
									</li>
                                                                </ul>
                                                        </li>
                                                        <?php
                                                }
                                                ?>
                                                <?php
                                                if (Yii::$app->session['post']['masters'] == 1) {
                                                        ?>
                                                        <li>
                                                                <a href="">
                                                                        <i class="linecons-database"></i>
                                                                        <span class="title">Masters</span>
                                                                </a>
                                                                <ul>
                                                                        <li>
                                                                                <?= Html::a('Plans', ['/masters/master-plans/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                        <li>
                                                                                <?= Html::a('Country', ['/masters/country/index'], ['class' => 'title']) ?>
                                                                        </li>
                                                                        <li>
                                                                                <?= Html::a('Print Status', ['/masters/print-status/index'], ['class' => 'title']) ?>
                                                                        </li>


                                                                </ul>
                                                        </li>
                                                        <?php
                                                }
                                                ?>
                                                <?php
                                                if (Yii::$app->session['post']['bank'] == 1) {
                                                        ?>
                                                        <li>
                                                                <a href="">
                                                                        <i class="fa fa-building-o" aria-hidden="true"></i>
                                                                        <span class="title">Banks</span>
                                                                </a>
                                                                <ul>
                                                                        <li>
                                                                                <?= Html::a('Banks', ['/masters/master-bank/index'], ['class' => 'title']) ?>
                                                                        </li>


                                                                </ul>
                                                        </li>
                                                        <?php
                                                }
                                                ?>

                                        </ul>

                                </div>

                        </div>

                        <div class="main-content">

                                <nav class="navbar user-info-navbar"  role="navigation"><!-- User Info, Notifications and Menu Bar -->

                                        <!-- Left links for user info navbar -->
                                        <ul class="user-info-menu left-links list-inline list-unstyled">

                                                <li class="hidden-sm hidden-xs">
                                                        <a href="#" data-toggle="sidebar">
                                                                <i class="fa-bars"></i>
                                                        </a>
                                                </li>
                                                <!-- Added in v1.2 -->
                                        </ul>
                                        <!-- Right links for user info navbar -->
                                        <ul class="user-info-menu right-links list-inline list-unstyled">
                                                <li class="dropdown user-profile">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!--								<img src="<?= Yii::$app->homeUrl; ?>/images/user-4.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />-->
                                                                <span>
                                                                        <?php
                                                                        echo '<li class="last">'
                                                                        . Html::beginForm(['/site/logout'], 'post') . '<a>'
                                                                        . Html::submitButton(
                                                                                '<i class="fa-lock"></i> Logout (' . Yii::$app->user->identity->user_name . ')', ['class' => 'btn btn-link linker']
                                                                        ) . '</a>'
                                                                        . Html::endForm()
                                                                        . '</li>';
                                                                        ?>
                                                                        <?php // Yii::$app->user->identity->name ?>

                                                                        <i class="fa-angle-down"></i>
                                                                </span>
                                                        </a>
                                                        <!--  <ul class="dropdown-menu user-profile-menu list-unstyled">
                                                              <li>
                                                                  <a href="#edit-profile">
                                                                      <i class="fa-edit"></i>
                                                                      New Post
                                                                  </a>
                                                              </li>
                                                              <li>
                                                                  <a href="#settings">
                                                                      <i class="fa-wrench"></i>
                                                                      Settings
                                                                  </a>
                                                              </li>
                                                              <li>
                                                                  <a href="#profile">
                                                                      <i class="fa-user"></i>
                                                                      Profile
                                                                  </a>
                                                              </li>
                                                              <li>
                                                                  <a href="#help">
                                                                      <i class="fa-info"></i>
                                                                      Help
                                                                  </a>
                                                              </li>

                                                        <?php
                                                        //   echo '<li class="last">'
                                                        //   . Html::beginForm(['/site/logout'], 'post') . '<a>'
                                                        //   . Html::submitButton(
                                                        //          '<i class="fa-lock"></i> Logout (' . Yii::$app->user->identity->user_name . ')', ['class' => 'btn btn-link linker']
                                                        //  ) . '</a>'
                                                        //  . Html::endForm()
                                                        //  . '</li>';
                                                        ?>
                                                          </ul> -->
                                                </li>


                                        </ul>

                                </nav>
                                <div class="row">


                                        <?= $content; ?>


                                </div>
                                <footer class="main-footer sticky footer-type-1">

                                        <div class="footer-inner">

                                                <!-- Add your copyright text here -->
                                                <div class="footer-text">
                                                        &copy; <?= Html::encode(date('Y')) ?>
                                                        <strong></strong>
                                                        All rights reserved.
                                                </div>


                                                <!-- Go to Top Link, just add rel="go-top" to any link to add this functionality -->
                                                <div class="go-up">

                                                        <a href="#" rel="go-top">
                                                                <i class="fa-angle-up"></i>
                                                        </a>

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
                <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>/css/fonts/meteocons/css/meteocons.css">

                <!-- Bottom Scripts -->



                <!-- JavaScripts initializations and stuff -->
                <script src="<?= Yii::$app->homeUrl; ?>/js/xenon-custom.js"></script>
                <?php $this->endBody() ?>
        </body>
</html>
<?php $this->endPage() ?>
<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\widgets\ActiveForm;
use common\models\Users;
use common\models\MasterPlans;
use yii\helpers\ArrayHelper;
use common\models\Country;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html data-style-switcher-options="{'borderRadius': '0'}">

    <head>

        <!-- Basic -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Check Management</title>

        <meta name="keywords" content="" />
        <meta name="description" content="">

        <!-- Favicon -->
        <link rel="shortcut icon" href="<?= Yii::$app->homeUrl; ?>img/favicon.png" type="image/x-icon" />

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- Web Fonts  -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>vendor/simple-line-icons/css/simple-line-icons.min.css">
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>vendor/owl.carousel/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>vendor/owl.carousel/assets/owl.theme.default.min.css">
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>vendor/magnific-popup/magnific-popup.min.css">

        <!-- Theme CSS -->
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/theme.css">
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/theme-elements.css">
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/theme-blog.css">
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/theme-shop.css">
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/theme-animate.css">

        <!-- Current Page CSS -->
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>vendor/rs-plugin/css/settings.css">
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>vendor/rs-plugin/css/layers.css">
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>vendor/rs-plugin/css/navigation.css">
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>vendor/circle-flip-slideshow/css/component.css">

        <!-- Skin CSS -->
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/skins/skin-corporate-3.css">
        <script src="master/style-switcher/style.switcher.localstorage.js"></script>

        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/custom.css">
        <script src="<?= Yii::$app->homeUrl; ?>vendor/jquery/jquery.min.js"></script>
        <!-- Head Libs -->
        <script src="<?= Yii::$app->homeUrl; ?>vendor/modernizr/modernizr.min.js"></script>
<script type="text/javascript">
            var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
            (function () {
                var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src = 'https://embed.tawk.to/595fd6ef1dc79b329518d2ba/default';
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
            })();
        </script>



        <style>
            .modal-dialog {
                max-height: calc(100vh - 210px);
                overflow-y: auto;
            }
            .nav-tabs {
                margin-bottom: 15px;
                /*overflow: !important;*/
                list-style:outside;
            }
            .sign-with {
                margin-top: 25px;
                padding: 20px;
            }
            div#OR {
                height: 30px;
                width: 30px;
                border: 1px solid #C2C2C2;
                border-radius: 50%;
                font-weight: bold;
                line-height: 28px;
                text-align: center;
                font-size: 12px;
                float: right;
                position: absolute;
                right: -16px;
                top: 40%;
                z-index: 1;
                background: #DFDFDF;
            }

        </style>




    </head>
    <body>

        <div class="body">
            <header id="header" data-plugin-options='{"stickyEnabled": true, "stickyEnableOnBoxed": true, "stickyEnableOnMobile": true, "stickyStartAt": 0, "stickySetTop": "0", "stickyChangeLogo": false}'>
                <div class="header-body">

                    <div class="header-container container">
                        <div class="header-row">
                            <div class="header-column">
                                <div class="header-logo">
                                    <a href="<?= Yii::$app->homeUrl; ?>site/index">
                                        <img alt="" width="286" height="78" data-sticky-width="82" data-sticky-height="40" data-sticky-top="33" src="<?= Yii::$app->homeUrl; ?>img/logo.png">
                                    </a>
                                </div>
                            </div>
                            <div class="header-column">
                                <ul class="header-extra-info hidden-xs">
                                    <li>
                                        <div class="feature-box feature-box-style-3">
                                            <div class="feature-box-icon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <div class="feature-box-info">
                                                <h4 class="mb-none" style="font-size:16px;">+971 555 88 4262</h4>
                                                <p><small>Get in touch with us</small></p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="feature-box feature-box-style-3">
                                            <div class="feature-box-icon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                            <div class="feature-box-info">
                                                <h4 class="mb-none" style="font-size:16px;">info@gulfproaccountants.com</h4>
                                                <p><small>Send us an e-mail</small></p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="header-container header-nav header-nav-bar header-nav-bar-primary">
                        <div class="container">
                            <button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main">
                                <i class="fa fa-bars"></i>
                            </button>
                            <div class="header-nav-main header-nav-main-light header-nav-main-effect-1 header-nav-main-sub-effect-1 collapse">

                                <ul class="header-app-logoo" style="list-style:none;">
                                    <li style="float:left;margin-right: 10px;">
                                        <a href="https://play.google.com/store/apps/details?id=com.ionicframework.cheque819757" style="" class="" target="_blank">
                                            <img alt="" src="<?= Yii::$app->homeUrl; ?>img/android.png">
                                        </a>
                                    </li>
                                    <li style="float:left;">
                                        <a href="https://itunes.apple.com/in/app/facebook/id1233137764?mt=8" style="text-decoration:none;" class="" target="_blank">
                                            <img alt=""  src="<?= Yii::$app->homeUrl; ?>img/apple.png">
                                        </a>
                                    </li>
<!--                                                                        <li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                    <li class="social-icons-facebook"><a href="#" target="_blank" title="App"><i class="fa fa-android"></i></a></li>
                                    <li class="social-icons-twitter"><a href="#" target="_blank" title="App"><i class="fa fa-apple"></i></a></li>
                                    <li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                    <li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>-->
                                </ul>
                                <nav>
                                    <ul class="nav nav-pills" id="mainNav">
                                        <li><?= Html::a('Home', ['index']) ?></li>
                                        <li><?= Html::a('About', ['about']) ?></li>
                                        <li class=""><?= Html::a('Features', ['features']) ?></li>
                                        <li class=""><?= Html::a('Pricing', ['pricing']) ?></li>
                                        <li><?= Html::a('LOGIN/REGISTER', ['login'], ['class' => 'btn btn-primary log-btn']) ?></li>
                                        <li class=""><?= Html::a('Contact', ['contact']) ?></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>



                    </div>
                </div>
            </header>
            <body>
                <?php $this->beginBody() ?>


                <?= $content ?>




                <?php $this->endBody() ?>
                <div role="main" class="main">
                    <section class="section mt-none section-footer">
                        <h4 style="text-align:center">Our Clientele</h4>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 center">
                                    <div class="owl-carousel owl-theme mt-xl" data-plugin-options='{"items": 6, "autoplay": true, "autoplayTimeout": 3000}'>
                                        <div><img class="img-responsive" src="<?= Yii::$app->homeUrl; ?>img/logos/logo-1.png" alt=""></div>
                                        <div><img class="img-responsive" src="<?= Yii::$app->homeUrl; ?>img/logos/logo-2.png" alt=""></div>
                                        <div><img class="img-responsive" src="<?= Yii::$app->homeUrl; ?>img/logos/logo-3.png" alt=""></div>
                                        <div><img class="img-responsive" src="<?= Yii::$app->homeUrl; ?>img/logos/logo-4.png" alt=""></div>
                                        <div><img class="img-responsive" src="<?= Yii::$app->homeUrl; ?>img/logos/logo-5.png" alt=""></div>
                                        <div><img class="img-responsive" src="<?= Yii::$app->homeUrl; ?>img/logos/logo-6.png" alt=""></div>
                                        <div><img class="img-responsive" src="<?= Yii::$app->homeUrl; ?>img/logos/logo-4.png" alt=""></div>
                                        <div><img class="img-responsive" src="<?= Yii::$app->homeUrl; ?>img/logos/logo-2.png" alt=""></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </section>
                </div>
                <section class="section section-primary mb-none">
                    <div class="container">
                        <div class="row">
                            <div class="counters counters-text-light">
                                <div class="col-md-3 col-sm-6">
                                    <div class="counter">
                                        <strong data-to="300" data-append="+">0</strong>
                                        <label>Happy Clients</label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="counter">
                                        <strong data-to="4000">0</strong>
                                        <label>Cheque Prints</label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="counter">
                                        <strong data-to="100">0</strong>
                                        <label>% Secure</label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="counter">
                                        <strong data-to="24">0</strong>
                                        <label>Hrs Support</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <footer id="footer" class="light narrow">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="nav nav-pills">
                                    <li class="active"><?= Html::a('Home', ['index']) ?></li>
                                    <li><?= Html::a('About', ['about']) ?></li>
                                    <li class=""><?= Html::a('Features', ['features']) ?></li>
                                    <li class=""><?= Html::a('Pricing', ['pricing']) ?></li>
                                    <li class=""><?= Html::a('Contact Us', ['contact']) ?></li>
                                    <li class=""><?= Html::a('Privacy Policy', ['privacy-policy']) ?></li>
                                </ul>
                            </div>
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-5">
                                <div class="narrow-phone">
                                    <h5 class="mb-sm">Contact Us</h5>
                                    <span class="phone">+971 555 88 4262</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer-copyright">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-2">
                                    <a href="<?= Yii::$app->homeUrl; ?>site/index" class="logo">
                                        <img alt="" class="img-responsive" src="<?= Yii::$app->homeUrl; ?>img/logo_footer.png">
                                    </a>
                                </div>
                                <div class="col-md-6" style="padding:0px">
                                    <p>© www.eazycheque.com <span style="float:right">Powered by: <a href="http://gulfproaccountants.com/" target="_blank">www.gulfproaccountants.com</a></span></p>
                                </div>
                                <div class="col-md-4">
                                    <ul class="social-icons pull-right">
                                        <li class="social-icons-facebook"><a href="#" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li class="social-icons-facebook"><a href="https://play.google.com/store/apps/details?id=com.ionicframework.cheque819757" target="_blank" title="App"><i class="fa fa-android"></i></a></li>
                                        <li class="social-icons-twitter"><a href="https://itunes.apple.com/in/app/facebook/id1233137764?mt=8" target="_blank" title="App"><i class="fa fa-apple"></i></a></li>
                                        <li class="social-icons-twitter"><a href="#" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                        <li class="social-icons-linkedin"><a href="#" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
        </div>

        <!-- Vendor -->
        <!--        <script type="text/javascript">
            document.getElementById("submit").onclick = function () {
                //alert("dfkjg");
                location.href = "<?= Yii::$app->homeUrl; ?>site/dashboard";
            };
        </script>-->


        <script src="<?= Yii::$app->homeUrl; ?>vendor/jquery.appear/jquery.appear.min.js"></script>
        <script src="<?= Yii::$app->homeUrl; ?>vendor/jquery.easing/jquery.easing.min.js"></script>
        <script src="<?= Yii::$app->homeUrl; ?>vendor/jquery-cookie/jquery-cookie.min.js"></script>
        <script src="<?= Yii::$app->homeUrl; ?>master/style-switcher/style.switcher.js"></script>
        <script src="<?= Yii::$app->homeUrl; ?>vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?= Yii::$app->homeUrl; ?>vendor/common/common.min.js"></script>
        <script src="<?= Yii::$app->homeUrl; ?>vendor/jquery.validation/jquery.validation.min.js"></script>
        <script src="<?= Yii::$app->homeUrl; ?>vendor/jquery.stellar/jquery.stellar.min.js"></script>
        <script src="<?= Yii::$app->homeUrl; ?>vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
        <script src="<?= Yii::$app->homeUrl; ?>vendor/jquery.gmap/jquery.gmap.min.js"></script>
        <script src="<?= Yii::$app->homeUrl; ?>vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
        <script src="<?= Yii::$app->homeUrl; ?>vendor/isotope/jquery.isotope.min.js"></script>
        <script src="<?= Yii::$app->homeUrl; ?>vendor/owl.carousel/owl.carousel.min.js"></script>
        <script src="<?= Yii::$app->homeUrl; ?>vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
        <script src="<?= Yii::$app->homeUrl; ?>vendor/vide/vide.min.js"></script>

        <script src="<?= Yii::$app->homeUrl; ?>js/theme.js"></script>

        <script src="<?= Yii::$app->homeUrl; ?>vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
        <script src="<?= Yii::$app->homeUrl; ?>vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
        <script src="<?= Yii::$app->homeUrl; ?>vendor/circle-flip-slideshow/js/jquery.flipshow.min.js"></script>
        <script src="<?= Yii::$app->homeUrl; ?>js/views/view.home.js"></script>

        <script src="<?= Yii::$app->homeUrl; ?>js/views/view.contact.js"></script>

        <script src="<?= Yii::$app->homeUrl; ?>js/custom.js"></script>

        <script src="<?= Yii::$app->homeUrl; ?>js/theme.init.js"></script>

        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '../../../www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-42715764-5', 'auto');
            ga('send', 'pageview');
        </script>
        <script src="master/analytics/analytics.js"></script>



        <!------POP UP------>

        <script>
            /*$(document).ready(function () {
             //                                var session = <?php // Yii::$app->session['return']                                                                                                                       ?>;
             //                                if (session == 1) {
             //                                        $('#myModal').modal('show');
             //                                        $('#Registration').tab('show');
             //                                }
             });
             // Get the modal
             var modal = document.getElementById('myModal');

             // Get the button that opens the modal
             var btn = document.getElementById("myBtn");

             // Get the <span> element that closes the modal
             var span = document.getElementsByClassName("close")[0];

             // When the user clicks the button, open the modal
             btn.onclick = function () {
             modal.style.display = "block";
             }

             // When the user clicks on <span> (x), close the modal
             span.onclick = function () {
             modal.style.display = "none";
             var session = <?= Yii::$app->session['return'] == '' ? '' : Yii::$app->session['return'] ?>;
             session = 0;
             }

             // When the user clicks anywhere outside of the modal, close it
             window.onclick = function (event) {
             if (event.target == modal) {
             modal.style.display = "none";
             }
             }*/
        </script>

    </body>
</html>
<?php $this->endPage() ?>

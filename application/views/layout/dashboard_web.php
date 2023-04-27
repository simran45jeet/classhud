<!DOCTYPE html>
<html lang="en-US" class="no-js">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo (isset($title_for_layout) && !empty($title_for_layout)) ? $title_for_layout : $this->lang->line("heading_web_meta_title"); ?></title>
        <meta name="robots" content='max-image-preview:large' />
        <meta name="keywords" content="<?php echo (isset($meta_for_layout) && !empty($meta_for_layout)) ? $meta_for_layout : $this->lang->line("heading_web_meta_keywords"); ?>">
        <meta name="description" content="<?php echo (isset($meta_description) && !empty($meta_description)) ? $meta_description : $this->lang->line("heading_web_meta_description"); ?>">
        <link rel="shortcut icon" href="<?php echo base_url(BASE_WEB_IMAGES_PATH . "favicon.ico"); ?>"/>
        <script src="<?php echo base_url(BASE_WEB_JS_PATH."jquery.min.js") ?>"></script>
        <link rel="stylesheet"  href="<?php echo base_url(BASE_WEB_CSS_PATH . "style.css?_=". filemtime(FCPATH.BASE_WEB_CSS_PATH . "style.css")); ?>" type="text/css" />
        <?php /* ?>
        <!--<link href="<?php echo base_url(BASE_ASSETS_PATH."web/css/style.bundle.css"); ?>" rel="stylesheet" type="text/css" />-->
        <!--<link rel="stylesheet"  href="<?php echo base_url(BASE_WEB_CSS_PATH . "bootstrap.css") ?>" type="text/css" />-->
        <script src="<?php echo base_url(BASE_ASSETS_PATH."web/plugins/global/plugins.bundle.js") ?>"></script>
        <!--<script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "bootstrap.min.js") ?>" id="elementor-frontend-js"></script>-->
        <script src="<?php echo base_url(BASE_WEB_JS_PATH."scripts.bundle.js") ?>"></script>
        <!--<script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "jquery.min.js") ?>" id="jquery-core-js"></script>-->
        <?php */ ?>
        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "main.js") ?>"></script><!-- don't place it in footer-->
        <link rel="stylesheet" id="font-awesome-5-all-css" href="<?php echo base_url(BASE_WEB_CSS_PATH . "all.min.css"); ?>" type="text/css" media="all" />
        <link rel="stylesheet" id="elementor-icons-css" href="<?php echo base_url(BASE_WEB_CSS_PATH . "auto.css"); ?>" type="text/css" />
        <script src="<?php echo base_url(BASE_WEB_JS_PATH."bootstrap.min.js?_=".filemtime(FCPATH.BASE_WEB_JS_PATH . "bootstrap.min.js")) ?>"></script>
        <link rel="stylesheet"  href="<?php echo base_url(BASE_WEB_CSS_PATH . "bootstrap.css"); ?>" type="text/css"/>
        <script type="text/javascript">
            var base_url = "<?php echo $this->base_url; ?>";
            var week_days = <?php echo json_encode($this->lang->line("heading_week_days")) ?>;
        </script>
    </head>

    <body class="page-template-default page page-id-1371 logged-in theme-fioxen woocommerce-no-js tribe-no-js fioxen-body-loading fioxen elementor-default elementor-kit-7 logged-in">
        <div class="wrapper-page">
            <section id="wp-main-content" class="clearfix main-page listing-dashboard-page">
                <?php $this->load->view("{$this->module_name}/common/dashboard_header"); ?>
                <div class="main-page-content">
                    <div id="job-manager-job-dashboard"> 
                        <a class="job-control-mobile-sidebar d-none">
                            <i class="icon fas fa-bars">
                            </i>
                        </a>
                        <div class="dashboard-content-wrapper">
                            <a class="job-control-mobile-sidebar d-block d-lg-none"><i class="icon fas fa-bars"></i></a>
                            <div class="dashboard-sidebar">
                                <div class="dashboard-sidebar-content">
                                    <div class="content-inner">
                                        <div class="user-avatar">
                                            <img class="lazyload" src="<?php echo $this->user_data["image"] ?>" data-src="<?php echo $this->user_data["image"] ?>" alt="<?php echo $this->user_data["full_name"] ?>" />
                                        </div>
                                        <div class="user-information">
                                            <h3 class="username"><?php echo $this->user_data["full_name"] ?></h3>
                                            
                                            <?php if( !empty($user_data["referral_code"])  ){ ?>
                                            <div class="date-created">
                                                <?php echo sprintf($this->lang->line("heading_user_referral_code"),$user_data["referral_code"]) ?>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <div class="user-navigation">
                                            <ul class="dashboard-navigation">
                                                <li class="<?php echo isActive("dashboard.index") ?>">
                                                    <a href="<?php echo base_url("dashboard") ?>">
                                                        <i class="icon fas fa-tachometer-alt">
                                                        </i><?php echo $this->lang->line("heading_dashboard") ?>
                                                    </a>
                                                </li>
                                                <li class="<?php echo isActive("user.my_listing") ?>">
                                                    <a href="<?php echo basE_url("user/my_listing") ?>">
                                                        <i class="icon fas fa-clipboard-list">
                                                        </i><?php echo $this->lang->line("heading_my_listings") ?>
                                                    </a>
                                                </li>
                                                
                                                <?php 
                                                if( !empty( $dashboard_menus ) ) {
                                                    foreach( $dashboard_menus as $dashboard_menu_arr ) {
                                                ?>
                                                <li class="<?php echo $dashboard_menu_arr["active"] ?>"> 
                                                    <a href="<?php echo base_url( str_replace(".","/",$dashboard_menu_arr["action"]) ) ?>">
                                                        <i class="icon fas fa-<?php echo $dashboard_menu_arr["icon"] ?>"></i>
                                                        <?php echo $dashboard_menu_arr["name"] ?>
                                                    </a>
                                                </li>
                                                <?php
                                                    }
                                                } ?>
                                                <?php /* ?>
                                                  <li class=""> <a href="profile.html">
                                                  <i class="icon fas fa-user-circle">
                                                  </i>My Profile</a>
                                                  </li>
                                                  <li class=""> <a href="favorite.html">
                                                  <i class="icon fas fa-heart">
                                                  </i>Favorite</a>
                                                  </li>
                                                  <li class=""> <a href="packages.html">
                                                  <i class="icon fas fa-layer-group">
                                                  </i>
                                                  </i>Packages</a>
                                                  </li>
                                                  <li class=""> <a href="change-password.html">
                                                  <i class="icon fas fa-lock">
                                                  </i>Change Password</a>
                                                  </li>
                                                  <?php */ ?>
                                                <li> 
                                                    <a href="<?php echo base_url("users/signout") ?>">
                                                        <i class="icon fas fa-sign-out-alt">
                                                        </i><?php echo $this->lang->line("heading_logout") ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dashboard-main-content">
                                <div class="dashboard-content-inner">
                                    <div class="main-dashboard">
                                        <?php echo $content_for_layout; ?>
                                    </div>
                                </div>
                                <div class="dashboard-copyright">&copy; 2023 Copyrights by ClassHud Pvt. Ltd.</div>
                            </div>
                        </div>
                    </div>
                </div><!-- End page -->
            </section>
        </div>

        <?php //$this->load->view("{$this->module_name}/common/header"); ?>

        <!--<link rel="stylesheet" id="fioxen-template-css" href="<?php echo base_url(BASE_WEB_CSS_PATH . "template19f6.css") ?>" type="text/css" media="all" />-->

        <link rel="stylesheet" id="dashicons-css" href="<?php echo base_url(BASE_WEB_CSS_PATH . "dashicons.min.css") ?>" type="text/css" media="all" />
        <link rel="stylesheet" id="line-awesome-css" href="<?php echo base_url(BASE_WEB_CSS_PATH . "line-awesome.min.css") ?>" type="text/css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(BASE_WEB_CSS_PATH . "icons-style.css") ?>">
        <link rel="stylesheet" href="<?php echo base_url(BASE_WEB_CSS_PATH . "widget-icon-box.min.css") ?>"/>
        <link rel="stylesheet" id="elementor-icons-css" href="<?php echo base_url(BASE_WEB_CSS_PATH . "elementor-icons.mine.css"); ?>" type="text/css" media="all" />

        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "jquery.magnific-popup.min.js") ?>" id="sticky-kit-js"></script>
        <?php /* ?>
        <link rel="stylesheet"  href="<?php echo base_url(BASE_ASSETS_PATH . "web/plugins/global/plugins.bundle.css"); ?>" type="text/css" media="all" />
        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "sticky-kit.js") ?>" id="sticky-kit-js"></script>
        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "swiper.min.js") ?>" id="swiper-js"></script>
        <?php */ ?>
        
        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "jqBootstrapValidation.js") ?>" defer=""></script>
        <?php /* ?>
        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "webpack.runtime.min.js") ?>" id="elementor-webpack-runtime-js"></script>
        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "frontend-modules.min.js") ?>" id="elementor-frontend-modules-js"></script>
        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "jquery-migrate.min.js") ?>" id="jquery-migrate-js"></script>
        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "default.js") ?>" id="fioxen-sty-js"></script>

        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "imagesloaded.mineda1.js") ?>" id="imagesloaded-js"></script>
        <?php */ ?>

        
        <!--<script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "frontend.min.js") ?>" ></script>-->
        <!--<script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "imagesloaded.min.js") ?>"></script>-->
        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "jquery.mCustomScrollbar.min.js") ?>" ></script>
        <!--<script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "jquery.auto.js") ?>" ></script>-->

        <link rel="stylesheet" id="elementor-icons-css" href="<?php echo base_url(BASE_WEB_CSS_PATH . "magnific-popup.css"); ?>" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" id="fioxen-fonts-css"  href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&#038;family=Muli:wght@400;500;600;700&#038;display=swap" type="text/css" media="all" />

        <script async src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_LOCATION_API_KEY ?>&sensor=false&callback=initialize&libraries=places"></script>
        
        <!--<link rel="stylesheet" id="elementor-icons-css" href="<?php echo base_url(BASE_WEB_CSS_PATH . "jquery.mCustomScrollbar.min.css"); ?>" type="text/css" />-->
        
        <div class="position-fixed top-0 end-0 p-3 toast-dv">
            <div id="liveToast" role="alert" aria-live="assertive" aria-atomic="true" class="toast fade-in fade hide">
                <div class="toast-header">
                    <!--<svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#007aff"></rect></svg>-->
                    <a class="logo-mm" href="#">
                        <img src="<?php echo base_url(BASE_WEB_IMAGES_PATH."logo/class-hud-logo.svg") ?>" alt="<?php echo $this->lang->line("heading_logo_alt") ?>" />
                    </a>

                    <strong class="me-auto"></strong>
                    <small></small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    
                </div>
            </div>
        </div>
        <script type="text/javascript">
            "use strict";
            jQuery(function () { 
                jQuery("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); 
            });
        </script>
    </body>
</html>
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

        <link href="<?php echo base_url(BASE_ASSETS_PATH."web/css/style.bundle.css"); ?>" rel="stylesheet" type="text/css" />
        <!--<link rel="stylesheet"  href="<?php echo base_url(BASE_WEB_CSS_PATH . "bootstrap.css") ?>" type="text/css" />-->
        <link rel="stylesheet"  href="<?php echo base_url(BASE_WEB_CSS_PATH . "style.css"); ?>" type="text/css" media="all" />
        <link rel="stylesheet" id="font-awesome-5-all-css" href="<?php echo base_url(BASE_WEB_CSS_PATH . "all.min.css"); ?>" type="text/css" media="all" />
        <script src="<?php echo base_url(BASE_ASSETS_PATH."web/plugins/global/plugins.bundle.js") ?>"></script>
        <!--<script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "bootstrap.min.js") ?>" id="elementor-frontend-js"></script>-->
        <script src="<?php echo base_url(BASE_WEB_JS_PATH."scripts.bundle.js") ?>"></script>
        <!--<script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "jquery.min.js") ?>" id="jquery-core-js"></script>-->
        <script type="text/javascript">
            var base_url = "<?php echo $this->base_url; ?>";
            var week_days = <?php echo json_encode($this->lang->line("heading_week_days")) ?>;
        </script>
    </head>

    <body class="home page-template-default page page-id-18 theme-fioxen woocommerce-no-js tribe-no-js page-template-fioxen fioxen-body-loading fioxen elementor-default elementor-kit-7 elementor-page elementor-page-18 ">

        <?php $this->load->view("{$this->module_name}/common/header"); ?>
        <div class="wrapper-page"> <!--page-->
            <div id="page-content"> <!--page content-->
                <?php echo $content_for_layout; ?>
            </div><!--end page content-->

        </div><!-- End page -->

        <?php $this->load->view("{$this->module_name}/common/footer"); ?>

        <!--<link rel="stylesheet" id="fioxen-template-css" href="<?php echo base_url(BASE_WEB_CSS_PATH . "template19f6.css") ?>" type="text/css" media="all" />-->

        <link rel="stylesheet" id="dashicons-css" href="<?php echo base_url(BASE_WEB_CSS_PATH . "dashicons.min.css") ?>" type="text/css" media="all" />
        <link rel="stylesheet" id="line-awesome-css" href="<?php echo base_url(BASE_WEB_CSS_PATH . "line-awesome.min.css") ?>" type="text/css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(BASE_WEB_CSS_PATH . "icons-style.css") ?>">
        <link rel="stylesheet" href="<?php echo base_url(BASE_WEB_CSS_PATH . "widget-icon-box.min.css") ?>"/>
        <link rel="stylesheet" id="elementor-icons-css" href="<?php echo base_url(BASE_WEB_CSS_PATH . "elementor-icons.mine.css"); ?>" type="text/css" media="all" />
        <link rel="stylesheet"  href="<?php echo base_url(BASE_ASSETS_PATH . "web/plugins/global/plugins.bundle.css"); ?>" type="text/css" media="all" />

        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "jquery.magnific-popup.min.js") ?>" id="sticky-kit-js"></script>
        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "sticky-kit.js") ?>" id="sticky-kit-js"></script>
        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "swiper.min.js") ?>" id="swiper-js"></script>
        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "main.js") ?>" id="gavias.elements-js"></script>
        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "webpack.runtime.min.js") ?>" id="elementor-webpack-runtime-js"></script>
        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "frontend-modules.min.js") ?>" id="elementor-frontend-modules-js"></script>
        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "jquery-migrate.min.js") ?>" id="jquery-migrate-js"></script>
        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "default.js") ?>" id="fioxen-sty-js"></script>

        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "imagesloaded.mineda1.js") ?>" id="imagesloaded-js"></script>


        <script type="text/javascript" id="elementor-frontend-js-before">
            var elementorFrontendConfig = {"environmentMode": {"edit": false, "wpPreview": false, "isScriptDebug": false}, "i18n": {"shareOnFacebook": "Share on Facebook", "shareOnTwitter": "Share on Twitter", "pinIt": "Pin it", "download": "Download", "downloadImage": "Download image", "fullscreen": "Fullscreen", "zoom": "Zoom", "share": "Share", "playVideo": "Play Video", "previous": "Previous", "next": "Next", "close": "Close"}, "is_rtl": false, "breakpoints": {"xs": 0, "sm": 480, "md": 768, "lg": 1025, "xl": 1440, "xxl": 1600}, "responsive": {"breakpoints": {"mobile": {"label": "Mobile", "value": 767, "default_value": 767, "direction": "max", "is_enabled": true}, "mobile_extra": {"label": "Mobile Extra", "value": 880, "default_value": 880, "direction": "max", "is_enabled": false}, "tablet": {"label": "Tablet", "value": 1024, "default_value": 1024, "direction": "max", "is_enabled": true}, "tablet_extra": {"label": "Tablet Extra", "value": 1200, "default_value": 1200, "direction": "max", "is_enabled": false}, "laptop": {"label": "Laptop", "value": 1366, "default_value": 1366, "direction": "max", "is_enabled": false}, "widescreen": {"label": "Widescreen", "value": 2400, "default_value": 2400, "direction": "min", "is_enabled": false}}}, "version": "3.10.2", "is_static": false, "experimentalFeatures": {"e_dom_optimization": true, "e_optimized_assets_loading": true, "e_optimized_css_loading": true, "a11y_improvements": true, "additional_custom_breakpoints": true, "e_hidden_wordpress_widgets": true, "landing-pages": true, "kit-elements-defaults": true}, "urls": {"assets": "https:\/\/mankawal.com\/site\/wp-content\/plugins\/elementor\/assets\/"}, "settings": {"page": [], "editorPreferences": []}, "kit": {"active_breakpoints": ["viewport_mobile", "viewport_tablet"], "global_image_lightbox": "yes", "lightbox_enable_counter": "yes", "lightbox_enable_fullscreen": "yes", "lightbox_enable_zoom": "yes", "lightbox_enable_share": "yes", "lightbox_title_src": "title", "lightbox_description_src": "description"}, "post": {"id": 18, "title": "Class%20Hud", "excerpt": "", "featuredImage": false}};
        </script>
        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "frontend.min.js") ?>" id="elementor-frontend-js"></script>

        <link rel="stylesheet" id="elementor-icons-css" href="<?php echo base_url(BASE_WEB_CSS_PATH . "magnific-popup.css"); ?>" type="text/css" />
        <link rel="stylesheet" id="fioxen-fonts-css"  href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&#038;family=Muli:wght@400;500;600;700&#038;display=swap" type="text/css" media="all" />

        <script async src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_LOCATION_API_KEY ?>&sensor=false&callback=initialize&libraries=places"></script>
    </body>

</html>
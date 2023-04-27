<?php
//ob_start("minifier");
// function minifier($code) {
//     $search = array(
//         // Remove whitespaces after tags
//         '/\>[^\S ]+/s',
//         // Remove whitespaces before tags
//         '/[^\S ]+\</s'
//     );
//     $replace = array('>', '<', '\\1');
//     $code = preg_replace($search, $replace, $code);
//     return $code;
// }
?>
<!DOCTYPE html>
<html lang="en-US" class="no-js">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo (isset($meta_for_layout) && !empty($meta_for_layout)) ? $meta_for_layout : $this->lang->line("heading_web_meta_title"); ?></title>
        <meta name="robots" content='max-image-preview:large' />
        <meta name="keywords" content="<?php echo (isset($meta_keywords) && !empty($meta_keywords)) ? $meta_keywords : $this->lang->line("heading_web_meta_keywords"); ?>">
        <meta name="description" content="<?php echo (isset($meta_description) && !empty($meta_description)) ? $meta_description : $this->lang->line("heading_web_meta_description"); ?>">
        
        
        <meta property="og:title" content="<?php echo (isset($meta_for_layout) && !empty($meta_for_layout)) ? $meta_for_layout : $this->lang->line("heading_web_meta_title"); ?>" />
        <meta property="og:description" content="<?php echo (isset($meta_description) && !empty($meta_description)) ? $meta_description : $this->lang->line("heading_web_meta_description"); ?>" />
        <meta property="og:image" content="<?php echo (isset($meta_image) && !empty($meta_image)) ? $meta_image : base_url(BASE_WEB_IMAGES_PATH."logo/classhud-site-full.jpg"); ?>" />

        <link rel="shortcut icon" href="<?php echo base_url(BASE_WEB_IMAGES_PATH . "favicon.ico"); ?>"/>
        <script src="<?php echo base_url(BASE_WEB_JS_PATH."jquery.min.js") ?>"></script>
        <link rel="stylesheet"  href="<?php echo base_url(BASE_WEB_CSS_PATH . "style.css?_=". filemtime(FCPATH.BASE_WEB_CSS_PATH . "style.css")); ?>" type="text/css" />
        <script type="text/javascript">
            var base_url = "<?php echo $this->base_url; ?>";
            var week_days = <?php echo json_encode($this->lang->line("heading_week_days")) ?>;
        </script>
        <style type="text/css">
            .preloader {background-color: #fff;bottom: 0;height: 100vh;left: 0;position: fixed;right: 0;top: 0;width: 100vw;z-index: 99999;}
            .preloader .loader {margin: 0 auto;position: relative;top: 50%;-webkit-transform: translateY(-50%);-ms-transform: translateY(-50%);transform: translateY(-50%);text-align: center;z-index: 9999;-webkit-animation: loadershake infinite .8s linear;animation: loadershake infinite .8s linear;}
        </style>
        <script src="<?php echo base_url(BASE_WEB_JS_PATH."bootstrap.min.js?_=".filemtime(FCPATH.BASE_WEB_JS_PATH . "bootstrap.min.js")) ?>"></script>
        <link rel="stylesheet"  href="<?php echo base_url(BASE_WEB_CSS_PATH . "bootstrap.css"); ?>" type="text/css"/>
    </head>

    <body class="home page-template-default page page-id-18 theme-fioxen woocommerce-no-js tribe-no-js page-template-fioxen fioxen-body-loading fioxen elementor-default elementor-kit-7 elementor-page elementor-page-18 <?php echo !empty($this->user_data["id"]) ? "logged-in" : "" ?>">

        <?php $this->load->view("{$this->module_name}/common/header"); ?>
        <div class="wrapper-page"> <!--page-->
            <div id="page-content"> <!--page content-->
                <?php echo $content_for_layout; ?>
            </div><!--end page content-->

        </div><!-- End page -->

        <?php $this->load->view("{$this->module_name}/common/footer"); ?>
        
        <!--<link rel="stylesheet"  href="<?php echo base_url(BASE_WEB_CSS_PATH . "style.css"); ?>" type="text/css" />-->
        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "main.js") ?>" defer=""></script>
        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "jqBootstrapValidation.js") ?>" defer=""></script>
        <!--
        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "sticky-kit.js") ?>" defer=""></script>
        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "swiper.min.js") ?>" defer="" ></script>
        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "webpack.runtime.min.js") ?>" defer=""></script>
        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "frontend-modules.min.js") ?>" defer=""></script>

        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "imagesloaded.mineda1.js") ?>" id="imagesloaded-js"></script>
        -->
        <link rel="stylesheet" id="fioxen-fonts-css"  href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&#038;family=Muli:wght@400;500;600;700&#038;display=swap" type="text/css" media="all" />
        <script type="text/javascript">
            "use strict";
            jQuery(function () { 
                jQuery("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); 
//                var head = document.getElementsByTagName('HEAD')[0];
//                // Create new link Element
//                var link = document.createElement('link');
//                // set the attributes for link element
//                link.rel = 'stylesheet';
//                link.type = 'text/css';
//                link.href = '<?php echo base_url(BASE_WEB_CSS_PATH . "style.css"); ?>';
//                // Append link element to HTML head
//                head.appendChild(link);
            });
        </script>
        <div class="position-fixed top-0 end-0 p-3 toast-dv">
            <div id="liveToast" role="alert" aria-live="assertive" aria-atomic="true" class="toast fade hide">
                <div class="toast-header">
                    <!--<svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#007aff"></rect></svg>-->
                    <a class="logo-mm" href="#">
                        <img src="<?php echo base_url(BASE_WEB_IMAGES_PATH."logo/class-hud-logo.svg") ?>" alt="<?php echo $this->lang->line("heading_logo_alt") ?>"  />
                    </a>
                    <strong class="me-auto"></strong>
                    <small></small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">             
                </div>
            </div>
        </div>
        <!--<script async src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_LOCATION_API_KEY ?>&libraries=places&callback=initialize"></script>-->
        <script type="text/javascript">
            $(function(){
                $.getScript("https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_LOCATION_API_KEY ?>&libraries=places&callback=initialize");
            });
        </script>
        <script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH . "jquery.magnific-popup.min.js") ?>" id="sticky-kit-js"></script>
        <!-- <link rel="stylesheet" id="elementor-icons-css" href="<?php echo base_url(BASE_WEB_CSS_PATH . "magnific-popup.css"); ?>" type="text/css" /> -->
        <?php
        if(!empty($scripts) && count($scripts)){
            foreach($scripts as $script) { 
                $attributes=''; 
                if( is_array($script) ) {
                    $attributes=$script['attributes']; 
                    $script = $script['src'];
                } 
        ?>
        <script src="<?=$script?>" <?php echo $attributes ?>></script>

        <?php
            }
        }
        ?>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-42775Q4HMB"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'G-42775Q4HMB');
        </script>
    </body>
</html>
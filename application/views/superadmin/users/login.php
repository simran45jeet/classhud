<html lang="en">
    <!--begin::Head-->
    <head>
        <base href="<?php echo superadmin_url() ?>"/>
        <title><?php echo $this->lang->line("heading_superadmin_meta_title") ?></title>
        <meta charset="utf-8" />
        <meta name="description" content="<?php echo $this->lang->line("heading_superadmin_meta_description") ?>" />
        <meta name="keywords" content="<?php echo $this->lang->line("heading_superadmin_meta_keywords") ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="<?php echo $this->lang->line("heading_superadmin_og_meta_title") ?>" />
        <link rel="shortcut icon" href="<?php echo base_url(BASE_ASSETS_PATH."media/logos/favicon.ico") ?>" />
        <!--begin::Fonts(mandatory for all pages)-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
        <!--end::Fonts-->
        <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
        <link href="<?php echo base_url(BASE_ASSETS_PATH."superadmin/plugins/global/plugins.bundle.css") ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(BASE_SUPERADMIN_CSS_PATH."style.bundle.css") ?>" rel="stylesheet" type="text/css" />
        <!--end::Global Stylesheets Bundle-->
    </head>
    <!--end::Head-->
    <!--begin::Body-->
    <body id="kt_body" class="app-blank">
        
        <!--begin::Theme mode setup on page load-->
        <script type="text/javascript">
            var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-theme-mode")) { themeMode = document.documentElement.getAttribute("data-theme-mode"); } else { if ( localStorage.getItem("data-theme") !== null ) { themeMode = localStorage.getItem("data-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-theme", themeMode); }
        </script>
        <!--end::Theme mode setup on page load-->
        <!--begin::Root-->
        <div class="d-flex flex-column flex-root" id="kt_app_root">
            <!--begin::Page bg image-->
            <style type="text/css">
                body { background-image: url('<?php echo base_url(BASE_ASSETS_PATH."media/auth/bg10.jpeg") ?>'); } [data-theme="dark"] body { background-image: url('<?php echo base_url(BASE_ASSETS_PATH."media/auth/bg10-dark.jpeg") ?>'); }
            </style>
            <!--end::Page bg image-->
            <!--begin::Authentication - Sign-in -->
            <div class="d-flex flex-column flex-lg-row flex-column-fluid">
                <!--begin::Aside-->
                <div class="d-flex flex-lg-row-fluid">
                    <!--begin::Content-->
                    <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                        <!--begin::Image-->
                        <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="<?php echo base_url(BASE_ASSETS_PATH."media/auth/agency.png") ?>" alt="" />
                        <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="<?php echo BASE_ASSETS_PATH."media/auth/agency-dark.png" ?>" alt="" />
                        <!--end::Image-->
                        <!--begin::Title-->
                        <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7"><?php echo $this->lang->line('heading_feature_heading') ?></h1>
                        <!--end::Title-->
                        <!--begin::Text-->
                        <div class="text-gray-600 fs-base text-center fw-semibold">
                            <?php echo $this->lang->line('heading_feature_detail') ?>
                        </div>
                        <!--end::Text-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--begin::Aside-->
                <!--begin::Body-->
                <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                    <!--begin::Wrapper-->
                    <div class="bg-body d-flex flex-center rounded-4 w-md-600px p-10">
                        <!--begin::Content-->
                        <div class="w-md-400px">
                            <!--begin::Form-->
                            <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="<?php echo superadmin_url('users/login') ?>" action="<?php echo superadmin_url('users/login') ?>" method="post">
                                <!--begin::Heading-->
                                <div class="text-center mb-11">
                                    <!--begin::Title-->
                                    <h1 class="text-dark fw-bolder mb-3"><?php echo $this->lang->line('heading_signin') ?></h1>
                                    <!--end::Title-->
                                    <!--begin::Subtitle-->
                                    <div class="text-gray-500 fw-semibold fs-6"><?php echo $this->lang->line('heading_login_sub_heading') ?></div>
                                    <!--end::Subtitle=-->
                                </div>
                                <!--begin::Heading-->
                                <!--begin::Login options-->
                                
                                
                                <!--end::Separator-->
                                <!--begin::Input group=-->
                                <div class="fv-row mb-8">
                                    <!--begin::Email-->
                                    <input type="email" placeholder="<?php echo $this->lang->line('heading_email') ?>" name="email" autocomplete="off" class="form-control bg-transparent" />
                                    <!--end::Email-->
                                </div>
                                <!--end::Input group=-->
                                <div class="fv-row mb-3" data-kt-password-meter="true">
                                    <!--begin::Password-->
                                    <input type="password" placeholder="<?php echo $this->lang->line('heading_password') ?>" name="password" autocomplete="off" class="form-control bg-transparent" />
                                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                        <i class="bi bi-eye-slash fs-2"></i>
                                        <i class="bi bi-eye fs-2 d-none"></i>
                                    </span>
                                    <!--end::Password-->
                                </div>
                                <!--end::Input group=-->
                                <!--begin::Wrapper-->
                                
                                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8 d-none">
                                    <div></div>
                                    <!--begin::Link-->
                                    <a href="<?php echo superadmin_url('users/forgot_password') ?>" class="link-primary"><?php echo $this->lang->line('heading_forgot_password') ?></a>
                                    <!--end::Link-->
                                </div>

                                <!--end::Wrapper-->
                                <!--begin::Submit button-->
                                <div class="d-grid mb-10">
                                    <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label"><?php echo $this->lang->line('heading_signin') ?></span>
                                        <!--end::Indicator label-->
                                        <!--begin::Indicator progress-->
                                        <span class="indicator-progress"><?php echo $this->lang->line('heading_wait') ?>
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        <!--end::Indicator progress-->
                                    </button>
                                </div>
                                <!--end::Submit button-->
                                <!--begin::Sign up-->
                                <div class="text-gray-500 text-center fw-semibold fs-6">&nbsp;</div>
                                <!--end::Sign up-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Authentication - Sign-in-->
        </div>
        <!--end::Root-->
        <!--begin::Javascript-->
        <script>var hostUrl = "assets/";</script>
        <!--begin::Global Javascript Bundle(mandatory for all pages)-->
        <script src="<?php echo base_url(BASE_ASSETS_PATH.SUPERADMIN."/plugins/global/plugins.bundle.js") ?>"></script>
        <script src="<?php echo base_url(BASE_SUPERADMIN_JS_PATH."scripts.bundle.js") ?>"></script>
        <!--end::Global Javascript Bundle-->
        <!--begin::Custom Javascript(used for this page only)-->
        <script src="<?php echo base_url(BASE_SUPERADMIN_JS_PATH."custom/authentication/sign-in/general.js") ?>"></script>
        <!--end::Custom Javascript-->
        <!--end::Javascript-->
        <?php $this->load->view(SUPERADMIN."/common/flash_message"); ?>
    </body>
    <!--end::Body-->
</html>
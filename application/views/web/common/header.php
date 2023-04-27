<?php $this->load->view("web/common/flash_message"); ?>
<div class="preloader d-none">
    <div class="loader">
        <img src="<?php echo base_url(BASE_WEB_IMAGES_PATH . "class-hud-loader.gif"); ?>" alt="loader" />
    </div>
</div>

<div class="loader_div d-none">
    <img src="<?php echo base_url(BASE_WEB_IMAGES_PATH . "class-hud-loader.gif"); ?>" alt="loader" width="200px"/>
</div>

<header class="wp-site-header header-builder-frontend header-position-relative" id="header">
    <div class="canvas-mobile">
        <div class="canvas-menu gva-offcanvas hidden">
            <a class="dropdown-toggle" data-canvas=".mobile" href="#"><i class="icon las la-bars"></i></a>
        </div>
        <div class="gva-offcanvas-content mobile">
            <div class="top-canvas">
                <a class="logo-mm" href="<?php echo $this->base_url; ?>">
                    <img src="<?php echo base_url(BASE_WEB_IMAGES_PATH."logo/class-hud-m-logo.svg") ?>" alt="<?php echo $this->lang->line("heading_logo_alt") ?>" />
                </a>
                <a class="control-close-mm" href="#"><i class="las la-times-circle"></i></a>
            </div>
            <div class="wp-sidebar sidebar">
                <div id="gva-mobile-menu" class="navbar-collapse">
                    <ul id="menu-main-menu" class="gva-nav-menu gva-mobile-menu">
                        <li id="menu-item-1629" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-18 current_page_item current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor menu-item-has-children menu-item-1629">
                            <a href="<?php echo $this->base_url; ?>" data-link_id="link-6487">
                                <span class="menu-title">Home</span>
                                <!--<span class="la la-angle-down"></span>-->
                            </a>
                        </li>
                        <li id="menu-item-1633" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-1633">
                            <a <?php echo empty($this->user_data["id"]) ? "href='#' data-bs-toggle='modal' data-bs-target='#form-ajax-login-popup'" : "href='".base_url("listing/add")."'"; ?>>
                                <span class="menu-title">Add Listings</span>
                            </a>
                            
                        </li>
                        
                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-1630 menu-active">
                            <a <?php echo !empty($this->user_data["id"]) ? "href='".base_url("dashboard")."'":"href='#' data-bs-toggle='modal' data-bs-target='#form-ajax-login-popup'"; ?>>
                                <span class="menu-title">Account</span>
                                <span class="la la-angle-down">
                                </span>
                            </a>
                            <ul class="submenu-inner" style="display:block">
                                <?php if(empty($this->user_data["id"])) { ?>
                                <li id="menu-item-1603" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1603">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#form-ajax-login-popup">
                                        <i class="icon la la-user-circle-o"></i>
                                        <span class="menu-title"><?php echo $this->lang->line("heading_login") ?></span>
                                    </a>
                                </li>
                                <li id="menu-item-1603" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1603">
                                    <a  href="<?php echo base_url("users/signup") ?>">
                                        <i class="icon las la-user-plus"></i>
                                        <span class="menu-title"><?php echo $this->lang->line("heading_register") ?></span>
                                    </a>
                                </li>
                                <?php }else{ ?>
                                <li id="menu-item-1603" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1603">
                                    <a href="<?php echo base_url("dashboard") ?>" >
                                        <i class="icon la la-user-circle-o"></i>
                                        <span class="menu-title"><?php echo $this->lang->line("heading_my_profile") ?></span>
                                    </a>
                                </li>
                                <li id="menu-item-1603" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1603">
                                    <a href="<?php echo base_url("users/signout") ?>">
                                        <i class="la la-power-off"></i>
                                        <span class="menu-title"><?php echo $this->lang->line("heading_logout") ?></span>
                                    </a>
                                </li>
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>          
    <div class="header_default_screen">
        <div class="header-builder-inner">
            <div class="header-main-wrapper">       
                <div data-elementor-type="wp-post" data-elementor-id="865" class="elementor elementor-865">
                    <section class="elementor-section elementor-top-section elementor-element elementor-element-e070a1c elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="e070a1c" data-element_type="section">
                        <div class="elementor-container elementor-column-gap-default">
                            <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-7f8bcf6" data-id="7f8bcf6" data-element_type="column">
                                
                            </div>
                            <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-7822bab" data-id="7822bab" data-element_type="column">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div class="elementor-element elementor-element-12065a6 elementor-widget__width-auto elementor-hidden-mobile elementor-widget elementor-widget-gva-user-wishlist" data-id="12065a6" data-element_type="widget" data-widget_type="gva-user-wishlist.default">
                                        <div class="elementor-widget-container">
                                            <div class="gva-element-gva-user-wishlist gva-element">
                                                <div class="user-wishlist  text-center">
                                                    <div class="user-wishlist-content">
                                                        <div class="user-account">
                                                            <div class="my_account_nav_list gva-user-menu pt-2 pb-2" >
                                                                
                                                                <?php if(empty($this->user_data["id"])) { ?>
                                                                
                                                                    <a style="color:white;padding-right:10px;" class="login-link" href="#" data-bs-toggle="modal" data-bs-target="#form-ajax-login-popup">
                                                                        <i class="icon la la-user-circle-o"></i>
                                                                        <?php echo $this->lang->line("heading_login") ?>          
                                                                    </a>
                                                                    <a style="color:white;padding-right:10px;" class="register-link" href="<?php echo base_url("users/signup") ?>">
                                                                        <i class="icon las la-user-plus"></i>
                                                                        <span class="register-text"><?php echo $this->lang->line("heading_register") ?></span>
                                                                    </a>
                                                                <?php }else{ ?>
                                                               
                                                                    <a class="register-link text-white" href="<?php echo base_url("dashboard") ?>">
                                                                        <i class="icon la la-user-circle-o"></i>
                                                                        <?php echo $this->lang->line("heading_my_profile") ?>
                                                                    </a>
                                                               
                                                                    <a class="register-link text-white" href="<?php echo base_url("users/signout") ?>">
                                                                        <i class="la la-power-off"></i>
                                                                        <span class="register-text"><?php echo $this->lang->line("heading_logout") ?></span>
                                                                    </a>
                                                               
                                                                <?php } ?>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>      
                                        </div>
                                    </div>
                                  <!--  <div class="elementor-element elementor-element-fa19bb2 elementor-align-center elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="fa19bb2" data-element_type="widget" data-widget_type="button.default">
                                        <div class="elementor-widget-container">
                                            <div class="elementor-button-wrapper">
                                                <a href="<?php echo base_url("listing/add"); ?>" class="elementor-button-link elementor-button elementor-size-sm" role="button">
                                                    <span class="elementor-button-content-wrapper">
                                                        <span class="elementor-button-icon elementor-align-icon-left">
                                                            <i aria-hidden="true" class="fi flaticon-plus"></i>         
                                                        </span>
                                                        <span class="elementor-button-text"><?php echo $this->lang->line("heading_add_listing") ?></span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                              -->  </div>
                            </div>
                        </div>
                    </section>
                    <section class="elementor-section elementor-top-section elementor-element elementor-element-690f6ef elementor-section-boxed elementor-section-height-default elementor-section-height-default header_logo" data-id="690f6ef" data-element_type="section" id="header_menu">
                        <div class="elementor-container elementor-column-gap-default">
                            <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-fc0b1a9" data-id="fc0b1a9" data-element_type="column">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div class="elementor-element elementor-element-c4e7c98 elementor-widget elementor-widget-gva-logo" data-id="c4e7c98" data-element_type="widget" data-widget_type="gva-logo.default">
                                        <div class="elementor-widget-container">
                                            <div class="gva-element-gva-logo gva-element">      
                                                <div class="gsc-logo text-left">

                                                    <a class="site-branding-logo" href="<?php echo $this->base_url; ?>" title="Home" rel="Home">
                                                        <img src="<?php echo base_url(BASE_WEB_IMAGES_PATH."logo/class-hud-logo.svg") ?>" alt="<?php echo $this->lang->line("heading_logo_alt") ?>" />
                                                    </a>
                                                </div>
                                            </div>      
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-c99722a" data-id="c99722a" data-element_type="column">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div class="elementor-element elementor-element-db4ea7d elementor-hidden-tablet elementor-hidden-mobile elementor-widget__width-auto elementor-widget elementor-widget-gva-navigation-menu" data-id="db4ea7d" data-element_type="widget" data-widget_type="gva-navigation-menu.default">
                                        <div class="elementor-widget-container">
                                            <div class="gva-element-gva-navigation-menu gva-element">
                                                <div class="gva-navigation-menu  menu-align-right">
                                                    <div class="menu-main-menu-container"><ul id="menu-869830250" class="gva-nav-menu gva-main-menu"><li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-18 current_page_item current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor menu-item-has-children menu-item-1629"><a href="<?php echo $this->base_url; ?>" data-link_id="link-2811"><span class="menu-title">Home</span>
                                                                    <!--<span class="la la-angle-down"></span>-->
                                                                </a>
                                                            </li>
                                                            
                                                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1643"><a href="<?php echo base_url("about") ?>" data-link_id="link-5484"><span class="menu-title">About us</span></a></li>
                                                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1643">
                                                                <a class="popup-video" href="https://www.youtube.com/watch?v=aHOoGF-PTcc">
                                                                    <span><?php echo $this->lang->line("heading_how_it_works"); ?></span>
                                                                </a>
                                                            </li>
<!--                                                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1643">
                                                                <a  href="<?php echo base_url("blogs") ?>">
                                                                    <span><?php echo $this->lang->line("heading_blogs_title"); ?></span>
                                                                </a>
                                                            </li>-->
                                                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1643"><a href="<?php echo base_url("contact-us") ?>" data-link_id="link-5484"><span class="menu-title">Contact</span></a></li>
                                                            
                                                            
                                                               
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>      
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-2d49e4c elementor-widget__width-auto elementor-widget elementor-widget-gva_user" data-id="2d49e4c" data-element_type="widget" data-widget_type="gva_user.default">
                                        <div class="elementor-widget-container">
                                            <div class="gva-element-gva_user gva-element">
                                                <div class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1643"> 
                                                    <div class="elementor-element elementor-element-fa19bb2 elementor-align-center elementor-widget__width-auto elementor-widget elementor-widget-button" data-id="fa19bb2" data-element_type="widget" data-widget_type="button.default">
                                                        
                                                        <div class="elementor-widget-container">
                                                            <div class="elementor-button-wrapper">
                                                                <a href="<?php echo !empty($this->user_data["id"]) ? base_url("listing/add"):base_url("users/signup"); ?>" class="elementor-button-link elementor-button elementor-size-sm" role="button" >
                                                                    <span class="elementor-button-content-wrapper">
                                                                        <span class="elementor-button-icon elementor-align-icon-left">
                                                                            <i aria-hidden="true" class="fi flaticon-plus"></i>         
                                                                        </span>
                                                                        <span class="elementor-button-text"><?php echo $this->lang->line("heading_add_listing") ?></span>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                           </div>       
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-8448d64 elementor-widget-tablet__width-auto elementor-hidden-desktop elementor-widget__width-auto elementor-widget elementor-widget-gva-navigation-mobile" data-id="8448d64" data-element_type="widget" data-widget_type="gva-navigation-mobile.default">
                                        <div class="elementor-widget-container">
                                            <div class="gva-element-gva-navigation-mobile gva-element">
                                                <div class="gva-navigation-mobile">
                                                    <div class="canvas-menu gva-offcanvas">
                                                        <a class="dropdown-toggle" data-canvas=".mobile" href="#"><i aria-hidden="true" class=" las la-bars"></i></a>   </div>
                                                </div>

                                            </div>      
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>              
        </div> 
    </div> 
</header>
<div class="modal fade modal-ajax-user-form" id="form-ajax-login-popup" tabindex="-1" role="dialog" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header-form"> <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">x</span> </button>
            </div>
            <div class="modal-body">
                <div class="ajax-user-form"><h2 class="title">Welcome</h2>
                    <p class="text-center">Sign In for a seamless experience</p>
                    <div class="form-ajax-login-popup-content">
                        <form class="form w-100" id="kt_sign_in_form" action="<?php echo base_url("users/signin"); ?>" method="post" novalidate="" modalDialog="1" >
                            <div class="form-status"></div>
                            <div class="form-group"> 
                                <!--<label for="username"><?php echo $this->lang->line("heading_mobile_no") ?></label>--> 
                                <input id="username" data-validation-regex-regex="^[0-9]*$" data-validation-regex-message="Invalid Phone Number" minlength="10" maxlength="10" type="text" placeholder="<?php echo $this->lang->line("heading_mobile_no") ?>" name="username" autocomplete="off" class="form-control"  required="" data-validation-required-message="<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_mobile_no") ) ?>"/>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group"> 
                                <!--<label for="password"><?php echo $this->lang->line("heading_password") ?></label>--> 
                                <input id="password" type="password" placeholder="<?php echo $this->lang->line("heading_password") ?>" name="password" autocomplete="off" class="form-control" required="" data-validation-required-message="<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_password") ) ?>" />
                                <span class="help-block"></span>
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Submit button-->
                            <div class="d-grid mb-2">
                                <button type="submit" id="kt_sign_in_submit" class="btn-theme btn-fw">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label"><?php echo $this->lang->line("heading_signin") ?></span>
                                    <!--end::Indicator label-->
                                    
                                </button>
                            </div>
                            <!--end::Submit button-->
                            <!--begin::Sign up-->
                            <div class="text-gray-500 text-center fw-semibold fs-6 lost-password">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#form-ajax-lost-password-popup" data-target="#form-ajax-lost-password-popup"><?php echo $this->lang->line("heading_forgot_password") ?></a>
                            </div>
                            <!--end::Sign up-->
                        </form>
                    </div>
                    <div class="user-registration">
                        <?php echo sprintf($this->lang->line("heading_new_user"),base_url("users/signup")); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-ajax-user-form" id="form-ajax-lost-password-popup" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header-form"> 
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">x</span> </button>
            </div>
            <div class="modal-body">
                <div class="ajax-user-form"><h2 class="title"><?php echo $this->lang->line("heading_reset_password") ?></h2>
                    <div class="form-ajax-login-popup-content">
                        <form id="kt_lost_password" class="ajax-form-content" method="post" action="<?php echo base_url("users/forgot_password") ?>" name="kt_lost_password" novalidate="" modalDialog="1">
                            <div class="form-group"> 
                                <label for="forget_pwd_user_login"><?php echo $this->lang->line("heading_username_phone") ?></label>
                                <input type="text" name="username" class="control-form input-fw form-control" id="forget_pwd_user_login" placeholder="<?php echo $this->lang->line("heading_username_phone") ?>" data-validation-required-message="<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_username_phone") ) ?>" />
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group form-action"> 
                                <button type="submit" name="submit_reset_password" id="kt_forgot_password_submit" class="btn-theme btn-fw" value="1">
                                    <span class="indicator-label"><?php echo $this->lang->line("heading_get_new_paassword") ?></span>
                                    <!--
                                    <span class="indicator-progress"><?php echo $this->lang->line("heading_wait") ?>
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    -->
                                </button>
                                
                            </div>
                        </form>
                    </div>
                    <div class="user-registration">
                        <?php echo sprintf($this->lang->line("heading_new_user"),base_url("users/signup")); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if( !empty($this->user_data["id"]) && empty($this->user_data["password_set"]) ) { $this->load->view("web/common/set_password");} ?>
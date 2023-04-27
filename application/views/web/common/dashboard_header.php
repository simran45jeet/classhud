<?php $this->load->view("web/common/flash_message"); ?>
<div class="preloader">
    <div class="loader">
        <img src="<?php echo base_url(BASE_WEB_IMAGES_PATH . "class-hud-loader.gif"); ?>" alt="loader"/>
    </div>
</div>
<div class="loader_div d-none">
    <img src="<?php echo base_url(BASE_WEB_IMAGES_PATH . "class-hud-loader.gif"); ?>" alt="loader" width="200px"/>
</div>

<div class="my-account-header" id="header_menu">
    <div class="header-left">
        <div class="logo">
             <a class="logo-mm site-branding-logo" href="<?php echo $this->base_url; ?>">
                <img src="<?php echo base_url(BASE_WEB_IMAGES_PATH."logo/class-hud-logo.svg") ?>" alt="<?php echo $this->lang->line("heading_logo_alt") ?>" />
            </a>
        </div>
    </div>
    <div class="header-right">
        <div class="me-3 add_institute_dashboard"> 
            <a href="<?php echo base_url("listing/add") ?>" class="btn-theme btn-action text-white text-capitalize fw-normal"> 
                <!--<i class="bi bi-building-fill-add"></i>&nbsp;-->
                <?php echo $this->lang->line("heading_add_listing") ?> 
            </a>
        </div>
        <div class="user-profile">
            <div class="avata">
                <div class="user-avatar">
                    <img src="<?php echo $this->user_data["image"] ?>" alt="<?php echo $this->user_data["full_name"] ?>" />
                    <img class="lazyload" src="<?php echo $this->user_data["image"] ?>" data-src="<?php echo $this->user_data["image"] ?>" alt="<?php echo $this->user_data["full_name"] ?>"/>
                </div>
            </div>
            <div class="name"> <span class="user-text"> <?php echo $this->user_data["full_name"]; ?> </span>
            </div>
        </div>
    </div>
</div>
<?php if( !empty($this->user_data["id"]) && empty($this->user_data["password_set"]) ) { $this->load->view("web/common/set_password");} ?>
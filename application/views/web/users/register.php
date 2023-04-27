<section class="main-page-content">
    <div id="job-manager-job-dashboard"> 
        <div class="dashboard-content-wrapper">
            <div class="dashboard-main-content without-login">
                <div class="dashboard-content-inner p-0">
                    <div class="dashboard-inner-block user-login-form">
                        <div class="ajax-user-form">
                            <h2 class="title">Register Now</h2>
                            <p class="text-center">Join the Class Hud community today and explore endless educational opportunities!</p>
                            <form  action="<?php echo $main_form_url ?>" id="ajax-register-user" method="post" class="ajax-form-content register-form" novalidate="">
                                <div class="form-group"> 
                                    <!--<label for="full_name"><?php echo $this->lang->line("heading_full_name") ?></label>--> 
                                    <input type="text" class="form-control" placeholder="<?php echo $this->lang->line("heading_full_name") ?>" name="full_name" value="<?php echo !empty($post_data['full_name']) ? $post_data['full_name'] : ""; ?>" id="full_name" required=""/>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <!--<label for="phone_no"><?php echo $this->lang->line("heading_phone") ?></label>-->
                                        <div class="col-sm-6 col-md-4 col-lg-4 d-none">
                                            <select class="form-control form-control-select" name="phone_code" id="phone_code" >
                                                <option value=""><?php echo $this->lang->line("heading_phone_code") ?></option>
                                                <?php foreach ($phone_codes as $phone_code) { ?>
                                                    <option value="<?php echo encrypt($phone_code["id"]) ?>" <?php echo ( (!empty($post_date['phone_code']) && decrypt($post_date['phone_code']) == $phone_code["id"] ) || count($phone_codes) == 1 ) ? "selected=''" : ""; ?>><?php echo $phone_code["phonecode"] ?></option>
                                                <?php } ?>
                                            </select>
 
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <input type="text" data-validation-regex-regex="^[0-9]*$" data-validation-regex-message="Invalid Phone Number"  class="form-control no_arrow" maxlength="10" minlength="10" placeholder="<?php echo $this->lang->line("heading_phone") ?>" name="phone_no"  value="<?php echo!empty($post_data['phone_no']) ? $post_data['phone_no'] : ""; ?>" id="phone_no" required="" maxlength="10" minlength="10"/>
                                            <span class="help-block"></span>
                                        </div>
                                        
                                        <span class="text-danger"><?php echo form_error("phone_code") . form_error("phone_no") ?></span>
                                    </div>
                                </div>
                                <div class="form-group form-action"> 
                                    <button type="submit" class="btn-theme btn-fw" id="kt_register_submit">
                                        <span class="indicator-label"><?php echo $this->lang->line("heading_register_now") ?></span>
                                        <!--
                                        <span class="indicator-progress"><?php echo $this->lang->line("heading_wait") ?>
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        -->
                                    </button>
                                </div>
                            </form>
                            <div class="user-registration"> 
                                <?php echo $this->lang->line("heading_already_have_account") ?>
                                <a class="login-popup" data-bs-toggle="modal" data-bs-target="#form-ajax-login-popup"><?php echo $this->lang->line("heading_login") ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<?php if( !empty($this->user_data["id"]) && empty($this->user_data["password_set"]) ) { ?>
<div class="modal fade modal-ajax-user-form" id="form-ajax-set-password" tabindex="-1" role="dialog" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="ajax-user-form"><h2 class="title"><?php echo $this->lang->line("heading_set_passwords") ?></h2>
                    <div class="form-ajax-login-popup-content">
                        <form id="kt_set_password" class="ajax-form-content" method="post" action="<?php echo base_url("users/set_password") ?>" name="kt_set_password"  novalidate="" modalDialog="1">
                            <div class="form-group position-relative"> 
                                <label for="password"><?php echo $this->lang->line("heading_new_password") ?></label>
                                <input type="password" name="password" minlength='8' class="control-form input-fw form-control password" id="password" placeholder="<?php echo $this->lang->line("heading_new_password") ?>" autocomplete="off" required="" data-validation-required-message="<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_new_password") ) ?>"/>
                                <span class="help-block"></span>
                                <span class="input-group-addon">
                                    <a href="javascript:;">
                                        <i class="far fa-eye cursor-pointer toggle-password position-absolute end-0 top-0 pt-4 mt-3 me-2" data-rel="password"></i>
                                    </a>
                                </span>
                            </div>
                            <div class="form-group position-relative"> 
                                <label for="password"><?php echo $this->lang->line("heading_confirm_new_password") ?></label>
                                <input type="password" name="confirm_password" minlength='8' class="control-form input-fw form-control password " id="confirm_password" placeholder="<?php echo $this->lang->line("heading_confirm_new_password") ?>" autocomplete="off" required="" data-validation-required-message="<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_confirm_new_password") ) ?>" />
                                <span class="help-block"></span>
                                <span class="input-group-addon">
                                        <a href="javascript:;">
                                            <i class="far fa-eye cursor-pointer toggle-password position-absolute end-0 top-0 pt-4 mt-3 me-2" data-rel="confirm_password" ></i>
                                        </a>
                                    </span>
                            </div>
                            <div class="form-group form-action"> 
                                <button type="submit" name="submit_set_password" id="kt_set_password_submit" class="btn-theme btn-fw" value="1">
                                    <span class="indicator-label"><?php echo $this->lang->line("heading_set_new_paassword") ?></span>
                                    <!--
                                    <span class="indicator-progress"><?php echo $this->lang->line("heading_wait") ?>
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    -->
                                </button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    "use strict";
    $(function () {
        //KTSetPasswordGeneral.init();
        $("#form-ajax-set-password").modal("show")  
    });
</script>
<?php } ?>

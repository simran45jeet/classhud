<!-- Modal HTML -->
<div id="delete_confirmation" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="material-icons"></i>
                </div>              
                <h4 class="modal-title" id="confirm_delete"></h4>  
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body"  id="confirm_delete_mess">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $this->lang->line('heading_no'); ?></button>
                <a href="#" id="delete_url"><button type="button" class="btn btn-success"><?php echo $this->lang->line('heading_yes'); ?></button></a>
            </div>
        </div>
    </div>
</div>
<div id="status_confirmation" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="material-icons"></i>
                </div>              
                <h4 class="modal-title" id="confirm_status"></h4>  
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body"  id="confirm_status_mess">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success yes_confirm"><?php echo $this->lang->line('yes'); ?></button>
                <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $this->lang->line('no'); ?></button>
            </div>
        </div>
    </div>
</div>
<div id="time_confirmation" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="material-icons"></i>
                </div>              
                <h4 class="modal-title">Confirmation</h4>  
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body" >
                From time must be smaller then to time
            </div>
            <div class="modal-footer">
                <a href="#" id="confirm_time"><button type="button" class="btn btn-success"><?php echo $this->lang->line('ok'); ?></button></a>
            </div>
        </div>
    </div>
</div>
<div id="publish_request" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="material-icons"></i>
                </div>              
                <h4 class="modal-title" id="conf_status">Restaurant Confirmation</h4>  
                <button type="button" class="close no_pub">&times;</button>
            </div>
            <div class="modal-body">
                <div id="confirm_mess"></div>
                <div class="form-group">

                    <label class="switch">
                        <?php
                            $active = FALSE;
                            $extra['id'] = 'sendpubunpubemail';
                            echo form_checkbox('send_email', '1', $active, $extra);
                        ?> 
                        <span class="slider"></span>
                    </label>
                    &nbsp;&nbsp;Send Email
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success yes_pub"><?php echo $this->lang->line('yes'); ?></button>
                <button type="button" class="btn btn-primary no_pub"><?php echo $this->lang->line('no'); ?></button>
            </div>
        </div>
    </div>
</div>

<div id="country_setting" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="material-icons"></i>
                </div>              
                <h4 class="modal-title" id="conf_status">Country Setting</h4>  
                <button type="button" class="close no_pub">&times;</button>
            </div>
            <div class="modal-body"  id="cs_mess">
            </div>
        </div>
    </div>
</div>     

<div id="country_setting" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="material-icons"></i>
                </div>              
                <h4 class="modal-title" id="conf_status">Country Setting</h4>  
                <button type="button" class="close no_pub">&times;</button>
            </div>
            <div class="modal-body"  id="cs_mess">
            </div>
        </div>
    </div>
</div>

<!-- The core Firebase JS SDK is always required and must be listed first -->
<!--<script src="<?= base_url('assets/js/firebase-app.js') ?>"></script>-->
<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<!--<script src="<?= base_url('assets/js/firebase-analytics.js') ?>"></script>-->
<!--<script src="<?= base_url('assets/js/firebase-init.js') ?>"></script>-->
<!--<script src="<?= base_url('assets/js/firebase-messaging.js') ?>"></script>-->
<!--<script src="<?= base_url('assets/js/socket.io.js') ?>"></script>-->
<script src="<?= base_url('assets/backend/app-assets/vendors/js/extensions/toastr.min.js') ?>"></script>
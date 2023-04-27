<section class="main-page-content">
    <div id="job-manager-job-dashboard"> 
        <div class="dashboard-content-wrapper">
            <div class="dashboard-main-content without-login">
                <div class="dashboard-content-inner p-0">
                    <div class="dashboard-inner-block user-login-form">
                        <div class="ajax-user-form">
                            <h2 class="title"><?php echo $this->lang->line("heading_verify_account") ?></h2>
                            <form method="post" action="<?php echo $main_form_url; ?>" id="kt_verify_form" novalidate="">
                                <div class="form-group">
                                    <label for="otp"><?php echo $this->lang->line("heading_enter_verify_code") ?></label>
                                    <input type="text" class="form-control mb-0" data-validation-regex-regex="^[0-9]*$" data-validation-regex-message="Invalid OTP" minlength="6" maxlength="6" placeholder="<?php echo $this->lang->line("heading_enter_verify_code_placeholder") ?>" name="otp" id="otp" required=""/>
                                    <span class="help-block" ></span>

                                    <div style="font-size:13px; color:#E12829;" id="resend">Resend OTP in: <span id="timer"></span></div>
                                    <span class="text-danger"><?php echo form_error("otp"); ?></span>
                                </div>
                                <div class="form-group form-action"> 
                                    <button type="submit" class="btn-theme btn-fw" id="kt_register_submit">
                                        <span class="indicator-label"><?php echo $this->lang->line("heading_submit_btn") ?></span>
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
</section>

<script type="text/javascript">
    var timerOn = true;

    function timer(remaining) {
        var m = Math.floor(remaining / 60);
        var s = remaining % 60;

        m = m < 10 ? '0' + m : m;
        s = s < 10 ? '0' + s : s;
        document.getElementById('timer').innerHTML = m + ':' + s;
        remaining -= 1;

        if (remaining >= 0 && timerOn) {
            setTimeout(function () {
                timer(remaining);
            }, 1000);
            return;
        }

        if (!timerOn) {
            // Do validate stuff here
            return;
        }

        // Do timeout stuff here
        // alert('Timeout for otp');

        $("#resend").html('<a href="<?php echo base_url("{$controller_name}/resend_verify_claim_code/{$edited_id}") ?>" style="float:right; color:#E12829;" /><?php echo $this->lang->line("heading_resend") ?></a>');

    }

    timer('90');
</script>
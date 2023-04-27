<section class="fioxen-add-listing pt-120 pb-120">
    <div class="container">
        <form method="post" action="<?php echo base_url("users/forgot_password") ?>" id="kt_register_form">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="add-listing-form general-listing-form mb-60 wow fadeInUp">
                        <h4 class="title"><?php echo $this->lang->line("heading_forgot_password") ?></h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <lable><?php echo $this->lang->line("heading_username_phone") ?></lable>
                                    <input type="text" class="form_control mb-0" placeholder="<?php echo $this->lang->line("heading_username_phone") ?>" name="username" value="" />
                                    <span class="text-danger"><?php echo form_error("username"); ?></span>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="button text-center">
                        <button class="main-btn icon-btn" type="submit" id="kt_register_submit"><?php echo $this->lang->line("heading_get_new_password") ?></button>
                        <h4 class="text-center mt-2">
                            <?php echo sprintf($this->lang->line("heading_new_user"),base_url("users/signup")) ?>
                        </h4>
                    </div>
                    </div>                    
                </div>
            </div>
        </form>
    </div>
</section>
<script type="text/javascript">
    var KTForm = (function () {
        var t, e, i;
        return {
            init: function () {
                (i = document.querySelector("#kt_register_form")),
                    (t = document.getElementById("kt_register_submit")),
                    (e = FormValidation.formValidation(i, {
                        fields: {
                            username: { validators: { notEmpty: { message: "<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_username") ) ?>" } } },
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap: new FormValidation.plugins.Bootstrap5({rowSelector: ".form-group", eleInvalidClass: "", eleValidClass: ""}),
                            defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                        },
                    })),
                    i.addEventListener("submit", function (i2) {
                            i2.preventDefault(),
                            e &&
                            e.validate().then(function (e) {                        
                                "Valid" == e
                                ? (t.setAttribute("data-kt-indicator", "on"),
                                        (t.disabled = !0),
                                        setTimeout(function () {
                                            t.removeAttribute("data-kt-indicator"),
                                                    (t.disabled = !1),
                                                    Swal.fire({text: "<?php echo $this->lang->line("message_form_submit_success") ?>", icon: "success", buttonsStyling: !1, confirmButtonText: "<?php echo $this->lang->line("heading_form_submit_success_btn") ?>", customClass: {confirmButton: "btn btn-primary"}}).then(
                                                    function (t) {
                                                        t.isConfirmed;
                                                    }
                                            );
                                        }, 0))
                                : Swal.fire({
                                    text: "<?php echo $this->lang->line("message_form_submit_error") ?>",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "<?php echo $this->lang->line("heading_form_submit_error_btn") ?>",
                                    customClass: {confirmButton: "btn btn-danger"},
                                }).then(function (t) {
                            KTUtil.scrollTop();
                        });
                    });
                });
            },
        };
    })();
    $(function () {
        KTForm.init();
    });
</script>
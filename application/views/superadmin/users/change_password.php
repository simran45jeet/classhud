
<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_change_password">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bold m-0"><?php echo $this->lang->line("heading_change_password") ?></h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->
    <!--begin::Content-->
    <div id="kt_change_password" class="collapse show">
        <!--begin::Form-->
        <form id="kt_change_password_form" class="form" action="<?php echo $main_form_url ?>" enctype="multipart/form-data" method="post" name="kt_change_password_form">
            <div class="card-body border-top p-9">
                <div class="row mb-1">
                <div class="col-lg-4">
                    <div class="fv-row mb-0">
                        <label for="current_password" class="form-label fs-6 fw-bold mb-3"><?php echo $this->lang->line("heading_current_password") ?></label>
                        <input type="password" class="form-control form-control-lg form-control-solid" name="current_password" id="current_password" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="fv-row mb-0">
                        <label for="new_password" class="form-label fs-6 fw-bold mb-3"><?php echo $this->lang->line("heading_new_password") ?></label>
                        <input type="password" class="form-control form-control-lg form-control-solid" name="new_password" id="new_password" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="fv-row mb-0">
                        <label for="confirm_password" class="form-label fs-6 fw-bold mb-3"><?php echo $this->lang->line("heading_confirm_new_password") ?></label>
                        <input type="password" class="form-control form-control-lg form-control-solid" name="confirm_password" id="confirm_password" />
                    </div>
                </div>
            </div>
                <!--<div class="form-text mb-5">Password must be at least 8 character and contain symbols</div>-->
            </div>
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button id="kt_password_submit" type="submit" class="btn btn-primary me-2 px-6"><?php echo $this->lang->line("message_update") ?></button>
                <button id="kt_password_cancel" type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6"><?php echo $this->lang->line("heading_cancel") ?></button>
            </div>
        </form>
        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>
<script type="text/javascript">
    var KTForm = (function () {
        var t, e, i;
        return {
            init: function () {
                (i = document.querySelector("#kt_change_password_form")),
                    (t = document.getElementById("kt_password_submit")),
                    (e = FormValidation.formValidation(i, {
                        fields: {
                            current_password: { validators: { notEmpty: { message: "<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_current_password") ) ?>" },stringLength:{min:<?php echo PASSWORD_MIN_LENGTH ?>,message:"<?php echo $this->lang->line("message_password_min_length") ?>"} } },
                            new_password: { validators: { notEmpty: { message: "<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_new_password") ) ?>" },stringLength:{min:<?php echo PASSWORD_MIN_LENGTH ?>,message:"<?php echo $this->lang->line("message_password_min_length") ?>"} } },
                            confirm_password: {
                                validators: {
                                    notEmpty: { message: "<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_confirm_new_password") ) ?>" },
                                    identical: {
                                        compare: function () {
                                            return i.querySelector('[name="new_password"]').value;
                                        },
                                        message: "<?php echo $this->lang->line("message_same_password_error") ?>",
                                    },stringLength:{min:<?php echo PASSWORD_MIN_LENGTH ?>,message:"<?php echo $this->lang->line("message_password_min_length") ?>"}
                                },
                            },
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap: new FormValidation.plugins.Bootstrap5({rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: ""}),
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
                                                    Swal.fire({text: "Form has been successfully submitted!", icon: "success", buttonsStyling: !1, confirmButtonText: "Ok, got it!", customClass: {confirmButton: "btn btn-primary"}}).then(
                                                    function (t) {
                                                        t.isConfirmed;
                                                    }
                                            );
                                        }, 0))
                                : Swal.fire({
                                    text: "Sorry, looks like there are some errors detected, please try again.",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {confirmButton: "btn btn-primary"},
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
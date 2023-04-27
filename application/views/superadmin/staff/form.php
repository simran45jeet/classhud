<div class="d-flex justify-content-end pb-5" data-kt-customer-table-toolbar="base">
    <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
        <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0"><?php echo $title ?></h1>
            <!--end::Title-->
        </div>

        <div class="d-flex align-items-center gap-2 gap-lg-3">
            
        </div>
        <!--end::Add customer-->
    </div>
    <!--end::Toolbar-->
</div>
<!--begin::Careers - Apply-->
<div class="card">
    <!--begin::Body-->
    <div class="card-body p-lg-17">
        <!--begin::Layout-->
        <div class="d-flex flex-column flex-lg-row mb-17">
            <!--begin::Content-->
            <div class="flex-lg-row-fluid me-0 me-lg-20">
                <!--begin::Form-->
                <form  class="form mb-15" method="post" id="kt_add_form" action="<?php echo $main_form_url ?>" autocomplete="off">
                    <input type="hidden" name="option_for" value="<?php echo OPTIONS_FOR_ORGNIZATION ?>" />
                    <!--begin::Input group-->
                    <div class="row mb-5">
                        <!--begin::Col-->
                        <div class="col-md-12 fv-row">
                            <!--begin::Label-->
                            <label class="required fs-5 fw-semibold mb-2"><?php echo $this->lang->line('heading_full_name') ?></label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line('heading_full_name') ?>" name="full_name" value="<?php echo $post_data['full_name']?:""; ?>" />
                            <!--end::Input-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <div class="row mb-5">
                        <!--begin::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row">
                            <!--begin::Label-->
                            <label class="required fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_phone_no") ?></label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-xs-6">
                                    <select  data-control="select2" data-placeholder="<?php echo $this->lang->line("heading_phone_code") ?>" class="form-select form-select-solid" name="phone_code">
                                        <option value="">-<?php echo $this->lang->line("heading_phone_code") ?>-</option>
                                        <?php foreach( $phone_codes as $index => $phone_code ){ ?>
                                        <option value="<?php echo encrypt($phone_code['id']) ?>" <?php echo ( !empty($post_data['phone_code']) && decrypt($post_data['phone_code'])==$phone_code['id'] ) ?"selected=''":"" ?>><?php echo $phone_code['phonecode'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                
                                <div class="col-sm-6 col-md-6 col-xs-6">
                                   <input type="text" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_phone_no") ?>" name="phone_no" value="<?php echo $post_data['phone_no']?:""; ?>" />
                                </div>
                                <span class="text-danger"><?php echo form_error('phone_code').form_error('phone_no'); ?></span>
                            </div>
                            <!--end::Input-->
                        </div>
                        <!--end::Col-->
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row">
                            <!--end::Label-->
                            <label class="required fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_email") ?></label>
                            <!--begin::Select-->
                            <input type="email" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_email") ?>" name="email" value="<?php echo $post_data['email']?:""; ?>" />
                            <span class="text-danger"><?php echo form_error('email'); ?></span>
                            </select>
                            <!--end::Select-->
                            <!--end::Input-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <div class="row mb-5">
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row">
                            <!--end::Label-->
                            <label class="required fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_password") ?></label>
                            <!--begin::Select-->
                            <input type="password" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_password") ?>" name="password" value="" />
                            <!--end::Select-->
                            <!--end::Input-->
                        </div>
                        <!--end::Col-->
                        
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row">
                            <!--begin::Label-->
                            <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_staff_group") ?></label>
                            <select  data-control="select2" data-placeholder="<?php echo $this->lang->line("heading_staff_group") ?>" class="form-select form-select-solid" name="group_id">
                                <option value="">-<?php echo $this->lang->line("heading_staff_group") ?>-</option>
                                <?php foreach( $groups as $indedx => $group_detail ){ ?>
                                <option value="<?php echo encrypt($group_detail['id']) ?>" <?php echo ( !empty($post_data['group_id']) && decrypt($post_data['group_id'])==$group_detail['id'] ) ?"selected=''":"" ?>><?php echo $group_detail['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <!--end::Input group-->
                    
                    <div class="row mb-5">
                       
                        
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row">
                            <!--begin::Label-->
                            <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_status") ?></label>
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="<?php echo ACTIVE ?>" id="status" name="status" <?php echo ( !empty($post_data['status']) || !isset($post_data['status']) ) ? "checked=''":"" ?> />
                            </div>
                        </div>
                    </div>

                    <!--begin::Separator-->
                    <div class="separator mb-8 mt-8"></div>
                    <!--end::Separator-->
                    <!--begin::Submit-->
                    <button type="submit" class="btn btn-primary" id="kt_submit_button">
                        <!--begin::Indicator label-->
                        <span class="indicator-label"><?php echo $this->lang->line("heading_submit_btn") ?></span>
                        <!--end::Indicator label-->
                        <!--begin::Indicator progress-->
                        <span class="indicator-progress"><?php echo $this->lang->line("heading_wait") ?>
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        <!--end::Indicator progress-->
                    </button>
                    <!--end::Submit-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Layout-->

    </div>
    <!--end::Body-->
</div>
<!--end::Careers - Apply-->
<!--begin::Modals-->
<script type="text/javascript">
    var KTForm = (function () {
        var t, e, i;
        return {
            init: function () {
                (i = document.querySelector("#kt_add_form")),
                    (t = document.getElementById("kt_submit_button")),
                    (e = FormValidation.formValidation(i, {
                        fields: {
                            full_name: {validators: {notEmpty: {message: "Full Name is Required"}}},
                            phone_code: {validators: {notEmpty: {message: "Phone Code is Required"}}},
                            phone_no: {validators: { notEmpty: {message: "Phone No is Required"},numeric:{message:"Phone No is Invalid"} }},
                            email: {validators: {notEmpty: {message: "Email is Required"},emailAddress:{message: "Email is Invalid"}}},
                            <?php echo ( isset($password_required) && $password_required==true )?"password: {validators: {notEmpty: {message: \"password is Required\"}}}," : ""; ?>
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
       
        $(document).on("click",".delete_row",function(){
            $(this).closest(".fv-row").remove();
        });
    });
    
</script>
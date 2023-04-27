<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">Profile Details</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->
    <!--begin::Content-->
    <div id="kt_account_settings_profile_details" class="collapse show">
        <!--begin::Form-->
        <form id="kt_account_profile_details_form" class="form" action="<?php echo $main_form_url ?>" enctype="multipart/form-data" method="post">
            <!--begin::Card body-->
            <div class="card-body border-top p-9">
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-2 col-form-label fw-semibold fs-6"><?php echo $this->lang->line("heading_profile_image") ?></label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-10">
                        <!--begin::Image input-->
                        <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('<?php echo base_url(BASE_MEDIA_PATH."svg/avatars/blank.svg") ?>')">
                            <!--begin::Preview existing avatar-->
                            <div class="image-input-wrapper w-125px h-125px" style="background-image: url('<?php echo $post_data['image'] ?>')"></div>
                            <!--end::Preview existing avatar-->
                            <!--begin::Label-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="<?php echo $this->lang->line("heading_change_profile_image") ?>">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <!--begin::Inputs-->
                                <input type="file" name="image" accept="<?php echo IMAGE_ACCEPT_UPLOAD_TYPES ?>" />
                                <input type="hidden" name="avatar_remove" />
                                <!--end::Inputs-->
                            </label>
                            <!--end::Label-->
                            <!--begin::Cancel-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="<?php echo $this->lang->line("heading_change_profile_image"); ?>">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Cancel-->
                            <!--begin::Remove-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="<?php echo $this->lang->line("heading_change_profile_image"); ?>">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Remove-->
                        </div>
                        <!--end::Image input-->
                        <!--begin::Hint-->
                        <div class="form-text"><?php echo $this->lang->line("heading_allowed_image_upload_types") ?></div>
                        <!--end::Hint-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-2 col-form-label required fw-semibold fs-6"><?php echo $this->lang->line("heading_full_name") ?></label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-10">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-12 fv-row">
                                <input type="text" name="full_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="<?php echo $this->lang->line("heading_full_name") ?>" value="<?php echo $post_data['full_name'] ?>" />
                            </div>
                            <!--end::Col-->
                            
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-2 col-form-label required fw-semibold fs-6"><?php echo $this->lang->line("heading_email") ?></label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-10">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-12 fv-row">
                                <input type="text" name="email" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="<?php echo $this->lang->line("heading_email") ?>" value="<?php echo $post_data['email'] ?>" />
                            </div>
                            <!--end::Col-->
                            
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-2 col-form-label required fw-semibold fs-6"><?php echo $this->lang->line("heading_phone_no") ?></label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-10">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-3 fv-row">
                                <select  data-control="select2" data-placeholder="<?php echo $this->lang->line("heading_phone_code")?>" class="form-select form-select-solid" name="phone_code">
                                    <option value="">-<?php echo $this->lang->line("heading_phone_code") ?>-</option>
                                    <?php foreach( $phone_codes as $index => $phone_code ){ ?>
                                    <option value="<?php echo encrypt($phone_code['id']) ?>" <?php echo ( !empty($post_data['phone_code']) && decrypt($post_data['phone_code'])==$phone_code['id'] ) ?"selected=''":"" ?>><?php echo $phone_code['phonecode'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                            <div class="col-lg-9 fv-row">
                                <input type="text" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_phone_no") ?>"  value="<?php echo $post_data['phone_no']?:""; ?>" name="phone_no" id="phone_no"/>
                            </div>
                            <!--end::Col-->                            
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                
            </div>
            <!--end::Card body-->
            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="reset" class="btn btn-light btn-active-light-primary me-2"><?php echo $this->lang->line("heading_cancel") ?></button>
                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit"><?php echo $this->lang->line("heading_submit_btn") ?></button>
            </div>
            <!--end::Actions-->
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
                (i = document.querySelector("#kt_account_profile_details_form")),
                    (t = document.getElementById("kt_account_profile_details_submit")),
                    (e = FormValidation.formValidation(i, {
                        fields: {
                            full_name: {validators: {notEmpty: {message: "Full Name is Required"}}},
                            phone_code: {validators: {notEmpty: {message: "Phone Code is Required"}}},
                            phone_no: {validators: { notEmpty: {message: "Phone No is Required"},numeric:{message:"Phone No is Invalid"} }},
                            email: {validators: {notEmpty: {message: "Email is Required"},emailAddress:{message: "Email is Invalid"}}},
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
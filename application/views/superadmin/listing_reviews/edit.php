<div class="app-toolbar d-flex justify-content-end pb-5" data-kt-customer-table-toolbar="base" id="kt_app_toolbar">
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
<div class="app-content flex-column-fluid p-0">
    <!--begin::Body-->
    <div class="d-flex flex-column flex-xl-row">
        <!--begin::Layout-->
        <div class="flex-lg-row-fluid">

            <!--begin::Content-->
            <form  class="form mb-15" method="post" id="kt_add_form" action="<?php echo $main_form_url ?>" autocomplete="off" enctype="multipart/form-data">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="kt_listing_general_info" role="tabpanel">
                        <div class="card pt-4 mb-6 mb-xl-9">
                            
                            <div class="card-body pt-0 pb-5">
                                <div class="row mb-5">                                    
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line('heading_full_name') ?></label>
                                        <input type="text" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_full_name") ?>" name="full_name" value="<?php echo $post_data["full_name"]? : ""; ?>"  />
                                    </div>
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line('heading_email') ?></label>
                                        <input type="text" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_email") ?>" name="email" value="<?php echo $post_data["email"]?:""; ?>"/>
                                    </div>

                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-12 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_listing_review_title") ?></label>
                                        <textarea  class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_listing_review_title") ?>" name="review"><?php echo stripcslashes($post_data["review"])?:"" ?></textarea>
                                    </div>

                                </div>
                                
                                <div class="row mb-5">
                                    <?php foreach($post_data["review_category"] as $key=>$review_category) { ?>
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2"><?php echo $post_data["review_category_name"][$key] ?></label>
                                        
                                        <input type="text" class="form-control form-control-solid" name="category_review[<?php echo $key ?>]" value="<?php echo $post_data["category_review"][$key]?:""; ?>" /> 
                                        
                                        <input type="hidden" class="form-control form-control-solid" name="review_category[<?php echo $key ?>]" value="<?php echo $review_category?:""; ?>" /> 
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_request_status_title") ?></label>
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <select name="request_status" class="form-select form-select-solid" data-control="select2">
                                                <option value="<?php echo REVIEW_STATUS_PENDING ?>"><?php echo $this->lang->line("heading_listing_review_request_status_title") ?></option>
                                                <option value="<?php echo REVIEW_STATUS_APPROVE ?>" <?php echo $post_data["request_status"]==REVIEW_STATUS_APPROVE ? "selected=''" :"" ?>><?php echo $this->lang->line("heading_listing_review_approved_status_title") ?></option>
                                                <option value="<?php echo REVIEW_STATUS_DISAPPROVE ?>" <?php echo $post_data["request_status"]==REVIEW_STATUS_DISAPPROVE ? "selected=''" :"" ?>><?php echo $this->lang->line("heading_listing_review_disapproved_status_title") ?></option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_status") ?></label>
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="<?php echo ACTIVE ?>" id="status" name="status" <?php echo ( !empty($post_data['status']) || !isset($post_data['status']) ) ? "checked=''":"" ?> />
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Form-->
                    </div>
                    
                    
                    <div class="card-body">
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
                    </div>
                </div>
            </form>
            <!--end::Content-->
        </div>
        <!--end::Layout-->

    </div>
    <!--end::Body-->
</div>
<!--end::Careers - Apply-->
<!--begin::Modals-->
<script src="<?php echo base_url(BASE_ASSETS_PATH.SUPERADMIN."/plugins/custom/formrepeater/formrepeater.bundle.js?v=1.1") ?>"></script>
<script type="text/javascript">
    
    "use strict";
    var KTAppEcommerceSaveProduct = (function () {
        const e = () => {
            $("#listing_social_media").repeater({
                initEmpty: !1,
                defaultValues: { "text-input": "" },
                show: function () {
                    $(this).slideDown();
                },
                hide: function (e) {
                    $(this).slideUp(e);
                },
            });
        };
        return {
            init: function () {e()},
        };
    })();

    
    var KTForm = (function () {
        var t, e, i;
        return {
            init: function () {
                (i = document.querySelector("#kt_add_form")),
                        (t = document.getElementById("kt_submit_button")),
                        (e = FormValidation.formValidation(i, {
                            fields: {
                                "request_status": { validators: { notEmpty: { message: "<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_status") ) ?>" } } },
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
                                            confirmButtonText: "<?php echo $this->lang->line("heading_form_submit_success_btn") ?>",
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
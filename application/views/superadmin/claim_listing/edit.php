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
                                        <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line('heading_name') ?></label>
                                        <input type="text" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_name") ?>" name="name" value="<?php echo $post_data["listing_name"]? : ""; ?>" disabled="
                                               " />
                                    </div>
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line('heading_institute_type') ?></label>
                                        <input type="text" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_name") ?>" name="listing_type_name" value="<?php echo $post_data["listing_type_name"]; ?>" disabled=""/>
                                    </div>

                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_full_name") ?></label>
                                        <input type="text" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_full_name") ?>" name="full_name" value="<?php echo $post_data["full_name"]; ?>" />
                                    </div>

                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line('heading_phone_no') ?></label>
                                        <div class="row">
                                            <div class="col-md-3 <?php echo count($phone_codes) == 1 ? "d-none" : "" ?>">
                                                <select class="form-select form-select-solid" name="phone_code" data-control="select2" disabled="">
                                                    <?php foreach ($phone_codes as $key => $phone_code) { ?>
                                                        <option value="<?php echo encrypt($phone_code["id"]) ?>" <?php echo ( count($phone_codes) == 1 || $phone_code["id"] == decrypt($post_data["phone_code"]) ) ? "selected=''" : ""; ?>><?php echo $phone_code["phonecode"] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="<?php echo count($phone_codes) == 1 ? "col-md-12" : "col-md-9"; ?>">
                                                <input type="text" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_whats_app") ?>" name="phone_no" value="<?php echo $post_data["phone_no"]? : ""; ?>" disabled="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mb-5">
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_claim_institute_personal_document_title") ?></label>
                                        
                                        
                                        <a class="d-block overlay" data-fslightbox="lightbox-hot-sales" href="<?php echo base_url(BASE_CLAIM_LISTING_PERSONAL_DOCUMENTS_IMAGE_PATH."{$post_data["personal_document"]}") ?>">
                                            <!--begin::Image-->
                                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url('<?php echo base_url(BASE_CLAIM_LISTING_PERSONAL_DOCUMENTS_IMAGE_PATH."{$post_data["personal_document"]}") ?>')"></div>
                                            <!--end::Image-->
                                            <!--begin::Action-->
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                                <i class="bi bi-eye-fill fs-2x text-white"></i>
                                            </div>
                                            <!--end::Action-->
                                        </a>
                                        <!--end::Overlay-->
                                    </div>
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_claim_institute_personal_document_title") ?></label>
                                        <a class="d-block overlay" data-fslightbox="lightbox-basic" href="<?php echo base_url(BASE_CLAIM_LISTING_LEGAL_DOCUMENTS_IMAGE_PATH."{$post_data["legal_document"]}") ?>">
                                            <!--begin::Image-->
                                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                                 style="background-image:url('<?php echo base_url(BASE_CLAIM_LISTING_LEGAL_DOCUMENTS_IMAGE_PATH."{$post_data["legal_document"]}") ?>')">
                                            </div>
                                            <!--end::Image-->

                                            <!--begin::Action-->
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                                <i class="bi bi-eye-fill text-white fs-3x"></i>
                                            </div>
                                            <!--end::Action-->
                                        </a>
                                        <!--end::Overlay-->
                                    </div>

                                    
                                </div>
                                
                                <div class="row mb-5">                                    
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line('heading_status') ?></label>
                                        <select class="form-select form-select-solid" name="request_status" data-control="select2" >
                                            <?php foreach( $this->lang->line("heading_claim_listing_status_list") as $status => $status_name ) {?>
                                            <option value="<?php echo $status ?>" <?php echo $status==$record["request_status"] ? "selected=''":""; ?>><?php echo $status_name ?></option>
                                            <?php } ?>

                                        </select>
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
<script src="<?php echo base_url(BASE_ASSETS_PATH . "web/ckeditor/ckeditor.js?_=".filemtime(FCPATH.BASE_ASSETS_PATH."web/ckeditor/ckeditor.js"))?>"></script>
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
<div class="app-content flex-column-fluid">
    <!--begin::Body-->
    <div class="d-flex flex-column flex-xl-row">
        <!--begin::Layout-->
        <div class="flex-lg-row-fluid">
            <!--begin::Content-->
            <form  class="form mb-15" method="post" id="kt_add_form" action="<?php echo $main_form_url ?>" autocomplete="off" enctype="multipart/form-data">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="kt_listing_general_info" role="tabpanel">
                        <div class="card pt-4 mb-6 mb-xl-9">
                            <div class="card-header border-0">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2><?php echo $this->lang->line("heading_general_information") ?></h2>
                                </div>
                            </div>
                            <div class="card-body pt-0 pb-5">
                                <div class="row mb-5">
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2"><?php echo $this->lang->line('heading_name') ?></label>
                                        <input type="text" class="form-control form-solid" name="name" value="<?php echo !empty($post_data["name"]) ? stripcslashes($post_data["name"]) : ""; ?>"/>
                                        <span class="text-danger"><?php echo form_error("name") ?></span>
                                    </div>
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_sort_order") ?></label>
                                        <input type="text" class="form-control form-solid" name="sort_order" value="<?php echo !empty($post_data["sort_order"]) ? stripcslashes($post_data["sort_order"]) : ""; ?>"/>
                                        <span class="text-danger"><?php echo form_error("sort_order") ?></span>
                                    </div>
                                </div>
                                
                                <div class="row mb-5">                                    
                                    <div class="col-md-12 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2"><?php echo $this->lang->line('heading_description') ?></label>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <textarea class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_description") ?>" name="description" id="kt_docs_ckeditor_classic"><?php echo stripcslashes($post_data["description"])? : ""; ?></textarea>
                                                <input type="hidden" name="description_check" value="<?php echo !empty( stripcslashes($post_data["description"]) )?1:"" ?>" class="form-control" />
                                                <span class="text-danger"><?php echo form_error("description") ?></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="row mb-5">
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

<script type="text/javascript">
    "use strict";
    var KTForm = (function () {
        var t, e, i;
        return {
            init: function () {
                (i = document.querySelector("#kt_add_form")),
                        (t = document.getElementById("kt_submit_button")),
                        (e = FormValidation.formValidation(i, {
                            fields: {
                                "name": { validators: { notEmpty: { message: "<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_name") ) ?>" } } },
                                "description_check": { validators: { notEmpty: { message: "<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_description") ) ?>" } } },
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
    
    $(function(){
        KTForm.init();
        CKEDITOR.replace("kt_docs_ckeditor_classic");
        CKEDITOR.instances.kt_docs_ckeditor_classic.on('change', function(e) { 
             if( e.editor.getData()!="" ) {
                $(":input[name='description_check']").val(1);
             }else{
                 $(":input[name='description_check']").val("");
             }
        });
    });

</script>
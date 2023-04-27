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
            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_listing_general_info"><?php echo $listing_data["name"]; ?></a>
                </li>

            </ul>
            <!--begin::Content-->
            <form  class="form mb-15" method="post" id="kt_add_form" action="<?php echo $main_form_url ?>" autocomplete="off" enctype="multipart/form-data">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="kt_listing_general_info" role="tabpanel">
                        <div class="card pt-4 mb-6 mb-xl-9">
                            
                            <div class="card-body pt-0 pb-5">
                                <div class="row mb-5">                                    
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2"><?php echo $this->lang->line('heading_add_user_title') ?></label>
                                        <select class="form-select form-select-solid" name="user_id">
                                            <option value=""><?php echo $this->lang->line("heading_add_user_title") ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error("listing_type") ?></span>
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
    </div>
</div>

<script type="text/javascript">
    "use strict";
    var KTFormControls = function () {
        var t, e, i;
        return {
            init: function () {
                (i = document.querySelector("#kt_add_form")),
                        (t = document.getElementById("kt_submit_button")),
                        (e = FormValidation.formValidation(i, {
                            fields: {
                                user_id: {
                                    validators: {
                                        notEmpty: {
                                            message: "<?php echo sprintf($this->lang->line("message_field_required"),$this->lang->line("heading_listing_user_title")) ?>"
                                        }
                                    }
                                }
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
                                                setTimeout( function () {
                                                    t.removeAttribute("data-kt-indicator"),
                                                    (t.disabled = !1)
                                                }, 0) 
                                            )
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
    
    }();
    $(function(){
        KTFormControls.init();
        $(":input[name='user_id']").select2({
            minimumInputLength: 2,
            minimumResultsForSearch: 20,
            //placeholder: "Select a state",
            placeholder: {
                id: "", // the value of the option
                text: '<?php echo $this->lang->line("heading_add_user_title") ?>'
            },
            allowClear: true,
            cache: true,
            ajax: {
                url: "<?php echo superadmin_url("listing/get_users_list/{$edited_id}") ?>",
                type: "post",
                dataType: 'json',
                data: function(params) {
                    return {
                        search : params.term // search term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                }
            }
        });
    });
    //kt_add_form
    
    
</script>
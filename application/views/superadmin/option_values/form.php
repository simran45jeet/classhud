<div class="d-flex justify-content-end pb-5" data-kt-customer-table-toolbar="base">
    <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
        <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0"><?php echo $title ?></h1>
            <!--end::Title-->
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
                    <!--begin::Input group-->
                    <div class="row mb-5">
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row">
                            <!--begin::Label-->
                            <label class="required fs-5 fw-semibold mb-2"><?php echo $this->lang->line('heading_name') ?></label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line('heading_name') ?>" name="name" value="<?php echo $post_data['name']?:""; ?>" />
                            <!--end::Input-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row">
                            <!--begin::Label-->
                            <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line('heading_sort_order') ?></label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line('heading_sort_order') ?>" name="sort_order" value="<?php echo $post_data["sort_order"]?:""; ?>"/>
                            <!--end::Input-->
                        </div>
                        <!--end::Col-->

                    </div>
                    <div class="row mb-5">
                        <!--begin::Col-->
                        <div class="col-md-12 fv-row">
                            <!--begin::Label-->
                            <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line('heading_status') ?></label>
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="<?php echo ACTIVE ?>" id="status" name="status" <?php echo ( !empty($post_data['status']) || !isset($post_data['status']) ) ? "checked=''":"" ?> />
                            </div>
                        </div>
                    </div>
                    <!--end::Input group-->

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
                            name: {validators: {notEmpty: {message: "First name is Required"}}}
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
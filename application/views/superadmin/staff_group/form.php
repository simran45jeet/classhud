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
<!--begin::Form-->
<form  class="form" method="post" id="kt_add_form" action="<?php echo $main_form_url ?>" autocomplete="off">
    <!--begin::Careers - Apply-->
    <div class="card">
    <!--begin::Body-->
        <div class="card-body pt-lg-17 pl-lg-17 pr-lg-17 pb-0">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-lg-row">
                <!--begin::Content-->
                <div class="flex-lg-row-fluid me-0 me-lg-20">
                        <input type="hidden" name="option_for" value="<?php echo OPTIONS_FOR_ORGNIZATION ?>" />
                        <!--begin::Input group-->
                        <!--<h4 class="fs-1 text-gray-800 w-bolder mb-6 col-12"><?php echo $this->lang->line("heading_staff_group") ?></h4>-->
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
                                <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_status") ?></label>
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="<?php echo ACTIVE ?>" id="status" name="status" <?php echo ( !empty($post_data['status']) || !isset($post_data['status']) ) ? "checked=''":"" ?> />
                                </div>
                            </div>
                        </div>
                        <!--begin::Separator-->
                        <div class="separator mb-8 mt-8"></div>
                        <!--end::Separator-->
                        <div class="row mb-5">
                            <!--begin::Col-->
                            <h4 class="fs-1 text-gray-800 w-bolder mb-6 col-12"><?php echo $this->lang->line("heading_permissions") ?></h4>

                            <div class="col-md-6 fv-row"></div>
                            <ul class="nav nav-tabs" id="ex1" role="tablist">
                            <?php $cnt=0;foreach($permission_list as $permission_group => $permission_group_detail){ $cnt++;?>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link <?php echo $cnt==1 ? "active":""; ?>" id="permission_group_<?php echo $permission_group ?>" data-mdb-toggle="tab" href="#permission_tab_<?php echo $permission_group ?>" role="tab" aria-controls="permission_tab_<?php echo $permission_group ?>" aria-selected="false" tabindex="-1"><?php echo ucfirst($permission_group) ?></a>
                                </li>
                            <?php } ?>
                            </ul>
                            <?php foreach($permission_list as $permission_group => $permission_group_detail){?>
                            <div class="tab-content p-0" id="permission_tab_<?php echo $permission_group ?>" data-kt-menu="true" data-kt-menu-expand="false">
                                <?php foreach($permission_group_detail as $module=>$module_permission){ ?>
                                <div class="accordion" id="accordionPanelsStayOpenExample">
                                    <div class="accordion-item" style="border-radius: 0;">
                                        <h2 class="accordion-header" id="panelsStayOpen-<?php echo "{$permission_group}_$module" ?>">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpencollapse-<?php echo "{$permission_group}_$module" ?>" aria-expanded="true" aria-controls="panelsStayOpen-<?php echo "{$permission_group}_$module" ?>"  style="border-top-left-radius: 0;border-top-right-radius: 0;">
                                                <?php echo $module ?>
                                            </button>
                                        </h2>
                                        <div id="panelsStayOpencollapse-<?php echo "{$permission_group}_$module" ?>" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-<?php echo "{$permission_group}_$module" ?>">
                                            <div class="accordion-body">
                                                <?php 
                                                $total_cnt = $cnt=0;
                                                foreach( $module_permission as $permission_name=>$permission_slug ) {
                                                    if($cnt==0){
                                                        echo "<div class='row'>";
                                                    }
                                                ?>
                                                <div class="col-md-4">
                                                    <div class="row mb-3">
                                                        <div class="col-md-12 col-sm-12 d-flex">
                                                            <div class="form-check form-switch form-check-custom form-check-solid ">
                                                                
                                                                <input class="form-check-input" type="checkbox" value="<?php echo $permission_slug ?>" name="permission[<?php echo $permission_group ?>][]" <?php echo ( !empty($group_permissions[$permission_group]) && is_array($group_permissions[$permission_group]) &&  in_array($permission_slug,$group_permissions[$permission_group]) ) ? "checked=''":"" ?>  />
                                                            </div>
                                                            <label class="m-3 mt-1 mb-1"><?php echo $permission_name ?></label>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <?php $cnt++; $total_cnt++;
                                                    if($cnt==3 || $total_cnt==count($module_permission)){
                                                        echo "</div>";
                                                        $cnt=0;
                                                    }
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                <!--end::Content-->
            </div>
            <!--end::Layout-->
        </div>
    </div>
    <div class="card border-0">
        <!--end::Body-->
        <div class="card-body pt-lg-17 pl-lg-17 pr-lg-17 pb-0">
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
        </div>
    </div>
</form>
<!--end::Form-->
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
                            first_name: {validators: {notEmpty: {message: "First name is Required"}}},
                            last_name: {validators: {notEmpty: {message: "Last Name is Required"}}},
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
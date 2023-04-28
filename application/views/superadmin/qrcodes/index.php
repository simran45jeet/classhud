<?php
$edit_permission = hasPermission($this->user_data['group_id'], "{$controller_name}.edit", SUPERADMIN);
?>
<div class="d-flex justify-content-end pb-5" data-kt-customer-table-toolbar="base">
    <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
        <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0"><?php echo $title ?></h1>
            <!--end::Title-->
        </div>

        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <?php if (hasPermission($this->user_data['group_id'], "{$controller_name}.add", SUPERADMIN)) { ?>
                <!--begin::Add customer-->
                <a  href="#" class="btn btn-primary btn-sm flex-shrink-0 me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_bidding"><?php echo $this->lang->line("heading_add") ?></a>
            <?php } ?>
        </div>
        <!--end::Add customer-->
    </div>
    <!--end::Toolbar-->
</div>
<!--begin::Card-->
<div class="card">
    <!--begin::Card header-->
    <form class="card-header border-0 pt-6" data-kt-customer-table-toolbar="base" name="filter_customers" method="get" action="<?php echo $main_form_url ?>" name="search_form">
        <!--begin::Card title-->
        <div class="card-title">
            <!--begin::Search-->

            <div class="d-flex align-items-center position-relative my-1">
                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
                <input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="<?php echo $this->lang->line("heading_search") ?>" name="search" value="<?php echo!empty($post_data["search"]) ? $post_data["search"] : "" ?>"/>&nbsp;
            </div>
            <!--begin::Actions-->
            <div class="d-flex justify-content-end">
                <a href="<?php echo $main_form_url; ?>"><button type="button" class="btn btn-light btn-active-light-primary me-2" name="reset_form"><?php echo $this->lang->line("heading_reset_btn_title") ?></button></a>
                <button type="submit" class="btn btn-primary" data-kt-menu-dismiss="true" data-kt-customer-table-filter="filter" name="subbmit_form"><?php echo $this->lang->line("heading_apply_btn_title") ?></button>
            </div>
            <!--end::Actions-->
            <!--end::Search-->
        </div>
        
    </form>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_staff_table">
            <!--begin::Table head-->
            <thead>
                <!--begin::Table row-->
                <tr class="text-start text-gray-400 fw-bold fs-7 gs-0">

                    <th width="min-w-30px">#</th>
                    <th class="min-w-125px"><?php echo $this->lang->line("heading_qrcode_title") ?></th>
                    <th class="min-w-125px"><?php echo $this->lang->line("heading_qrcode_type_title") ?></th>
                    <th class="min-w-125px"><?php echo $this->lang->line("heading_name") ?></th>
                    <th class="text-end min-w-70px"><?php echo $this->lang->line("heading_action") ?></th>
                </tr>
                <!--end::Table row-->
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody class="fw-semibold text-gray-600">                
                <?php
                foreach ($records as $key => $record) {
                    $encoded_id = encrypt($record['id']);
                ?>
                <tr>
                    <!--begin::Name=-->
                    <td><?php echo ++$start_record; ?></td>
                    <td>
                        <div class="d-flex align-items-center">

                            <div class="ms-5">
                                <!--begin::Title-->
                                <a href="<?php echo $edit_permission ? superadmin_url("{$controller_name}/edit/{$encoded_id}") : "#"; ?>" class="text-gray-800 text-hover-primary fs-5 fw-bold" data-kt-ecommerce-product-filter="listing_name"><?php echo $record["qrcode"] ?></a>
                                <!--end::Title-->
                            </div>
                        </div>

                    </td>

                    <td><?php echo $record["type_name"] ?></td>
                    <td><?php echo $record["name"] ?></td>
                    <td class="text-end">
                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"><?php echo $this->lang->line("heading_action") ?>
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                            <span class="svg-icon svg-icon-5 m-0">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </a>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <?php if ($edit_permission) { ?>
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="<?php echo superadmin_url("{$controller_name}/edit/{$encoded_id}") ?>" class="menu-link px-3"><?php echo $this->lang->line('heading_edit') ?></a>
                                </div>
                                <!--end::Menu item-->
                            <?php } ?>
                        </div>
                        <!--end::Menu-->
                    </td>
                    <!--end::Action=-->
                </tr>
                <?php } ?>
            </tbody>
            <!--end::Table body-->
        </table>
        <!--end::Table-->
        <?php echo $links ? : ""; ?>
    </div>
    <!--end::Card body-->
</div>
<div class="modal fade" id="kt_modal_bidding" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal" aria-label="Close">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <!--begin:Form-->
                <form id="kt_modal_bidding_form" class="form" action="<?php echo superadmin_url("{$controller_name}/add") ?>" method="post">
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3"><?php echo sprintf( $this->lang->line("heading_add_title"),$this->lang->line("heading_qrcodes_title")) ?></h1>
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required"><?php echo $this->lang->line("heading_qrcode_generate_no_title") ?></span>
                            
                        </label>

                        <input type="text" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_qrcode_generate_no_title") ?>" name="qr_no" />
                    </div>                    
                    
                    <div class="text-center">
                        <button type="reset" class="btn btn-light me-3" data-kt-modal-action-type="cancel"><?php echo $this->lang->line("heading_cancel") ?></button>
                        <button type="submit" class="btn btn-primary" data-kt-modal-action-type="submit">
                            <span class="indicator-label"><?php echo $this->lang->line("heading_submit_btn") ?></span>
                            <span class="indicator-progress"><?php echo $this->lang->line("heading_wait") ?>
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end::Card-->
<script type="text/javascript">
    "use strict";
    var KTForm = (function () {
        var t, e, i;
        return {
            init: function () {
                (i = document.querySelector("#kt_modal_bidding_form")),
                        (e = FormValidation.formValidation(i, {
                            fields: {
                                qr_no: { 
                                    validators: { 
                                        notEmpty: { message: "<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_qrcode_generate_no_title") ) ?>" },
                                        integer: {
                                            message: '<?php echo $this->lang->line("message_invalid_integer_no") ?>',
                                        },
                                        greaterThan: {
                                            message: '<?php echo sprintf($this->lang->line("message_value_greater_then") ,1) ?>',
                                            min: 1,
                                        },
                                    } 
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
                                "Valid" == e ? 
                                ( $(":input[name='save_draft']").val(""),
                                    t.setAttribute("data-kt-indicator", "on"),
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
    $(function (){
        KTForm.init();
    });
</script>
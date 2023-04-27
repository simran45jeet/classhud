<?php
$edit_permission = hasPermission($this->user_data['group_id'], "{$controller_name}.edit", SUPERADMIN);
$delete_permission = hasPermission($this->user_data['group_id'], "{$controller_name}.delete", SUPERADMIN);
$edit_listing_permission = hasPermission($this->user_data['group_id'], "listing.edit", SUPERADMIN);
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
                <a type="button" class="btn btn-primary" href="<?php echo superadmin_url("{$controller_name}/add") ?>"><?php echo $this->lang->line("heading_add") ?></a>
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
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                <!--begin::Filter-->
                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                    <span class="svg-icon svg-icon-2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <?php echo $this->lang->line("heading_filter") ?>
                </button>
                <!--begin::Menu 1-->
                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true" id="kt-toolbar-filter-verify-type">
                    <!--begin::Header-->
                    <div class="px-7 py-5">
                        <div class="fs-4 text-dark fw-bold"><?php echo $this->lang->line("heading_filter_options") ?></div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Separator-->
                    <div class="separator border-gray-200"></div>
                    <!--end::Separator-->
                    <!--begin::Content-->

                    <div class="px-7 py-5">
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <!--begin::Label-->
                            <label class="form-label fs-5 fw-semibold mb-3"><?php echo $this->lang->line("heading_status") ?></label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-customer-table-filter="month" data-dropdown-parent="#kt-toolbar-filter-verify-type" name="status">
                                <option value="-1" ><?php echo $this->lang->line("heading_all_records_title") ?></option>
                                <option value="<?php echo ACTIVE ?>" <?php echo (!empty($post_data["status"]) && $post_data["status"] == ACTIVE ) ? "selected=''" : "" ?>><?php echo $this->lang->line("heading_active_title") ?></option>
                                <option value="<?php echo INACTIVE ?>" <?php echo ( isset($post_data["status"]) && $post_data["status"] == INACTIVE ) ? "selected=''" : "" ?>><?php echo $this->lang->line("heading_inactive_title") ?></option>

                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>



                    <!--end::Content-->
                </div>
                <!--end::Menu 1-->
                <!--end::Filter-->
                <!--begin::Export-->

                <button type="button" class="btn btn-light-primary me-3 d-none" data-bs-toggle="modal" data-bs-target="#kt_customers_export_modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
                    <span class="svg-icon svg-icon-2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="currentColor" />
                            <path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="currentColor" />
                            <path opacity="0.3" d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    Export
                </button>
                <!--end::Export-->
                <!--end::Add customer-->
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Card toolbar-->
    </form>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_staff_table">
            <!--begin::Table head-->
            <thead>
                <!--begin::Table row-->
                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">

                    <th width="min-w-30px">#</th>
                    <th class="min-w-125px"><?php echo $this->lang->line("heading_name") ?></th>
                    <th class="min-w-125px"><?php echo $this->lang->line("heading_status") ?></th>
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
                                <a href="<?php echo $edit_permission ? superadmin_url("{$controller_name}/edit/{$encoded_id}") : "#"; ?>" class="text-gray-800 text-hover-primary fs-5 fw-bold" data-kt-ecommerce-product-filter="listing_name"><?php echo $record["name"] ?></a>
                                <!--end::Title-->
                            </div>
                        </div>

                    </td>
                    
                    <td>
                        <?php
                        if ($record['status'] == ACTIVE) {
                            echo $this->lang->line("heading_active_title");
                        } else{
                            echo $this->lang->line("heading_inactive_title");
                        }
                        ?>
                    </td>
                    <td class="text-end">
                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
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
                            <?php } if ($delete_permission) { ?>
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" data-href="<?php echo superadmin_url("{$controller_name}/delete/{$encoded_id}") ?>" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_alert" data-title="<?php echo $this->lang->line("heading_sure_delete_record") ?>" data-kt-customer-table-filter="delete_row"><?php echo $this->lang->line("heading_delete") ?></a>
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
        <?php echo $links? : ""; ?>
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->
<script type="text/javascript">
    $(function () {
        $(document).on("change", ":input[name='account_verified_type']", function () {
            $("form[name='filter_customers']").submit();
        });
    });
</script>
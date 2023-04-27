<?php 
$edit_permission =  hasPermission($this->user_data['group_id'],"{$controller_name}.edit_listing_users",SUPERADMIN) ;
$delete_permission =  hasPermission($this->user_data['group_id'],"{$controller_name}.delete_listing_users",SUPERADMIN) ;
?>
<div class="d-flex justify-content-end pb-5" data-kt-customer-table-toolbar="base">
    <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
        <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0"><?php echo $title ?></h1>
            <!--end::Title-->
        </div>

        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <?php if( hasPermission($this->user_data['group_id'],"{$controller_name}.add_listing_users",SUPERADMIN) ) {?>
            <!--begin::Add customer-->
            <a type="button" class="btn btn-primary" href="<?php echo superadmin_url("{$controller_name}/add_listing_users/{$edited_id}") ?>"><?php echo $this->lang->line("heading_add") ?></a>
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
                <input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="<?php echo $this->lang->line("heading_search") ?>" name="search" value="<?php echo !empty($post_data["search"]) ? $post_data["search"]:"" ?>"/>&nbsp;
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
                
            </div>
            
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
                    <th class="min-w-125px"><?php echo $this->lang->line("heading_full_name") ?></th>
                    <th class="min-w-125px"><?php echo $this->lang->line("heading_phone_no") ?></th>
                    <th class="min-w-125px"><?php echo $this->lang->line("heading_status") ?></th>
                    <th class="text-end min-w-70px"><?php echo $this->lang->line("heading_action") ?></th>
                </tr>
                <!--end::Table row-->
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody class="fw-semibold text-gray-600">                
                <?php 
                foreach( $records as $key=>$record ) {
                    $encoded_id = encrypt($record['id']);
                ?>
                <tr>
                    <!--begin::Name=-->
                    <td><?php echo ++$start_record; ?></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="ms-5">
                                <!--begin::Title-->
                                <a href="<?php echo $edit_permission ? superadmin_url("{$controller_name}/edit_listing_users/{$edited_id}/{$encoded_id}") : "#"; ?>" class="text-gray-800 text-hover-primary fs-5 fw-bold" data-kt-ecommerce-product-filter="listing_name"><?php echo $record["full_name"] ?></a>
                                <!--end::Title-->
                            </div>
                        </div>
                        
                    </td>
                    <td><?php echo $record["phone_no"] ?></td>
                    <td>
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="<?php echo ACTIVE ?>" name="status" <?php echo ($record["status"]==ACTIVE ) ? "checked=''":"" ?> data-id="<?php echo $encoded_id ?>"/>
                            </div>

                        </div>
                    </td>
                    <td class="text-end">
                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"><?php echo $this->lang->line("heading_action") ?>
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                            <span class="svg-icon svg-icon-5 m-0">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon--></a>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <?php /*if($edit_permission) {?>
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="<?php echo superadmin_url("{$controller_name}/edit_listing_users/{$edited_id}/{$encoded_id}") ?>" class="menu-link px-3"><?php echo $this->lang->line('heading_edit') ?></a>
                            </div>
                            <!--end::Menu item-->
                            <?php }*/ if($delete_permission) {?>
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" data-href="<?php echo superadmin_url("{$controller_name}/delete_listing_users/{$edited_id}/{$encoded_id}") ?>" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_alert" data-title="<?php echo $this->lang->line("heading_sure_delete_record") ?>" data-kt-customer-table-filter="delete_row"><?php echo $this->lang->line("heading_delete") ?></a>
                            </div>
                            <!--end::Menu item-->
                            <?php }?>
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
        <?php echo $links?:""; ?>
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->
<script type="text/javascript">
    $(function (){
        $(document).on("change",":input[name='account_verified_type']",function(){
            $("form[name='filter_customers']").submit();
        });
        
        $(":input[name='status']").on("change",function(e){
            var $status = "<?php echo INACTIVE ?>";
            if( $(this).is(":checked") )  {
                $status = "<?php echo ACTIVE ?>";
            }
            $.ajax({
               url  : "<?php echo superadmin_url("{$controller_name}/change_listing_user_status/{$edited_id}/") ?>"+$(this).data("id"),
               data : {"status":$status},
               type : "post",
               success : function($response){
                   var $resp = JSON.parse($response);
                   if($resp.flag=='<?php echo FLAG_SUCCESS ?>'){
                       success_message($resp.message);
                   }else{
                       error_message($resp.message);
                   }
                   
               }
            });
        });
    });
</script>
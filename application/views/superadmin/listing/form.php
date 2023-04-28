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

            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">

                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_listing_general_info"><?php echo $this->lang->line("heading_general_information") ?></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_listing_address"><?php echo $this->lang->line("heading_address") ?></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_listing_logo"><?php echo $this->lang->line("heading_media") ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_listing_social_media"><?php echo $this->lang->line("heading_social_media") ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_listing_timming"><?php echo $this->lang->line("heading_institute_timings") ?></a>
                </li>
            </ul>
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
                                        <label class="required fs-5 fw-semibold mb-2"><?php echo $this->lang->line('heading_institute_type') ?></label>
                                        <select class="form-select form-select-solid" name="listing_type" data-control="select2">
                                            <option value=""><?php echo $this->lang->line("heading_institute_type") ?></option>
                                            <?php foreach ($organization_types as $key => $organization_type) { ?>
                                                <option value="<?php echo encrypt($organization_type["id"]) ?>" <?php echo (!empty($post_data['listing_type']) && decrypt($post_data['listing_type']) == $organization_type["id"]) ? "selected=''" : ""; ?>><?php echo $organization_type["name"] ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error("listing_type") ?></span>
                                    </div>

                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2"><?php echo $this->lang->line('heading_name') ?></label>
                                        <input type="text" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_name") ?>" name="name" value="<?php echo $post_data["name"]? : ""; ?>" />
                                    </div>
                                    <span class="text-danger"><?php echo form_error("name") ?></span>
                                </div>
                                <div class="row mb-5">                                    
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line('heading_website') ?></label>
                                        <input type="text" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_website") ?>" name="website" value="<?php echo $post_data["website"]? : ""; ?>" />
                                    </div>

                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line('heading_whats_app') ?></label>
                                        <div class="row">
                                            <div class="col-md-3 <?php echo count($phone_codes) == 1 ? "d-none" : "" ?>">
                                                <select class="form-select form-select-solid" name="primary_whatsapp_code" data-control="select2">
                                                    <?php foreach ($phone_codes as $key => $phone_code) { ?>
                                                        <option value="<?php echo encrypt($phone_code["id"]) ?>" <?php echo ( count($phone_codes) == 1 || $phone_code["id"] == decrypt($post_data["primary_whatsapp_code"]) ) ? "selected=''" : ""; ?>><?php echo $phone_code["phonecode"] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="<?php echo count($phone_codes) == 1 ? "col-md-12" : "col-md-9"; ?>">
                                                <input type="text" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_whats_app") ?>" name="primary_whatsapp_no" value="<?php echo $post_data["primary_whatsapp_no"]? : ""; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-5 listing_emails">                                    
                                    <div class="col-md-12 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2"><?php echo $this->lang->line('heading_email') ?></label>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <input type="email" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_email") ?>" name="primary_email" value="<?php echo $post_data["primary_email"]? : ""; ?>" />
                                                <span class="text-danger"><?php echo form_error("primary_email") ?></span>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-sm btn-flex btn-light-primary add_more_email" id="add_email">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                                    <span class="svg-icon svg-icon-3">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                                                        <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor"></rect>
                                                        <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor"></rect>
                                                        </svg>
                                                    </span>
                                                    <?php echo $this->lang->line("heading_add_email") ?>
                                                </button>
                                            </div>
                                        </div>
                                        <?php
                                        if (!empty($post_data["listing_email"])) {
                                            foreach ($post_data["listing_email"] as $key => $listing_email) {
                                        ?>
                                        <div class="col-md-6 fv-row mt-5">
                                            <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line('heading_email') ?></label>
                                            <div class="row">
                                                <div class="col-md-10 col-sm-10">
                                                    <input type="hidden" name="listing_email_id[]" value="<?php echo $key ?>" />
                                                    <input type="email" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_email") ?>" name="listing_email[]" value="<?php echo $listing_email ?>"/>
                                                </div>
                                                <div class="col-md-2 col-sm-2">
                                                    <span class="delete_more_email">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" >
                                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>

                                </div>

                                <div class="row mb-5 listing_phone">
                                    <div class="col-md-12 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line('heading_phone') ?></label>
                                        <div class="row">
                                            <div class="col-md-3 <?php echo count($phone_codes) == 1 ? "d-none" : "" ?>">
                                                <select class="form-select form-select-solid" name="primary_phone_code" data-control="select2">
                                                    <?php foreach ($phone_codes as $key => $phone_code) { ?>
                                                        <option value="<?php echo encrypt($phone_code["id"]) ?>" <?php echo ( count($phone_codes) == 1 || $phone_code["id"] == decrypt($post_data["primary_phone_code"]) ) ? "selected=''" : ""; ?>><?php echo $phone_code["phonecode"] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="<?php echo count($phone_codes) == 1 ? "col-md-10" : "col-md-9"; ?>">
                                                <input type="text" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_phone") ?>" name="primary_phone_no" value="<?php echo $post_data["primary_phone_no"]? : ""; ?>" />
                                                <span class="text-danger"><?php echo form_error("primary_phone_no") ?></span>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-sm btn-flex btn-light-primary add_more_phone" id="add_email">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                                                    <span class="svg-icon svg-icon-3">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"></rect>
                                                        <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor"></rect>
                                                        <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor"></rect>
                                                        </svg>
                                                    </span>
                                                    <?php echo $this->lang->line("heading_add_phone") ?>
                                                </button>
                                            </div>
                                        </div>
                                        <?php
                                        if (!empty($post_data["phone_no"])) {
                                            foreach ($post_data["phone_no"] as $key => $phone_no) {
                                        ?>
                                        <div class="col-md-6 fv-row mt-5">
                                            <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line('heading_phone') ?></label>
                                            <div class="row">
                                                <div class="col-md-10 col-sm-10">
                                                    <div class="row">
                                                        <input type="hidden" name="listing_phone_id[]" value="<?php echo $key ?>" />
                                                        <div class="col-md-3 <?php echo count($phone_codes) == 1 ? "d-none" : "" ?>">
                                                            <select class="form-select form-select-solid" name="phone_code[]" data-control="select2">
                                                                <?php foreach ($phone_codes as $key => $phone_code) { ?>
                                                                    <option value="<?php echo encrypt($phone_code["id"]) ?>" <?php echo ( count($phone_codes) == 1 || $phone_code["id"] == decrypt($post_data["phone_code"][$key]) ) ? "selected=''" : ""; ?>><?php echo $phone_code["phonecode"] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="<?php echo count($phone_codes) == 1 ? "col-md-12" : "col-md-9" ?>">
                                                            <input type="text" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_phone") ?>" name="phone_no[]" value="<?php echo $phone_no ?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-sm-2">
                                                    <span class="delete_more_phone">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" >
                                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                
                                <div class="row mb-5">
                                    <div class="col-md-12 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line('heading_landline') ?></label>
                                        <div class="row">
                                            
                                            <div class="col-md-12">
                                                <input type="text" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_landline") ?>" name="landline" value="<?php echo $post_data["landline"]? : ""; ?>" />
                                            </div>
                                        </div>                                        
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

                                        <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_listing_amenity") ?></label>
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input type="text" class="form-control" name="amenities" value="<?php echo !empty($post_data["amenities"]) ? implode(",",$post_data["amenities"]) : ""; ?>" data-kt-inbox-form="tagify" tabindex="-1" id="kt_tagify_amenities" />
                                             <?php /* ?>
                                            <select name="amenities[]"  data-placeholder="<?php echo $this->lang->line('heading_listing_amenity') ?>" class="form-select form-select-solid mt-multiselect " multiple="" >
                                                <option value=""><?php echo $this->lang->line("heading_listing_amenity") ?></option>
                                                <?php //foreach($amenities as $key => $ameniy) { ?>
                                                <option value="<?php echo encrypt($ameniy["id"]) ?>" <?php echo ( is_array($post_data["amenities"]) && !empty($post_data["amenities"]) && in_my_array($ameniy["id"],$post_data["amenities"] ) )? "selected=''":""; ?>><?php echo $ameniy["name"] ?></option>
                                                <?php //} ?>
                                            </select>
                                            <?php */ ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line('heading_meta_title') ?></label>
                                        <input type="text" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_meta_title") ?>" name="meta_title" value="<?php echo $post_data["meta_title"]? : ""; ?>" />
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line('heading_meta_keywords') ?></label>
                                        <input type="text" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_meta_keywords") ?>" name="meta_keywords" value="<?php echo $post_data["meta_keywords"]? : ""; ?>" />
                                    </div>
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line('heading_meta_description') ?></label>
                                        <input type="text" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_meta_description") ?>" name="meta_description" value="<?php echo $post_data["meta_description"]? : ""; ?>" />
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_qrcode_title") ?></label>
                                        <select class="form-select form-select-solid" name="qrcode" data-control="select2">
                                            <option value=""><?php echo $this->lang->line("heading_qrcode_title") ?></option>
                                            <?php 
                                            if( !empty($qrcodes) ) {
                                                foreach ($qrcodes as $key => $qrcode) {
                                            ?>
                                            <option value="<?php echo encrypt($qrcode["id"]) ?>" <?php echo (!empty($post_data['qrcode']) && decrypt($post_data['qrcode']) == $qrcode["id"]) ? "selected=''" : ""; ?>><?php echo $qrcode["qrcode"] ?></option>
                                            <?php } 
                                            }
                                            ?>
                                        </select>
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
                                <?php if( isset($claim_option) && $claim_option==true ){ ?>
                                <div class="row mb-5">
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_listing_claimable_title") ?></label>
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="<?php echo ACTIVE ?>" id="is_claimable" name="is_claimable" <?php echo ( !empty($post_data['is_claimable']) ) ? "checked=''":"" ?> />
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="row mb-5">

                                    <div class="col-md-6 fv-row">
                                         <!--begin::Label-->

                                        <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_listing_tags_title") ?></label>
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input type="text" class="form-control" name="tags" value="<?php echo !empty($post_data["tags"]) ? $post_data["tags"] : ""; ?>"id="tags" />
                                             
                                        </div>
                                    </div>
                                
                                    <?php if( $referral_code==true ) { ?>
                                    <div class="col-md-6 fv-row">
                                         <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_listing_use_referral_code") ?></label>
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input type="text" class="form-control" name="referral_code" value="<?php echo !empty($post_data["referral_code"]) ? $post_data["referral_code"] : ""; ?>" id="referral_code" />
                                             
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                                
                            </div>
                        </div>
                        <!--end::Form-->
                    </div>

                    <div class="tab-pane fade" id="kt_listing_address" role="tabpanel">
                        <div class="card pt-4 mb-6 mb-xl-9">
                            <div class="card-header border-0">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2><?php echo $this->lang->line("heading_address") ?></h2>
                                </div>
                            </div>
                            <div class="card-body pt-0 pb-5">
                                <div class="row mb-5">                                    
                                    <div class="col-md-6 fv-row">
                                        <input type="hidden" name="country" value="<?php echo $post_data["country"] ?>" />
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_state") ?></label>
                                        <select class="form-select form-select-solid" name="state" data-control="select2">
                                            <option value=""><?php echo $this->lang->line("heading_state") ?></option>
                                            <?php 
                                            if( !empty($states) ) {
                                                foreach ($states as $key => $state) {
                                            ?>
                                            <option value="<?php echo encrypt($state["id"]) ?>" <?php echo (!empty($post_data['state']) && decrypt($post_data['state']) == $state["id"]) ? "selected=''" : ""; ?>><?php echo $state["name"] ?></option>
                                            <?php } 
                                            }
                                            ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error("state") ?></span>
                                    </div>

                                    <div class="col-md-6 fv-row">

                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_city") ?></label>
                                        <select class="form-select form-select-solid" name="city" data-control="select2">
                                            <option value=""><?php echo $this->lang->line("heading_city") ?></option>
                                            <?php if( !empty($cities)){
                                                foreach ($cities as $key => $city) { ?>
                                                <option value="<?php echo encrypt($city["id"]) ?>" <?php echo (!empty($post_data['city']) && decrypt($post_data['city']) == $city["id"]) ? "selected=''" : ""; ?>><?php echo $city["name"] ?></option>
                                                <?php }
                                                } ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error("city") ?></span>
                                    </div>
                                </div>
                                <div class="row mb-5">                                    
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_zip_code") ?></label>
                                        <input type="text" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_zip_code") ?>" name="zip_code" value="<?php echo $post_data["zip_code"]? : ""; ?>" />
                                    </div>

                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_address") ?></label>
                                        <input type="text" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_address") ?>" name="address" value="<?php echo $post_data["address"]? : ""; ?>" />
                                        <span class="text-danger"><?php echo form_error("address") ?></span>
                                    </div>

                                    <div class="col-md-12 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_google_location") ?></label>
                                        <input type="text" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_google_location") ?>" name="google_location" value="<?php echo $post_data["google_location"]? : ""; ?>" id="autocompleteLocation" />

                                        <input type="hidden" name="full_address" id="full_address" value="<?php echo $post_data["full_address"]? : ""; ?>"/>
                                        <input type="hidden" name="place_id" id="place_id" value="<?php echo $post_data["place_id"]? : ""; ?>"/>
                                        <input type="hidden" name="longitude" id="longitude" value="<?php echo $post_data["longitude"]? : ""; ?>"/>
                                        <input type="hidden" name="latitude" id="latitude" value="<?php echo $post_data["latitude"]? : ""; ?>"/>
                                        <div class="mt-5">
                                            <div id="custom-map-field_map" class="custom-map-field_map col-sm-12 min-h-600px"></div>
                                        </div>
                                        <span class="text-danger"><?php echo form_error("google_location") ?></span>
                                    </div>
                                    
                                    <div class="col-md-12 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_virtual_map_heading") ?></label>
                                        <input type="text" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_virtual_map_heading") ?>" name="google_virtual_map" value="<?php echo $post_data["google_virtual_map"]? : ""; ?>" id="google_virtual_map" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Form-->
                    </div>
                    <div class="tab-pane fade" id="kt_listing_logo" role="tabpanel">
                        <div class="card pt-4 mb-6 mb-xl-9">
                            <div class="card-header border-0">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2><?php echo $this->lang->line("heading_media") ?></h2>
                                </div>
                            </div>
                            <div class="card-body pt-0 pb-5">
                                <div class="row mb-5">                                    
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <div class="card card-flush py-4">
                                            <div class="card-header">
                                                <!--begin::Card title-->
                                                <div class="card-title">
                                                    <h2><?php echo $this->lang->line("heading_institute_logo") ?></h2>
                                                </div>
                                                <!--end::Card title-->
                                            </div>

                                            <div class="card-body text-left pt-0">
                                                <!--<div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">-->
                                                <div class="image-input image-input-outline" data-kt-image-input="true">
                                                    <!--begin::Preview existing avatar-->
                                                    <div class="image-input-wrapper w-150px h-150px" style="background-image: url('<?php echo base_url(BASE_LISTING_LOGO_PATH . $post_data["logo"]) ?>')"></div>
                                                    <!--end::Preview existing avatar-->
                                                    <!--begin::Label-->
                                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                                        <i class="bi bi-pencil-fill fs-7"></i>
                                                        <!--begin::Inputs-->
                                                        <input type="file" name="logo" class="form_control" />
                                                        <input type="hidden" name="logo_remove" />
                                                        <!--end::Inputs-->
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Cancel-->
                                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span>
                                                    <!--end::Cancel-->
                                                    <!--begin::Remove-->
                                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span>
                                                    <!--end::Remove-->
                                                </div>
                                                <input type="hidden" name="logo_no_error"  class="form-control no_error_input" value="1" required="" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <div class="card card-flush py-4">
                                            <div class="card-header">
                                                <!--begin::Card title-->
                                                <div class="card-title">
                                                    <h2><?php echo $this->lang->line("heading_featured_image") ?></h2>
                                                </div>
                                                <!--end::Card title-->
                                            </div>

                                            <div class="card-body text-left pt-0">
                                                <!--<div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">-->
                                                <div class="image-input image-input-outline" data-kt-image-input="true">
                                                    <!--begin::Preview existing avatar-->
                                                    <div class="image-input-wrapper w-150px h-150px" style="background-image: url('<?php echo!empty($post_data["cover_image"]) ? base_url(BASE_LISTING_COVER_IMAGE_PATH . $post_data["cover_image"]) : "" ?>')"></div>
                                                    <!--end::Preview existing avatar-->
                                                    <!--begin::Label-->
                                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                                        <i class="bi bi-pencil-fill fs-7"></i>
                                                        <!--begin::Inputs-->
                                                        <input type="file" name="cover_image" class="form_control" />
                                                        <input type="hidden" name="cover_image_remove" />
                                                        <!--end::Inputs-->
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Cancel-->
                                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span>
                                                    <!--end::Cancel-->
                                                    <!--begin::Remove-->
                                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="<?php echo $this->lang->line("heading_remove") ?>">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span>
                                                    <!--end::Remove-->
                                                </div>
                                                <input type="hidden" name="cover_image_no_error" class="form-control no_error_input" value="1" required="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 fv-row">
                                    <!--begin::Label-->
                                    <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_listing_video_title") ?></label>
                                    <input type="text" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_listing_video_title") ?>" name="video" value="<?php echo $post_data["video"]? : ""; ?>" />
                                </div>
                            </div>
                        </div>
                        <!--end::Form-->
                    </div>

                    <div class="tab-pane fade" id="kt_listing_social_media" role="tabpanel">
                        <div class="card pt-4 mb-6 mb-xl-9">
                            <div class="card-header border-0">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2><?php echo $this->lang->line("heading_social_media") ?></h2>
                                </div>
                            </div>
                            <div class="card-body pt-0 pb-5" id="listing_social_media">
                                <div class="form-group">
                                    <div data-repeater-list="listing_social_media" class="d-flex flex-column gap-3">
                                    <?php
                                    if( isset($post_data["social_media"]) ) {
                                        foreach( $post_data["social_media"] as $key=>$listing_social_media ) {?>
                                        <div data-repeater-item="" class="form-group d-flex flex-wrap align-items-center gap-5">
                                            <!--begin::Select2-->
                                            <div class="col-md-5">
                                                <input type="hidden" name="social_media_id"  value="<?php echo !empty($post_data["social_media_id"][$key]) ? $post_data["social_media_id"][$key]  :""; ?>"/>
                                                <select class="form-select" name="social_media" data-placeholder="<?php echo $this->lang->line("heading_social_media") ?>" data-kt-ecommerce-catalog-add-product="<?php echo $this->lang->line("heading_social_media") ?>">
                                                    <?php foreach($social_medias as $sub_key=>$social_media ){ ?>
                                                    <option value="<?php echo  encrypt($social_media['id']) ?>"  <?php echo ( !empty($post_data["social_media"][$key]) && decrypt($post_data["social_media"][$key]) == $social_media['id'] ) ? "selected=''":"" ?>><?php echo $social_media['display_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <!--end::Select2-->
                                            <!--begin::Input-->
                                            <div class="col-md-5">
                                                
                                                <input type="text" class="form-control " name="add_social_media" placeholder="<?php echo$this->lang->line("heading_add_social_media_username") ?>" value="<?php echo !empty($post_data["add_social_media"][$key]) ? $post_data["add_social_media"][$key]:""; ?>" />
                                            </div>
                                            <!--end::Input-->
                                            <button type="button" data-repeater-delete="" class="col-sm-2 col-md-2 btn btn-sm btn-icon btn-light-danger">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr088.svg-->
                                                <span class="svg-icon svg-icon-1">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="currentColor" />
                                                    <rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </button>
                                        </div>
                                        <?php }
                                        } ?>
                                    </div>
                                </div>
                                <div class="form-group mt-5">
                                    <button type="button" data-repeater-create="" class="btn btn-sm btn-light-primary">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
                                            <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <?php echo $this->lang->line("heading_add_more") ?>
                                    </button>
                                </div>
                                
                            </div>
                        </div>
                        <!--end::Form-->
                    </div>
                    
                    <div class="tab-pane fade" id="kt_listing_timming" role="tabpanel">
                        <div class="card pt-4 mb-6 mb-xl-9">
                            <div class="card-header border-0">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2><?php echo $this->lang->line("heading_institute_timings") ?></h2>
                                </div>
                            </div>
                            <div class="form-group card-body">
                                <div class="form-group row mb-5">
                                    <!--begin::Select2-->
                                    <div class="col-md-2 col-sm-3">
                                        <?php echo $this->lang->line("heading_day") ?>
                                    </div>
                                    <div class="col-md-10 col-sm-9">
                                        <div class="row">
                                            <div class="col-md-2 col-md-2" >
                                                <?php echo $this->lang->line("heading_start_time") ?>
                                            </div>
                                            <div class="col-md-2 col-md-2" >
                                                <?php echo $this->lang->line("heading_end_time") ?>
                                            </div>

                                            <!--end::Input-->
                                            <div class="col-md-6 col-md-6">&nbsp;</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php foreach( $week_days as $day_no => $day_name ) {?>
                                <div class="form-group row mb-5 timming_row_<?php echo $day_no ?>">
                                    <!--begin::Select2-->
                                    <div class="col-md-2 col-sm-3">
                                        <div class="form-check form-check-custom form-check-solid mb-2">
                                            <input class="form-check-input timming" type="checkbox" name="timming[<?php echo $day_no ?>]" id="timming_<?php echo $day_no ?>" data-day="<?php echo $day_no ?>" <?php echo ( !empty($post_data['timming']) && array_key_exists($day_no, $post_data['timming']) )?"checked=''":""; ?> />
                                            <label class="form-check-label"><?php echo $day_name ?></label>
                                        </div>
                                    </div>
                                    <div class="timing-listing-form col-md-10 col-sm-9 <?php echo ( !empty($post_data['timming']) && array_key_exists($day_no, $post_data['timming']) )?"":"d-none"; ?>">
                                        <div class="row mb-2">
                                            <input type="hidden" name="timming_id[<?php echo $day_no ?>][]" value="<?php echo !empty($post_data['timming_id']) ? $post_data['timming_id'][$day_no][0]:"" ?>"/>
                                            <div class="col-md-2 col-md-2" >
                                                <input type="text" class="form-control timepicker timepicker-24" name="start_time[<?php echo $day_no ?>][]" value="<?php echo  !empty($post_data['start_time'][$day_no]) ? $post_data['start_time'][$day_no][0]:"";?>"/>
                                            </div>
                                            <div class="col-md-2 col-md-2" >
                                                <input type="text" class="form-control timepicker timepicker-24" name="end_time[<?php echo $day_no ?>][]" value="<?php echo  !empty($post_data['end_time'][$day_no][0]) ? $post_data['end_time'][$day_no][0]:"";?>"/>
                                            </div>
                                        <!--end::Input-->
                                            <div class="col-sm-6 col-md-6">
                                                <button type="button" data-repeater-create="" class="btn btn-sm btn-light-primary add_more_timming" data-day="<?php echo $day_no ?>">
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
                                                        <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                    <?php echo $this->lang->line("heading_add_more") ?>
                                                </button>
                                                
                                                <?php if( $day_no==1 ) { ?>
                                                <button type="button" data-repeater-create="" class="btn btn-sm btn-light-primary add_same_timming" data-day="<?php echo $day_no ?>">
                                                    
                                                    <?php echo $this->lang->line("heading_timming_same_title") ?>
                                                </button>
                                                <?php } ?>

                                            </div>
                                        </div>
                                        <?php if( !empty($post_data["timming"][$day_no]) && is_array($post_data["timming"][$day_no]) && count($post_data["timming"][$day_no]) >1 ) { 
                                            for( $i=1;$i<count($post_data["timming"][$day_no]);$i++ ){
                                        ?>
                                        <div class="row mb-2">
                                            <input type="hidden" name="timming_id[<?php echo $day_no ?>][]" value="<?php echo !empty($post_data['timming_id'][$day_no][$i]) ? $post_data['timming_id'][$day_no][$i]:"" ?>"/>
                                            <div class="col-md-2 col-md-2" >
                                                <input type="text" class="form-control timepicker timepicker-24" name="start_time[<?php echo $day_no ?>][]" value="<?php echo  !empty($post_data['start_time'][$day_no][$i]) ? $post_data['start_time'][$day_no][$i]:"";?>"/>
                                            </div>
                                            <div class="col-md-2 col-md-2" >
                                                <input type="text" class="form-control timepicker timepicker-24" name="end_time[<?php echo $day_no ?>][]" value="<?php echo  !empty($post_data['end_time'][$day_no][$i]) ? $post_data['end_time'][$day_no][$i]:"";?>"/>
                                            </div>
                                        <!--end::Input-->
                                            <div class="col-sm-6 col-md-6">                                         
                                                <button type="button" data-repeater-delete="" class=" btn btn-sm btn-icon btn-light-danger delete_more_timming">
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr088.svg-->
                                                    <span class="svg-icon svg-icon-1">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="currentColor" />
                                                        <rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </button>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        } ?>
                                    </div>
                                </div>
                                <?php } ?>
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
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                            <!--end::Indicator progress-->
                        </button>
                        <?php if( $add_draft==true ) { ?>
                        <input type="hidden" name="save_draft" value="" />
                        <button type="button" class="btn btn-danger" id="kt_submit_button2"  >
                            <!--begin::Indicator label-->
                            <span class="indicator-label"><?php echo $this->lang->line("heading_listing_save_draft") ?></span>
                            <!--end::Indicator progress-->
                        </button>
                        <?php } ?>
                        
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
                                listing_type: { validators: { notEmpty: { message: "<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_institute_type") ) ?>" } } },
                                "name": { validators: { notEmpty: { message: "<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_name") ) ?>" } } },
                                "primary_email": { validators: { notEmpty: { message: "<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_email") ) ?>" },emailAddress:{message:"<?php echo $this->lang->line("message_invalid_email") ?>"} } },
                                "address": { validators: { notEmpty: { message: "<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_address") ) ?>" } } },
                                "state": { validators: { notEmpty: { message: "<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_state") ) ?>" } } },
                                "city": { validators: { notEmpty: { message: "<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_city") ) ?>" } } },
                                "country": { validators: { notEmpty: { message: "<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_country") ) ?>" } } },
                                "description_check": { validators: { notEmpty: { message: "<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_description") ) ?>" } } },
                                "cover_image_no_error": { validators: { notEmpty: { message: "<?php echo sprintf($this->lang->line("heading_listing_logo_max_size_instruction"),MAX_FILE_UPLOAD_SIZE) ?>" } } },
                                "logo_no_error": { validators: { notEmpty: { message: "<?php echo sprintf($this->lang->line("heading_listing_logo_max_size_instruction"),MAX_FILE_UPLOAD_SIZE) ?>" } } },
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
                                        ? ($(":input[name='save_draft']").val(""),t.setAttribute("data-kt-indicator", "on"),
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
    const usersList = <?php echo json_encode($amenity_list) ?>;
    var inputElm = document.querySelector('#kt_tagify_amenities');
    // initialize Tagify on the above input node reference
    var tagify = new Tagify(inputElm, {
        tagTextProp: 'name', // very important since a custom template is used with this property as text. allows typing a "value" or a "name" to match input with whitelist
        enforceWhitelist: true,
        skipInvalid: true, // do not remporarily add invalid tags
        dropdown: {
            closeOnSelect: false,
            enabled: 0,
            maxItems: 200,
            classname: 'users-list',
            searchKeys: ["name","value"]  // very important to set by which keys to search for suggesttions when typing
        },
        templates: {
            tag: tagTemplate,
            dropdownItem: suggestionItemTemplate
        },
        whitelist: usersList
    });
    tagify.on('dropdown:show dropdown:updated', onDropdownShow)
    tagify.on('dropdown:select', onSelectSuggestion)
    
    var $function_after_location_set = show_google_map;
    $(function () {
        KTForm.init();
        KTAppEcommerceSaveProduct.init();

        CKEDITOR.replace("kt_docs_ckeditor_classic");
        CKEDITOR.instances.kt_docs_ckeditor_classic.on('change', function(e) { 
             if( e.editor.getData()!="" ) {
                $(":input[name='description_check']").val(1);
             }else{
                 $(":input[name='description_check']").val("");
             }
        });
        $(document).on("click", ".add_more_email", function () {
            add_email();
        });
        $(document).on("click", ".delete_more_email", function () {
            remove_email($(this));
        });

        $(document).on("click", ".add_more_phone", function () {
            add_phone();
        });
        $(document).on("click", ".delete_more_phone", function () {
            remove_phone($(this));
        });

        $(document).on("click", ".add_more_whatsapp", function () {
            add_whatsapp();
        });
        $(document).on("click", ".delete_more_whatsapp", function () {
            remove_whatsapp($(this));
        });

        $(document).on("click", ".add_more_social", function () {
            add_social_media();
        });
        $(document).on("click", ".delete_more_social", function () {
            remove_social_media($(this));
        });
        $(document).on("click", "#kt_submit_button2", function () {
            $(":input[name='save_draft']").val("1");
            $("#kt_add_form").submit();
        });

        $(document).on("change", ".timming", function () {
            var $this = $(this);
            var $day_no = $this.data("day");
            if ($this.is(":checked")) {
                $(".timming_row_" + $day_no + " .timing-listing-form").removeClass("d-none");
            } else {
                $(".timming_row_" + $day_no + " .timing-listing-form").addClass("d-none");
            }
        });
        $(document).on("click", ".add_more_timming", function () {
            add_timming($(this));
        });
        $(document).on("click",".add_same_timming",function(){
            add_same_timming();
        });
        $(document).on("click", ".delete_more_timming", function () {
            delete_timming($(this));
        });
        show_time_picker();
        show_time_picker();
        var input1 = document.querySelector("#tags");
        new Tagify(input1);
        
        $(":input[name='logo']").on("change",function(){
            var $file_size = $(this)[0].files.item(0).size;
            if($file_size>'<?php echo MAX_FILE_UPLOAD_SIZE*1024*1024 ?>') {
                $(":input[name='logo_no_error']").val("");
            }else{
                $(":input[name='logo_no_error']").val(1);
            }
        });
        $(":input[name='cover_image']").on("change",function(){
            var $file_size = $(this)[0].files.item(0).size;
            if($file_size>'<?php echo MAX_FILE_UPLOAD_SIZE*1024*1024 ?>') {
                $(":input[name='cover_image_no_error']").val("");
            }else{
                $(":input[name='cover_image_no_error']").val(1);
            }
        });
        
        $("span[data-kt-image-input-action='cancel']").on("click",function(){
            $(this).parent().parent().find(".no_error_input").val("1");
        });
    });
    function show_google_map() {
       var myLatlng = new google.maps.LatLng($(":input[name='latitude']").val(),$(":input[name='longitude']").val());

        var myOptions = {
            zoom: 15,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("custom-map-field_map"), myOptions);

        var marker = new google.maps.Marker({
            draggable: true,
            position: myLatlng,
            map: map,
            title: "Your location"
        });

        google.maps.event.addListener(marker, 'dragend', function (event) {
            $(":input[name='latitude']").val(event.latLng.lat());
            $(":input[name='longitude']").val(event.latLng.lng());
        });
    }
    var addAllSuggestionsElm;
    function tagTemplate(tagData) {
        return `
            <tag title="${(tagData.title || tagData.email)}"
                    contenteditable='false'
                    spellcheck='false'
                    tabIndex="-1"
                    class="${this.settings.classNames.tag} ${tagData.class ? tagData.class : ""}"
                    ${this.getAttributes(tagData)}>
                <x title='' class='tagify__tag__removeBtn' role='button' aria-label='remove tag'></x>
                <div class="d-flex align-items-center">
                    <span class='tagify__tag-text'>${tagData.name}</span>
                </div>
            </tag>
        `
    }

    function suggestionItemTemplate(tagData) {
        return `
            <div ${this.getAttributes(tagData)}
                class='tagify__dropdown__item d-flex align-items-center ${tagData.class ? tagData.class : ""}'
                tabindex="0"
                role="option">

                ${tagData.image ? `
                        <div class='tagify__dropdown__item__avatar-wrap me-2'>
                            <img class="w-30px me-2" src="${tagData.image}">
                        </div>` : ''
                    }

                <div class="d-flex flex-column">
                    <strong>${tagData.name}</strong>
                </div>
            </div>
        `
        }

    function onDropdownShow(e) {
        var dropdownContentElm = e.detail.tagify.DOM.dropdown.content;

        if (tagify.suggestedListItems.length > 1) {
            addAllSuggestionsElm = getAddAllSuggestionsElm();

            // insert "addAllSuggestionsElm" as the first element in the suggestions list
            dropdownContentElm.insertBefore(addAllSuggestionsElm, dropdownContentElm.firstChild)
        }
    }

    function onSelectSuggestion(e) {
        if (e.detail.elm == addAllSuggestionsElm)
            tagify.dropdown.selectAll.call(tagify);
    }

    // create a "add all" custom suggestion element every time the dropdown changes
    function getAddAllSuggestionsElm() {
        // suggestions items should be based on "dropdownItem" template
        return tagify.parseTemplate('dropdownItem', [{
            class: "addAll",
            name: "Add all",
            email: tagify.settings.whitelist.reduce(function (remainingSuggestions, item) {
                return tagify.isTagDuplicate(item.value) ? remainingSuggestions : remainingSuggestions + 1
            }, 0) + " Members"
        }]
        )
    }
    function add_email() {
        var $html = '<div class="col-md-6 fv-row mt-5">'+
                    '<label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line('heading_email') ?></label>'+
                        '<div class="row">'+
                            '<div class="col-md-10 col-sm-10">'+
                                '<input type="hidden" name="listing_email_id[]" value="" />'+
                                '<input type="email" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_email") ?>" name="listing_email[]" />'+
                            '</div>'+
                            '<div class="col-md-2 col-sm-2">'+
                                '<span class="delete_more_email">'+
                                    '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" >'+
                                    '<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>'+
                                    '<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>' +
                                '</svg>'+
                        '</span>'+
                    '</div>'+
                '</div>';
        $(".listing_emails").append($html);
    }
    function remove_email($this) {
        $this.parent().parent().parent().remove();
    }
    function add_phone() {
        var $html = '<div class="col-md-6 fv-row mt-5">' +
                        '<label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line('heading_phone') ?></label>' +
                        '<div class="row">' +
                            '<div class="col-md-10 col-sm-10">' +
                                '<div class="row">' +
                                    '<input type="hidden" name="listing_phone_id[]" value="" />'+
                                    '<div class="col-md-3 <?php echo count($phone_codes) == 1 ? "d-none" : "" ?>">' +
                                        '<select class="form-select form-select-solid" name="phone_code[]" data-control="select2">' +
                                        <?php foreach ($phone_codes as $key => $phone_code) { ?>
                                            '<option value="<?php echo encrypt($phone_code["id"]) ?>" <?php echo ( count($phone_codes) == 1 || $phone_code["id"] == decrypt($listing_phone["phone_code"]) ) ? "selected=\'\'" : ""; ?>><?php echo $phone_code["phonecode"] ?></option>' +
                                        <?php } ?>
                                    '</select>' +
                                '</div>' +
                                '<div class="<?php echo count($phone_codes) == 1 ? "col-md-12" : "col-md-9" ?>">' +
                                    '<input type="text" class="form-control form-control-solid" placeholder="<?php echo $this->lang->line("heading_phone") ?>" name="phone_no[]" value="<?php echo $listing_phone["phone_no"] ?>"/>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-md-2 col-sm-2">' +
                            '<span class="delete_more_phone">' +
                                '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" >' +
                                    '<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>' +
                                    '<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>' +
                                '</svg>' +
                            '</span>' +
                        '</div>' +
                    '</div>';
        $(".listing_phone").append($html);
        $("select").niceSelect();
    }
    function remove_phone($this) {
        $this.parent().parent().parent().remove();
    }
    function add_timming($this) {
        var $day_no = $this.data("day");
        var $html = '<div class="row mb-2">'+
                        '<input type="hidden" name="timming_id['+$day_no+'][]" value=""/>'+
                        '<div class="col-md-2 col-md-2" >'+
                            '<input type="text" class="form-control timepicker timepicker-24" name="start_time['+$day_no+'][]" />'+
                        '</div>'+
                        '<div class="col-md-2 col-md-2" >'+
                            '<input type="text" class="form-control timepicker timepicker-24" name="end_time['+$day_no+'][]" />'+
                        '</div>'+
                        '<div class="col-sm-6 col-md-6">'+
                            '<button type="button" data-repeater-delete="" class=" btn btn-sm btn-icon btn-light-danger delete_more_timming">'+
                                '<span class="svg-icon svg-icon-1">'+
                                    '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">'+
                                    '<rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="currentColor" />'+
                                    '<rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor" />'+
                                    '</svg>'+
                                '</span>'+
                            '</button>'+
                        '</div>'+
                    '</div>';
        $(".timming_row_" + $day_no + " .timing-listing-form").append($html);
        show_time_picker();
    }
    
    function add_same_timming(){
        var $total_inputs = $(".timming_row_1 :input[name='start_time[1][]']").length;
        for( var $i=1;$i<=7;$i++ ){
            $("#timming_"+$i).prop("checked",false).click();//show timing inputs
            
            for( var $j=0;$j<$total_inputs;$j++ ){
                var $start_time = $(".timming_row_1 :input[name='start_time[1][]']")[$j].value;
                var $end_time = $(".timming_row_1 :input[name='end_time[1][]']")[$j].value;
                if( typeof  $(".timming_row_"+$i+" :input[name='start_time["+$i+"][]']")[$j] =="undefined" ) {
                    $(".add_more_timming[data-day='"+$i+"']").click();
                }
                $(".timming_row_"+$i+" :input[name='start_time["+$i+"][]']")[$j].value = $start_time
                $(".timming_row_"+$i+" :input[name='end_time["+$i+"][]']")[$j].value = $end_time
                
            }
        }
    }
    
    function delete_timming($this) {
        
        $this.parent().parent().remove()
    }

    function show_time_picker(){
        $(".timepicker:not(.flatpickr-input)").flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        }); 
    }
</script>
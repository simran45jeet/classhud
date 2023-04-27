<!--<link rel="stylesheet" href="<?php echo base_url(BASE_WEB_CSS_PATH . "template.css") ?>" type="text/css" />-->
<link rel="stylesheet" href="<?php echo base_url(BASE_WEB_CSS_PATH . "jquery.timepicker.min.css")?>">
<script src="<?php echo base_url(BASE_WEB_JS_PATH . "jquery.timepicker.min.js")?>"></script>
<script src="<?php echo base_url(BASE_ASSETS_PATH . "web/ckeditor/ckeditor.js?_=".filemtime(FCPATH.BASE_ASSETS_PATH."web/ckeditor/ckeditor.js"))?>"></script>
<style type="text/css">
    .additional-info-item {box-align:start !important;-webkit-box-align:start !important;align-items:start !important; }
    .timepicker .title{font-size:16px !important;}
</style>
<section id="wp-main-content" class="clearfix main-page">
    <div class="main-page-content">
        <div class="content-page">
            <div id="wp-content" class="wp-content clearfix">
                <div class="single-page-template">
                    <form name="add_listing" method="post" action="<?php echo $main_form_url ?>" method="post" id="submit-job-form" enctype="multipart/form-data" class="job-manager-form" novalidate="">
                        <div class="lazyload custom-breadcrumb breadcrumb-default text-light d-none d-sm-block" data-bg="<?php echo base_url(BASE_WEB_IMAGES_PATH."breadcrumb.jpg") ?>" style="background-image: url('<?php echo base_url(BASE_WEB_IMAGES_PATH."classhud-listing-breadcrumb.jpg") ?>')">
                            <div class="breadcrumb-overlay" style="background-color: rgba(0,0,0, 0.01)">
                            </div>
                            <div class="breadcrumb-main">
                                <div class="container">
                                    <div class="breadcrumb-container-inner" style="padding-top:120px;padding-bottom:120px">
                                        <ol class="breadcrumb">
                                            <li>
                                                <a href="<?php echo $this->base_url; ?>"><?php echo $this->lang->line("heading_home") ?></a>
                                            </li>
                                            <li class="active"><?php echo $this->lang->line("heading_add_listing") ?></li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="lazyload custom-breadcrumb breadcrumb-default text-light d-block d-sm-none" data-bg="<?php echo base_url(BASE_WEB_IMAGES_PATH."breadcrumb.jpg") ?>" style="background-image: url('<?php echo base_url(BASE_WEB_IMAGES_PATH."classhud-listing-breadcrumb-mobile.jpg") ?>')">
                            <div class="breadcrumb-overlay" style="background-color: rgba(0,0,0, 0.01)">
                            </div>
                            <div class="breadcrumb-main">
                                <div class="container">
                                    <div class="breadcrumb-container-inner" style="padding-top:120px;padding-bottom:120px">
                                        <ol class="breadcrumb d-block">
                                            <li>
                                                <a href="<?php echo $this->base_url; ?>"><?php echo $this->lang->line("heading_home") ?></a>
                                            </li>
                                            <li class="active"><?php echo $this->lang->line("heading_add_listing") ?></li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="container single-content-inner">
                            <div class="row">
                                <div class="col-12">
                                    <div class="clearfix post-1370 page type-page status-publish hentry">

                                        <div class="listing-submit-group">
                                            <div class="group-title"><?php echo $this->lang->line("heading_general_information") ?></div>
                                            <div class="group-content">
                                                
                                                <fieldset class="fieldset-job_type fieldset-type-term-select"> 
                                                    <label for="listing_type">
                                                        <?php echo $this->lang->line("heading_institute_type") ?>
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    
                                                    <div class="field form-group"> 
                                                        <select class="wide form-control" name="listing_type" id="listing_type" required="" data-validation-required-message="<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_institute_type") ) ?>">
                                                            <option value="">Institute Type</option>
                                                            <?php foreach( $organization_types as $key => $organization_type) { ?>
                                                            <option value="<?php echo encrypt($organization_type["id"]) ?>" <?php echo (!empty($post_data['listing_type']) && decrypt($post_data['listing_type'])==$organization_type["id"]) ?"selected=''":""; ?>><?php echo $organization_type["name"] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <span class="help-block"></span>
                                                        <span class="text-danger"><?php echo form_error("listing_type") ?></span>
                                                        
                                                    </div>
                                                </fieldset>
                                                
                                                <fieldset class="fieldset-job_title fieldset-type-text"> 
                                                    <label for="name">
                                                        Institute Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="field required-field form-group"> 
                                                        <input type="text" class="form-control" id="name" placeholder="<?php echo $this->lang->line("heading_name") ?>" name="name"  value="<?php echo $post_data["name"]?:""; ?>" required="" data-validation-required-message="<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_name") ) ?>" />
                                                        <span class="help-block"></span>
                                                        <span class="text-danger"><?php echo form_error("name") ?></span>
                                                    </div>
                                                </fieldset>
                                                <fieldset class="fieldset-lt_category fieldset-type-term-multiselect fieldset-type-custom-socials"> 
                                                    <label for="primary_email">
                                                        <?php echo $this->lang->line("heading_email") ?>
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    
                                                    <div class="lt-custom-additional-info-field lt-additional-info-lt_additional_info">
                                                        <div class="custom-additional-info-field">
                                                            <div class="content-inner listing_emails row">
                                                                <div class="additional-info-item  col-sm-12 col-md-10"> 
                                                                    <div class="d-inline-block form-group col-sm-12">
                                                                        <input type="email" class="input-text form_control col-sm-12" placeholder="<?php echo $this->lang->line("heading_email") ?>" name="primary_email" id="primary_email"  value="<?php echo !empty($post_data["primary_email"])?$post_data["primary_email"]:"" ?>" required="" data-validation-required-message="<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_email") ) ?>"/>
                                                                        <span class="help-block"></span>
                                                                        <span class="text-danger"><?php echo form_error("eprimary_email") ?></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col p-0">
                                                                    <a class="btn-primary btn-add_custom_social_item add_more_email" data-index="0" data-key="lt_email" href="javascript:;" id="add_more_social"> <?php echo $this->lang->line("heading_plus_add_more") ?></a>
                                                                </div>
                                                                <?php 
                                                                if(!empty($post_data["listing_email"])) { 
                                                                    foreach( $post_data["listing_email"] as $key=>$listing_email ){
                                                                ?>
                                                                <div class="additional-info-item form-group">                   
                                                                    <div class="col-sm-11 col-11">
                                                                        <input type="hidden" class="input-text form-control" placeholder="<?php echo $this->lang->line("heading_email") ?>" name="listing_email_id[]"  value="<?php echo $key; ?>" />
                                                                        <input type="email" class="input-text form-control" placeholder="<?php echo $this->lang->line("heading_email") ?>" name="listing_email[]"  value="<?php echo $listing_email ?>" />
                                                                        <span class="help-block"></span>
                                                                    </div>
                                                                    <div class="item-del pe-5 ps-3">
                                                                        <a class="btn-primary btn-inline-remove btn-remove_additional_item delete_more_email" href="javascript:;">
                                                                            <i class="las la-trash"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <?php 
                                                                    }
                                                                } ?>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                
                                                <fieldset class="fieldset-lt_category fieldset-type-term-multiselect  fieldset-type-custom-socials"> 
                                                    <label for="primary_phone_no">
                                                        <?php echo $this->lang->line("heading_phone_no") ?>
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="lt-custom-additional-info-field lt-additional-info-lt_additional_info">
                                                        <div class="custom-additional-info-field">
                                                            <div class="content-inner listing_phone">
                                                                <div class="additional-info-item form-group row">
                                                                    <div class="col-md-4 d-none">
                                                                        <select class="wide" name="primary_phone_code">
                                                                            <option value=""><?php echo $this->lang->line("heading_phone_code") ?></option>
                                                                            <?php foreach( $phone_codes as $key => $phone_code) { ?>
                                                                            <option value="<?php echo encrypt($phone_code["id"]) ?>" <?php echo count($phone_codes)==1 ? "selected=''":""; ?>><?php echo $phone_code["phonecode"] ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-12 col-md-10 ">
                                                                        <input type="number" class="input-text form-control no_arrow" placeholder="<?php echo $this->lang->line("heading_phone_no") ?>" name="primary_phone_no" id="primary_phone_no"  value="<?php echo !empty($post_data["primary_phone_no"])?$post_data["primary_phone_no"]:"" ?>"  data-validation-required-message="<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_phone_no") ) ?>" minlength="10" maxlength="10"/>
                                                                        <span class="help-block"></span>
                                                                        <span class="text-danger"><?php echo form_error("primary_phone_no") ?></span>
                                                                    </div>
                                                                    <div class="col p-0">
                                                                        <a class="btn-asd btn-add_custom_social_item add_more_phone" data-index="0" data-key="lt_email" href="javascript:;" id="add_more_social"> <?php echo $this->lang->line("heading_plus_add_more") ?></a>
                                                                    </div>
                                                                </div>
                                                                <?php 
                                                                if( !empty($post_data["phone_no"]) ) {
                                                                    foreach($post_data["phone_no"] as $key => $phone_no) {
                                                                ?>
                                                                <div class="additional-info-item">
                                                                    <div class="col-md-4 d-none">
                                                                        <input type="text" class="input-text form_control" placeholder="<?php echo $this->lang->line("heading_phone_no") ?>" name="listing_phone_id[]" value="<?php echo $post_data["listing_phone_id"][$key] ?>" />
                                                                        <select class="wide" name="phone_code[]">
                                                                            <option value=""><?php echo $this->lang->line("heading_phone_code") ?></option>
                                                                            <?php foreach( $phone_codes as $key => $phone_code) { ?>
                                                                            <option value="<?php echo encrypt($phone_code["id"]) ?>" <?php echo count($phone_codes)==1 ? "selected=''":""; ?>><?php echo $phone_code["phonecode"] ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                    <input type="text" class="input-text form_control" placeholder="<?php echo $this->lang->line("heading_phone_no") ?>" name="phone_no[]" value="<?php echo $phone_no ?>" />
                                                                    
                                                                    <div class="item-del pe-5 ps-3">
                                                                        <a class="btn-primary btn-inline-remove btn-remove_additional_item delete_more_phone" href="javascript:;">
                                                                            <i class="las la-trash"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>        
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </div> 
                                                            
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                
                                                <fieldset class="fieldset-lt_category fieldset-type-term-multiselect  fieldset-type-custom-socials"> 
                                                    <label for="primary_phone_no">
                                                        <?php echo $this->lang->line("heading_landline") ?>
                                                    </label>
                                                    <div class="lt-custom-additional-info-field lt-additional-info-lt_additional_info">
                                                        <div class="custom-additional-info-field">
                                                            <div class="content-inner">
                                                                <div class="additional-info-item form-group row">                                                                    
                                                                    <div class="col-sm-12 col-md-12">
                                                                        <input type="number" class="input-text form-control no_arrow" placeholder="<?php echo $this->lang->line("heading_landline") ?>" name="primary_phone_no" id="primary_phone_no"  value="<?php echo !empty($post_data["landline"])?$post_data["landline"]:"" ?>" />
                                                                        <span class="help-block"></span>
                                                                        <span class="text-danger"><?php echo form_error("primary_phone_no") ?></span>
                                                                    </div>

                                                                </div>
                                                            </div> 
                                                            
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                
                                                <fieldset class="fieldset-lt_category fieldset-type-term-multiselect"> 
                                                    <label for="primary_whatsapp_no"><?php echo $this->lang->line("heading_whats_app") ?></label>
                                                    <div class="lt-custom-additional-info-field lt-additional-info-lt_additional_info">
                                                        <div class="custom-additional-info-field">
                                                            <div class="content-inner">
                                                                <div class="additional-info-item form-group">
                                                                    <div class="col-md-4 d-none">
                                                                        <select class="wide" name="primary_whatsapp_code">
                                                                            <option value=""><?php echo $this->lang->line("heading_phone_code") ?></option>
                                                                            <?php foreach( $phone_codes as $key => $phone_code) { ?>
                                                                            <option value="<?php echo encrypt($phone_code["id"]) ?>" <?php echo count($phone_codes)==1 ? "selected=''":""; ?>><?php echo $phone_code["phonecode"] ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-12 p-0">
                                                                        <input type="number" class="input-text form-control no_arrow" placeholder="<?php echo $this->lang->line("heading_whats_app") ?>" name="primary_whatsapp_no" id="primary_whatsapp_no"  value="<?php echo !empty($post_data["primary_whatsapp_no"])?$post_data["primary_whatsapp_no"]:"" ?>" maxlength="10" minlength="10"/>
                                                                        <span class="help-block"></span>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <fieldset class="fieldset-job_description fieldset-type-wp-editor"> 
                                                    <label for="description">
                                                        <?php echo $this->lang->line("heading_listing_description_message") ?>
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="field">
                                                        <div id="wp-job_description-wrap" class="wp-core-ui wp-editor-wrap tmce-active form-group">
                                                            <div id="wp-job_description-editor-container" class="wp-editor-container">
                                                                <textarea class="wp-editor-area form-control" rows="5" autocomplete="off" cols="40" name="description" id="description" ><?php echo stripcslashes($post_data["description"])?:"" ?></textarea>
                                                                <input type="hidden" name="description_check" value="<?php echo !empty( stripcslashes($post_data["description"]) )?1:"" ?>" class="form-control" required="" data-validation-required-message="<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_description") ) ?>"/>
                                                                <span class="help-block"></span>
                                                                <span class="text-danger"><?php echo form_error("description") ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <fieldset class="fieldset-lt_amenities"> 
                                                    <label><?php echo $this->lang->line("heading_listing_amenity") ?></label>
                                                    <div class="field">
                                                        <div class="amenities-alert"><?php echo $this->lang->line("heading_choose_amenities") ?></div>
                                                        <ul class="job-manager-term-checklist job-manager-term-checklist-lt_amenitiesrow">
                                                            <?php foreach($amenities as $key=>$amenity) { ?>
                                                            <li class="ameity-cat-item col-12 col-sm-6 col-md-4">
                                                                <div class="pretty p-icon p-curve p-smooth">
                                                                    <input name="amenities[]" id="amenities_<?php echo $key+1; ?>" type="checkbox" value="<?php echo encrypt($amenity["id"]) ?>" <?php echo ( !empty($post_data["amenities"]) && in_my_array($amenity["id"],$post_data["amenities"]) ) ? "checked=''" :"" ?>>
                                                                    <div class="state">
                                                                        <i class="icon la la-check"></i>
                                                                        <label><?php echo $amenity["name"] ?></label>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </fieldset>
                                                <fieldset> 
                                                    <label><?php echo $this->lang->line("heading_listing_tags_title") ?></label>
                                                    <div class="field required-field form-group"> 
                                                        <input type="text" class="form-control" id="tags" placeholder="<?php echo $this->lang->line("heading_listing_tags_title") ?>" name="tags"  value="<?php echo $post_data["tags"]?:""; ?>" data-role="tagsinput"  />
                                                        <span class="help-block"></span>
                                                        <span class="text-danger"><?php echo form_error("tags") ?></span>
                                                    </div>
                                                </fieldset>
                                                <?php if( $referral_code == true ) {?>
                                                <fieldset> 
                                                    <label><?php echo $this->lang->line("heading_listing_use_referral_code") ?></label>
                                                    <div class="field required-field form-group"> 
                                                        <input type="text" class="form-control" id="referral_code" placeholder="<?php echo $this->lang->line("heading_listing_use_referral_code") ?>" name="referral_code"  value="<?php echo $post_data["referral_code"]?:""; ?>"  />
                                                        <span class="help-block"></span>
                                                        <span class="text-danger"><?php echo form_error("referral_code") ?></span>
                                                    </div>
                                                </fieldset>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="listing-submit-group listing_submit-group-media ">
                                            <div class="group-title"><?php echo $this->lang->line("heading_media") ?></div>
                                            <div class="group-content clearfix row">
                                                <fieldset class="fieldset-lt_logo_image fieldset-type-file col-sm-12 col-md-6 fieldset-type-file "> 
                                                    <label for="logo" class="fw-bold"><?php echo $this->lang->line("heading_listing_logo") ?></label>
                                                    <div class="field form-group"> 
                                                        <div class="image-input image-input-outline" data-kt-image-input="true">
                                                            <!--begin::Preview existing avatar-->
                                                            <div class="image-input-wrapper w-150px h-150px" <?php echo !empty($post_data["logo_url"]) ? "style=\"background-image: url('".base_url(BASE_LISTING_LOGO_PATH . $post_data["logo"]) ."')\"" :""; ?>></div>
                                                            <!--end::Preview existing avatar-->
                                                            <!--begin::Label-->
                                                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                                                <i class="la la-pencil"></i>
                                                                <!--begin::Inputs-->
                                                                <input type="file" name="logo" id="logo" class="form-control" <?php echo !empty($logo_required) && $logo_required==true ? "required='' data-validation-required-message='".sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_listing_logo") ) ."'" :"" ?>/>
                                                                
                                                                <input type="hidden" name="logo_remove" />
                                                                <!--end::Inputs-->
                                                            </label>
                                                            <!--end::Label--> 
                                                            <input type="text" name="logo_no_error" class="form-control" value="1" required="" data-validation-required-message="<?php echo sprintf($this->lang->line("heading_listing_logo_max_size_instruction"),MAX_FILE_UPLOAD_SIZE) ?>" />
                                                        </div>
                                                        <div><small><?php echo sprintf($this->lang->line("heading_listing_logo_max_size_instruction"),MAX_FILE_UPLOAD_SIZE) ?></small></div>
                                                        <span class="help-block"></span>
                                                    </div>
                                                   
                                                </fieldset>
                                                
                                                <fieldset class="fieldset-lt_logo_image fieldset-type-file col-sm-12 col-md-6 fieldset-type-file "> 
                                                    <label for="cover_image" class="fw-bold"><?php echo $this->lang->line("heading_listing_featured_image") ?></label>
                                                    <div class="field form-group">
                                                        <div class="image-input image-input-outline" data-kt-image-input="true">
                                                            <!--begin::Preview existing avatar-->
                                                            <div class="image-input-wrapper w-150px h-150px" <?php echo !empty($post_data["cover_image_url"]) ? "style=\"background-image: url('".base_url(BASE_LISTING_COVER_IMAGE_PATH . $post_data["cover_image"]) ."')\"" :""; ?>></div>
                                                            <!--end::Preview existing avatar-->
                                                            <!--begin::Label-->
                                                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                                                <i class="la la-pencil"></i>
                                                                <!--begin::Inputs-->
                                                                <input type="file" name="cover_image" class="form-control" <?php echo !empty($cover_image_required) && $cover_image_required==true ? "required='' data-validation-required-message='".sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_listing_featured_image") ) ."'" :"" ?> id="cover_image"/>
                                                                <input type="hidden" name="cover_image_remove" />
                                                                <!--end::Inputs-->
                                                            </label>
                                                            <input type="text" name="cover_image_no_error" class="form-control" value="1" required="" data-validation-required-message="<?php echo sprintf($this->lang->line("heading_listing_logo_max_size_instruction"),MAX_FILE_UPLOAD_SIZE) ?>" />
                                                            <!--end::Label--> 
                                                       </div>
                                                        <!-- <small class="description"> Maximum file size: 16 MB. </small> -->
                                                    <div><small><?php echo sprintf($this->lang->line("heading_listing_logo_max_size_instruction"),MAX_FILE_UPLOAD_SIZE) ?></small></div>
                                                        <span class="help-block"></span>
                                                    </div>
                                                </fieldset>
                                                
                                                <fieldset class="fieldset-lt_video fieldset-type-text form-group"> 
                                                    <label for="lt_video"><?php echo $this->lang->line("heading_listing_video_title") ?></label>
                                                    <div class="field ">
                                                        <input type="text" class="input-text form-control" name="video" id="video" placeholder="<?php echo $this->lang->line("heading_listing_video_example_placeholde") ?>" value="" data-validation-regex-regex="^((?:https?:)?\/\/)?((?:www|m)\.)?((?:youtube\.com|youtu.be))(\/(?:[\w\-]+\?v=|embed\/|v\/)?)([\w\-]+)(\S+)?$" data-validation-regex-message="<?php echo $this->lang->line("message_invalid_youtube_link") ?>" />
                                                        <span class="help-block"></span>
                                                        <span class="text-danger"><?php echo form_error("video") ?></span>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            
                                        </div>
                                        <div class="listing-submit-group">
                                            <div class="group-title"><?php echo $this->lang->line("heading_location_information") ?></div>
                                            <div class="group-content">
                                                
                                                <fieldset class="fieldset-job_location fieldset-type-text " style="position: relative"> 
                                                    <label for="autocompleteLocation">
                                                        <?php echo $this->lang->line("heading_google_location") ?>
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="field form-controller"> 
                                                        <input type="text" class="input-text form-control" placeholder="<?php echo $this->lang->line("heading_google_location") ?>" name="google_location" id="autocompleteLocation" style="position: relative" required="" data-validation-required-message="<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_google_location") ) ?>" value="<?php echo !empty($post_data["google_location"]) ? $post_data["google_location"] : ""; ?>" /> 
                                                        <input type="hidden" name="full_address" id="full_address" value="<?php echo !empty($post_data["full_address"]) ? $post_data["full_address"]: ""; ?>" />
                                                        <input type="hidden" name="place_id" id="place_id" value="<?php echo !empty($post_data["place_id"]) ? $post_data["place_id"] : "" ?>"/>
                                                        <input type="hidden" name="longitude" id="longitude" value="<?php echo !empty($post_data["longitude"]) ? $post_data["longitude"] : ""; ?>"/>
                                                        <input type="hidden" name="latitude" id="latitude" value="<?php echo !empty($post_data["latitude"]) ? $post_data["latitude"] : "";  ?>"/>
                                                    </div>
                                                </fieldset>
                                                <fieldset class="fieldset-type-custom-map">
                                                    <div class="custom-map-field">
                                                        <div id="custom-map-field_map" class="custom-map-field_map"></div>
                                                    </div>
                                                </fieldset>
                                                
                                                <fieldset class="fieldset-job_location fieldset-type-text " style="position: relative"> 
                                                    <label for="autocompleteLocation">
                                                        <?php echo $this->lang->line("heading_virtual_map_heading") ?>
                                                    </label>
                                                    <div class="field form-controller"> 
                                                        <input type="text" class="input-text form-control" placeholder="<?php echo $this->lang->line("heading_virtual_map_heading") ?>" name="google_virtual_map" id="google_virtual_map" style="position: relative" value="<?php echo !empty($post_data["google_virtual_map"]) ? $post_data["google_virtual_map"] : ""; ?>" /> 
                                                    </div>
                                                </fieldset>
                                                
                                            </div>
                                        </div>
                                        <div class="listing-submit-group listing_submit-group-business">
                                            <div class="group-title">
                                                Institute Information
                                            </div>
                                            <div class="group-content">
                                                
                                                
                                                <fieldset class="fieldset-lt_website fieldset-type-text"> 
                                                    <label for="website"><?php echo $this->lang->line("heading_website") ?></label>
                                                    <div class="field "> 
                                                        <input type="text" class="input-text" id="website" name="website" value="<?php echo !empty($post_data["website"]) ? $post_data["website"] : ""; ?>"  />
                                                    </div>
                                                </fieldset>
                                                <fieldset class="fieldset-lt_address fieldset-type-text"> 
                                                    <label for="address">
                                                        <?php echo $this->lang->line("heading_address") ?>
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="field form-group"> 
                                                        <input type="text" class="input-text form-control"  id="addresss" name="address" value="<?php echo !empty($post_data["address"]) ? $post_data["address"] : ""; ?>" placeholder="<?php echo $this->lang->line("heading_address") ?>" required="" data-validation-required-message="<?php echo sprintf( $this->lang->line("heading_address"),$this->lang->line("heading_address") ) ?>"/>
                                                        <span class="help-block"></span>
                                                        <span class="text-danger"><?php echo form_error("address") ?></span>
                                                    </div>
                                                </fieldset>
                                                
                                                <fieldset class="fieldset-lt_address fieldset-type-text"> 
                                                    <label for="state">
                                                        <?php echo $this->lang->line("heading_state") ?>
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="field form-group city"> 
                                                        
                                                        <select class="wide form-control" name="state" id="state" required="" data-validation-required-message="<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_state") ) ?>">
                                                            <option value=""><?php echo $this->lang->line("heading_state") ?></option>
                                                            <?php 
                                                            if( !empty($states) ) {
                                                                foreach( $states as $key => $state ) { 
                                                            ?>
                                                            <option value="<?php echo encrypt($state["id"]) ?>" <?php echo ( !empty($post_data["state"]) && decrypt($post_data["state"])==$state["id"] ) ? "selected=''":"" ?>><?php echo $state["name"] ?></option>
                                                            <?php } 
                                                            }?>
                                                        </select>
                                                        <span class="help-block"></span>
                                                        <span class="text-danger"><?php echo form_error("state") ?></span>
                                                    </div>
                                                </fieldset>
                                                <fieldset class="fieldset-lt_address fieldset-type-text"> 
                                                    <label for="city">
                                                        <?php echo $this->lang->line("heading_city") ?>
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="field form-group"> 
                                                        <select class="wide form-control" name="city" id="city" required="" data-validation-required-message="<?php echo sprintf( $this->lang->line("message_field_required"),$this->lang->line("heading_institute_type") ) ?>">
                                                            <option value=""><?php echo $this->lang->line("heading_city") ?></option>
                                                            <?php 
                                                            if( !empty($cities) ) {
                                                                foreach( $cities as $key => $city ) {
                                                            ?>
                                                            <option value="<?php echo encrypt($city["id"]) ?>" <?php echo ( !empty($post_data["city"]) && decrypt($post_data["city"])==$city["id"] ) ? "selected=''":"" ?>><?php echo $city["name"] ?></option>
                                                            <?php } 
                                                            }
                                                            ?>
                                                        </select>
                                                        <span class="help-block"></span>
                                                        <span class="text-danger"><?php echo form_error("city") ?></span>
                                                    </div>
                                                </fieldset>
                                                <fieldset class="fieldset-lt_address fieldset-type-text"> 
                                                    <label for="zip_code"><?php echo $this->lang->line("heading_zip_code") ?></label>
                                                    <div class="field "> 
                                                        <input type="text" class="input-text"  id="zip_code" name="zip_code" value="<?php echo !empty($post_data["zip_code"]) ? $post_data["zip_code"] : ""; ?>" placeholder="<?php echo $this->lang->line("heading_zip_code") ?>" />
                                                    </div>
                                                </fieldset>
                                                <fieldset class="fieldset-lt_address fieldset-type-text d-none"> 
                                                    <label for="address"><?php echo $this->lang->line("heading_country") ?></label>
                                                    <div class="field form_group"> 
                                                        <select class="wide" name="country">
                                                            <option value=""><?php echo $this->lang->line("heading_country") ?></option>
                                                            <?php foreach( $countries as $key => $country ) { ?>
                                                            <option value="<?php echo encrypt($country["id"]) ?>" <?php echo count($countries)==1 ? "selected=''":""; ?>><?php echo $country["name"] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                        
                                        <div class="listing-submit-group listing_submit-group-social">
                                            <div class="group-title"><?php echo $this->lang->line("heading_social_media") ?></div>
                                            <div class="group-content">
                                                <fieldset class="fieldset-lt_socials_media fieldset-type-custom-socials"> 
                                                    <label for="lt_socials_media">Social Media</label>
                                                    <div class="field ">
                                                        <div class="lt-custom-socials-field lt-socials-lt_social_items">
                                                            <div class="custom-socials-field">
                                                                <div class="social_medias">
                                                                    <?php
                                                                    if (!empty($post_data["social_media"])) {
                                                                        foreach ($post_data["social_media"] as $key=>$social_media) {
                                                                    ?>
                                                                    <div class="social-media-item">
                                                                        <div class="col-width-2 col-select">
                                                                            <input type="hidden" name="social_media_id[]" value="<?php echo $post_data["social_media_id"][$key]; ?>"/>
                                                                            <select name="social_media[]" class="form-control-select">
                                                                                <option value=""><?php echo $this->lang->line("heading_social_media") ?></option>
                                                                                <?php foreach ($social_medias as $sub_key => $social_media) { ?>
                                                                                    <option value="<?php echo encrypt($social_media['id']) ?>" <?php echo (!empty($post_data["social_media"][$key]) && decrypt($post_data["social_media"][$key]) == $social_media['id'] ) ? "selected=''" : ""; ?>><?php echo $social_media['display_name'] ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-width-2 col-link">
                                                                            <input type="text" class="form-control" name="add_social_media[]" placeholder="<?php echo $this->lang->line("heading_add_social_media_username") ?>" value="<?php echo !empty($post_data["add_social_media"][$key]) ? $post_data["add_social_media"][$key]  :"" ?>"/>
                                                                        </div>
                                                                        <div class="item-del">
                                                                            <a class="btn-primary btn-inline-remove btn-remove_social_item delete_more_social" href="javascript:;"><i class="las la-trash"></i></a>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div> 
                                                                <a class="btn-primary btn-add_custom_social_item add_more_social" data-index="0" data-key="lt_social_items" href="javascript:;" id="add_more_social"> <?php echo $this->lang->line("heading_plus_social_media") ?></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                        
                                        <div class="listing-submit-group listing_submit-business-hours lt-custom-additional-info-field">
                                            <div class="group-title">Institute Hours</div>
                                            <div class="group-content clearfix content-inner">
                                                <fieldset class="fieldset-lt_amenities fieldset-type-term-checklist"> 
                                                    <!--<label for="lt_hours"><?php echo $this->lang->line("heading_business_hours") ?></label>-->
                                                    <div class="field ">
                                                        <div class="lt-custom-hours-field lt-hours-lt_hours">
                                                            <ul class="job-manager-term-checklist job-manager-term-checklist-lt_amenities">
                                                                <?php foreach($week_days as $day_no => $day_name) { ?>
                                                                <li class="ameity-cat-item cat-all d-block  w-100 timming_row_<?php echo $day_no ?> additional-info-item">
                                                                    <div class="row">
                                                                        <div class="col-md-2 col-sm-3 p-0">
                                                                            <div class="form-check form-check-custom form-check-solid pretty p-icon p-curve p-smooth">
                                                                                <div class="pretty p-icon p-curve p-smooth">
                                                                                    <input type="checkbox" name="timming[<?php echo $day_no ?>]" id="timming_<?php echo $day_no ?>" class="timming" data-day="<?php echo $day_no ?>"  <?php echo ( !empty($post_data['timming']) && array_key_exists($day_no, $post_data['timming']) )?"checked=''":""; ?>/>
                                                                                    <div class="state">
                                                                                        <i class="icon la la-check"></i>
                                                                                        <label><?php echo $day_name ?></label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="timing-listing-form col-md-10 col-sm-9 <?php echo ( !empty($post_data['timming']) && array_key_exists($day_no, $post_data['timming']) ) ? :"d-none"; ?>">
                                                                            <div class="row mb-2">
                                                                                <input type="hidden" name="timming_id[<?php echo $day_no ?>][]" value="<?php echo !empty($post_data['timming_id'][$day_no][0]) ? $post_data['timming_id'][$day_no][0]:"" ?>"/>
                                                                                <div class="col-md-2 col-4" >
                                                                                    <input type="text" class="form-control timepicker_input" name="start_time[<?php echo $day_no ?>][]" value="<?php echo !empty($post_data['start_time'][$day_no][0]) ? $post_data['start_time'][$day_no][0]:"" ?>" placeholder="<?php echo $this->lang->line("heading_start_time") ?>"/>
                                                                                </div>
                                                                                <div class="col-md-2 col-4" >
                                                                                    <input type="text" class="form-control timepicker_input" name="end_time[<?php echo $day_no ?>][]" value="<?php echo !empty($post_data['end_time'][$day_no][0]) ? $post_data['end_time'][$day_no][0]:"" ?>" placeholder="<?php echo $this->lang->line("heading_end_time") ?>"/>
                                                                                </div>
                                                                                <div class="col-md-6 col-4">
                                                                                    <fieldset class="fieldset-lt_socials_media fieldset-type-custom-socials m-0 lh-initial">
                                                                                        <a class="btn-primary btn-add_custom_social_item add_more_timming text-nowrap " data-index="0" data-key="lt_social_items" href="javascript:;" data-day="<?php echo $day_no ?>"> <?php echo $this->lang->line("heading_add_more") ?></a>
                                                                                        <?php if( $day_no==1 ) { ?>
                                                                                        <a class="btn-primary btn-add_custom_social_item add_same_timming text-nowrap " data-index="0" data-key="lt_social_items" href="javascript:;" > <?php echo $this->lang->line("heading_timming_same_title") ?></a>
                                                                                        <?php } ?>
                                                                                    </fieldset>
                                                                                </div>
                                                                            </div>
                                                                            <?php if( !empty($post_data['timming_id'][$day_no]) && count($post_data['timming_id'][$day_no]) >1 ) { 
                                                                                for($i=1;$i<count($post_data['timming_id'][$day_no]);$i++){
                                                                            ?>
                                                                            <div class="row mb-2">
                                                                                <input type="hidden" name="timming_id[<?php echo $day_no ?>][]" value="<?php echo !empty($post_data['timming_id'][$day_no][$i]) ? $post_data['timming_id'][$day_no][$i]:"" ?>"/>
                                                                                <div class="col-md-2 col-4" >
                                                                                    <input type="text" class="form-control timepicker_input" name="start_time[<?php echo $day_no ?>][]" value="<?php echo !empty($post_data['start_time'][$day_no][$i]) ? $post_data['start_time'][$day_no][$i]:"" ?>" placeholder="<?php echo $this->lang->line("heading_start_time") ?>"/>
                                                                                </div>
                                                                                <div class="col-md-2 col-4" >
                                                                                    <input type="text" class="form-control timepicker_input" name="end_time[<?php echo $day_no ?>][]" value="<?php echo !empty($post_data['end_time'][$day_no][$i]) ? $post_data['end_time'][$day_no][$i]:"" ?>" placeholder="<?php echo $this->lang->line("heading_end_time") ?>"/>
                                                                                </div>
                                                                                <div class="col-md-6 col-4">
                                                                                    <div class="item-del">
                                                                                        <a class="btn-primary btn-inline-remove btn-remove_social_item delete_more_timming" href="javascript:;"><i class="las la-trash"></i></a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                                    
                                                                                }
                                                                            } ?>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </li>
                                                                <?php } ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                        
                                        <p> 
                                            
                                            <button type="submit" class="btn-theme" id="kt_register_submit">
                                                <!--begin::Indicator label-->
                                                <span class="indicator-label"><?php echo $this->lang->line("heading_submit_btn") ?></span>
                                                <!--end::Indicator label-->
                                                <!--begin::Indicator progress-->
                                                <!--
                                                <span class="indicator-progress"><?php echo $this->lang->line("heading_wait") ?>
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                </span>
                                                -->
                                                <!--end::Indicator progress-->
                                            </button>
                                            
                                        </p>

                                        <div class="link-pages"></div>
                                        <div class="comment-page-wrapper clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="<?php echo base_url(BASE_WEB_JS_PATH."bootstrap-tagsinput.min.js") ?>" ></script>
<link rel="stylesheet" href="<?php echo base_url(BASE_WEB_CSS_PATH."bootstrap-tagsinput.css") ?>" />
<script type="text/javascript">
    function show_google_map() {
        /*
        var CustomOp = {
            center:new google.maps.LatLng(latitude,longitude),
            zoom:18,
            mapTypeId:google.maps.MapTypeId.TERRAIN

        };
        var map = new google.maps.Map(
            document.getElementById("custom-map-field_map"),
            CustomOp
        );
        */
       var myLatlng = new google.maps.LatLng(latitude,longitude);

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
    var $function_after_location_set = show_google_map;
    $(function(){
        $(document).on("click",".add_more_email",function(e){
            e.preventDefault();
            add_email();
        });
        $(document).on("click",".delete_more_email",function(e){
            e.preventDefault();
            remove_email($(this));
        });

        $(document).on("click",".add_more_phone",function(e){
            e.preventDefault();
            add_phone();
        });
        $(document).on("click",".delete_more_phone",function(e){
            e.preventDefault();
            remove_phone($(this));
        });

        $(document).on("click",".add_more_whatsapp",function(e){
            e.preventDefault();
            add_whatsapp();
        });
        $(document).on("click",".delete_more_whatsapp",function(e){
            e.preventDefault();
            remove_whatsapp($(this));
        });
       
        $(document).on("click",".add_more_social",function(e){
            e.preventDefault();
            add_social_media();
        });
        $(document).on("click",".delete_more_social",function(e){
            e.preventDefault();
            remove_social_media($(this));
        });
       
        $(document).on("click",".timming",function(){
           var $this = $(this);
           var $day_no = $this.data("day");
           if( $this.is(":checked") ) {
               $(".timming_row_"+$day_no+" .timing-listing-form").removeClass("d-none");
           }else{
               $(".timming_row_"+$day_no+" .timing-listing-form").addClass("d-none");
           }
        });
        $(document).on("click",".add_more_timming",function(){
            add_timming($(this));
        });
        $(document).on("click",".add_same_timming",function(){
            add_same_timming();
        });
        $(document).on("click",".delete_more_timming",function(){
            delete_timming($(this));
        });
        show_timepicker();
        
        CKEDITOR.replace("description");
        CKEDITOR.instances.description.on('change', function(e) { 
             if( e.editor.getData()!="" ) {
                $(":input[name='description_check']").val(1);
             }else{
                 $(":input[name='description_check']").val("");
             }
        });
       <?php if( !empty($post_data["state"]) ) { ?> 
            get_cities('<?php echo $post_data["country"] ?>', '<?php echo $post_data["state"] ?>','<?php echo !empty($post_data["city"]) ? $post_data["city"] : "" ?>'); 
       <?php } ?>
        
        $(":input#logo").on("change",function(){
            var $file_size = $(this)[0].files.item(0).size;
            if($file_size>'<?php echo MAX_FILE_UPLOAD_SIZE*1024*1024 ?>') {
                $(":input[name='logo_no_error']").val("");
            }else{
                $(":input[name='logo_no_error']").val(1);
            }
        });
        $(":input#cover_image").on("change",function(){
            var $file_size = $(this)[0].files.item(0).size;
            if($file_size>'<?php echo MAX_FILE_UPLOAD_SIZE*1024*1024 ?>') {
                $(":input[name='cover_image_no_error']").val("");
            }else{
                $(":input[name='cover_image_no_error']").val(1);
            }
        });
    });
    
    function add_email() {
        if( $("input[name='listing_email[]']").length<<?php echo MAX_ADD_EMAIL-1 ?> ) {
            $html = '<div class="additional-info-item form-group">'+                                       
                        '<div class="col-sm-11 col-11">'+
                            '<input type="email" class="input-text form-control" placeholder="<?php echo $this->lang->line("heading_email") ?>" name="listing_email[]"  />'+
                            '<span class="help-block"></span>'+
                        '</div>'+
                        '<div class="item-del pe-5 ps-3">'+
                            '<a class="btn-primary btn-inline-remove btn-remove_additional_item delete_more_email" href="javascript:;">'+
                                '<i class="las la-trash"></i>'+
                            '</a>'+
                        '</div>'+
                    '</div>';
            $(".listing_emails").append($html);
            jQuery("input,select,textarea").not("[type=submit]").jqBootstrapValidation("destroy");
            jQuery("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
        }
    }
    function remove_email($this){
        $this.parent().parent().remove();
    }
    function add_phone() {    
        if( $("input[name='phone_no[]']").length<<?php echo MAX_ADD_PHONE_NO-1 ?> ) {
            var $html ='<div class="additional-info-item form-group">'+
                            '<div class="col-md-4 d-none">'+
                                '<input type="hidden" class="input-text form-control no_arrow" placeholder="<?php echo $this->lang->line("heading_phone_no") ?>" name="listing_phone_id[]" value=""/>'+
                                '<select class="wide" name="phone_code[]">'+
                                    '<option value=""><?php echo $this->lang->line("heading_phone_code") ?></option>'+
                                    <?php foreach( $phone_codes as $key => $phone_code) { ?>
                                    '<option value="<?php echo encrypt($phone_code["id"]) ?>" <?php echo count($phone_codes)==1 ? "selected=\'\'":""; ?>><?php echo $phone_code["phonecode"] ?></option>'+
                                    <?php } ?>
                                '</select>'+
                            '</div>'+

                            '<input type="number" class="input-text form-control no_arrow" placeholder="<?php echo $this->lang->line("heading_phone_no") ?>" name="phone_no[]" minlength="10" maxlength="10"/>'+
                            '<span class="help-block"></span>'+
                            '<div class="item-del pe-5 ps-3">'+
                                '<a class="btn-primary btn-inline-remove btn-remove_additional_item delete_more_phone" href="javascript:;">'+
                                    '<i class="las la-trash"></i>'+
                                '</a>'+
                            '</div>'+
                        '</div>';
            $(".listing_phone").append($html);
        }
    }
    function remove_phone($this){
        $this.parent().parent().remove();
    }
   
    function add_whatsapp() {
       var $html ='<div class="d-flex">'+
                        '<div class="col-md-4 p-0 d-none">'+
                            '<select class="wide" name="whatsapp_phone_code[]">'+
                                '<option value=""><?php echo $this->lang->line("heading_phone_code") ?></option>'+
                                <?php foreach( $phone_codes as $key => $phone_code) { ?>
                                '<option value="<?php echo encrypt($phone_code["id"]) ?>" <?php echo count($phone_codes)==1 ? "selected=\"\"":""; ?>><?php echo $phone_code["phonecode"] ?></option>'+
                                <?php } ?>
                            '</select>'+
                        '</div>'+
                        '<div class="col-md-11 p-0">'+
                            '<input type="text" class="form_control" placeholder="<?php echo $this->lang->line("heading_whats_app") ?>" name="whatsapp_no" />'+
                        '</div>'+
                        '<div class="col-md-1">'+
                            '<a class="add_row delete_more_whatsapp">'+
                                '<i class="ti-minus"></i>'+
                            '</a>'+
                        '</div>'+
                    '</div>';
        $(".listing_whats_app").append($html);
        $("select").niceSelect();
    }
    function remove_whatsapp($this){
        $this.parent().parent().remove();
    }
   
    function add_social_media(){
        var $html='<div class="social-media-item">'+
                        '<div class="col-width-2 col-select">'+
                            '<input type="hidden" name="social_media_id[]" value=""/>'+
                            '<select name="social_media[]" class="form-control-select">'+
                                '<option value=""><?php echo $this->lang->line("heading_social_media") ?></option>'+
                                <?php foreach($social_medias as $key=>$social_media ){ ?>
                                '<option value="<?php echo encrypt($social_media['id']) ?>"><?php echo $social_media['display_name'] ?></option>'+
                                <?php } ?>
                            '</select>'+
                        '</div>'+
                        '<div class="col-width-2 col-link">'+
                            '<input type="text" class="form_control" name="add_social_media[]" placeholder="<?php echo $this->lang->line("heading_add_social_media_username") ?>"/>'+
                        '</div>'+
                        '<div class="item-del">'+
                            '<a class="btn-primary btn-inline-remove btn-remove_social_item delete_more_social" href="javascript:;"><i class="las la-trash"></i></a>'+
                        '</div>'+
                    '</div>';
        $(".social_medias").append($html);    
        
    }
    
    function remove_social_media($this){
        $this.parent().parent().remove();
    }
    
    function add_timming($this) {
        var $day_no  = $this.data("day");
        var $html = '<div class="row mb-2">'+
                        '<input type="hidden" name="timming_id['+$day_no+'][]" value=""/>'+
                        '<div class="col-md-2 col-4" >'+
                            '<input type="text" class="form-control timepicker_input" name="start_time['+$day_no+'][]" value="" placeholder="<?php echo $this->lang->line("heading_start_time") ?>"/>'+
                        '</div>'+
                        '<div class="col-md-2 col-4" >'+
                            '<input type="text" class="form-control timepicker_input" name="end_time['+$day_no+'][]" value="" placeholder="<?php echo $this->lang->line("heading_end_time") ?>"/>'+
                        '</div>'+
                        '<div class="col-md-6 col-4">'+
                            '<div class="item-del">'+
                                '<a class="btn-primary btn-inline-remove btn-remove_social_item delete_more_timming" href="javascript:;"><i class="las la-trash"></i></a>'+
                            '</div>'+
                        '</div>'+
                    '</div>';
        $(".timming_row_"+$day_no+" .timing-listing-form").append($html);
        show_timepicker();
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
   
    function show_timepicker(){
        jQuery('.timepicker_input:not(.ui-timepicker-input)').timepicker({"step": "1",timeFormat:"h:i A"})
        //$(".timepicker:not(.flatpickr-input)").flatpickr({enableTime: true,noCalendar: true,dateFormat: "H:i"});
    }
    function delete_timming($this) {
        $this.parent().parent().parent().remove()
    }
</script>

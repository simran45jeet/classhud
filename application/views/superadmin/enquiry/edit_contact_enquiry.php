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
                            <div class="card-body pt-0 pb-5">
                                <div class="row mb-5">                                    
                                    <div class="col-md-12 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2"><?php echo $this->lang->line('heading_name') ?></label>
                                        <input type="text" class="form-control" name="name" value="<?php echo !empty($post_data["name"]) ? $post_data["name"] : ""; ?>" readonly=""/>
                                        <span class="text-danger"><?php echo form_error("name") ?></span>
                                    </div>
                                    
                                </div>
                                
                                <div class="row mb-5">                                    
                                    <div class="col-md-12 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_email") ?></label>
                                        <input type="text" class="form-control" name="email" value="<?php echo !empty($post_data["email"]) ? $post_data["email"] : ""; ?>" readonly=""/>
                                        <span class="text-danger"><?php echo form_error("email") ?></span>
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
                                                        <option value="<?php echo encrypt($phone_code["id"]) ?>" <?php echo ( count($phone_codes) == 1 || $phone_code["id"] == decrypt($post_data["phone_code"]) ) ? "selected=''" : ""; ?>><?php echo $phone_code["phonecode"] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="<?php echo count($phone_codes) == 1 ? "col-md-12" : "col-md-9"; ?>">
                                                <input type="text" class="form-control" placeholder="<?php echo $this->lang->line("heading_phone") ?>" name="phone_no" value="<?php echo $post_data["phone_no"]? : ""; ?>" readonly=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="row mb-5">                                    
                                    <div class="col-md-12 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_subject_title") ?></label>
                                        <input type="text" class="form-control" name="subject" value="<?php echo !empty($post_data["subject"]) ? $post_data["subject"] : ""; ?>" readonly=""/>
                                        <span class="text-danger"><?php echo form_error("subject") ?></span>
                                    </div>
                                    
                                </div>
                                <div class="row mb-5">                                    
                                    <div class="col-md-12 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_message_title") ?></label>
                                        <textarea type="text" class="form-control" name="description" readonly=""><?php echo !empty($post_data["description"]) ? stripcslashes($post_data["description"]) : ""; ?></textarea>
                                        <span class="text-danger"><?php echo form_error("subject") ?></span>
                                    </div>
                                    
                                </div>
                                
                                <div class="row mb-5">
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2"><?php echo $this->lang->line("heading_status") ?></label>
                                        <select data-control="select2" data-placeholder="<?php echo $this->lang->line("heading_status") ?>" data-hide-search="true" class="form-select" name="enquiry_status">
                                            <option value="<?php echo ENQUIRY_STATUS_PENDING ?>" <?php echo $post_data["enquiry_status"]==ENQUIRY_STATUS_PENDING ? "selected=''":"" ?>><?php echo $this->lang->line("heading_enquiry_status_list")[ENQUIRY_STATUS_PENDING] ?></option>
                                            <option value="<?php echo ENQUIRY_STATUS_SOLVED ?>" <?php echo $post_data["enquiry_status"]==ENQUIRY_STATUS_SOLVED ? "selected=''":"" ?>><?php echo $this->lang->line("heading_enquiry_status_list")[ENQUIRY_STATUS_SOLVED] ?></option>
                                            <option value="<?php echo ENQUIRY_STATUS_REJECTED ?>" <?php echo $post_data["enquiry_status"]==ENQUIRY_STATUS_REJECTED ? "selected=''":"" ?>><?php echo $this->lang->line("heading_enquiry_status_list")[ENQUIRY_STATUS_REJECTED] ?></option>
                                            
                                        </select>
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

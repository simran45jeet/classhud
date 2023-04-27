<section id="wp-main-content" class="clearfix main-page">
    <div class="main-page-content">
        <div class="content-page">
            <div id="wp-content" class="wp-content clearfix">
                <div class="single-page-template">
                    <form name="add_listing" method="post" action="<?php echo $main_form_url ?>" method="post" id="submit-job-form" enctype="multipart/form-data" class="job-manager-form" novalidate="">
                        <div class="container single-content-inner p-0">
                            <div class="row">
                                <div class="col-12">
                                    <div class="clearfix post-1370 page type-page status-publish hentry">

                                        <div class="listing-submit-group">
                                            <div class="group-title"><?php echo $this->lang->line("message_listing_setting_title") ?></div>
                                            <div class="group-content">
                                                <fieldset class="fieldset-lt_address fieldset-type-text"> 
                                                    <label for="banner_field_one_value"><?php echo $this->lang->line("heading_banner_setting_field_one_title") ?></label>
                                                    <div class="field "> 
                                                        <input type="text" class="input-text"  id="banner_field_one_value" name="banner_field_one_value" value="<?php echo !empty($post_data["banner_field_one_value"]) ? $post_data["banner_field_one_value"] : ""; ?>" placeholder="<?php echo $this->lang->line("message_banner_setting_field_one_title") ?>" />
                                                    </div>
                                                </fieldset>
                                                <fieldset class="fieldset-lt_address fieldset-type-text"> 
                                                    <label for="banner_field_two_value"><?php echo $this->lang->line("heading_banner_setting_field_two_title") ?></label>
                                                    <div class="field "> 
                                                        <input type="text" class="input-text"  id="banner_field_two_value" name="banner_field_two_value" value="<?php echo !empty($post_data["banner_field_two_value"]) ? $post_data["banner_field_two_value"] : ""; ?>" placeholder="<?php echo $this->lang->line("message_banner_setting_field_two_title") ?>" />
                                                    </div>
                                                </fieldset>
                                                <fieldset class="fieldset-lt_address fieldset-type-text"> 
                                                    <label for="message_banner_setting_field_three_title"><?php echo $this->lang->line("heading_banner_setting_field_three_title") ?></label>
                                                    <div class="field "> 
                                                        <input type="text" class="input-text"  id="message_banner_setting_field_three_title" name="banner_field_three_value" value="<?php echo !empty($post_data["banner_field_three_value"]) ? $post_data["banner_field_three_value"] : ""; ?>" placeholder="<?php echo $this->lang->line("message_banner_setting_field_three_title") ?>" />
                                                    </div>
                                                </fieldset>
                                                
                                                <fieldset class="fieldset-lt_address fieldset-type-text"> 
                                                    <label for="logo_position"><?php echo $this->lang->line("heading_logo_position_title") ?></label>
                                                    <div class="field "> 
                                                        <select  class="input-text form-control"  id="logo_position" name="logo_position">
                                                            <option value="<?php echo LISTING_LOGO_POSITION_TOP_LEFT ?>" <?php echo ( !empty($post_data["logo_position"]) && $post_data["logo_position"]==LISTING_LOGO_POSITION_TOP_LEFT ) ? "seelcted=''":"" ?>><?php echo $this->lang->line("heading_logo_position_top_left_title") ?></option>
                                                            <option value="<?php echo LISTING_LOGO_POSITION_TOP_CENTER ?>" <?php echo ( !empty($post_data["logo_position"]) && $post_data["logo_position"]==LISTING_LOGO_POSITION_TOP_CENTER ) ? "seelcted=''":"" ?>><?php echo $this->lang->line("heading_logo_position_top_center_title") ?></option>
                                                            <option value="<?php echo LISTING_LOGO_POSITION_TOP_RIGHT ?>" <?php echo ( !empty($post_data["logo_position"]) && $post_data["logo_position"]==LISTING_LOGO_POSITION_TOP_RIGHT ) ? "seelcted=''":"" ?>><?php echo $this->lang->line("heading_logo_position_top_right_title") ?></option>
                                                        </select>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <p>                                         
                                            <button type="submit" class="btn-theme" id="kt_register_submit">

                                                <span class="indicator-label"><?php echo $this->lang->line("heading_submit_btn") ?></span>
                                            </button>
                                        </p>
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

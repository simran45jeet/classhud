<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row ">
        <div class="col-md-12 col-sm-12 col-xs-12 card">

            <div class="x_panel card-body">
                <div class="x_content">
                    <form name="follow_up_form"  method="post" action="<?php echo superadmin_url("{$controllerName}/{$methodName}") ?>" id="follow_up_form" novalidate="">
                        <input type="hidden" name="edited_id" value="<?php echo $edited_id; ?>"/>
                        <div class="form-group row">
                            <label class=" col-md-2 col-sm-2 col-xs-12" for="follow_up_type"><?php echo $this->lang->line('heading_followup_type'); ?> <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select name="follow_up_type" class="form-control col-md-12 col-xs-12 select2_single" id="follow_up_type">
                                    <option value=""><?php echo $this->lang->line('heading_followup_type') ?></option>
                                    <option value="<?php echo FOLLOWUP_TYPE_VISIT ?>" <?php echo ( !empty($postData['follow_up_type']) && $postData['follow_up_type'] == FOLLOWUP_TYPE_VISIT )  ?"selected=''" :""?>><?php echo $this->lang->line('heading_followup_type_visit') ?></option>
                                    <option value="<?php echo FOLLOWUP_TYPE_CALL ?>"  <?php echo ( !empty($postData['follow_up_type']) && $postData['follow_up_type'] == FOLLOWUP_TYPE_CALL )  ?"selected=''" :""?>label=""><?php echo $this->lang->line('heading_followup_type_call') ?></option>
                                </select>
                                <div class="help-block"></div>
                                <span class="text-danger"><?php echo form_error('follow_up_type'); ?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class=" col-md-2 col-sm-2 col-xs-12" for="first_name"><?php echo $this->lang->line('heading_first_name'); ?> <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" name="first_name" value="<?php echo $postData['first_name']? : ""; ?>" class="form-control col-md-12 col-xs-12" required="" id="first_name"/>
                                <div class="help-block"></div>
                                <span class="text-danger"><?php echo form_error('first_name'); ?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class=" col-md-2 col-sm-2 col-xs-12" for="last_name"><?php echo $this->lang->line('heading_last_name'); ?> <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" name="last_name" value="<?php echo $postData['last_name']? : ""; ?>" class="form-control col-md-12 col-xs-12" required="" id="last_name"/>
                                <div class="help-block"></div>
                                <span class="text-danger"><?php echo form_error('last_name'); ?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class=" col-md-2 col-sm-2 col-xs-12" for="phone_no"><?php echo $this->lang->line('heading_phone_no'); ?> <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" name="phone_no" value="<?php echo $postData['phone_no']? : ""; ?>" class="form-control col-md-12 col-xs-12" maxlength="10" minlength="10" required="" data-validation-contains-regex="[0-9]+$" data-validation-contains-message ="<?php echo $this->lang->line('message_enter_valid_phone') ?>" id="phone_no"/>
                                <div class="help-block"></div>
                                <span class="text-danger"><?php echo form_error('name'); ?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class=" col-md-2 col-sm-2 col-xs-12" for="designation"><?php echo $this->lang->line('heading_followup_designation'); ?> </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" name="designation"  class="form-control col-md-12 col-xs-12" id="designation" value="<?php echo $postData['designation']?:"" ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class=" col-md-2 col-sm-2 col-xs-12" for="company_name"><?php echo $this->lang->line('heading_followup_firm'); ?> </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" name="company_name" class="form-control col-md-12 col-xs-12" id="company_name" value="<?php echo $postData['company_name']?:"" ?>"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class=" col-md-2 col-sm-2 col-xs-12" for="address"><?php echo $this->lang->line('heading_followup_area'); ?>  <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" name="address" class="form-control col-md-12 col-xs-12" id="address" value="<?php echo $postData['address']?:""; ?>" required="" />
                                <div class="help-block"></div>
                                <span class="text-danger"><?php echo form_error('address'); ?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class=" col-md-2 col-sm-2 col-xs-12" for="date"><?php echo $this->lang->line('heading_date'); ?> <span class="required">*</span> </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" name="follow_up_date" class="form-control col-md-12 col-xs-12" id="date" value="<?php echo $postData['follow_up_date']?:""; ?>" required="" />
                                <div class="help-block"></div>
                                <span class="text-danger"><?php echo form_error('follow_up_date'); ?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class=" col-md-2 col-sm-2 col-xs-12" for="services"><?php echo $this->lang->line('heading_followup_services'); ?> <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12" >

                                <select class="form-control col-md-12 col-xs-12 select2_multiple" id="services" name="services[]" required="" multiple="" >
                                    <option value=""><?php echo $this->lang->line('heading_followup_services'); ?> </option>
                                    <?php foreach ($services as $key => $service) { ?>
                                        <option value="<?php echo encrypt($service['id']); ?>" <?php echo ( !empty($postData) && in_array($service['id'],$postData['services']) ) ? "selected=''" :""; ?>><?php echo $service['name']; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class=" col-md-2 col-sm-2 col-xs-12" for="complete_status"><?php echo $this->lang->line('heading_followup_status'); ?> </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select name="complete_status" class="form-control col-md-12 col-xs-12 select2_single" id="complete_status">
                                    <option value="<?php echo FOLLOWUP_STATUS_PENDING ?>" <?php echo ( isset($postData['complete_status']) && $postData['complete_status'] == FOLLOWUP_STATUS_PENDING )  ?"selected=''" :""?>><?php echo $this->lang->line('heading_followup_status_pending') ?></option>
                                    <option value="<?php echo FOLLOWUP_STATUS_COMPLETE ?>"  <?php echo ( !empty($postData['complete_status']) && $postData['complete_status'] == FOLLOWUP_STATUS_COMPLETE )  ?"selected=''" :""?>label=""><?php echo $this->lang->line('heading_followup_status_complete') ?></option>
                                    <option value="<?php echo FOLLOWUP_STATUS_CANCEL ?>"  <?php echo ( !empty($postData['complete_status']) && $postData['complete_status'] == FOLLOWUP_STATUS_CANCEL )  ?"selected=''" :""?>label=""><?php echo $this->lang->line('heading_followup_status_cancel') ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                <button type="submit" name="submit" class="btn btn-success"><?php echo $this->lang->line('heading_save'); ?></button>
                                <a href="<?php echo superadmin_url(); ?>restaurants/index"><button class="btn btn-primary" type="button"><?php echo $this->lang->line('heading_cancel'); ?></button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $(":input").not("[type=image],[type=submit]").jqBootstrapValidation();
    });
</script>
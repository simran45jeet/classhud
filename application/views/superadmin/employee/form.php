<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row ">
        <div class="col-md-12 col-sm-12 col-xs-12 card">

            <div class="x_panel card-body">
                <div class="x_content">
                    <form name="follow_up_form"  method="post" action="<?php echo superadmin_url("{$controllerName}/{$methodName}") ?>" id="follow_up_form" novalidate="">
                        <input type="hidden" name="edited_id" value="<?php echo $edited_id; ?>"/>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12 col-xs-12 no-pad d-sm-flex d-md-flex d-xs-block">
                                <label class=" col-md-3 col-sm-3 col-xs-12" for="first_name"><?php echo $this->lang->line('heading_first_name'); ?> <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" name="first_name" value="<?php echo $postData['first_name']? : ""; ?>" class="form-control col-md-12 col-xs-12" required="" id="name"/>
                                    <div class="help-block"></div>
                                    <span class="text-danger"><?php echo form_error('first_name'); ?></span>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-6 col-sm-12 col-xs-12 no-pad d-sm-flex d-md-flex d-xs-block">
                                <label class=" col-md-3 col-sm-3 col-xs-12" for="last_name"><?php echo $this->lang->line('heading_last_name'); ?> <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" name="last_name" value="<?php echo $postData['last_name']? : ""; ?>" class="form-control col-md-12 col-xs-12" required="" id="name"/>
                                    <div class="help-block"></div>
                                    <span class="text-danger"><?php echo form_error('last_name'); ?></span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12 col-xs-12 no-pad d-sm-flex d-md-flex d-xs-block">
                                <label class=" col-md-3 col-sm-3 col-xs-12" for="name"><?php echo $this->lang->line('heading_email'); ?> <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="email" name="email" value="<?php echo $postData['email']? : ""; ?>" class="form-control col-md-12 col-xs-12" required="" id="email"/>
                                    <div class="help-block"></div>
                                    <span class="text-danger"><?php echo form_error('email'); ?></span>
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12 col-xs-12 no-pad d-sm-flex d-md-flex d-xs-block">
                                <label class=" col-md-3 col-sm-3 col-xs-12" for="phone_no"><?php echo $this->lang->line('heading_phone_no'); ?> <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" name="phone_no" value="<?php echo $postData['phone_no']? : ""; ?>" class="form-control col-md-12 col-xs-12" required="" id="phone_no" maxlength="10" minlength="10" required="" data-validation-contains-regex="[0-9]+$" data-validation-contains-message ="<?php echo $this->lang->line('message_enter_valid_phone') ?>" />
                                    <div class="help-block"></div>
                                    <span class="text-danger"><?php echo form_error('phone_no'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12 col-xs-12 no-pad d-sm-flex d-md-flex d-xs-block">
                                <label class=" col-md-3 col-sm-3 col-xs-12" for="name"><?php echo $this->lang->line('heading_country'); ?> </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select name="country_id" class="form-control select2_single" id="country_id">
                                        <option value=""><?php echo $this->lang->line('heading_country') ?></option>
                                        <?php foreach($countries as $key=>$country) { ?>
                                        <option value="<?php echo encrypt($country['id']) ?>" <?php echo ( !empty($postData['country_id']) && $postData['country_id'] == $country['id']) ? "selected=''":""; ?>><?php echo $country['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="help-block"></div>
                                    <span class="text-danger"><?php echo form_error('country_id'); ?></span>
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12 col-xs-12 no-pad d-sm-flex d-md-flex d-xs-block">
                                <label class=" col-md-3 col-sm-3 col-xs-12" for="state"><?php echo $this->lang->line('heading_state'); ?> <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12" >
                                    <div id="stateDv">
                                        <select name="state_id" class="form-control select2_single" id="state_id">
                                            <option value=""><?php echo $this->lang->line('heading_state') ?></option>
                                            <?php foreach( $states as $key=>$state ) { ?>
                                            <option value="<?php echo encrypt($state['id']) ?>" <?php echo ( !empty($postData['state_id']) && $state['id']==$postData['state_id']) ? "selected=''":"" ?>><?php echo $state['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="help-block"></div>
                                    <span class="text-danger"><?php echo form_error('state_id'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12 col-xs-12 no-pad d-sm-flex d-md-flex d-xs-block">
                                <label class=" col-md-3 col-sm-3 col-xs-12" for="city"><?php echo $this->lang->line('heading_city'); ?> <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12" >
                                    <div id="cityDv">
                                        <select name="city_id" class="form-control select2_single" id="state_id">
                                            <option value=""><?php echo $this->lang->line('heading_city') ?></option>
                                            <?php foreach( $cities as $key=>$city ) { ?>
                                            <option value="<?php echo encrypt($city['id']) ?>" <?php echo ( !empty($postData['city_id']) && $city['id']==$postData['city_id']) ? "selected=''":"" ?>><?php echo $city['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="help-block"></div>
                                    <span class="text-danger"><?php echo form_error('city_id'); ?></span>
                                </div>
                            </div>
                            
                            <div class="form-group  col-md-6 col-sm-12 col-xs-12 no-pad d-sm-flex d-md-flex d-xs-block">
                                <label class=" col-md-3 col-sm-3 col-xs-12" for="services"><?php echo $this->lang->line('heading_services'); ?> <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12" >

                                    <select class="form-control col-md-12 col-xs-12 select2_multiple" id="services" name="services[]" required="" multiple="" >
                                        <option value=""><?php echo $this->lang->line('heading_services'); ?> </option>
                                        <?php foreach ($services as $key => $service) { ?>
                                            <option value="<?php echo encrypt($service['id']); ?>" <?php echo ( !empty($postData) && in_array($service['id'],$postData['services']) ) ? "selected=''" :""; ?>><?php echo $service['name']; ?> </option>
                                        <?php } ?>
                                    </select>
                                    <div class="help-block"></div>
                                    <span class="text-danger"><?php echo form_error('heading_services'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12 col-xs-12 no-pad d-sm-flex d-md-flex d-xs-block">
                                <label class=" col-md-3 col-sm-3 col-xs-12" for="password"><?php echo $this->lang->line('heading_password'); ?> </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="password" name="password" value="" class="form-control col-md-12 col-xs-12" minlength="<?php echo PASSWORD_MIN_LENGTH ?>"/>
                                    <div class="help-block"></div>
                                    <span class="text-danger"><?php echo form_error('password'); ?></span>
                                </div>
                            </div>
                                
                            <div class="form-group col-md-6 col-sm-12 col-xs-12 no-pad d-sm-flex d-md-flex d-xs-block">
                                <label class=" col-md-3 col-sm-3 col-xs-12" for="password"><?php echo $this->lang->line('heading_confirm_password'); ?> </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="password" name="confirm_password" value="" class="form-control col-md-12 col-xs-12" minlength="<?php echo PASSWORD_MIN_LENGTH ?>" data-validation-match-match="password"/>
                                    <div class="help-block"></div>
                                    <span class="text-danger"><?php echo form_error('confirm_password'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12 col-xs-12 no-pad d-sm-flex d-md-flex d-xs-block">
                                <label class=" col-md-3 col-sm-3 col-xs-12" for="start_date"><?php echo $this->lang->line('heading_status'); ?> </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="checkbox" name="status" value="1" <?php echo (!isset($postData['status']) || $postData['status']==ACTIVE) ? "checked=''"  :""; ?> class="switch"/>
                                </div>
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
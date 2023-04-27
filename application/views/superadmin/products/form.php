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
                                <label class=" col-md-3 col-sm-3 col-xs-12" for="name"><?php echo $this->lang->line('heading_name'); ?> <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" name="name" value="<?php echo $postData['name']? : ""; ?>" class="form-control col-md-12 col-xs-12" required="" id="name"/>
                                    <div class="help-block"></div>
                                    <span class="text-danger"><?php echo form_error('name'); ?></span>
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12 col-xs-12 no-pad d-sm-flex d-md-flex d-xs-block">
                                <label class=" col-md-3 col-sm-3 col-xs-12" for="start_date"><?php echo $this->lang->line('heading_duration'); ?> </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select name="duration" id="duration" class="select2_single form-control col-md-12 col-xs-12">
                                        <option value=""><?php echo $this->lang->line('heading_duration') ?></option>
                                        <?php foreach($durations as $duration) { ?>
                                        <option value="<?php echo encrypt($duration['id']) ?>" <?php echo (!empty($postData['duration']) && $postData['duration']==$duration['id']) ? "selected=''":""; ?>><?php echo $duration['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12 col-xs-12 no-pad d-sm-flex d-md-flex d-xs-block">
                                <label class=" col-md-3 col-sm-3 col-xs-12" for="price"><?php echo $this->lang->line('heading_product_price'); ?> <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" name="price" value="<?php echo $postData['price']? : ""; ?>" class="form-control col-md-12 col-xs-12" required="" id="price"/>
                                    <div class="help-block"></div>
                                    <span class="text-danger"><?php echo form_error('price'); ?></span>
                                </div>
                            </div>
                                
                            <div class="form-group col-md-6 col-sm-12 col-xs-12 no-pad d-sm-flex d-md-flex d-xs-block">
                                <label class=" col-md-3 col-sm-3 col-xs-12" for="sale_price"><?php echo $this->lang->line('heading_product_sale_price'); ?> <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" name="sale_price" value="<?php echo $postData['sale_price']? : ""; ?>" class="form-control col-md-12 col-xs-12" required="" id="sale_price"/>
                                    <div class="help-block"></div>
                                    <span class="text-danger"><?php echo form_error('sale_price'); ?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12 col-xs-12 no-pad d-sm-flex d-md-flex d-xs-block">
                                <label class=" col-md-3 col-sm-3 col-xs-12" for="start_date"><?php echo $this->lang->line('heading_start_date'); ?> </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" name="start_date" value="<?php echo $postData['start_date']? : ""; ?>" class="form-control col-md-12 col-xs-12 date"  id="start_date"/>
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12 col-xs-12 no-pad d-sm-flex d-md-flex d-xs-block">
                                <label class=" col-md-3 col-sm-3 col-xs-12" for="end_date"><?php echo $this->lang->line('heading_end_date'); ?> </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text"  value="<?php echo $postData['start_date']? : ""; ?>" class="form-control col-md-12 col-xs-12 date" id="end_date"/>
                                </div>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 no-pad ">
                                <label class="col-md-12  col-sm-12 col-xs-12" for="description"><?php echo $this->lang->line('heading_description'); ?> <span class="required">*</span></label>
                                <div class="col-md-19 col-sm-12 col-xs-12">
                                    <textarea  name="description"  class="form-control col-md-12 col-xs-12 " required="" id="description"><?php echo $postData['description']? : ""; ?></textarea>
                                    <div class="help-block"></div>
                                    <span class="text-danger"><?php echo form_error('start_date'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 no-pad ">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <table class="table table-bordered table-hover table-checkable" id="crm_datatable">
                                        <thead>
                                            <tr>
                                                <th><?php echo $this->lang->line('heading_service'); ?></th> 
                                                <th><?php echo $this->lang->line('heading_product_service_count') ?></th>
                                                <th><?php echo $this->lang->line('heading_action') ?></th>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                        <?php foreach( $postData['services'] as $key=>$serviceId ){ 
                                                foreach( $services as $key2=>$service ){
                                                    if($service['id']!=$serviceId) {
                                                        continue;
                                                    }else{
                                                        $services[$key2]['disabled']=true;
                                                    }
                                        ?>
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <?php echo $service['name'] ?><input type="hidden" name="services[]" class="font-control" value="<?php echo encrypt($serviceId) ?>" required=""/><input type="hidden" name="services_no[]" class="font-control services_no" value="<?php echo $key2; ?>" />
                                                        <div class="help-block"></div>
                                                    </div>
                                                    </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="services_count[]" value="<?php echo $postData['services_count'][$key] ?>" min="1"/>
                                                        <div class="help-block"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="javascript:;" class="deleteServiceRow"><i class="la la-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        <?php } ?>
                                        </tbody> 
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="form-group  col-md-6 col-sm-12 col-xs-12 no-pad d-sm-flex d-md-flex d-xs-block">
                            <label class=" col-md-3 col-sm-3 col-xs-12" for="services"><?php echo $this->lang->line('heading_services'); ?> <span class="required">*</span></label>
                            <div class="col-md-4 col-sm-4 col-xs-12 pr-0" >
                                <select class="form-control col-md-12 col-xs-12" id="services" name="add_services" >
                                    <option value=""><?php echo $this->lang->line('heading_services'); ?> </option>
                                    <?php foreach ($services as $key => $service) { ?>
                                        <option value="<?php echo encrypt($service['id']); ?>" data-cnt="<?php echo $key ?>" <?php echo $service['disabled'] ?"disabled='disabled'":""?>><?php echo $service['name']; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12 pr-0" >
                                <input type="button" class="form-control btn btn-success" value="<?php echo $this->lang->line('heading_add') ?>" name="add_service" id="add_service" />
                            </div>
                            
                        </div>
                        
                        <div class="form-group  col-md-6 col-sm-12 col-xs-12 no-pad d-sm-flex d-md-flex d-xs-block">
                            <label class=" col-md-3 col-sm-3 col-xs-12" for="start_date"><?php echo $this->lang->line('heading_status'); ?> </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="checkbox" name="status" value="1" <?php echo (!isset($postData['status']) || $postData['status']==ACTIVE) ? "checked=''"  :""; ?> class="switch"/>
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
        $(document).on("click",".deleteServiceRow",function(){
            var $tr = $(this).closest('tr');
            var $dataCnt = $tr.find('.services_no').val();
            $tr.remove();
            $(':input[name="add_services"] option[data-cnt="'+$dataCnt+'"]').prop('disabled',false);
        });
        $(document).on("click","#add_service",function(){
            var $selectServiceName = $(':input[name="add_services"] option:selected').text();
            var $selectServiceId = $(':input[name="add_services"] option:selected').val();
            var $selectServiceNo = $(':input[name="add_services"] option:selected').data("cnt");
            if( $selectServiceId!='' ) {
                var $html ='<tr>'+
                                '<td>'+$selectServiceName+'<div class="form-group"><input type="hidden" name="services[]" class="font-control" value="'+$selectServiceId+'" required=""/><input type="hidden" name="services_no[]" class="font-control services_no" value="'+$selectServiceNo+'" /><div class="help-block"></div></div></td>'+
                                '<td><div class="form-group"><input type="text" class="form-control" name="services_count[]" required="" min="1" /><div class="help-block"></div></div></td>'+
                                '<td><a href="javascript:;" class="deleteServiceRow"><i class="la la-trash"></i></a></td>'+
                            '</tr>';
            }
            $('#crm_datatable tbody').append($html);
            $(':input[name="add_services"] option[data-cnt="'+$selectServiceNo+'"]').prop('disabled','disabled');
            $(':input[name="add_services"]').val("");
            $(":input").not("[type=image],[type=submit]").jqBootstrapValidation("destroy");
            $(":input").not("[type=image],[type=submit]").jqBootstrapValidation();
        });
    });
</script>
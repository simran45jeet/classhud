<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row ">
        <div class="col-md-12 col-sm-12 col-xs-12 card">

            <div class="x_panel card-body">
                <div class="x_content">
                    <form name="follow_up_form"  method="post" action="<?php echo superadmin_url("{$controllerName}/{$methodName}") ?>" id="follow_up_form" novalidate="">
                        <input type="hidden" name="edited_id" value="<?php echo $edited_id; ?>"/>
                        
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
                            <label class=" col-md-2 col-sm-2 col-xs-12" for="services"><?php echo $this->lang->line('heading_followup_services'); ?> <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12" >

                                <select class="form-control col-md-12 col-xs-12 select2_multiple" id="services" name="services[]" required="" multiple="" >
                                    <option value=""><?php echo $this->lang->line('heading_followup_services'); ?> </option>
                                    <?php foreach ($services as $key => $service) { ?>
                                        <option value="<?php echo encrypt($service['id']); ?>" <?php echo ( !empty($postData['services']) && in_array($service['id'],$postData['services']) ) ? "selected=''" :""; ?>><?php echo $service['name']; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class=" col-md-2 col-sm-2 col-xs-12" for="services"><?php echo $this->lang->line('heading_products'); ?> <span class="required">*</span></label>
                            <div class="col-md-4 col-sm-4 col-xs-12" >

                                <select class="form-control col-md-12 col-xs-12 select2_single" id="products" name="products" >
                                    <option value=""><?php echo $this->lang->line('heading_products'); ?> </option>
                                    <?php foreach ($products as $key => $products) { ?>
                                        <option value="<?php echo encrypt($products['id']); ?>" ><?php echo $products['name']; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12" >
                                <input type="button" class="form-control btn btn-success" value="<?php echo $this->lang->line('heading_add') ?>" name="add_product" id="add_product" />
                            </div>
                        </div>
                        
                        <div class="form-group row" id="order_products">
                        </div>
                        
                        <div class="row border-top pt-2">
                            <div class="col-md-12 text-right mb-2">
                                <button type="button" class="btn btn-success font-weight-bold mr-2" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-lg-discount">Add Discount</button>
                            </div>
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-sm-8 text-right">Sub Total</div>
                                    <div class="col-sm-4 subtotal">0</div>
                                </div>
                                <div class="row discountRow">
                                    <div class="col-sm-8 text-right">Discount</div>
                                    <div class="col-sm-4 discount"></div>
                                </div>
                                <div class="row taxRow d-none">
                                    <div class="col-sm-8 text-right">Tax</div>
                                    <div class="col-sm-4 tax">0</div>
                                </div>
                                <div class="row finalPriceRow">
                                    <div class="col-sm-8 text-right">Final</div>
                                    <div class="col-sm-4 finalprice">0</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                <button type="submit" name="submit" class="btn btn-success"><?php echo $this->lang->line('heading_save'); ?></button>
                            </div>
                        </div>
                        <div class="modal fade bs-example-modal-lg-discount" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"  aria-hidden="true" >
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title mt-0" id="myLargeModalLabel">Discount</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    
                                    <div class="row col-md-12 pt-3" >
                                        <div class="row col-md-12">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Discount Type</label>
                                                    <select name="discount_type" class="form-control form-control-lg form-control-solid"  autocomplete="off">
                                                        <option value="">-Discount Type-</option>
                                                        <option value="1" <?php echo (!empty($orderDetail['discount_type']) && $orderDetail['discount_type']==1) ? "selected=''":"" ?>>Percentage</option>
                                                        <option value="2" <?php echo (!empty($orderDetail['discount_type']) && $orderDetail['discount_type']==2) ? "selected=''":"" ?>>Fixed</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Discount Amount</label>
                                                    <input type="text" name="discount" value="" class="form-control form-control-lg form-control-solid"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-primary px-2 mt-2 float-right mb-0 ml-2 calculateDiscount" data-dismiss="modal" >Submit</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var totalItemsAdded = subTotal = total = discountType = discountAmount = 0;
    $(function () {
        $(":input").not("[type=image],[type=submit]").jqBootstrapValidation();
        
        $(document).on("click","#add_product",function (){
           var productId = $(':input[name="products"]').val();
           if( productId !='' ) {
               json = {"product_id":productId};
               commonAjx('<?php echo base_url('ajax/getProduct') ?>', '', '', '', 'post', json, addProduct) 
           }
        });
    });
    
    function addProduct(response){
        
        var resp = JSON.parse(response);
        var $html = '<div class="br-bg-1 added-values-div subattrsec-1" data-cnt="'+totalItemsAdded+'">'+
                        '<label class="label-control col-md-12 col-sm-12 col-xs-12 pd-0 label-asm" for="last-name"> '+resp.data['name']+' </label>'+
                        '<div class="col-md-1 post-abs">'+
                            '<button type="button" class="btn btn-wicon add-sub-attr-val temp-attr-add-butn-10 btn-success btn-sm"  ><i class="la la-minus-circle"></i> <label class="add_sub_attr">'+resp.data['name']+'</label></button>'+
                            '<input type="hidden" class="sale_price" value="'+resp.data['sale_price']+'" />'+
                        '</div>';
        if(  resp.flag=='<?php echo FLAG_SUCCESS ?>') {
            totalItemsAdded++;
            var services = resp.data['services'];
            var productName = resp.data['name'];
            var productDuration = resp.data['duration'];
            var productId = resp.data['id'];
            
            for($i=0;$i<resp.data['services'].length;$i++) {
                $html+='<div class="form-group row">'+
                            '<div class="col-md-2 col-sm-2 col-xs-12">'+
                                services[$i].name+' <input type="hidden" name="product[]" value="'+resp.data['id']+'" /><input type="hidden" name="product_service[]" value="'+services[$i]['id']+'" />'+
                            '</div>'+
                            '<div class="col-md-3 col-sm-3 col-xs-3">'+
                                '<input type="text" name="product_service_count[]" value="1" class="fonm-control"/>'+
                            '</div>'+
                            '<div class="col-md-2 col-sm-2 col-xs-2 text-align-left">'+
                                '<a href="javascript:;" class="remove_service"><i class="la la-trash"></i></a>'+
                            '</div>'+
                       '</div>';
            }
        }
        $html+='</div>';//added-values-div
        $('#order_products').append($html);
        calculateTotal();
    }
    $(document).on('click','.calculateDiscount',function(){
        calculateTotal();
    })
    
    function calculateTotal(){
        total = subTotal = 0;
        if( $('.sale_price').length> 0 ){
            $('.sale_price').each(function (){
               var itemPrice = $(this).val();
               itemPrice = !isNaN(itemPrice) ? parseFloat(itemPrice) : 0;
               subTotal+=itemPrice;
            })
        }
        total = subTotal;
        if( $(":input[name='discount_type']").val()!='' ) {
            discountType = $(":input[name='discount_type']").val();
            discountAmount = $(":input[name='discount']").val();
            if( discountType==1 ) {
                discountAmount = (subTotal*discountAmount/100)
            }
            if( !isNaN(discountAmount) && discountAmount>0 ) {
                total-=discountAmount;
            }
        }
        showTotal();
    }
    
    function showTotal(){
        $('.subtotal').text(parseFloat(subTotal).toFixed(2));
        $('.discount').text(parseFloat(discountAmount).toFixed(2));
        $('.finalprice').text(parseFloat(total).toFixed(2));
    }
</script>
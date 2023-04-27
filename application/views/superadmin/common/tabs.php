<style>
    .btn.active_hover span{
  max-width:7rem !important;
}
</style>
<?php
$group_id = $this->userData['group_id'];
$view_restaurant = hasPermission($group_id,'restaurants.view','superadmin');
$edit_restaurant = hasPermission($group_id,'restaurants.edit','superadmin');
$view_logs = hasPermission($group_id,'get_logs.view','superadmin');
$is_restaurant = 0;
$business_type = strtolower($business_type);
if($business_type !== 'store'){
    $is_restaurant = 1;
}
$viewSubmitChecklist = 0;
if( $is_restaurant==1  ) {
    $viewSubmitChecklist = hasPermission($group_id,'restaurants.viewSubmitChecklist','superadmin');
}
$group_id = $this->userData['group_id'];
$restaurant_settings_edit = hasPermission($group_id,'restaurant_settings.edit','superadmin');
$restaurant_users = hasPermission($group_id,'users.restaurant_users','superadmin');
if($this->url_translate->uri_segment(3)=="business_document" || $this->url_translate->uri_segment(3)=="business_document_view" || ($this->url_translate->uri_segment(3)== "add" && ($this->url_translate->uri_segment(4)== "store" || $this->url_translate->uri_segment(4)== "restaurants" || $this->url_translate->uri_segment(4)== "restaurant" )) || $this->url_translate->uri_segment(3)=="store_user_edit" || $this->url_translate->uri_segment(3)=="restaurant_user_edit" || $this->url_translate->uri_segment(3)=="food_edit" || $this->url_translate->uri_segment(3)=="restaurant_category_edit" || ($business_type=='store' && $this->url_translate->uri_segment(2)=='food_categories' && $this->url_translate->uri_segment(3)=='edit')){
    $segment = $this->url_translate->uri_segment(5);
    $id = $this->my_encryption->decode($segment);
}else{
    $segment = $this->url_translate->uri_segment(4);
    $id = $this->my_encryption->decode($segment);
}
$restaurant_data = get_db_data('restaurants',$id,'is_active,request_to_publish,name');
$process_data = get_restaurant_status_complete($id,true);
if($view_logs && ($this->url_translate->uri_segment(3)=='edit' ||  $this->url_translate->uri_segment(3)=='viewSubmitChecklist' || $this->url_translate->uri_segment(3)=='food_edit' || $this->url_translate->uri_segment(3)=='restaurant_category_edit')){
    $view_id = $table_Name = $log_segment = "";
    switch ($this->url_translate->uri_segment(3)) {
        case "edit":
        case "viewSubmitChecklist":
            switch ($this->url_translate->uri_segment(2)) {
                case "restaurants":
                    $table_Name = $this->restaurants_model->table_name;
                    $log_segment = $this->url_translate->uri_segment(4);
                    $view_id = $this->my_encryption->decode($log_segment);
                    $record = $this->restaurant_model->get($view_id);
                    $record_Name = stripcslashes($record['name']);
                break;
                case "delivery_details":
                    $table_Name = $this->restaurant_delivery_areas_model->table_name;
                    $log_segment = $this->url_translate->uri_segment(5);
                    $view_id = $this->my_encryption->decode($log_segment);
                    $record = $this->restaurant_delivery_areas_model->get($view_id);
                    $record_Name = stripcslashes($record['name']);    
                break;
            }
        break;
        case "food_edit":
            $table_Name = $this->food_items_model->table_name;
            $log_segment = $this->url_translate->uri_segment(4);
            $view_id = $this->my_encryption->decode($log_segment);
            $record = $this->food_items_model->get($view_id);
            $record_Name = stripcslashes($record['name']);
        break;
        case "restaurant_category_edit":
            $table_Name = $this->food_categories_model->table_name;
            $log_segment = $this->url_translate->uri_segment(4);
            $view_id = $this->my_encryption->decode($log_segment);
            $record = $this->food_categories_model->get($view_id);
            $record_Name = stripcslashes($record['name']);
        break;
    }
?>
<div class="row">
    <div class="col-sm-12">
        <a href="<?php echo superadmin_url().'get_logs/view/'.$this->my_encryption->encode($view_id).'/'.$this->my_encryption->encode($table_Name).'/'.$this->my_encryption->encode($record_Name); ?>" title="View Logs" class="btn btn-sm btn-social btn-min-width mb-1 btn-outline-facebook round pull-right"><i class="la la-history"></i>History</a>    
    </div>
</div>
<?php } ?>
<div class="row mb-1">
    <!-- <div class="col-lg-6 col-md-12">
        <h2><?php // ucfirst(get_db_data('restaurants', $this->my_encryption->decode($this->url_translate->uri_segment(4)),'name')['name'])?></h2>
    </div> -->
    <div class="col-lg-12 col-md-12 width-res">
        <div class="req-block" att-act="<?= $restaurant_data['is_active'];?>" att-req-pub="<?= $restaurant_data['request_to_publish'];?>" att-grp="<?= $this->userData['group_id']?>" att-adm="<?= ADMIN_GROUP_ID?>" att-rid="<?php echo $id; ?>" att-rname="<?php echo  $restaurant_data['name'];?>" >
        <?php
            if(empty($process_data['has_data'])){
                if($restaurant_data['is_active']!=1 && $restaurant_data['request_to_publish']==0 && $this->userData['group_id'] == ADMIN_GROUP_ID){ ?>
                        <button class=" btn btn-success req_to_pub" att-rid="<?php echo $id; ?>" att-rname="<?php echo  $restaurant_data['name'];?>" >Request to publish</button>
                        <?php }
            }
            ?>
        </div>
        <div class="clear-fix"></div>
        <div class="btn-group btn-group-sm  pull-right displ-revrt" role="group" aria-label="Basic example">
            <?php if(!empty($is_restaurant)): ?>
            <a class="btn btn-default" href="#" data-toggle="modal" data-target="#print_qr_code" id="logo_image" style="padding-top: 10px; display: block; ">
                <i class="la la-qrcode"></i> <span>QR Code</span>
            </a>
            <div class="modal fade text-left" id="print_qr_code" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <label class="modal-title white text-text-bold-600" id="myModalLabel33"><?= $this->lang->line('select').' '.$this->lang->line('template') ?></label>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= superadmin_url(). 'restaurant_tables/print_all_qrcode/'; ?><?= ($this->url_translate->uri_segment(3) == 'food_edit') ? $this->url_translate->uri_segment(5) :$this->url_translate->uri_segment(4); ?>" method="POST">
                          <div class="modal-body">
                            <div class="form-group text-center">
                                <input type="radio" id="square-qrCode" name="qrCode_type" value="square" checked>
                                <label for="square-qrCode"><img src="<?= base_url().BASE_IMAGE_PATH.'admin/thumbnail-square.jpg' ?>"></label>
                                <input type="radio" id="vertical-qrCode" name="qrCode_type" value="vertical">
                                <label for="vertical-qrCode">
                                    <img src="<?= base_url().BASE_IMAGE_PATH.'admin/thumbnail-vertical.jpg' ?>">
                                    <span style="display: table;">(8x16) </span>
                                </label>
                                <input type="radio" id="vertical-qrCode-small" name="qrCode_type" value="vertical_small">
                                <label for="vertical-qrCode-small">
                                    <img src="<?= base_url().BASE_IMAGE_PATH.'admin/thumbnail-vertical-small.png' ?>">
                                    <span style="display: table;">(8x14) </span>
                                </label>
                                <input type="radio" id="rectangle-qrCode" name="qrCode_type" value="rectangle">
                                <label for="rectangle-qrCode">
                                    <img src="<?= base_url().BASE_IMAGE_PATH.'admin/thumbnail_qr_code.jpeg' ?>" style="width:50px" >
                                    <span style="display: table;">(85x55) </span>
                                </label>
                                <input type="radio" id="new-vertical-qrCode" name="qrCode_type" value="new_vertical_qrcode">
                                <label for="new-vertical-qrCode">
                                    <img src="<?= base_url().BASE_IMAGE_PATH.'admin/thumbnail-vertical-qr.jpeg' ?>" style="width:50px" >
                                    <span style="display: table;">(55x85) </span>
                                </label>
                                <input type="radio" id="vertical-qrCode-medium" name="qrCode_type" value="vertical_medium">
                                <label for="vertical-qrCode-medium">
                                    <img src="<?= base_url().BASE_IMAGE_PATH.'admin/thumbnail-vertical-small.png' ?>">
                                    <span style="display: table;">(7.3x13.8) </span>
                                </label>
                                <input type="radio" id="black-qr-code" name="qrCode_type" value="black_qr_code">
                                <label for="black-qr-code">
                                    <img src="<?= base_url().BASE_IMAGE_PATH.'admin/black-thumbnail.png' ?>">
                                    <span style="display: table;">(7.3x13.8) </span>
                                </label>
                            </div>
                            <input name="qrCode_for"  id="qrcode_for" value="restaurant" type="hidden" required>
                            <input name="template_layout" type="hidden" id="template_layout" class="custom-select custom-select-sm form-control form-control-sm"value="portrait">
                            <div class="form-group">
                                <label class="form-label"><?= $this->lang->line('template') ?>:</label>
                                <select name="template_type" id="template_type" class="custom-select custom-select-sm form-control form-control-sm" required>
                                    <option value="">Please Select</option>
                                    <option value="a4">A4</option>
                                    <!-- <option value="a5">A5</option> -->
                                    <!-- <option value="thermal">Thermal</option> -->
                                </select>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <input type="reset" class="pull-left btn btn-primary" data-dismiss="modal" value="Close">
                            <input type="submit" class="btn btn-success" value="Print">
                          </div>
                        </form>
                    </div>
                </div>
            </div>
            <a class="btn btn-success <?= ($this->url_translate->uri_segment(2) == 'restaurant_tables' ) ? 'active_hover' : ''; ?>" href="<?php echo superadmin_url() . 'restaurant_tables/index/'.$segment; ?>">
                <i class="la la-group"></i> <span><?php echo $this->lang->line('seating_plan'); ?></span>
            </a>
            <a class="btn btn-default <?= ($this->url_translate->uri_segment(2) == 'restaurant_bookings' ) ? 'active_hover' : ''; ?>" href="<?php echo superadmin_url() . 'restaurant_bookings/add/'.$segment; ?>">
                <i class="la la-table"></i> <span>Book a Table</span>
            </a>
            <a class="btn btn-success <?= (($this->url_translate->uri_segment(2) == 'discounts' && ($this->url_translate->uri_segment(3) == 'add' || $this->url_translate->uri_segment(3) == 'coupon_edit')) || $this->url_translate->uri_segment(3) == 'coupons' ) ? 'active_hover' : ''; ?>" href="<?php echo superadmin_url(). 'discounts/coupons/'.$segment; ?>">
                <i class="la la-tag"></i> <span><?php echo $this->lang->line('discounts') ?></span>
            </a>
            <?php
            endif;
                
            $_settings = strtolower($business_type);     
            if($_settings !== 'store'){
                $_settings = 'restaurant';
            }
            
            ?>
            <a class="btn btn-default <?= ($this->url_translate->uri_segment(3) == 'business_document_view' || $this->url_translate->uri_segment(3) == 'business_document' ) ? 'active_hover' : ''; ?>" href="<?php echo superadmin_url('restaurants/business_document/index/' . $segment);?>">
                <i class="la la-file-text"></i> <span>Documents</span>
            </a>
            <a class="btn btn-default <?= ( $this->url_translate->uri_segment(3) =='viewSubmitChecklist' ) ? 'active_hover' : ''; ?>" href="<?php echo superadmin_url('restaurants/viewSubmitChecklist/' .$segment);?>">
                <i class="la la-file-text"></i> <span>View Submited Check </span>
            </a>
            <a class="btn btn-success <?= ($this->url_translate->uri_segment(2) == $_settings.'_reports' ) ? 'active_hover' : ''; ?>" href="<?php echo superadmin_url($_settings.'_reports/get_reports/' . $segment);?>">
                <i class="la la-file-text"></i> <span>Reports</span>
            </a>
            <?php if($restaurant_settings_edit):
                ?>
                <a class="btn btn-default <?= ($this->url_translate->uri_segment(2) == $_settings.'_settings' ) ? 'active_hover' : ''; ?>" href="<?php echo superadmin_url($_settings.'_settings/edit/' . $segment);?>">
                    <i class="la la-gear"></i> <span>Settings</span>
                </a>
            <?php endif;?>
            <a class="btn btn-success <?= ($this->url_translate->uri_segment(2) == 'orders' ) ? 'active_hover' : ''; ?>" href="<?php echo superadmin_url() . 'orders/detail/' . $segment; ?>">
                <i class="la icon-basket-loaded"></i> <span>Orders</span>
            </a>
            <a class="btn btn-default <?= ($this->url_translate->uri_segment(3) == 'order_daily_tip_detail' ) ? 'active_hover' : ''; ?>" href="<?php echo superadmin_url() . 'orders/orders_tip_details/' . $segment; ?>">
                <i class="la la-money"></i> <span>Orders Tip details</span>
            </a>
            <a class="btn btn-success <?= ($this->url_translate->uri_segment(3) == 'order_daily_tip_detail' ) ? 'active_hover' : ''; ?>" href="<?php echo superadmin_url() . 'orders/order_daily_tip_detail/' . $segment; ?>">
                <i class="la la-file-text"></i> <span>Order Daily Tip Detail</span>
            </a>
            <a class="btn btn-default <?= ($this->url_translate->uri_segment(2) == $_settings.'_taxes' ) ? 'active_hover' : ''; ?>" href="<?php echo superadmin_url() .$_settings.'_taxes/index/'.$segment; ?>">
                <i class="la la-area-chart"></i> <span><?php echo $this->lang->line('tax'); ?></span>
            </a>
            <?php if($restaurant_users){ if($business_type=='store'){$user_for="store_users";}else{$user_for="restaurant_users";} ?>
                <a class="btn btn-success  <?= ($this->url_translate->uri_segment(3) == 'store_user_edit' ||$this->url_translate->uri_segment(3) == 'restaurant_user_edit' || $this->url_translate->uri_segment(3) == 'store_users' || $this->url_translate->uri_segment(3) == 'restaurant_users' || ($this->url_translate->uri_segment(3)=="add" && $this->url_translate->uri_segment(2)=="users")) ? 'active_hover' : ''; ?>" href="<?php echo superadmin_url() . 'users/'.$user_for.'/'.$segment; ?>">
                    <i class="la la-user"></i> <span><?php echo $this->lang->line('users'); ?></span>
                </a>
            <?php } ?>
            <a class="btn btn-default <?= ($this->uri->segment(3) == 'suppliers' ) ? 'active_hover' : ''; ?>" href="<?php echo superadmin_url() . 'suppliers/index/'.$segment; ?>">
                <i class="la la-user"></i> <span>Suppliers</span>
            <a class="btn btn-success <?= ($this->uri->segment(2) == 'purchases' ) ? 'active_hover' : ''; ?>" href="<?php echo superadmin_url() . 'purchases/index/' . $segment; ?>">
                <i class="la icon-basket-loaded"></i> <span>Purchases</span>
            </a>
        </div>
    </div>
</div>
<div class="progress_update">
    <?php echo $process_data['html'];
    ?>
</div>
<ul class="nav nav-tabs full_width_tab">
    <li class="nav-item">
        <a class="nav-link <?=isActive('restaurants.edit').isActive('restaurants.view')?>" href="<?=superadmin_url()?><?=$business_type?>/<?php if($edit_restaurant){ echo 'edit'; }else if($view_restaurant){ echo 'view'; }?>/<?=$segment?>" aria-expanded="true">Basic</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?=isActive('restaurants.resturanttimings')?>" href="<?=superadmin_url()?><?=$business_type?>/resturanttimings/<?=$segment?>" aria-expanded="true">Timing</a>
    </li>
    <li class="nav-item">
        <?php
        if($is_restaurant){
            $food_items_action = 'restaurantsfoods';
            $food_items_text = 'Food items';
        }else{
            $food_items_action = 'items';
            $food_items_text = 'Store Items';
        }
        ?>
        <a class="nav-link <?=isActive('food_items.food_edit').isActive('restaurants.restaurantsfoods')?>" href="<?=superadmin_url()?><?=$business_type?>/<?=$food_items_action?>/<?=$segment?>" aria-expanded="true"><?=$food_items_text?></a>
    </li>
    <?php if(!empty($is_restaurant)): ?>
    <li class="nav-item">
        <a class="nav-link <?=isActive('restaurants.restaurantsMenu')?>" href="<?=superadmin_url()?>restaurants/restaurantsMenu/<?=$segment?>" aria-expanded="true">Menu</a>
    </li>
    <?php endif; ?>
    <li class="nav-item">
        <?php
        if($is_restaurant){
            $food_category_action = 'food_categories/restaurant_category';
            $food_category_text = 'Food Categories';
        }else{
            $food_category_action = 'store/category';
            $food_category_text = 'Store categories';
        }
        ?>
        <a class="nav-link <?=isActive('food_categories.index').isActive('food_categories.restaurant_category').isActive('food_categories.restaurant_category_edit')?>" href="<?=superadmin_url()?><?=$food_category_action?>/<?=$segment?>" aria-expanded="true"><?=$food_category_text?></a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?=isActive('restaurants.deliverylist').isActive('delivery_details.edit')?>" href="<?=superadmin_url()?><?=$business_type?>/deliverylist/<?=$segment?>" aria-expanded="true">Delivery Area</a>
    </li>
    <li class="nav-item">
        <?php
        if($is_restaurant){
            $restaurant_gallary = 'resturantgallery';
        }else{
            $restaurant_gallary = 'gallery';
        }
        ?>
        <a class="nav-link <?=isActive('restaurants.resturantgallery')?>" href="<?=superadmin_url()?><?=$business_type?>/<?=$restaurant_gallary?>/<?=$segment?>" aria-expanded="true">Gallery</a>
    </li>
</ul>
<div class="mt-2"></div>
<style>
.add_highlights .la{
    vertical-align: sub;
}
.full_width_tab .nav-item {
    width: 14.28%;
    font-size: 12px;
}
</style>
<?php
$restaurant_id = $this->my_encryption->decode($restaurant_id);
?>
            <ul class="col-sm-5 mt-3 nav nav-tabs nav-justified" style="max-width:100%;">
                    
                    <!-- <li role="presentation" class="nav-item" style="padding-left: 15px;">
                        <a class="nav-link <?=isActive('restaurant_delivery.index');?>"  aria-controls="tabIcon3" href="<?php echo superadmin_url() . 'restaurant_delivery/index/?id=' . $_GET['id'] ?>">
                        Delivery
                        </a>
                    </li> -->

                    <li role="presentation" class="nav-item" style="padding-left: 15px;">
                        <a class="nav-link <?=isActive('restaurant_delivery_areas.index');?>" aria-controls="tabIcon3" href="<?php echo superadmin_url() . 'restaurant_delivery_areas/index/' . $this->my_encryption->encode($restaurant_id) ?>">
                            <?php echo $this->lang->line('delivery_areas'); ?>
                        </a>
                    </li>

                    <li role="presentation" class="nav-item">
                        <a class="nav-link <?=isActive('restaurant_delivery_timings.index');?> " aria-controls="tabIcon3" href="<?php echo superadmin_url() . 'restaurant_delivery_timings/index/' . $this->my_encryption->encode($restaurant_id) ?>">
                            <?php echo $this->lang->line('delivery_timings'); ?>
                        </a>
                    </li>

            </ul><br/><br/>
            <?php
                if(empty($restaurant_id) && $restaurant_id==null){
                    $restaurant_id = $this->url_translate->uri_segment(4);
                }
                $tabber_restaurant_id = $this->my_encryption->decode($restaurant_id);
            ?>
            <?php // restaurant close open script ?>
            <div class="form-group">
                <div class="col-md-12 col-sm-9 col-xs-12 text-right viewres_opnclose" att-rid="<?php echo $tabber_restaurant_id; ?>">
                </div>
            </div>
            <?php // restaurant close open script end ?>
 
            <ul class="nav nav-tabs nav-linetriangle no-hover-bg nav-justified">
                    <li role="presentation" class="nav-item">
                        <a href="<?php echo superadmin_url() . 'restaurants/edit/' . $this->my_encryption->encode($tabber_restaurant_id) ?>" aria-controls="tabIcon3" class="nav-link <?=isActive('restaurants.edit');?>" >
                        <?php echo $this->lang->line('restaurant_detail'); ?>
                        </a>
                    </li>
                    <li role="presentation" class="nav-item">
                        <a class="nav-link <?=isActive('restaurants.create_user');?>" aria-controls="tabIcon3" href="<?php echo superadmin_url() . 'restaurants/create_user/' . $this->my_encryption->encode($tabber_restaurant_id) ?>">
                            <?php echo $this->lang->line('user_details'); ?>
                        </a>
                    </li>
                    <li role="presentation" class="nav-item">
                        <a class="nav-link <?=isActive('restaurant_features.index');?>" aria-controls="tabIcon3" href="<?php echo superadmin_url() . 'restaurant_features/index/' . $this->my_encryption->encode($tabber_restaurant_id) ?>">
                            Features
                        </a>
                    </li>
                    <li role="presentation" class="nav-item">
                        <a class="nav-link <?=isActive('restaurant_timings.index');?>" aria-controls="tabIcon3" href="<?php echo superadmin_url() . 'restaurant_timings/index/' . $this->my_encryption->encode($tabber_restaurant_id) ?>">
                            <?php echo $this->lang->line('restaurant_timings'); ?>
                        </a>
                    </li>
                    <li role="presentation" class="nav-item">
                        <a class="nav-link <?=isActive('restaurant_takeaway_timings.index');?>" aria-controls="tabIcon3" href="<?php echo superadmin_url() . 'restaurant_takeaway_timings/index/' . $this->my_encryption->encode($tabber_restaurant_id) ?>">
                            Takeaway
                        </a>
                    </li>
                    <li role="presentation" class="nav-item">
                        <a class="nav-link <?=isActive('restaurant_images.index');?>" aria-controls="tabIcon3" href="<?php echo superadmin_url() . 'restaurant_images/index/' . $this->my_encryption->encode($tabber_restaurant_id) ?>">
                            <?php echo $this->lang->line('gallery'); ?>
                        </a>
                    </li>
                    <li role="presentation" class="nav-item">
                        <a class="nav-link  <?=isActive('restaurant_food_items.import_food');?> <?=isActive('restaurant_food_items.edit');?>  <?=isActive('restaurant_food_items.index');?>" aria-controls="tabIcon3" href="<?php echo superadmin_url() . 'restaurant_food_items/index/' . $this->my_encryption->encode($tabber_restaurant_id) ?>">
                            <?php echo $this->lang->line('food_menu'); ?>
                        </a>
                    </li>
                    <li role="presentation" class="nav-item">
                        <a class="nav-link <?=isActive('restaurant_delivery_areas.index');?> <?=isActive('restaurant_delivery_timings.index');?>" aria-controls="tabIcon3" href="<?php echo superadmin_url() . 'restaurant_delivery_areas/index/' . $this->my_encryption->encode($tabber_restaurant_id) ?>">
                            <?php echo $this->lang->line('delivery_details'); ?>
                        </a>
                    </li>
                    <li role="presentation" class="nav-item">
                        <a class="nav-link <?=isActive('restaurant_discounts.index');?>" aria-controls="tabIcon3" href="<?php echo superadmin_url() . 'restaurant_discounts/index/' . $this->my_encryption->encode($tabber_restaurant_id) ?>">
                            <?php echo $this->lang->line('discounts'); ?>
                        </a>
                    </li>
                    <li role="presentation" class="nav-item">
                        <a class="nav-link <?=isActive('restaurant_seating_plan.index');?>" aria-controls="tabIcon3" href="<?php echo superadmin_url() . 'restaurant_seating_plan/index/' . $this->my_encryption->encode($tabber_restaurant_id) ?>">
                            <?php echo $this->lang->line('seating_plan'); ?>
                        </a>
                    </li>
                </ul>
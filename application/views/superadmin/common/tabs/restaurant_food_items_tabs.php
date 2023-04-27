<ul class="col-sm-5 mt-3 nav nav-tabs nav-justified" style="max-width:100%;margin-bottom:30px;">
    <li role="presentation" class="nav-item" style="padding-left: 15px;">
        <a class="nav-link <?=isActive('restaurant_food_items.index').isActive('restaurant_food_items.edit');?>" href="<?php echo superadmin_url() . 'restaurant_food_items/index/' . $this->my_encryption->encode($restaurant_id) ?>">Add/Edit Food Item</a>
    </li>
    <li role="presentation" class="nav-item" style="padding-left: 15px;">
        <a class="nav-link <?=isActive('restaurant_food_items.import_food');?>" href="<?php echo superadmin_url() . 'restaurant_food_items/import_food/' . $this->my_encryption->encode($restaurant_id) ?>">Import Food Items</a>
    </li>
</ul>
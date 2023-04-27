<?php $group_id = $this->userData['group_id'];?>
<!-- sidebar menu -->
<div class="main-menu menu-dark menu-accordion menu-shadow  menu-fixed" data-scroll-to-active="true" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <?php if (hasPermission($group_id, 'dashboard.index', SUPERADMIN)){ ?>
                <li class=" nav-item <?= isActive('dashboard.index') ?>">
                    <a href="<?php echo superadmin_url("dashboard"); ?>"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main"><?php echo $this->lang->line('heading_dashboard'); ?> </span></a>
                </li>
            <?php
            }

            $followUpList = hasPermission($this->userData['group_id'], 'followup.index',SUPERADMIN);
            $followUpAdd = hasPermission($this->userData['group_id'], 'followup.add',SUPERADMIN);
            if ( $followUpList || $followUpAdd ){
            ?>
                <li class="nav-item">
                    <a><i class="la la-glass"></i><span class="menu-title" data-i18n="nav.dash.main"><?php echo $this->lang->line('heading_followup'); ?></span>
                    </a>
                    <ul class="nav child_menu">
                        <?php                       
                        if ($followUpList) {
                        ?>
                        <li class=" nav-item <?php echo isActiveMod('followup.index').isActiveMod('followup.edit'); ?>">
                            <a href="<?php echo superadmin_url("followup/index"); ?>">
                                <?php echo $this->lang->line('heading_followup') ?>
                            </a>
                        </li>
                    <?php }if($followUpAdd) {?>
                        <li class=" nav-item <?php echo isActiveMod('followup.add'); ?>">
                            <a href="<?php echo superadmin_url("followup/add"); ?>">
                                <?php echo $this->lang->line('heading_followup_add') ?>
                            </a>
                        </li>
                    <?php } ?>
                    </ul>
                </li>
            <?php
            }

            $productList = hasPermission($this->userData['group_id'], 'products.index',SUPERADMIN);
            $productAdd = hasPermission($this->userData['group_id'], 'products.add',SUPERADMIN);
            if ( $productList || $productAdd ){
            ?>
                <li class="nav-item">
                    <a><i class="la la-list"></i><span class="menu-title" data-i18n="nav.dash.main"><?php echo $this->lang->line('heading_products'); ?></span>
                    </a>
                    <ul class="nav child_menu">
                        <?php  if ($productList){ ?>
                        <li class="nav-item <?php echo isActiveMod('products.index').isActiveMod('products.edit'); ?>">
                            <a href="<?php echo superadmin_url("products/index"); ?>">
                                <?php echo $this->lang->line('heading_products') ?>
                            </a>
                        </li>
                    <?php }if($productAdd) {?>
                        <li class=" nav-item <?php echo isActiveMod('products.add'); ?>">
                            <a href="<?php echo superadmin_url("products/add"); ?>">
                                <?php echo $this->lang->line('heading_product_add') ?>
                            </a>
                        </li>
                    <?php } ?>
                    </ul>

                    
                </li>
            <?php
            }


            $employeeList = hasPermission($this->userData['group_id'], 'employee.index',SUPERADMIN);
            $employeeAdd = hasPermission($this->userData['group_id'], 'employee.add',SUPERADMIN);
            if ( $employeeList || $employeeAdd ){
            ?>
                <li class="nav-item">
                    <a><i class="la la-user"></i><span class="menu-title" data-i18n="nav.dash.main"><?php echo $this->lang->line('heading_employee'); ?></span>
                    </a>
                    <ul class="nav child_menu">
                        <?php  if ($employeeList){ ?>
                        <li class="nav-item <?php echo isActiveMod('employee.index').isActiveMod('employee.edit'); ?>">
                            <a href="<?php echo superadmin_url("employee/index"); ?>">
                                <?php echo $this->lang->line('heading_employee') ?>
                            </a>
                        </li>
                    <?php }if($employeeAdd) {?>
                        <li class=" nav-item <?php echo isActiveMod('employee.add'); ?>">
                            <a href="<?php echo superadmin_url("employee/add"); ?>">
                                <?php echo $this->lang->line('heading_employee_add') ?>
                            </a>
                        </li>
                    <?php } ?>
                    </ul>

                    
                </li>
            <?php
            }
        ?>
        </ul>
    </div>
</div>
<!-- /sidebar menu -->
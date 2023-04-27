<nav class="header-navbar mynav-mobile navbar-expand-lg navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto">
                    <a class="res-icon nav-link nav-menu-main menu-toggle hidden-xs" href="#">
                        <i class="ft-menu font-large-1"></i>
                    </a>
                </li>
                <li class="nav-item d-md-none"><a class="nav-link open-navbar-container my-nav-link" data-toggle="collapse" data-target="#navbar-mobile">
                        <i class="la la-ellipsis-v"></i></a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo superadmin_url("dashboard"); ?>" class="navbar-brand">
                        <img class="brand-logo full_menu" alt="modern admin logo" src="<?= base_url('assets/backend/app-assets/images/logo.png') ?>">
                        <img class="brand-logo collapsed_menu" alt="modern admin logo" src="<?= base_url('assets/backend/app-assets/images/logo.png') ?>">
                    </a>
                </li>
                <?php if (!empty($this->userData['id'])) { ?>
                    <li class="nav-item d-none d-lg-block nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon font-medium-3 ft-toggle-right" data-ticon="ft-toggle-right"></i></a></li>
                    <li class="nav-item d-none d-lg-block nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon font-medium-3 ft-toggle-right" data-ticon="ft-toggle-right"></i></a></li>
                <?php } ?>
            </ul>
        </div>

        <div class="navbar-container content sec-nav-container">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">  
                    <li>
                        <h3 style="line-height: 1.8;"><?php echo $title_for_layout; ?></h3>
                    </li>
                </ul>
                <div class="form-group">
                    <?php if (isset($rest_all_data) && !empty($rest_all_data)): ?>
                        <select class="form-control" id="select_restaurant_id">
                            <?php
                            foreach ($rest_all_data as $all_data) {
                                $selected = '';
                                if ($all_data['pid'] == $current_rest_id) {
                                    $selected = 'selected="selected"';
                                }
                                ?>
                                <option value="<?php echo $all_data['id']; ?>" <?php echo $selected; ?>><?php echo $all_data['name']; ?></option>
                            <?php } ?>
                        </select>
                    <?php endif; ?>
                </div>
                <ul class="nav navbar-nav float-right">
                    <?php if (!empty($this->userData['id'])) { ?>
                        <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-bell"></i><span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow notificationCount"><?php echo ($this->notification['unread'] > 0) ? $this->notification['unread'] : ""; ?></span></a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right pb-0 notificationDropdown">
                                <li class="dropdown-menu-header">
                                    <h6 class="dropdown-header m-0"><span class="grey darken-2">Notifications</span></h6><span class="notification-tag badge badge-default badge-danger float-right m-0"><?php echo $this->notification['unread']; ?> New</span>
                                </li>
                                <li id="scrollable-container" class="scrollable-container media-list w-100 show_notification">
                                    <div class="notificationLoader"  id="notificationLoader"></div>
                                    <?php
                                    if (isset($this->notification['data'])) {
                                        foreach ($this->notification['data'] as $key => $value) {
                                            echo notificationHtml($value['main_type'], $value['notification_type'], $value['t_id'], $value);
                                        }
                                        ?>
                                    <?php } else { ?>
                                        <div class="media">
                                            <div class="media-left align-self-center"></div>
                                            <div class="media-body">
                                                <p class="notification-text font-small-3 text-muted text-center"><?php echo $this->notification['message']; ?></p>
                                            </div>
                                        </div>
                                    <?php } ?>

                                </li>
                                <li class="dropdown-menu-header">
                                    <h6 class="dropdown-header m-0"><span class="grey darken-2 readAllNotifications"><a href="javascript:;" class="readAllNotifications">Mark all notifications read.</a></span><span class="grey darken-2 pull-right"><a href="<?= superadmin_url('dashboard/notifications'); ?>">View all</a></h6>
                                    </h6>
                                </li>
                            </ul>

                        </li>

                        <li class="dropdown dropdown-language nav-item">
                            <a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">  
                                <i class="flag-icon flag-icon-<?= StaticArrays::$language_code[$this->userData['lang_id']] ?>"></i><span class="selected-language"></span>
                            </a>
                            <div class="dropdown-menu flag-list" aria-labelledby="dropdown-flag">
                                <?php foreach (StaticArrays::$language as $key => $flag) { ?>
                                    <a class="dropdown-item <?= ($this->userData['lang_id'] == $key) ? "bg-light" : ""; ?> " href="<?= superadmin_url(); ?>dashboard/set_lang/<?= $key ?>">
                                        <i class="flag-icon flag-icon-<?= StaticArrays::$language_code[$key] ?>"></i> 
                                        <?= $flag ?>
                                    </a>
                                <?php } ?>
                            </div>
                        </li>

                        <li class="dropdown dropdown-user nav-item"><a style="padding: 0.2rem 1rem;" class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><span class="mr-1">Hello,<span class="user-name text-bold-700"><?= ucfirst($this->userData['name']) . ' ' . $this->global_data['current_user_data']['last_name']; ?></span></span><span class="avatar avatar-online">
                                    <?php if (!empty($this->userData['image'])) { ?>
                                        <img src="<?php echo base_url(USERS_IMG_PATH . $this->userData['image']); ?>" alt="avatar">
                                    <?php } ?>
                                    <i></i></span></a>
                            <span class="user-nm">(<?php echo $this->userData['username']; ?>)</span>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown"><a class="dropdown-item" href="<?php echo superadmin_url() . 'users/change_password'; ?>"><i class="ft-user"></i> Change Password</a><!--a class="dropdown-item" href="#"><i class="ft-mail"></i> My Inbox</a-->
                                <?php if (hasPermission($this->userData['group_id'], 'users.edit', 'superadmin')) { ?>
                                    <a class="dropdown-item" href="<?php echo superadmin_url() . 'users/edit/' . $this->my_encryption->encode($this->userData['id']); ?>"><i class="ft-edit"></i> Edit Profile</a>
                                <?php } ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item logout-btn-fullwidth logOutBtn" href="<?php echo superadmin_url() . 'users/logout'; ?>"><i class="ft-power"></i> Logout</a> 
                            </div>
                        </li>


                        <li class="logout-btn">

                            <a class="dropdown-item" href="<?php echo superadmin_url() . 'users/logout'; ?>">
                                <i class="ft-power"></i> Logout</a>


                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</nav>
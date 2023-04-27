


<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
    <head>
        <link rel="icon" href="<?php echo base_url() . 'assets/images/favicon.png'?>" type="favicon.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title_for_layout; ?></title>

        <?php $this->load->view("superadmin/common/head.php"); ?>
        <!-- jQuery -->
        
        <link href="<?php echo base_url("assets/libs/clockpicker/jquery-clockpicker.min.css"); ?>" rel="stylesheet">
        <script type="text/javascript">
            var SITE_URL = "<?php echo base_url(); ?>";
        </script>
        
        <meta name="robots" content="noindex">
    </head>

    <body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
        <?php $this->load->view("superadmin/common/top_menu.php"); ?>
        <?php $this->load->view("superadmin/common/sidebar.php"); ?>
        <div class="app-content content">
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                
                <div class="content-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <img src="<?php echo base_url() . 'assets/images/frontend/404.png'; ?>"class="center-block"/>
                                <div class="error_flash_message">
                                    <i class="fa fa-remove"></i>
                                    <?php echo $error_message; ?>
                                </div>
                            <div class="button">
                                
                            </div>
                        </div>
                    </div>
                    <style>
                        .error_flash_message {
                            text-align: center; 
                            font-size: 15px;
                            font-weight: bold;
                            padding-top: 20px;
                        }
                    </style>
                    <!-- /page content -->
                    
                </div>
            </div>
        </div>
        <!-- footer content -->
        <?php $this->load->view("superadmin/common/footer.php"); ?>
        <!-- /footer content -->
        <?php $this->load->view("superadmin/common/bottom.php"); ?>
    </body>
</html>
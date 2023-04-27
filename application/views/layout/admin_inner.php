<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title_for_layout; ?></title>

        <?php $this->load->view("admin/common/head.php"); ?>
        <!-- jQuery -->
        <script src="<?php echo base_url("assets/js/jquery.min.js"); ?>"></script>
        <script type="text/javascript">
            var SITE_URL = "<?php echo base_url(); ?>";
        </script>
        
        <script src="<?php echo base_url('assets/js/frontend/bootstrap.min.js'); ?>" ></script>
        <script src="<?php echo base_url('assets/js/frontend/script.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/frontend/custom.js'); ?>"></script>
        <script src="<?php echo base_url("assets/js/1.10.3_jquery_ui.js"); ?>"></script>
        <script src="<?php echo base_url("assets/libs/clockpicker/jquery-clockpicker.min.js"); ?>"></script>
        <link href="<?php echo base_url("assets/libs/clockpicker/jquery-clockpicker.min.css"); ?>" rel="stylesheet">
        
        <meta name="robots" content="noindex">
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <?php $this->load->view("admin/common/sidebar.php"); ?>
                    </div>
                </div>

                <!-- top navigation -->
                <?php $this->load->view("admin/common/top_menu.php"); ?>
                <!-- /top navigation -->

                <!-- page content -->
                <?php echo $content_for_layout; ?> 
                <!-- /page content -->

                <!-- footer content -->
                <?php $this->load->view("admin/common/footer.php"); ?>
                <!-- /footer content -->
            </div>
        </div>
        <?php $this->load->view("admin/common/bottom.php"); ?>
    </body>
</html>
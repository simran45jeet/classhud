<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title> <?php echo (isset($meta_title) && !empty($meta_title)) ? $meta_title : 'YTheWait Restaurant'; ?> </title>
        <meta name="keywords" content="<?php echo (isset($meta_keywords) && !empty($meta_keywords)) ? $meta_keywords : 'YTheWait Restaurant'; ?>" />
        <meta name="description" content="<?php echo (isset($meta_description) && !empty($meta_description)) ? $meta_description : 'YTheWait Restaurant'; ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/frontend/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/frontend/style.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/frontend/custom.css'); ?>">
    </head>
    <body>
        <!-- page content -->
        <?php echo $content_for_layout; ?> 
        <!-- /page content -->
    </body>
</html>
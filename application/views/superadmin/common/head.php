<!--<script src="<?= base_url('assets/backend/app-assets/js/core/libraries/jquery_ui/jquery-ui.min.js') ?>"></script>-->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">
<!-- BEGIN VENDOR CSS-->
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/app-assets/css/vendors.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/libs/fancybox/jquery.fancybox.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/app-assets/vendors/css/forms/icheck/icheck.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/app-assets/vendors/css/forms/selects/select2.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/app-assets/vendors/css/extensions/datedropper.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/app-assets/vendors/css/extensions/timedropper.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/app-assets/vendors/css/weather-icons/climacons.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/app-assets/vendors/css/charts/morris.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/app-assets/vendors/css/charts/chartist.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/app-assets/vendors/css/charts/chartist-plugin-tooltip.css')?>">
<!-- END VENDOR CSS-->
<!-- BEGIN MODERN CSS-->
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/app-assets/css/app.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/app-assets/fonts/meteocons/style.css')?>">
<!-- END MODERN CSS-->
<!-- BEGIN Page Level CSS-->
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/app-assets/css/core/menu/menu-types/vertical-menu-modern.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/app-assets/css/core/colors/palette-gradient.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/app-assets/fonts/simple-line-icons/style.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/app-assets/css/core/colors/palette-gradient.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/app-assets/css/pages/timeline.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/app-assets/css/pages/dashboard-ecommerce.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/jquery-ui.min.css')?>">
<!-- END Page Level CSS-->
<!-- BEGIN Custom CSS-->
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/assets/css/style.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/app-assets/css/components.min.css')?>">
<!-- END Custom CSS-->
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css')?>">
<link rel="stylesheet" href="<?=base_url('assets/backend/app-assets/vendors/css/pickers/timepicker/jquery.timepicker.min.css')?>">

<!--Timer css-->
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/assets/css-timer/jquery-ui-1.10.0.custom.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/assets/css-timer/jquery.ui.timepicker.css')?>">
<!--Timer css ends-->
<?php $this->load->helper('form'); ?>
<script type="text/javascript">
var SITE_URL = base_url = "<?=base_url()?>";
var superadmin_url = "<?php echo superadmin_url(); ?>"; 
/*google_api_key = "<?php //echo BROWSER_GOOGLE_API_KEY ?>";*/

</script>
<script src="<?=base_url('assets/backend/app-assets/vendors/js/vendors.min.js')?>"></script>
<script src="<?= base_url('assets/backend/app-assets/js/core/libraries/jquery_ui/jquery-ui.min.js') ?>"></script>
 <script src="<?=base_url('assets/backend/app-assets/vendors/js/pickers/timepicker/jquery.timepicker.min.js')?>"></script> 
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css"/>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
<!--script for timer-->
<script src="<?=base_url('assets/backend/assets/js-timer/jquery.ui.position.min.js')?>"></script>
<script src="<?=base_url('assets/backend/assets/js-timer/jquery.ui.timepicker.js')?>"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/app-assets/vendors/css/extensions/toastr.css'); ?>">

<!--script for timer ends-->
<style>
.flash_message 
{
    margin-left: 10px;
    padding: 10px;
    background: #fff;
    margin-bottom: 10px;
    color: #4F8A10;
    background-color: #DFF2BF;
    font-size: 15px;
    margin-right: 10px;
}
.error_flash_message 
{
    margin-left: 10px;
    padding: 10px;
    background: #fff;
    margin-bottom: 10px;
    color: #D8000C;
    background-color: #FFBABA;
    font-size: 15px;
    margin-right: 10px;
}
</style>
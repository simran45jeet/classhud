<!-- BEGIN VENDOR JS-->
<!-- <script src="<?= base_url('assets/backend/app-assets/vendors/js/vendors.min.js') ?>"></script> -->
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->

<script src="<?= base_url('assets/backend/app-assets/vendors/js/forms/select/select2.full.min.js') ?>"></script>
<script src="<?= base_url('assets/backend/app-assets/vendors/js/charts/chart.min.js') ?>"></script>

<!-- END PAGE VENDOR JS-->
<!-- BEGIN MODERN JS-->
<script src="<?= base_url('assets/backend/app-assets/js/core/app-menu.js') ?>"></script>
<script src="<?= base_url('assets/backend/app-assets/js/core/app.js') ?>"></script>
<!-- END MODERN JS-->
<script src="<?= base_url('assets/backend/app-assets/js/scripts/forms/select/form-select2.js') ?>"></script>
<script src="<?= base_url('assets/backend/app-assets/vendors/js/extensions/datedropper.min.js') ?>"></script>

<!-- BEGIN PAGE LEVEL JS-->
<script src="<?= base_url('assets/backend/app-assets/js/scripts/pages/dashboard-ecommerce.js') ?>"></script>
<!-- END PAGE LEVEL JS-->
<script src="<?= base_url('assets/backend/app-assets/vendors/js/tables/datatable/datatables.min.js') ?>"></script>
<script src="<?= base_url('assets/backend/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('assets/backend/app-assets/js/scripts/tables/datatables/datatable-advanced.js') ?>"></script>

<script src="<?php echo base_url('assets/js/frontend/script.js'); ?>"></script>
<script src="<?php echo base_url('assets/backend/app-assets/vendors/js/forms/toggle/bootstrap-switch.js'); ?>"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/app-assets/css/bootstrap-datepicker.min.css">
<script src="<?= base_url() ?>assets/backend/app-assets/js/core/libraries/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
var deleteTarget="";
jQuery(document).ready(function () {
    jQuery(document).on('click',".toggle-password",function () {
        jQuery(this).toggleClass("la-eye la-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
    
    if( $('#date').length>0 ) {
        $('#date').datepicker({
            format:"yyyy-mm-dd"
        }).on('keydown',function(e){
            e.preventDefault();
        });
    }
    if( $('.date').length>0 ) {
        $('.date').datepicker({
            format:"yyyy-mm-dd"
        }).on('keydown',function(e){
            e.preventDefault();
        });
    }
  
    $('#delete_confirmation').on('show.bs.modal', function(e) {
        
        deleteTarget = e;
        $(this).find('#delete_url').attr('href', $(e.relatedTarget).data('href'));
        $(this).find('#confirm_delete').text($(e.relatedTarget).data('title'));
        $(this).find('#confirm_delete_mess').text($(e.relatedTarget).data('delete'));
    });
    //localStorage.removeItem('fcm_token');
    if( $('.switch').length>0 ) {
        $('.switch').bootstrapSwitch({
            onText  : "<?php echo $this->lang->line('heading_enable') ?>",
            offText : "<?php echo $this->lang->line('heading_disable') ?>",
            onColor : 'success',
            offColor : 'danger',
        });
    }
});
</script>
<?php
if (!empty($this->scripts) && count($this->scripts)) {
    foreach ($this->scripts as $script) {?>
        <script src="<?php echo $script ?>"></script>
<?php
    }
}
?>
<div class="ajax-loader loader">
    <img src="<?php echo base_url() ?>assets/images/backend/loader.gif"  class="img-responsive">
</div>
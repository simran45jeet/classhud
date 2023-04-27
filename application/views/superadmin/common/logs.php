<?php if( isset($total_logs) && $total_logs > 0) {  ?>
    <script type="text/javascript"> var total_logs = parseInt('<?php echo $total_logs ?>');</script>
<?php } 
if ( !empty($logs) ) { 
    foreach($logs as $log) {
?>   
<div class="border border-light rounded mb-1 logs">
    <p class="m-0"><?php echo $log['text']; ?> at <?php echo date( VIEW_DATETIME_FORMAT,strtotime( $log['created_at']) ); ?></p>
    <table class="table pt-0 mt-1  hidden">
        <tr>
            <td class="col-md-3 border-right"><span class="text-light"><?php echo $this->lang->line('update_by'); ?> : </span> <?php echo $log['full_name'] ?></td>
            <td class="col-md-9"><img src="<?php echo base_url('assets/images/frontend/clock.png') ?>" width="12" /> <?php echo date( VIEW_DATETIME_FORMAT,strtotime( $log['created_at']) ); ?></td>
        </tr>
    </table>
</div>
<script type="text/javascript">
    if( total_logs<=$('.logs_data .logs').length ) {
        $('.load_more_logs').addClass('hidden');
    }
</script>
<?php 
    }
} else{ ?>
    <div class="border border-light rounded mb-2 no-record-found">
        <p><?php echo $this->lang->line('no_records') ?></p>
    </div>
<?php } ?>
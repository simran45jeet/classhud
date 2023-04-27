<div class="row">
    <div class="col-md-12">
        <img src="<?php echo base_url() . 'assets/images/frontend/404.png'; ?>"class="center-block"/>
            <div class="error_flash_message">
                <i class="fa fa-remove"></i>
                <?php echo $error_message; ?>
                <br/><br/>
                <a href="<?php echo superadmin_url();?>" class="btn btn-info">Please Login</a>
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
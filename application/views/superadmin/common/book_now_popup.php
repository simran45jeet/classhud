<div class="right_col col-md-12" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3><?php echo $this->lang->line('book_table'); ?></h3>
        </div>
        <a href="javascript:void(0);" class="close">&times;</a>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <br />
                    <?php 
                        echo form_open(SUPERADMIN."/restaurants/book_now_post/", array("class" => "form-horizontal book_now_form"));
                    ?>
                    <div class="form-group row">
                        <label class="label-control col-md-4 col-sm-3 col-xs-12" for="first-name"><?php echo $this->lang->line('booking_date'); ?> <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                            <?php
                                $data = array(
                                    'type' => 'text',
                                    'name' => 'booking_date',
                                    'class' => 'form-control col-md-12 col-xs-12 datepicker',
                                    'value' => '',
                                );
                                echo form_input($data);
                                echo form_hidden('restaurant_id', $restaurant_id);
                                echo form_hidden('table_id', $table_id);
                            ?>
                            <span class="text-danger"><?php echo form_error('booking_date'); ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="label-control col-md-4 col-sm-3 col-xs-12" for="first-name"><?php echo $this->lang->line('booking_time'); ?> <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                            <?php
                                $data = array(
                                    'type' => 'text',
                                    'name' => 'booking_time',
                                    'class' => 'form-control col-md-12 col-xs-12 clockpicker',
                                    'value' => '',
                                );
                                echo form_input($data);
                            ?>
                            <span class="text-danger"><?php echo form_error('booking_time'); ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="label-control col-md-4 col-sm-3 col-xs-12" for="last-name"><?php echo $this->lang->line('party'); ?> <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                            <?php
                                $js = array(
                                    'class' => 'select2_single form-control',
                                    'tabindex' => '-1',
                                );

                                for($i = 1; $i <= 20; $i++)
                                {
                                    $party_list[$i] = $i; 
                                }
                                echo form_dropdown('no_of_tables', $party_list, '', $js); 
                            ?>
                            <span class="text-danger"><?php echo form_error('no_of_tables'); ?></span>
                        </div>
                    </div>
                    
                    <span class="section">Contact Details</span>
                    <div class="form-group row">
                        <label class="label-control col-md-4 col-sm-3 col-xs-12" for="first-name"><?php echo $this->lang->line('name'); ?> <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                            <?php
                                $data = array(
                                    'type' => 'text',
                                    'name' => 'contact_name',
                                    'class' => 'form-control col-md-12 col-xs-12',
                                    'value' => ''
                                );
                                echo form_input($data);
                            ?>
                            <span class="text-danger"><?php echo form_error('contact_name'); ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="label-control col-md-4 col-sm-3 col-xs-12" for="first-name"><?php echo $this->lang->line('email'); ?> <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                            <?php
                                $data = array(
                                    'type' => 'text',
                                    'name' => 'contact_email',
                                    'class' => 'form-control col-md-12 col-xs-12',
                                    'value' => '',
                                );
                                echo form_input($data);
                            ?>
                            <span class="text-danger"><?php echo form_error('contact_email'); ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="label-control col-md-4 col-sm-3 col-xs-12" for="first-name"><?php echo $this->lang->line('phone'); ?> <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                            <?php
                                $data = array(
                                    'type' => 'text',
                                    'name' => 'contact_phone',
                                    'class' => 'form-control col-md-12 col-xs-12',
                                    'value' => '',
                                );
                                echo form_input($data);
                            ?>
                            <span class="text-danger"><?php echo form_error('contact_phone'); ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="label-control col-md-4 col-sm-3 col-xs-12" for="last-name"><?php echo $this->lang->line('message'); ?></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                            <?php
                                $data = array(
                                    'type' => 'textarea',
                                    'name' => 'message',
                                    'class' => 'form-control col-md-12 col-xs-12',
                                    'value' => '',
                                );
                                echo form_textarea($data);
                            ?>	
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group row">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <button type="submit" name="submit" class="btn btn-success add_booking"><?php echo $this->lang->line('save'); ?></button>
                            <a href="<?php echo superadmin_url(); ?>restaurant_bookings/index">
                                <button class="btn btn-primary" type="button"><?php echo $this->lang->line('cancel'); ?></button>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$('.add_booking').click(function()
{
    $.ajax({
        type        : "POST",
        cache       : false,
        url         : '<?php echo superadmin_url('restaurants/book_now_post') ?>',
        data        : $(".book_now_form").serializeArray(),
        success: function(data)
        {     
            var myArray = JSON.parse(data);
            if(myArray.status == 0)
            {
                alert(myArray.errors);
                return false;
            }
            else
            {
                alert('Booking added successfully');
                window.location.reload();
            }
        }
    });
    return false;
});
    
$('.close').on('click', function()
{
    $.fancybox.close();
});
//Datepicker
$(".date-picker").datepicker({});

</script>
<style>
.close {
    font-size: 30px;
    float: right;
}
</style>
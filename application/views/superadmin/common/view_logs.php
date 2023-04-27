<section id="horizontal-form-layouts">
	<div class="row">
        <div class="col-sm-12">
            <div class="card">
                <!-- Flash Message -->
                <?php $this->load->view("superadmin/common/flash_message.php"); ?>
                
                <div class="card-content collpase show">
                     

                    <div class="card-body card-dashboard">
                        <div class="row">
                            <div class="col-sm-4 col-4 col-md-6 full-width-res">
                                <div class="dataTables_length ">
                                    <label>Show
                                        <select name="perpagecount" id="perpagecount" class="custom-select custom-select-sm form-control form-control-sm">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body card-dashboard" id="log_view_data">
                        <?php $this->load->view("superadmin/common/view_logs_ajax",$data); ?>   
                        <div class="clearfix"></div>
                    </div>
                </div>	
            </div>
        </div>
    </div><div class="clearfix"></div>  
</section>
<script>
    function show_modal(id)
    {
        $('#myModal_'+id).modal('show');
    }
    //setup before functions
    var typingTimer;                //timer identifier
    var doneTypingInterval = 1000;  //time in ms, 5 second for example
    var $input = $('body');

    //on keyup, start the countdown
    $input.on('keyup', '.form-control.my-0.red-border',function () {
      clearTimeout(typingTimer);
      typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });

    //on keydown, clear the countdown 
    $input.on('keydown', '.form-control.my-0.red-border',function () {
      clearTimeout(typingTimer);
    });

    //user is "finished typing," do something
    function doneTyping () {
        $('#log_view_data').append('<div id="divLoading"><p id="loading"><img src="<?=base_url()?>assets/images/loader.gif"></p></div>');
        $.ajax({
            method: "POST",
            data : {search : $('body .form-control.my-0.red-border').val(),perpagecount:$('#perpagecount').val()},
            success: function(data) 
            {
               $('#log_view_data').html(data);
            }
        });
    };
    $('body').on('change','#perpagecount',function(){
        doneTyping();
    });
    $('body').on('click','.page-link',function(){
        if($(this).attr('href')!="#"){
            $('#log_view_data').append('<div id="divLoading"><p id="loading"><img src="<?=base_url()?>assets/images/loader.gif"></p></div>');
            $.ajax({
                url: $(this).attr('href'),
                method: "POST",
                data : {search : $('body .form-control.my-0.red-border').val(),perpagecount:$('#perpagecount').val()},
                success: function(data) 
                {
                   $('#log_view_data').html(data);
                }
            });
        }
        return false;
    });
</script>
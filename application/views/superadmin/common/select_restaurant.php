<section id="horizontal-form-layouts">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <!-- <div class="card-header">
                    <div class="title_left">
                        <h2 class="card-title"><?php echo "Select Restaurant" ?></h2>
                    </div>
                </div> -->
                
                <!-- Flash Message -->
                
                <div class="card-content collpase show">
                    
                    <div class="card-body card-dashboard">
                        <?php $segment = $this->url_translate->uri_segment(4) ?  "/".$this->url_translate->uri_segment(4) : ""; ?>
                        <?php
                        if(empty($segment)) {
                            $hidden = array(
                                'referrer' => 'index',
                            );
                        } else {
                            $hidden = array(
                                'referrer' => $segment
                            );
                        }
                        echo form_open(
                            superadmin_url($this->url_translate->uri_segment(2)."/select_restaurant".$segment),
                            array("class" => "form-horizontal"),
                            $hidden
                        ); ?>
                        
                        <div class="form-group row" >
                            <label class="label-control col-md-3 col-sm-3 col-xs-12" for="first-name"><?php echo $this->lang->line('restaurant'); ?> </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                  <input type="text" class="form-control restaurant_search" placeholder="Search restaurants..">
                                <?php
                                    /*$js = array(
                                        'class'    => 'select2_single form-control',
                                        'tabindex' => '-1',
                                        'data-url'=>base_url('superadmin/restaurants/get_my_restaurants')
                                    );
                                    echo form_dropdown('restaurant_id', $restaurant_list, $restaurant_id, $js); 

                                    $data = array(
                                        'type' => 'hidden',
                                        'name' => 'target',
                                        'class' => 'form-control col-md-12 col-xs-12',
                                        'value' => $target
                                    );
                                    echo form_input($data);*/
                                    ?>
                                    <input type="hidden" name="restaurant_id" value="">
                                <span class="text-danger"><?php echo form_error('restaurant_id'); ?></span>
                            </div>
                        </div>
                        <span class="text-danger"><?php echo form_error('restaurant_id'); ?></span>
                        <?php
                            $data = array(
                                'type' => 'hidden',
                                'name' => 'target',
                                'class' => 'form-control col-md-12 col-xs-12',
                                'value' => $target,
                                'required'=> true
                            );
                            echo form_input($data);
                            ?>

        
                        <div class="ln_solid"></div>
                        <div class="form-group row">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-success"><?php echo $this->lang->line('select'); ?></button>
                                <a href="javascript:window.history.go(-1);"><button class="btn btn-primary" type="button"><?php echo $this->lang->line('cancel'); ?></button></a>
                            </div>
                        </div>
                        <?php echo form_close();?>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function(){
        $(".restaurant_search").autocomplete({
            minLength: 3,
            source: function(request, response) {
                $.getJSON("<?php echo superadmin_url()?>/restaurants/restaurant_search", request, function(data, status, xhr) {
                    response(data);
                });
            },
            select: function(event, ui) {
                if(ui.item.id==0){
                    return false;
                }
                $("input[name='restaurant_id']").val(ui.item.id);
            }
        });
    });
</script>
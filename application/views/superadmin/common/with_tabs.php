<?php 
    if($this->uri->segment(3) == 'add')
    {
        $heading = $this->lang->line('add');
    }
    else
    {
        $heading = $this->lang->line('edit');
    }
?>
<section id="horizontal-form-layouts">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-content collpase show">
                    <div class="card-body card-dashboard restaurant_steps_form">
                        <?php $this->load->view("superadmin/common/tabs");?>
                        <?php $this->load->view($inner_template,$data);?>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</section>
<style>

.add_highlights .la{
    vertical-align: sub;
}
</style>
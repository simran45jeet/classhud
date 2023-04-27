<?php
    if(empty($restaurant_id) && $restaurant_id==null){
        $restaurant_id = $this->url_translate->uri_segment(4);
    }
    $tabber_restaurant_id = $this->my_encryption->decode($restaurant_id);
?>
<?php // restaurant close open script ?>

<!-- Alerts for errors -->
<div class="alert alert-danger alert-dismissible fade" role="alert">
  <div class="error-list">
    
  </div>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<div class="form-group">
    <div class="col-md-12 col-sm-9 col-xs-12 text-right viewres_opnclose" att-rid="<?php echo $tabber_restaurant_id; ?>">
    </div>
</div>
<?php // restaurant close open script end ?>

<div class="progress">
  <div class="progress-bar" role="progressbar" style="" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
</div>

<ul class="nav nav-tabs nav-linetriangle no-hover-bg nav-justified" id="edit_restaurant_tabs" role="tablist">
    <li role="presentation" class="nav-item">
        <a class="nav-link active" id="basics-tab" data-toggle="tab" href="#basics" role="tab" aria-controls="basics" aria-selected="true" >
            <?php echo $this->lang->line('restaurant_detail'); ?>
        </a>
    </li>
    <li role="presentation" class="nav-item">
        <a class="nav-link" id="features-tab" data-toggle="tab" href="#features" role="tab" aria-controls="features" aria-selected="false" >
            <?php echo $this->lang->line('features'); ?>
        </a>
    </li>
    <li role="presentation" class="nav-item">
        <a class="nav-link" id="timings-tab" data-toggle="tab" href="#timings" role="tab" aria-controls="timings" aria-selected="false" >
            <?php echo $this->lang->line('timings'); ?>
        </a>
    </li>
    <!-- <li role="presentation" class="nav-item">
        <a class="nav-link" id="takeaway_timings-tab" data-toggle="tab" href="#takeaway_timings" role="tab" aria-controls="takeaway_timings" aria-selected="false" >
            <?php echo $this->lang->line('takeaway_timings'); ?>
        </a>
    </li> -->
    <li role="presentation" class="nav-item">
        <a class="nav-link" id="gallery-tab" data-toggle="tab" href="#gallery" role="tab" aria-controls="gallery" aria-selected="false" >
            <?php echo $this->lang->line('gallery'); ?>
        </a>
    </li>
</ul>

<!--  Tab Content -->
<div class="tab-content p-2 pt-4" id="edit_restaurant_tabs_content">
    <div class="tab-pane fade show active" id="basics" role="tabpanel" aria-labelledby="basics-tab">
        <?php $this->load->view('superadmin/restaurants/partials/basics.php'); ?>
    </div>
    <div class="tab-pane fade" id="features" role="tabpanel" aria-labelledby="features-tab">
        <?php $this->load->view('superadmin/restaurants/partials/features.php'); ?>
    </div>
    <div class="tab-pane fade" id="timings" role="tabpanel" aria-labelledby="timings-tab">
        <?php $this->load->view('superadmin/restaurants/partials/timings.php'); ?>
        <?php //$this->load->view('superadmin/restaurants/partials/takeaway_timings.php'); ?>
    </div>
    <!-- <div class="tab-pane fade" id="takeaway_timings" role="tabpanel" aria-labelledby="takeaway_timings-tab">
    </div> -->
    <div class="tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
        <?php $this->load->view('superadmin/restaurants/partials/gallery.php'); ?>
    </div>
</div>
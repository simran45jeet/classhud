<div class="not-found-wrapper text-center">
    <div class="not-found-image">
        <img class="lazyload" src="<?php echo base_url(BASE_WEB_IMAGES_PATH."404-image.png") ?>" alt="<?php echo $this->lang->line("heading_404_image_alt") ?>" />
    </div>
    <div class="not-found-title">
        <h1><?php echo $this->lang->line("heading_404_title") ?></h1>
    </div>
    <div class="not-found-desc"><?php echo $this->lang->line("heading_404_description") ?></div>
    <div class="not-found-home text-center"> 
        <a class="btn-theme" href="<?php echo $this->base_url; ?>"> 
            <i class="la la-arrow-circle-left"></i>
            <?php echo $this->lang->line("heading_404_back") ?>
        </a>
    </div>
</div>

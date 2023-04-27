<style type="text/css">
    .my-listing-item{background: none; box-shadow: none;}
    .listing-content-inner {padding: 10px;background: #fff;border-radius: 10px;}
</style>
<div class="my-listings">
    <h3 class="page-title"><?php echo $this->lang->line("heading_banner_list_title") ?></h3>
    <div class="job-manager-jobs">
        <?php
        $total_cnt = $cnt = 0;
        if (!empty($banners)) {
            foreach ($banners as $banners_data) {
                if ($cnt == 0) {
                    echo "<div class='row d-flex'>";
                }
                ?>
                <div class="my-listing-item job_listing listing-block listing-list col-md-4 col-sm-12 p-3">
                    <div class="listing-content-inner">
                        <div class="listing-content-banner with_thumbnail">
                            <div class="lt_block-category clearfix">
                                <div class="cat-item first-cat">
                                    <img src="<?php echo base_url(BASE_BANNER_IMAGES_PATH . $banners_data["image"]) ?>" alt="<?php echo $banners_data["name"] ?>"/>
                                </div>
                            </div>
                            <h3 class="title"><?php echo $listing_data["name"] ?></h3>
                        </div>
                        <div class="listing-action clearfix">
                            <div class="action-right">
                                <div class="job-dashboard-actions"> 
                                    <a href="<?php echo base_url("{$controller_name}/download_banner/" . encrypt($banners_data["id"])) . "/{$encoded_id}" ?>" class="btn-gray-icon job-dashboard-action-delete"><?php echo $this->lang->line("heading_banner_download_title") ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $total_cnt++;
                $cnt++;
                if ($cnt == 3 || $total_cnt == count($banners)) {
                    echo '</div>';
                    $cnt = 0;
                }
            }
        } else {
            ?>
            <div class="alert alert-warning"><?php echo $this->lang->line("message_no_records"); ?></div>
            <?php
        }
        ?>
    </div>
    <div class="modal fade modal-ajax-user-form" id="popup-ajax-package" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header-form"> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body">
                    <div class="ajax-package-form-content">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

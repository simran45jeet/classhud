<div class="my-listings">
    <h3 class="page-title">My Listings</h3>
    <div class="job-manager-jobs">
        <?php
        if(!empty($records)){
            foreach( $records as $listing_data ) {
                $edit_link = "#";
                if( $listing_data["request_status"]==LISTING_REQUEST_STATUS_DISAPPROVED ) {
                    $edit_link = base_url("user/edit_listing_request/{$listing_data["id"]}");
                }else if( $listing_data["request_status"]==LISTING_REQUEST_STATUS_APPROVED ) {
                    $edit_link = base_url("user/edit_listing/{$listing_data["id"]}");
                }
        ?>
        <div class="my-listing-item job_listing listing-block listing-list">
            <div class="listing-content-inner">
                <div class="listing-image"> 
                   
                    <img width="600" height="540" src="<?php echo $listing_data["cover_image_url"] ?>" data-src="<?php echo $listing_data["cover_image_url"] ?>" class="lazyload attachment-medium size-medium wp-post-image" alt="<?php echo $listing_data["name"] ?>" />
                    <!--<div class="listing-time open_day">open_day</div>-->
<!--                    <div class="wishlist-icon-content"> 
                        <a href="#" data-post_id="1837" class="ajax-wishlist-link wishlist-add" title="Wishlist"> <i class="icon far fa-heart">
                            </i> 
                        </a>
                    </div>-->
                </div>
                <div class="listing-content with_thumbnail">
                    <div class="lt_block-category clearfix">
                        <div class="cat-item first-cat">
                            <a href="#">
                                <span class="icon">
                                    <i class="">
                                        <img src="<?php echo $listing_data["listing_type_image"]; ?>" alt="<?php echo $listing_data["listing_type_name"]; ?>"/>
                                    </i>
                                </span>
                                <span class="cat-name"><?php echo $listing_data["listing_type_name"]; ?></span>
                            </a>
                        </div>
                        <?php /* ?>
                        <div class="more-cat">
                            <div class="more-cat-number">+1</div>
                            <div class="more-cat-content">
                                <div class="cat-item ">
                                    <a href="https://gaviaspreview.com/wp/fioxen/listing-category/restaurants/">
                                        <span class="icon">
                                            <i class="la la-cutlery">
                                            </i>
                                        </span>
                                        <span class="cat-name">Restaurants</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php */ ?>
                    </div>
                    <h3 class="title">
                        <a href="<?php echo $edit_link ?>"><?php echo $listing_data["name"] ?></a>
                    </h3>
                    <div class="listing-meta">
                        <div class="location"> 
                            <i class="icon fas fa-map-marker-alt"></i> 
                            <span class="regions"> 
                                <a href="<?php echo $edit_link; ?>"><?php echo $listing_data["google_location"] ?></a>
<!--                                <a href="https://gaviaspreview.com/wp/fioxen/region/bedford/">Bedford</a> <span>,&nbsp;</span>
                                <a href="https://gaviaspreview.com/wp/fioxen/region/united-kingdom/">United Kingdom</a> 
-->
                            </span>
                        </div>
                    </div>
                </div>
                <div class="listing-action clearfix">
                    <div class="action-left">
                        <div class="listing-date-post listing-meta-item"> 
                            <span class="label"><?php echo $this->lang->line("heading_listing_date_posted") ?></span> 
                            <span><?php echo date(VIEW_DATE_FORMAT,strtotime($listing_data["created_at"])); ?></span>
                            
                        </div>
                        <!--
                        <div class="listing-expires listing-meta-item"> <span class="label">Date Expires:</span> <span>&ndash;</span>
                        </div>
                        -->
                    </div>
                    <div class="action-right">
                        <div class="job-dashboard-actions"> 
                            
<!--                            <a href="/wp/fioxen/listings-dashboard/?dashboard=my-listings&#038;action=delete&#038;job_id=1837&#038;_wpnonce=5370713e21" class="btn-gray-icon job-dashboard-action-delete">Delete</a>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } 
        }else{
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
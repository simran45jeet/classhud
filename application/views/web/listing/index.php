<div class="elementor-element elementor-element-25c7841 elementor-widget elementor-widget-gva-listings" data-id="25c7841" data-element_type="widget" data-widget_type="gva-listings.default">
    <div class="elementor-widget-container">
        <div class="gva-element-gva-listings gva-element">  
            <div class="gva-listings-grid clearfix grid-wngi">

                <div class="gva-content-items"> 
                    <div class="lg-block-grid-3 md-block-grid-3 sm-block-grid-2 xs-block-grid-2 xx-block-grid-1">
                        <?php
                        if( !empty($records) ){ 
                            foreach( $records as $record ) {
                                $listing_url =  base_url( "best/".preg_replace("![\s]+!u","-",strtolower($record["listing_type_name"]))."/{$record["slug"]}/".preg_replace("![\s]+!u","-",strtolower($record["city_name"])) );
                        ?>
                        <div class="item-columns">
                            <div class="listing-block post-647 job_listing type-job_listing status-publish has-post-thumbnail hentry job_listing_category-party-center job_listing_category-traveling job_listing_amenity-accessories job_listing_amenity-car-parking job_listing_amenity-free-coupons job_listing_amenity-pet-friendly job_listing_amenity-reservations job_listing_amenity-security-cameras job_listing_amenity-smoking-allowed job_listing_amenity-wheelchair-accesible job_listing_amenity-wireless-internet job_listing_region-new-york job_listing_region-united-states job_listing_tag-food job_listing_tag-home-delivery job_listing_tag-restaurant job_listing_tag-shopping job_listing_tag-traving position-relative">

                                <div class="listing-image listing-image-cover">
                                    <i class="listing_image" style="background:url('<?php echo $record["cover_image_url"];?>') no-repeat center center / cover"></i>
                                    <div class="listing-logo">
                                        <img decoding="async" src="<?php echo $record["logo_url"];?>" <?php echo $record["name"]; ?> />
                                    </div>
                                    <a href="<?php echo $listing_url ?>" class="link-overlay"></a>
                                </div>   

                                <div class="listing-content listing-content-cover">
                                    <div class="lt-meta-top">
                                        <div class="lt_block-category">
                                            <div class="cat-item first-cat">
                                                <a href="<?php echo $listing_url ?>">
                                                    <span class="icon">
                                                        <?php echo !empty($record["listing_type_image"]) ? "<img src='{$record["listing_type_image"]}' />" :""; ?>
                                                    </span>
                                                    <span class="cat-name"><?php echo $record["listing_type_name"] ?></span>
                                                </a>
                                            </div>
                                            <?php /* ?>
                                            <div class="more-cat">
                                                <div class="more-cat-number">+1</div>
                                                <div class="more-cat-content">
                                                    <div class="cat-item ">
                                                        <a href="job-category/traveling/index.html">
                                                            <span class="icon">
                                                                <i class="las la-tram">
                                                                </i>
                                                            </span>
                                                            <span class="cat-name">Traveling</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div> 
                                            <?php */ ?>
                                        </div>
<!--                                        <div class="listing-time <?php echo $record["now_listing_open"]==IS_LISTING_OPEN ? "open":"closed" ?>">
                                            <?php echo $this->lang->line("heading_listing_open_status")[$record["now_listing_open"]] ?>
                                        </div>-->

                                    </div>
                                    <div class="lt-content-block">
                                        <h3 class="title"><a href="<?php echo $listing_url ?>"><?php echo $record["name"] ?></a></h3>

                                        <!--<div class="listing-tagline">One of the best Restaurant</div>-->

                                        <!--
                                        <div class="lt-review-show-start"><div class="review-results"><div class="base-stars"><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span></div><div class="votes-stars" style="width: 80%;"><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span></div></div><div class="lt-review-suffix">(2 Reviews)</div></div>   
                                        -->

                                        <div class="listing-meta">
                                            <div class="phone">
                                                <a href="tel:<?php echo $record["primary_phone_code_name"].$record["primary_phone_no"] ?>"><i class="icon las la-phone-volume"></i> <?php echo $record["primary_phone_code_name"].$record["primary_phone_no"] ?></a>
                                            </div>

                                                       
                                        <!--
                                        <div class="price-from">
                                            <i class="icon las la-money-bill"></i>
                                            From 80$
                                        </div>-->
                                        </div>    

                                        <div class="content-footer">
                                            <div class="location">          
                                                <i class="icon la la-map-marker"></i>
                                                <span class="regions">
                                                    <!--<a href="#">New York</a>-->
                                                    <!--<span>,&nbsp;</span>-->
                                                    <a href="#"><?php echo $record["google_location"] ?></a>
                                                </span>
                                            </div>
                                            <!--
                                            <div class="wishlist-icon-content">
                                                <a href="#" data-post_id="647" class="ajax-wishlist-link wishlist-add" title="Wishlist">
                                                    <i class="icon far fa-heart"></i>
                                                </a>
                                            </div> 
                                            -->
                                        </div> 

                                    </div>
                                </div> 
                            </div>
                        </div>
                        <?php 
                            }
                        } ?>
                    </div>
                </div>

            </div>

        </div>	
    </div>
</div>
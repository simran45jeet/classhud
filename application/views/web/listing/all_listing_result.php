<?php if($page_no==1){ ?>
<div class="lt_results-sorting">
    <div class="results-text">
        <?php echo sprintf($this->lang->line( "heading_results_found" ),$count) ?>
    </div>
    <div class="results-sorting d-none"> 
        <select class="select_lt_results_sorting d-none" name="select_lt_results_sorting">
            <option value="default">Default sorting</option>
            <option value="rating">Sort by average rating</option>
            <option value="date">Sort by latest</option>
            <option value="date-old">Sort by oldest</option>
            <option value="featured">Sort by featured</option>
            <option value="random">Sort by random</option> 
        </select>
    </div>
</div>
<?php } ?>
<div class="job_listings listings-list-inner">
    <?php
    if( !empty($records) ) { 
        foreach( $records as $key=>$listing_record ){
            $listing_url =  base_url( "best/".preg_replace("![\s]+!u","-",strtolower($listing_record["listing_type_name"]))."/{$listing_record["slug"]}/".preg_replace("![\s]+!u","-",strtolower($listing_record["city_name"])) );
    ?>
    <div class="listing-block-item">
        <div class="listing-block listing-list post-650 job_listing type-job_listing status-publish has-post-thumbnail hentry job_listing_category-traveling job_listing_type-full-time job_listing_amenity-car-parking job_listing_amenity-elevator job_listing_amenity-free-coupons job_listing_amenity-outdoor-seating job_listing_amenity-pet-friendly job_listing_amenity-reservations job_listing_amenity-security-cameras job_listing_amenity-smoking-allowed job_listing_amenity-wheelchair-accesible job_listing_region-new-york job_listing_region-united-states job_listing_tag-food job_listing_tag-home-delivery job_listing_tag-restaurant job_listing_tag-shopping job_listing_tag-traving job-type-full-time job_position_featured position-relative">
            <div class="listing-content-inner">
                <div class="listing-image">
                    <i class="listing_image" style="background:url('<?php echo $listing_record["cover_image_url"]; ?>') no-repeat center center / cover"></i>
<!--                    <div class="listing-time <?php echo $record["now_listing_open"]==IS_LISTING_OPEN ? "open":"closed" ?>">
                        <?php echo $this->lang->line("heading_listing_open_status")[$record["now_listing_open"]] ?>
                    </div>-->
                    <div class="listing-logo bg-transparent">
                        <img src="<?php echo $listing_record["logo_url"]; ?>" alt="<?php echo $listing_record["name"] ?>">
                    </div>
                    <!--
                    <div class="lt-featured">
                        <span>Featured</span>
                    </div>
                    -->
                    <a href="<?php echo $listing_url ?>" class="link-overlay"></a>
                </div>   
                <div class="listing-content">
                    <h3 class="title">
                        <a href="<?php echo $listing_url ?>"><?php echo $listing_record["name"] ?></a>
                    </h3>
                    <!--<div class="listing-tagline">Modern Hair Style Salon</div>-->

                    <div class="listing-meta">
                        <div class="location">       
                            <i class="icon las la-map-marked-alt">
                            </i>
                            <span class="regions">
                                <!--
                                <a href="https://mankawal.com/site/region/new-york/">New York</a>
                                <span>,&nbsp;</span>
                                -->
                                <a href="<?php echo $listing_url ?>"><?php echo $listing_record["google_location"] ?></a>
                            </span>
                        </div>
                        <div class="phone">
                            <i class="icon las la-phone-volume"></i>
                            <a href="tel:<?php echo $listing_record["primary_phone_code_name"].$listing_record["primary_phone_no"] ?>"><?php echo $listing_record["primary_phone_code_name"].$listing_record["primary_phone_no"] ?></a>
                        </div>

                    </div>    
                    <div class="content-footer">
                        <div class="lt_block-category">
                            <div class="cat-item first-cat">
                                <a href="<?php echo $listing_url ?>">
                                    <span class="icon">
                                        <?php echo !empty($listing_record["listing_type_image"]) ? "<img src='{$listing_record["listing_type_image"]}' />" :""; ?>
                                    </span>
                                    
                                    <span class="cat-name"><?php echo $listing_record["listing_type_name"] ?></span>
                                </a>
                            </div>            
                        </div>
                        <!--
                        <div class="lt-review-show-start">
                            <div class="lt-review-name">4.3</div>
                            <div class="review-results">
                                <div class="base-stars">
                                    <span>
                                        <i class="star dashicons dashicons-star-filled">
                                        </i>
                                    </span>
                                    <span>
                                        <i class="star dashicons dashicons-star-filled">
                                        </i>
                                    </span>
                                    <span>
                                        <i class="star dashicons dashicons-star-filled">
                                        </i>
                                    </span>
                                    <span>
                                        <i class="star dashicons dashicons-star-filled">
                                        </i>
                                    </span>
                                    <span>
                                        <i class="star dashicons dashicons-star-filled">
                                        </i>
                                    </span>
                                </div>
                                <div class="votes-stars" style="width: 86%;">
                                    <span>
                                        <i class="star dashicons dashicons-star-filled">
                                        </i>
                                    </span>
                                    <span>
                                        <i class="star dashicons dashicons-star-filled">
                                        </i>
                                    </span>
                                    <span>
                                        <i class="star dashicons dashicons-star-filled">
                                        </i>
                                    </span>
                                    <span>
                                        <i class="star dashicons dashicons-star-filled">
                                        </i>
                                    </span>
                                    <span>
                                        <i class="star dashicons dashicons-star-filled">
                                        </i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        }   
    }else{?>
        <div class="alert alert-warning"><?php echo $this->lang->line("message_no_records"); ?></div>
    <?php } ?>
</div>

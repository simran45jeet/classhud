<section id="wp-main-content" class="clearfix main-page">
    <div class="main-page-content">
        <div class="content-page">      
            <div id="wp-content" class="wp-content clearfix">
                <div data-elementor-type="wp-post" data-elementor-id="867" class="elementor elementor-867">
                    <section  class="elementor-section elementor-top-section elementor-element elementor-element-fec726d elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="fec726d" data-element_type="section">
                        <div class="elementor-container elementor-column-gap-default">
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-3949584" data-id="3949584" data-element_type="column">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div  class="elementor-element elementor-element-d773574 elementor-widget elementor-widget-gva-template_content" data-id="d773574" data-element_type="widget" data-widget_type="gva-template_content.default">
                                        <div class="elementor-widget-container">
                                            <div data-elementor-type="wp-page" data-elementor-id="18" class="elementor elementor-18">
                                                <section style="background: url('<?php echo base_url(BASE_WEB_IMAGES_PATH."classhud-back-drop-min.jpg"); ?>') no-repeat center center / cover;" class="elementor-section elementor-top-section elementor-element elementor-element-0e79c74 row-hero elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="0e79c74" data-element_type="section" >
                                                    <div class="elementor-background-slideshow-new swiper-container swiper-container-fade swiper-container-initialized swiper-container-horizontal swiper-container-rtl" dir="rtl">
                                                        <div class="swiper-wrapper" style="transition-duration: 0ms;">
                                                            <div class="elementor-background-slideshow__slide swiper-slide swiper-slide-duplicate" data-swiper-slide-index="0" style="width: 100%; transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);">
                                                                <div class="elementor-background-slideshow__slide__image elementor-ken-burns elementor-ken-burns--out" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    
                                                    <div  class="elementor-container elementor-column-gap-default">
                                                        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-71f34e5" data-id="71f34e5" data-element_type="column">
                                                            <div class="elementor-widget-wrap elementor-element-populated">
                                                                <div class="elementor-element elementor-element-9c91cb9 elementor-widget elementor-widget-gva-heading-block" data-id="9c91cb9" data-element_type="widget" data-widget_type="gva-heading-block.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="gva-element-gva-heading-block gva-element">   <div class="align-left style-1 widget gsc-heading box-align-left auto-responsive">
                                                                                <div class="content-inner">

                                                                                    <h1 class="title">
                                                                                        <span>Find The Right Educational Institution That Fits Your Goals</span>
                                                                                    </h1>
                                                                                    <div class="title-desc">Explore and Compare a vast selection of schools, colleges, and educational institutes to find the one that's perfect for you.</div>
                                                                                </div>
                                                                            </div>
                                                                        </div>		
                                                                    </div>
                                                                </div>
                                                                <div class="elementor-element elementor-element-085d5cf elementor-widget elementor-widget-gva-listing-search-form" data-id="085d5cf" data-element_type="widget" data-widget_type="gva-listing-search-form.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="gva-element-gva-listing-search-form gva-element">
                                                                            <div class="lt-listing-search-form style-1">
                                                                                <form class="lt-search-form-main" id="lt-search-form-main" action="<?php echo base_url("listing/all_listing") ?>" role="search" method="post">

                                                                                    <div class="search-form-content">

                                                                                        <div class="search-form-fields clearfix cols-2 has_search_keyword d-inline-block col-12">
                                                                                            <div class="lt_search_location col-md-8">
                                                                                                <div class="content-inner">
                                                                                                    <i class="icon icon la la-location-arrow locate_me"></i>
                                                                                                    <div class="search-location-inner">
                                                                                                        <input type="text" class="id_listing_location_text" name="google_location" id="autocompleteLocation" placeholder="<?php echo $this->lang->line("heading_location_placeholder") ?>" value="" autocomplete="off" />
                                                                                                        <input type="hidden" name="full_address" id="full_address"/>
                                                                                                        <input type="hidden" name="place_id" id="place_id"/>
                                                                                                        <input type="hidden" name="longitude" id="longitude"/>
                                                                                                        <input type="hidden" name="latitude" id="latitude"/>
                                                                                                        <div class="places_list_autocomplete" style="display:none;"></div>
                                                                                                    </div>
                                                                                                    <input type="hidden" class="job-manager-filter" id="lt_filter_location_value" name="lt_filter_location_value" value="" />
                                                                                                </div>
                                                                                            </div>
                                                                                            
                                                                                            <div class="search_keywords col-md-4 d-none">
                                                                                                <div class="content-inner">
                                                                                                    <i class="icon la la-globe"></i>
                                                                                                    <select name="listing_type">
                                                                                                        <option value="0">All Institutes</option>
                                                                                                        <?php foreach ($listing_types as $key=>$listing_type) { ?>
                                                                                                        <option value="<?php echo $listing_type["id"] ?>"><?php echo $listing_type["name"] ?></option>
                                                                                                        <?php } ?>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="lt_search_location col-md-4">
                                                                                                <div class="content-inner pe-0 ps-0">
                                                                                                    <div class="search-location-inner">
                                                                                                        <input type="text" class="search" name="search" id="search" placeholder="<?php echo $this->lang->line("heading_homepage_search_title") ?>" value="" autocomplete="off" />
                                                                                                    </div>
                                                                                                    
                                                                                                </div>
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                        <div class="form-action">
                                                                                            <button class="btn-theme btn-action" type="submit">
                                                                                                <i class="fi flaticon-magnifying-glass"></i>
                                                                                                <?php echo $this->lang->line("heading_search") ?>
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>		
                                                                    </div>
                                                                </div>
                                                                <?php /* ?>
                                                                <div class="elementor-element elementor-element-564deed elementor-icon-list--layout-inline elementor-align-left elementor-tablet-align-center style-list-1 elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="564deed" data-element_type="widget" data-widget_type="icon-list.default">
                                                                    <div class="elementor-widget-container">
                                                                        <ul class="elementor-icon-list-items elementor-inline-items">
                                                                            <li class="elementor-icon-list-item elementor-inline-item">
                                                                                <span class="elementor-icon-list-icon">
                                                                                    <i aria-hidden="true" class="fas fa-map-marker-alt"></i>						
                                                                                </span>
                                                                                <span class="elementor-icon-list-text"><b>Popular:</b></span>
                                                                            </li>
                                                                            <li class="elementor-icon-list-item elementor-inline-item">
                                                                                <a href="wp/fioxen/job-category/restaurants/">

                                                                                    <span class="elementor-icon-list-text">Restaurant,</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="elementor-icon-list-item elementor-inline-item">
                                                                                <a href="wp/fioxen/job-category/shopping/">

                                                                                    <span class="elementor-icon-list-text">Shopping,</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="elementor-icon-list-item elementor-inline-item">
                                                                                <a href="wp/fioxen/job-category/traveling/">

                                                                                    <span class="elementor-icon-list-text">Traving,</span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="elementor-icon-list-item elementor-inline-item">
                                                                                <a href="#">

                                                                                    <span class="elementor-icon-list-text">Game</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <?php */ ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                <section class="elementor-section elementor-top-section elementor-element elementor-element-6ff6d2e elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="6ff6d2e" data-element_type="section">
                                                    <div class="swiper-slider-wrapper" >
                                                        <div class="swiper-content-inner category_slider container my-3 mt-5" id="featureContainer">
                                                            <div class="swiper bg-white row mx-auto my-auto justify-content-center" data-carousel="">
                                                                <div class="swiper-wrapper carousel slide" id="featureCarousel" data-bs-ride="carousel">
                                                                    <div class="float-end pe-md-4 ">
                                                                        <a class="indicator prev swiper-nav-prev" href="#featureCarousel" role="button" data-bs-slide="prev">
                                                                            <span class="fas fa-chevron-left" aria-hidden="true"></span>
                                                                        </a> &nbsp;&nbsp;
                                                                        <a class="w-aut indicator next swiper-nav-next" href="#featureCarousel" role="button" data-bs-slide="next">
                                                                            <span class="fas fa-chevron-right" aria-hidden="true"></span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="carousel-inner" role="listbox">

                                                                        <div class="swiper-slide carousel-item active">
                                                                            <div class="icon-box-item elementor-repeater-item-ed311e2 col-md-2">
                                                                                <div class="icon-box-content">

                                                                                    <div class="content-inner">
                                                                                        <a href="<?php echo base_url("category/category_listing/pre-school") ?>" class="link-overlay">
                                                                                            <div class="box-icon text-center">
                                                                                                <i aria-hidden="true" class="d-inline-block">
                                                                                                    <img src="<?php echo base_url(BASE_WEB_IMAGES_PATH . "preschool.svg") ?>" alt="Pre School" />
                                                                                                </i>
                                                                                            </div>
                                                                                            <h3 class="title text-center">Pre School</h3>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>  	
                                                                            </div>               
                                                                        </div>
                                                                        <div class="swiper-slide carousel-item">
                                                                            <div class="icon-box-item elementor-repeater-item-ec77c0e col-md-2">
                                                                                <div class="icon-box-content">

                                                                                    <div class="content-inner">
                                                                                        <a href="<?php echo base_url("category/category_listing/school") ?>" class="link-overlay">
                                                                                            <div class="box-icon text-center">
                                                                                                <i aria-hidden="true" class="d-inline-block">
                                                                                                    <img src="<?php echo base_url(BASE_WEB_IMAGES_PATH . "School Icon.svg") ?>" alt="School"/>
                                                                                                </i>
                                                                                            </div>
                                                                                            <h3 class="title text-center">School</h3>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>  	

                                                                            </div>               
                                                                        </div>
                                                                        <div class="swiper-slide carousel-item">
                                                                            <div class="icon-box-item elementor-repeater-item-4157a90 col-md-2">
                                                                                <div class="icon-box-content">
                                                                                    <div class="content-inner">
                                                                                        <a href="<?php echo base_url("category/category_listing/college") ?>" class="link-overlay">
                                                                                            <div class="box-icon text-center">
                                                                                                <i aria-hidden="true" class="d-inline-block">
                                                                                                    <img src="<?php echo base_url(BASE_WEB_IMAGES_PATH . "college.svg") ?>" alt="college" />
                                                                                                </i>					
                                                                                            </div>
                                                                                            <h3 class="title text-center">College</h3>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>               
                                                                        </div>
                                                                        <div class="swiper-slide carousel-item">
                                                                            <div class="icon-box-item elementor-repeater-item-dba20e8 col-md-2">
                                                                                <div class="icon-box-content">
                                                                                    <div class="content-inner">
                                                                                        <a href="<?php echo base_url("category/category_listing/institute") ?>" class="link-overlay">
                                                                                            <div class="box-icon text-center">
                                                                                                <i aria-hidden="true" class="d-inline-block">
                                                                                                    <img src="<?php echo base_url(BASE_WEB_IMAGES_PATH . "coaching.svg") ?>" alt="Institute" />
                                                                                                </i>
                                                                                            </div>
                                                                                            <h3 class="title text-center">Institute</h3>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>  	
                                                                            </div>
                                                                        </div>
                                                                        <div class="swiper-slide carousel-item">
                                                                            <div class="icon-box-item elementor-repeater-item-89fbba2 col-md-2">
                                                                                <div class="icon-box-content">
                                                                                    <div class="content-inner">
                                                                                        <a href="<?php echo base_url("category/category_listing/tuition-centre") ?>" class="link-overlay">
                                                                                            <div class="box-icon text-center">
                                                                                                <i aria-hidden="true" class="d-inline-block">
                                                                                                    <img src="<?php echo base_url(BASE_WEB_IMAGES_PATH . "tution-centre.svg") ?>" alt="Tuition Centre" />
                                                                                                </i>
                                                                                            </div>
                                                                                            <h3 class="title text-center">Tuition Centre</h3>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>               
                                                                        </div>
                                                                        <div class="swiper-slide carousel-item">
                                                                            <div class="icon-box-item elementor-repeater-item-71cd5b7 col-md-2">
                                                                                <div class="icon-box-content">
                                                                                    <div class="content-inner">
                                                                                        <a href="<?php echo base_url("category/category_listing/university") ?>" class="link-overlay">
                                                                                            <div class="box-icon text-center">
                                                                                                <i aria-hidden="true" class="d-inline-block">
                                                                                                    <img src="<?php echo base_url(BASE_WEB_IMAGES_PATH . "university.svg") ?>" alt="University" />
                                                                                                </i>
                                                                                            </div>
                                                                                            <h3 class="title text-center">University</h3>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>              
                                                                        </div>
                                                                         <div class="swiper-slide carousel-item">
                                                                            <div class="icon-box-item elementor-repeater-item-71cd5b7 col-md-2">
                                                                                <div class="icon-box-content">
                                                                                    <div class="content-inner">
                                                                                        <a href="javascript:;" class="link-overlay">
                                                                                            <div class="box-icon text-center">
                                                                                                <i aria-hidden="true" class="d-inline-block">
                                                                                                    <img src="<?php echo base_url(BASE_WEB_IMAGES_PATH . "il.svg") ?>" alt="IELTS Centre"/>
                                                                                                </i>
                                                                                            </div>
                                                                                            <h3 class="title text-center">IELTS</h3>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>              
                                                                        </div>
                                                                        
                                                                        
                                                                        
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>   
                                                    </div>
                                                </section>
                                                <section class="elementor-section elementor-top-section elementor-element elementor-element-3b58066 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="3b58066" data-element_type="section">
                                                    <div class="elementor-container elementor-column-gap-default">
                                                        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-bf041b1" data-id="bf041b1" data-element_type="column">
                                                            <div class="elementor-widget-wrap elementor-element-populated">
                                                                <div class="elementor-element elementor-element-7da0091 elementor-widget elementor-widget-gva-heading-block" data-id="7da0091" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;none&quot;}" data-widget_type="gva-heading-block.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="gva-element-gva-heading-block gva-element">   <div class="align-center style-1 widget gsc-heading box-align-center auto-responsive">
                                                                                <div class="content-inner">
                                                                                    <div class="sub-title">
                                                                                        <span class="tagline">Featured List</span> 
                                                                                    </div>
                                                                                    <h3 class="title">
                                                                                        <span>Explore Top Institutes</span>
                                                                                    </h3>
                                                                                </div>
                                                                            </div>
                                                                        </div>		
                                                                    </div>
                                                                </div>
                                                                <div class="row col-sm-12" id="listing_record"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                <section class="elementor-section elementor-top-section elementor-element elementor-element-a72b136 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="a72b136" data-element_type="section" >
                                                    <div class="elementor-container elementor-column-gap-default">
                                                        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-b8554b5" data-id="b8554b5" data-element_type="column">
                                                            <div class="elementor-widget-wrap elementor-element-populated">
                                                                <div class="elementor-element elementor-element-ca2ad29 elementor-widget elementor-widget-image" data-id="ca2ad29" data-element_type="widget" data-widget_type="image.default">
                                                                    <div class="elementor-widget-container">
                                                                        <img decoding="async" width="104" height="104" src="<?php echo base_url(BASE_WEB_IMAGES_PATH."rocket.svg") ?>" class="attachment-full size-full wp-image-1470" alt="Boost institution's visibility" loading="lazy" />
                                                                    </div>
                                                                </div>
                                                                <div class="elementor-element elementor-element-40c801d elementor-widget elementor-widget-gva-heading-block" data-id="40c801d" data-element_type="widget" data-widget_type="gva-heading-block.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="gva-element-gva-heading-block gva-element">   <div class="align-center style-1 widget gsc-heading box-align-left auto-responsive">
                                                                                <div class="content-inner">

                                                                                    <h2 class="title" style="font-size:35px;">
                                                                                        <span>Get ahead of the competition and increase your<br>institution's visibility by listing on Class Hud.</span>
                                                                                    </h2>

                                                                                    <div class="heading-action">
                                                                                        <a href="<?php echo base_url("listing/add") ?>" class="btn-cta btn-theme ">
                                                                                            <span>Register Your Institute</span>
                                                                                        </a>

                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>		
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                <section class="elementor-section elementor-top-section elementor-element elementor-element-ef920d2 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="ef920d2" data-element_type="section">
                                                    <div class="elementor-container elementor-column-gap-default">
                                                        <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-9f990f1" data-id="9f990f1" data-element_type="column">
                                                            <div class="elementor-widget-wrap elementor-element-populated">
                                                                <div class="elementor-element elementor-element-dea5ca4 elementor-widget elementor-widget-gva-image-content" data-id="dea5ca4" data-element_type="widget" data-widget_type="gva-image-content.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="gva-element-gva-image-content gva-element">		
                                                                            <div class="gsc-image-content skin-v1">

                                                                                <div class="image">
                                                                                    <img decoding="async" src="<?php echo base_url(BASE_WEB_IMAGES_PATH."Image Left.png") ?>" title="" alt="Join Instutute" loading="lazy" />				
                                                                                </div>
                                                                            </div>
                                                                        </div>		
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-bfe7b39" data-id="bfe7b39" data-element_type="column">
                                                            <div class="elementor-widget-wrap elementor-element-populated">
                                                                <div class="elementor-element elementor-element-b360dce elementor-widget elementor-widget-gva-heading-block" data-id="b360dce" data-element_type="widget" data-widget_type="gva-heading-block.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="gva-element-gva-heading-block gva-element">   <div class="align-left style-1 widget gsc-heading box-align-left auto-responsive">
                                                                                <div class="content-inner">
                                                                                    <div class="sub-title">
                                                                                        <span class="tagline">Our Speciality ..</span> 
                                                                                    </div>


                                                                                    <h2 class="title">
                                                                                        <span>Explore and Compare Educational Options</span>
                                                                                    </h2>


                                                                                </div>
                                                                            </div>
                                                                        </div>		
                                                                    </div>
                                                                </div>
                                                                <div class="elementor-element elementor-element-021c23c elementor-widget elementor-widget-gva-icon-box-styles" data-id="021c23c" data-element_type="widget" data-widget_type="gva-icon-box-styles.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="gva-element-gva-icon-box-styles gva-element">
                                                                            <div class="widget gsc-icon-box-styles style-1 ">
                                                                                <div class="icon-box-content">
                                                                                    <div class="icon-inner">
                                                                                        <span class="box-icon">
                                                                                            <i aria-hidden="true" class="la la-search-location"></i>
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="box-content">
                                                                                        <h3 class="title">Find What You Want</h3>
                                                                                        <div class="desc">Class Hud offers a diverse selection of educational institutions across various categories, making it easy for you to find the perfect fit for your needs.
                                                                                        </div>            
                                                                                    </div>
                                                                                </div> 
                                                                            </div>   

                                                                        </div>		
                                                                    </div>
                                                                </div>
                                                                <div class="elementor-element elementor-element-6b72c4b elementor-widget elementor-widget-gva-icon-box-styles" data-id="6b72c4b" data-element_type="widget" data-widget_type="gva-icon-box-styles.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="gva-element-gva-icon-box-styles gva-element">
                                                                            <div class="widget gsc-icon-box-styles style-1 ">
                                                                                <div class="icon-box-content">
                                                                                    <div class="icon-inner">
                                                                                        <span class="box-icon">
                                                                                            <i aria-hidden="true" class="la la-school"></i>
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="box-content">
                                                                                        <h3 class="title">Choose Your Place for Study</h3><div class="desc">All institutions have latest &  most accurate information available. Like Contact Information, Review, Amenities, Fee Structures, Admissions etc. </div>
                                                                                    </div>
                                                                                </div> 
                                                                            </div>   
                                                                        </div>		
                                                                    </div>
                                                                </div>
                                                                <div class="elementor-element elementor-element-1e17d28 elementor-widget elementor-widget-gva-icon-box-styles" data-id="1e17d28" data-element_type="widget" data-widget_type="gva-icon-box-styles.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="gva-element-gva-icon-box-styles gva-element">
                                                                            <div class="widget gsc-icon-box-styles style-1 ">
                                                                                <div class="icon-box-content">
                                                                                    <div class="icon-inner">
                                                                                        <span class="box-icon">
                                                                                            <i aria-hidden="true" class=" la la-bookmark"></i>
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="box-content">
                                                                                        <h3 class="title">Side-by-side comparison</h3><div class="desc">Class Hud's platform allows you to compare multiple institutions side-by-side, making it easy to see which ones meet your criteria.</div>            
                                                                                    </div>
                                                                                </div> 
                                                                            </div>   

                                                                        </div>		
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                <?php /* ?>
                                                <section class="elementor-section elementor-top-section elementor-element elementor-element-27ad0f7 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="27ad0f7" data-element_type="section">
                                                    <div class="elementor-container elementor-column-gap-default">
                                                        <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-c3d2b65 column-line-right" data-id="c3d2b65" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                                            <div class="elementor-widget-wrap elementor-element-populated">
                                                                <div class="elementor-element elementor-element-fc5f8e8 elementor-widget elementor-widget-gva-video-box" data-id="fc5f8e8" data-element_type="widget" data-widget_type="gva-video-box.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="gva-element-gva-video-box gva-element">
                                                                            <div class="widget gsc-video-box clearfix style-1">
                                                                                <div class="video-inner">


                                                                                    <div class="video-content">
                                                                                        <div class="video-action">
                                                                                            <a href="https://www.youtube.com/watch?v=NrmMk1Myrxc" class="popup-video"><span><i class="fa fa-play"></i></span></a>

                                                                                        </div>   
                                                                                    </div>    
                                                                                </div>
                                                                            </div> 




                                                                        </div>		</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-15e8e58" data-id="15e8e58" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                                            <div class="elementor-widget-wrap elementor-element-populated">
                                                                <div class="elementor-element elementor-element-eb4c13d animated-fast elementor-invisible elementor-widget elementor-widget-gva-heading-block" data-id="eb4c13d" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="gva-heading-block.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="gva-element-gva-heading-block gva-element">   <div class="align-left style-1 widget gsc-heading box-align-left auto-responsive">
                                                                                <div class="content-inner">



                                                                                    <div class="sub-title">
                                                                                        <span class="tagline">Our benefit lists..</span> 
                                                                                    </div>


                                                                                    <h2 class="title">
                                                                                        <span>Why Choose Fioxen</span>
                                                                                    </h2>
                                                                                    <div class="title-desc">There are many variations of passages of lorem ipsum is simply free text available in the market for you.</div>


                                                                                </div>
                                                                            </div>
                                                                        </div>		</div>
                                                                </div>
                                                                <div class="elementor-element elementor-element-23468bb elementor-position-left icon-box-left animated-fast elementor-view-default elementor-mobile-position-top elementor-vertical-align-top elementor-invisible elementor-widget elementor-widget-icon-box" data-id="23468bb" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:300}" data-widget_type="icon-box.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="elementor-icon-box-wrapper">
                                                                            <div class="elementor-icon-box-icon">
                                                                                <span class="elementor-icon elementor-animation-" >
                                                                                    <i aria-hidden="true" class=" flaticon-travel-3"></i>				</span>
                                                                            </div>
                                                                            <div class="elementor-icon-box-content">
                                                                                <h3 class="elementor-icon-box-title">
                                                                                    <span  >
                                                                                        Professional and Certified					</span>
                                                                                </h3>
                                                                                <p class="elementor-icon-box-description">
                                                                                    Lorem ipsum is simply free text dolor sit but the majority have suffered amet, consectetur notted.					</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="elementor-element elementor-element-c73a081 elementor-position-left icon-box-left animated-fast elementor-view-default elementor-mobile-position-top elementor-vertical-align-top elementor-invisible elementor-widget elementor-widget-icon-box" data-id="c73a081" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:500}" data-widget_type="icon-box.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="elementor-icon-box-wrapper">
                                                                            <div class="elementor-icon-box-icon">
                                                                                <span class="elementor-icon elementor-animation-" >
                                                                                    <i aria-hidden="true" class=" flaticon-mountains"></i>				</span>
                                                                            </div>
                                                                            <div class="elementor-icon-box-content">
                                                                                <h3 class="elementor-icon-box-title">
                                                                                    <span  >
                                                                                        Get Instant Tour Bookings					</span>
                                                                                </h3>
                                                                                <p class="elementor-icon-box-description">
                                                                                    Lorem ipsum is simply free text dolor sit but the majority have suffered amet, consectetur notted.					</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </section>
                                                <?php *//* ?>
                                                <section class="elementor-section elementor-top-section elementor-element elementor-element-c106a42 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="c106a42" data-element_type="section">
                                                    <div class="elementor-container elementor-column-gap-default">
                                                        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-cc66066" data-id="cc66066" data-element_type="column">
                                                            <div class="elementor-widget-wrap elementor-element-populated">
                                                                <div class="elementor-element elementor-element-e0fd07d elementor-widget elementor-widget-gva-heading-block" data-id="e0fd07d" data-element_type="widget" data-widget_type="gva-heading-block.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="gva-element-gva-heading-block gva-element">   <div class="align-center style-1 widget gsc-heading box-align-center auto-responsive">
                                                                                <div class="content-inner">
                                                                                    <div class="sub-title">
                                                                                        <span class="tagline"> .. Feature Places ..</span> 
                                                                                    </div>


                                                                                    <h2 class="title">
                                                                                        <span>Explore By Destination</span>
                                                                                    </h2>


                                                                                </div>
                                                                            </div>
                                                                        </div>		</div>
                                                                </div>
                                                                <div class="elementor-element elementor-element-2bf8d62 elementor-widget elementor-widget-gva-listings-banner-group" data-id="2bf8d62" data-element_type="widget" data-widget_type="gva-listings-banner-group.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="gva-element-gva-listings-banner-group gva-element">
                                                                            <div class="gsc-listings-banner-group layout-carousel swiper-slider-wrapper style-1">
                                                                                <div class="swiper-content-inner">
                                                                                    <div class="init-carousel-swiper swiper" data-carousel="{&quot;items&quot;:4,&quot;items_lg&quot;:4,&quot;items_md&quot;:3,&quot;items_sm&quot;:2,&quot;items_xs&quot;:2,&quot;items_xx&quot;:1,&quot;effect&quot;:&quot;slide&quot;,&quot;space_between&quot;:30,&quot;loop&quot;:1,&quot;speed&quot;:600,&quot;autoplay&quot;:1,&quot;autoplay_delay&quot;:4500,&quot;autoplay_hover&quot;:1,&quot;navigation&quot;:1,&quot;pagination&quot;:1,&quot;dynamic_bullets&quot;:0,&quot;pagination_type&quot;:&quot;bullets&quot;}">
                                                                                        <div class="swiper-wrapper">
                                                                                            <div class="swiper-slide">
                                                                                                <div class="item listings-banner-item">
                                                                                                    <div class="listings-banner-item-content">

                                                                                                        <span class="number-listings">9 Listings</span>
                                                                                                        <div class="banner-image">
                                                                                                            <img decoding="async" src="<?php echo base_url(BASE_WEB_IMAGES_PATH."banner-1.jpg") ?>" alt="London" />
                                                                                                        </div>

                                                                                                        <div class="banner-content">
                                                                                                            <div class="subtitle">Places in</div><h3 class="title">London</h3><a class="link-term" href="#"><i class="arrow fa-solid fa fa-arrow-right"></i></a>      </div>

                                                                                                        <a class="link-term-overlay" href="region/new-york/index.html" ></a>

                                                                                                    </div>
                                                                                                </div></div><div class="swiper-slide">
                                                                                                <div class="item listings-banner-item">
                                                                                                    <div class="listings-banner-item-content">

                                                                                                        <span class="number-listings">1 Listing</span>
                                                                                                        <div class="banner-image">
                                                                                                            <img decoding="async" src="<?php echo base_url(BASE_WEB_IMAGES_PATH."banner-2.jpg") ?>" alt="Dubai" />
                                                                                                        </div>

                                                                                                        <div class="banner-content">
                                                                                                            <div class="subtitle">Enjoy in</div><h3 class="title">Dubai</h3><a class="link-term" href="#"><i class="arrow fa-solid fa fa-arrow-right"></i></a>      </div>

                                                                                                        <a class="link-term-overlay" href="region/chicago/index.html" ></a>

                                                                                                    </div>
                                                                                                </div></div><div class="swiper-slide">
                                                                                                <div class="item listings-banner-item">
                                                                                                    <div class="listings-banner-item-content">

                                                                                                        <span class="number-listings">1 Listing</span>
                                                                                                        <div class="banner-image">
                                                                                                            <img decoding="async" src="<?php echo base_url(BASE_WEB_IMAGES_PATH."banner-3.jpg") ?>" alt="Turkey" />
                                                                                                        </div>

                                                                                                        <div class="banner-content">
                                                                                                            <div class="subtitle">Travel to</div><h3 class="title">Turkey</h3><a class="link-term" href="#"><i class="arrow fa-solid fa fa-arrow-right"></i></a>      </div>

                                                                                                        <a class="link-term-overlay" href="region/blackpool/index.html" ></a>

                                                                                                    </div>
                                                                                                </div></div><div class="swiper-slide">
                                                                                                <div class="item listings-banner-item">
                                                                                                    <div class="listings-banner-item-content">

                                                                                                        <span class="number-listings">1 Listing</span>
                                                                                                        <div class="banner-image">
                                                                                                            <img decoding="async" src="<?php echo base_url(BASE_WEB_IMAGES_PATH."banner-4.jpg") ?>" alt="New York" />
                                                                                                        </div>

                                                                                                        <div class="banner-content">
                                                                                                            <div class="subtitle">Eat in</div><h3 class="title">New York</h3><a class="link-term" href="#"><i class="arrow fa-solid fa fa-arrow-right"></i></a>      </div>

                                                                                                        <a class="link-term-overlay" href="region/chicago/index.html" ></a>

                                                                                                    </div>
                                                                                                </div></div>         </div>
                                                                                    </div>      
                                                                                </div>
                                                                                <div class="swiper-pagination"></div>   <div class="swiper-nav-next"></div><div class="swiper-nav-prev"></div> 
                                                                            </div>
                                                                        </div>		</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                <?php */ ?>
                                                <?php /* ?>
                                                <section class="elementor-section elementor-top-section elementor-element elementor-element-7248457 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="7248457" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                                    <div class="elementor-container elementor-column-gap-default">
                                                        <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-d8e18bb" data-id="d8e18bb" data-element_type="column">
                                                            <div class="elementor-widget-wrap elementor-element-populated">
                                                                <div class="elementor-element elementor-element-bbc812b elementor-widget elementor-widget-image" data-id="bbc812b" data-element_type="widget" data-widget_type="image.default">
                                                                    <div class="elementor-widget-container">
                                                                        <img decoding="async" width="361" height="666" src="<?php echo base_url(BASE_WEB_IMAGES_PATH."image-app.png") ?>" class="attachment-full size-full wp-image-1467" alt="" loading="lazy" />															</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="elementor-column elementor-col-66 elementor-top-column elementor-element elementor-element-e07d049" data-id="e07d049" data-element_type="column">
                                                            <div class="elementor-widget-wrap elementor-element-populated">
                                                                <div class="elementor-element elementor-element-58e887c elementor-widget__width-auto elementor-widget elementor-widget-gva-icon-box-styles" data-id="58e887c" data-element_type="widget" data-widget_type="gva-icon-box-styles.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="gva-element-gva-icon-box-styles gva-element">

                                                                            <div class="widget gsc-icon-box-styles style-2 ">
                                                                                <div class="icon-box-content">
                                                                                    <div class="icon-inner">
                                                                                        <span class="box-icon">
                                                                                            <i aria-hidden="true" class="fab fa-google-play"></i>                     </span>
                                                                                    </div>
                                                                                    <div class="box-content">
                                                                                        <span class="sub-title">Get it on</span><h3 class="title">Google Play</h3>               
                                                                                    </div>
                                                                                </div> 
                                                                                <a href="wp/fioxen/about/" class="link-overlay">
                                                                                </a>
                                                                            </div>   


                                                                        </div>		
                                                                    </div>
                                                                </div>
                                                                <div class="elementor-element elementor-element-f8546c4 elementor-widget__width-auto elementor-widget elementor-widget-gva-icon-box-styles" data-id="f8546c4" data-element_type="widget" data-widget_type="gva-icon-box-styles.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="gva-element-gva-icon-box-styles gva-element">

                                                                            <div class="widget gsc-icon-box-styles style-2 ">
                                                                                <div class="icon-box-content">
                                                                                    <div class="icon-inner">
                                                                                        <span class="box-icon">
                                                                                            <i aria-hidden="true" class="fab fa-apple"></i>                     </span>
                                                                                    </div>
                                                                                    <div class="box-content">
                                                                                        <span class="sub-title">Get it on</span><h3 class="title">App Store</h3>               
                                                                                    </div>
                                                                                </div> 
                                                                                <a href="wp/fioxen/about/" class="link-overlay">
                                                                                </a>
                                                                            </div>   


                                                                        </div>		
                                                                    </div>
                                                                </div>
                                                                <div class="elementor-element elementor-element-72e926a elementor-widget elementor-widget-gva-heading-block" data-id="72e926a" data-element_type="widget" data-widget_type="gva-heading-block.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="gva-element-gva-heading-block gva-element">   <div class="align-left style-1 widget gsc-heading box-align-left auto-responsive">
                                                                                <div class="content-inner">

                                                                                    <h2 class="title">
                                                                                        <span>Fioxen is a World Online Tour Booking Platform</span>
                                                                                    </h2>
                                                                                    <div class="title-desc">Join us! Our members can access savings of up to 50% and earn Trip Coins while booking.</div>


                                                                                </div>
                                                                            </div>
                                                                        </div>		
                                                                    </div>
                                                                </div>
                                                                
                                                                <section class="elementor-section elementor-inner-section elementor-element elementor-element-62a8db6 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="62a8db6" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                                                    <div class="elementor-container elementor-column-gap-default">
                                                                        <div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-da40b39" data-id="da40b39" data-element_type="column">
                                                                            <div class="elementor-widget-wrap elementor-element-populated">
                                                                                <div class="elementor-element elementor-element-70c39f9 elementor-widget elementor-widget-gva-counter" data-id="70c39f9" data-element_type="widget" data-widget_type="gva-counter.default">
                                                                                    <div class="elementor-widget-container">
                                                                                        <div class="gva-element-gva-counter gva-element">
                                                                                            <div class="widget milestone-block style-1">
                                                                                                <div class="box-content">
                                                                                                    <div class="milestone-content">

                                                                                                        <div class="sub-title">Member</div><h3 class="milestone-text">Professional</h3>
                                                                                                        <div class="milestone-number-inner">
                                                                                                            <span class="milestone-number">220</span>
                                                                                                            <span class="symbol after">+</span>               </div>

                                                                                                    </div>


                                                                                                </div>   
                                                                                            </div> 


                                                                                        </div>		</div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-6fabd4a" data-id="6fabd4a" data-element_type="column">
                                                                            <div class="elementor-widget-wrap elementor-element-populated">
                                                                                <div class="elementor-element elementor-element-380b5fd elementor-widget__width-auto elementor-widget elementor-widget-gva-counter" data-id="380b5fd" data-element_type="widget" data-widget_type="gva-counter.default">
                                                                                    <div class="elementor-widget-container">
                                                                                        <div class="gva-element-gva-counter gva-element">
                                                                                            <div class="widget milestone-block style-1">
                                                                                                <div class="box-content">
                                                                                                    <div class="milestone-content">

                                                                                                        <div class="sub-title">Listing</div><h3 class="milestone-text">Received</h3>
                                                                                                        <div class="milestone-number-inner">
                                                                                                            <span class="milestone-number">72</span>
                                                                                                            <span class="symbol after">k +</span>               </div>

                                                                                                    </div>


                                                                                                </div>   
                                                                                            </div> 


                                                                                        </div>		</div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-e67b50b" data-id="e67b50b" data-element_type="column">
                                                                            <div class="elementor-widget-wrap elementor-element-populated">
                                                                                <div class="elementor-element elementor-element-a1d9d5c elementor-widget__width-auto elementor-widget elementor-widget-gva-counter" data-id="a1d9d5c" data-element_type="widget" data-widget_type="gva-counter.default">
                                                                                    <div class="elementor-widget-container">
                                                                                        <div class="gva-element-gva-counter gva-element">
                                                                                            <div class="widget milestone-block style-1">
                                                                                                <div class="box-content">
                                                                                                    <div class="milestone-content">

                                                                                                        <div class="sub-title">Client</div><h3 class="milestone-text">Satisfaction</h3>
                                                                                                        <div class="milestone-number-inner">
                                                                                                            <span class="milestone-number">50</span>
                                                                                                            <span class="symbol after">k +</span>               </div>

                                                                                                    </div>


                                                                                                </div>   
                                                                                            </div> 


                                                                                        </div>		</div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </section>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                <?php */ ?>
                                                <?php /* ?>
                                                <section class="elementor-section elementor-top-section elementor-element elementor-element-1b0fae3 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="1b0fae3" data-element_type="section">
                                                    <div class="elementor-container elementor-column-gap-default">
                                                        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-f8e60d3" data-id="f8e60d3" data-element_type="column">
                                                            <div class="elementor-widget-wrap elementor-element-populated">
                                                                <div class="elementor-element elementor-element-a62ba88 animated-fast elementor-invisible elementor-widget elementor-widget-gva-heading-block" data-id="a62ba88" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="gva-heading-block.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="gva-element-gva-heading-block gva-element">   <div class="align-center style-1 widget gsc-heading box-align-center auto-responsive">
                                                                                <div class="content-inner">



                                                                                    <div class="sub-title">
                                                                                        <span class="tagline"> .. Check the List ..</span> 
                                                                                    </div>


                                                                                    <h2 class="title">
                                                                                        <span>Popular Destination</span>
                                                                                    </h2>


                                                                                </div>
                                                                            </div>
                                                                        </div>		</div>
                                                                </div>
                                                                <div class="elementor-element elementor-element-f70c2f2 elementor-widget elementor-widget-gva-listings" data-id="f70c2f2" data-element_type="widget" data-widget_type="gva-listings.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="gva-element-gva-listings gva-element">
                                                                            <div class="allitem-listing listings-carousel swiper-slider-wrapper ">
                                                                                <div class="swiper-content-inner">
                                                                                    <div class="init-carousel-swiper swiper" data-carousel="{&quot;items&quot;:3,&quot;items_lg&quot;:3,&quot;items_md&quot;:2,&quot;items_sm&quot;:2,&quot;items_xs&quot;:1,&quot;items_xx&quot;:1,&quot;effect&quot;:&quot;slide&quot;,&quot;space_between&quot;:30,&quot;loop&quot;:1,&quot;speed&quot;:600,&quot;autoplay&quot;:1,&quot;autoplay_delay&quot;:4500,&quot;autoplay_hover&quot;:1,&quot;navigation&quot;:1,&quot;pagination&quot;:0,&quot;dynamic_bullets&quot;:0,&quot;pagination_type&quot;:&quot;bullets&quot;}">
                                                                                        <div class="swiper-wrapper">
                                                                                            <div class="swiper-slide">
                                                                                                <div class="listing-block-2 post-650 job_listing type-job_listing status-publish has-post-thumbnail hentry job_listing_category-traveling job_listing_type-full-time job_listing_amenity-car-parking job_listing_amenity-elevator job_listing_amenity-free-coupons job_listing_amenity-outdoor-seating job_listing_amenity-pet-friendly job_listing_amenity-reservations job_listing_amenity-security-cameras job_listing_amenity-smoking-allowed job_listing_amenity-wheelchair-accesible job_listing_region-new-york job_listing_region-united-states job_listing_tag-food job_listing_tag-home-delivery job_listing_tag-restaurant job_listing_tag-shopping job_listing_tag-traving job-type-full-time job_position_featured">

                                                                                                    <div class="listing-image">
                                                                                                        <img width="600" height="540" src="<?php echo base_url(BASE_WEB_IMAGES_PATH."listing-15-600x540.jpg") ?>" class="attachment-medium size-medium wp-post-image" alt="Novotel London Canary" decoding="async" loading="lazy" />      
                                                                                                        <div class="listing-time closed">Closed</div>


                                                                                                        <div class="wishlist-icon-content">
                                                                                                            <a href="#" data-post_id="650" class="ajax-wishlist-link wishlist-add" title="Wishlist">
                                                                                                                <i class="icon far fa-heart"></i>
                                                                                                            </a>
                                                                                                        </div> 
                                                                                                        <div class="listing-logo"><img decoding="async" src="<?php echo base_url(BASE_WEB_IMAGES_PATH."logo-listing-6.jpg") ?>" alt="Novotel London Canary" /></div>

                                                                                                        <div class="lt-featured d-none"><span>Featured</span></div>


                                                                                                        <a href="job/novotel-london-canary/index.html" class="link-overlay"></a>
                                                                                                    </div>   

                                                                                                    <div class="listing-content">
                                                                                                        <div class="content-inner">
                                                                                                            <h3 class="title"><a href="job/novotel-london-canary/index.html">Novotel London Canary</a></h3>

                                                                                                            <div class="listing-tagline">Modern Hair Style Salon</div>


                                                                                                            <div class="listing-meta">
                                                                                                                <div class="location">          
                                                                                                                    <i class="icon fas fa-map-marker-alt"></i>
                                                                                                                    <span class="regions">
                                                                                                                        <a href="region/new-york/index.html">New York</a>
                                                                                                                        <span>,&nbsp;</span><a href="region/united-states/index.html">United States</a>
                                                                                                                    </span>
                                                                                                                </div>


                                                                                                                <div class="phone"><i class="icon fas fa-phone-alt"></i><a href="tel:+84-666-888-99">+84-666-888-99</a></div>


                                                                                                            </div>    

                                                                                                            <div class="content-footer clearfix">
                                                                                                                <div class="lt_block-category">
                                                                                                                    <div class="cat-item first-cat"><a href="job-category/traveling/index.html"><span class="icon"><i class="las la-tram"></i></span><span class="cat-name">Traveling</span></a></div>            </div>

                                                                                                                <div class="lt-review-show-start"><div class="review-results"><div class="base-stars"><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span></div><div class="votes-stars" style="width: 86%;"><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span></div></div></div>   


                                                                                                            </div> 
                                                                                                        </div>   
                                                                                                    </div> 



                                                                                                </div>

                                                                                            </div><div class="swiper-slide">
                                                                                                <div class="listing-block-2 post-649 job_listing type-job_listing status-publish has-post-thumbnail hentry job_listing_category-traveling job_listing_type-freelance job_listing_amenity-accepts-credit-cards job_listing_amenity-accessories job_listing_amenity-alarm-system job_listing_amenity-car-parking job_listing_amenity-elevator job_listing_amenity-free-coupons job_listing_amenity-outdoor-seating job_listing_amenity-smoking-allowed job_listing_amenity-wireless-internet job_listing_region-new-york job_listing_region-united-states job_listing_tag-food job_listing_tag-home-delivery job_listing_tag-restaurant job_listing_tag-shopping job_listing_tag-traving job-type-freelance">

                                                                                                    <div class="listing-image">
                                                                                                        <img width="600" height="540" src="<?php echo base_url(BASE_WEB_IMAGES_PATH."listing-14-600x540.jpg") ?>" class="attachment-medium size-medium wp-post-image" alt="Cibo Fresco" decoding="async" loading="lazy" />      
                                                                                                        <div class="listing-time closed">Closed</div>


                                                                                                        <div class="wishlist-icon-content">
                                                                                                            <a href="#" data-post_id="649" class="ajax-wishlist-link wishlist-add" title="Wishlist">
                                                                                                                <i class="icon far fa-heart"></i>
                                                                                                            </a>
                                                                                                        </div> 
                                                                                                        <div class="listing-logo"><img decoding="async" src="<?php echo base_url(BASE_WEB_IMAGES_PATH."logo-listing-5.jpg") ?>" alt="Cibo Fresco" /></div>



                                                                                                        <a href="job/cibo-fresco/index.html" class="link-overlay"></a>
                                                                                                    </div>   

                                                                                                    <div class="listing-content">
                                                                                                        <div class="content-inner">
                                                                                                            <h3 class="title"><a href="job/cibo-fresco/index.html">Cibo Fresco</a></h3>

                                                                                                            <div class="listing-tagline">Super Clean &amp; Cool Food Corner</div>


                                                                                                            <div class="listing-meta">
                                                                                                                <div class="location">          
                                                                                                                    <i class="icon fas fa-map-marker-alt"></i>
                                                                                                                    <span class="regions">
                                                                                                                        <a href="region/new-york/index.html">New York</a>
                                                                                                                        <span>,&nbsp;</span><a href="region/united-states/index.html">United States</a>
                                                                                                                    </span>
                                                                                                                </div>


                                                                                                                <div class="phone"><i class="icon fas fa-phone-alt"></i><a href="tel:+84-666-888-99">+84-666-888-99</a></div>


                                                                                                            </div>    

                                                                                                            <div class="content-footer clearfix">
                                                                                                                <div class="lt_block-category">
                                                                                                                    <div class="cat-item first-cat"><a href="job-category/traveling/index.html"><span class="icon"><i class="las la-tram"></i></span><span class="cat-name">Traveling</span></a></div>            </div>

                                                                                                                <div class="lt-review-show-start"><div class="review-results"><div class="base-stars"><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span></div><div class="votes-stars" style="width: 80%;"><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span></div></div></div>   


                                                                                                            </div> 
                                                                                                        </div>   
                                                                                                    </div> 



                                                                                                </div>

                                                                                            </div><div class="swiper-slide">
                                                                                                <div class="listing-block-2 post-648 job_listing type-job_listing status-publish has-post-thumbnail hentry job_listing_category-restaurants job_listing_category-shopping job_listing_amenity-accessories job_listing_amenity-alarm-system job_listing_amenity-car-parking job_listing_amenity-elevator job_listing_amenity-free-coupons job_listing_amenity-pet-friendly job_listing_amenity-reservations job_listing_amenity-wheelchair-accesible job_listing_amenity-wireless-internet job_listing_region-new-york job_listing_region-united-states job_listing_tag-food job_listing_tag-home-delivery job_listing_tag-restaurant job_listing_tag-shopping job_listing_tag-traving">

                                                                                                    <div class="listing-image">
                                                                                                        <img width="600" height="540" src="<?php echo base_url(BASE_WEB_IMAGES_PATH."listing-13-600x540.jpg") ?>" class="attachment-medium size-medium wp-post-image" alt="The Burger Joint" decoding="async" loading="lazy" />      
                                                                                                        <div class="listing-time closed">Closed</div>


                                                                                                        <div class="wishlist-icon-content">
                                                                                                            <a href="#" data-post_id="648" class="ajax-wishlist-link wishlist-add" title="Wishlist">
                                                                                                                <i class="icon far fa-heart"></i>
                                                                                                            </a>
                                                                                                        </div> 
                                                                                                        <div class="listing-logo"><img decoding="async" src="<?php echo base_url(BASE_WEB_IMAGES_PATH."logo-listing-4.jpg") ?>" alt="The Burger Joint" /></div>



                                                                                                        <a href="job/the-burger-joint/index.html" class="link-overlay"></a>
                                                                                                    </div>   

                                                                                                    <div class="listing-content">
                                                                                                        <div class="content-inner">
                                                                                                            <h3 class="title"><a href="job/the-burger-joint/index.html">The Burger Joint</a></h3>

                                                                                                            <div class="listing-tagline">Super Clean &amp; Cool Food Corner</div>


                                                                                                            <div class="listing-meta">
                                                                                                                <div class="location">          
                                                                                                                    <i class="icon fas fa-map-marker-alt"></i>
                                                                                                                    <span class="regions">
                                                                                                                        <a href="region/new-york/index.html">New York</a>
                                                                                                                        <span>,&nbsp;</span><a href="region/united-states/index.html">United States</a>
                                                                                                                    </span>
                                                                                                                </div>


                                                                                                                <div class="phone"><i class="icon fas fa-phone-alt"></i><a href="tel:+84-666-888-99">+84-666-888-99</a></div>


                                                                                                            </div>    

                                                                                                            <div class="content-footer clearfix">
                                                                                                                <div class="lt_block-category">
                                                                                                                    <div class="cat-item first-cat"><a href="job-category/restaurants/index.html"><span class="icon"><i class="la la-cutlery"></i></span><span class="cat-name">Restaurants</span></a></div><div class="more-cat"><div class="more-cat-number">+1</div><div class="more-cat-content"><div class="cat-item "><a href="job-category/shopping/index.html"><span class="icon"><i class="la la-shopping-cart"></i></span><span class="cat-name">Shopping</span></a></div></div></div>            </div>

                                                                                                                <div class="lt-review-show-start"><div class="review-results"><div class="base-stars"><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span></div><div class="votes-stars" style="width: 76%;"><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span></div></div></div>   


                                                                                                            </div> 
                                                                                                        </div>   
                                                                                                    </div> 



                                                                                                </div>

                                                                                            </div><div class="swiper-slide">
                                                                                                <div class="listing-block-2 post-647 job_listing type-job_listing status-publish has-post-thumbnail hentry job_listing_category-party-center job_listing_category-traveling job_listing_amenity-accessories job_listing_amenity-car-parking job_listing_amenity-free-coupons job_listing_amenity-pet-friendly job_listing_amenity-reservations job_listing_amenity-security-cameras job_listing_amenity-smoking-allowed job_listing_amenity-wheelchair-accesible job_listing_amenity-wireless-internet job_listing_region-new-york job_listing_region-united-states job_listing_tag-food job_listing_tag-home-delivery job_listing_tag-restaurant job_listing_tag-shopping job_listing_tag-traving">

                                                                                                    <div class="listing-image">
                                                                                                        <img width="600" height="540" src="<?php echo base_url(BASE_WEB_IMAGES_PATH."listing-12-600x540.jpg") ?>" class="attachment-medium size-medium wp-post-image" alt="The Pastry Corner" decoding="async" loading="lazy" />      
                                                                                                        <div class="listing-time closed">Closed</div>


                                                                                                        <div class="wishlist-icon-content">
                                                                                                            <a href="#" data-post_id="647" class="ajax-wishlist-link wishlist-add" title="Wishlist">
                                                                                                                <i class="icon far fa-heart"></i>
                                                                                                            </a>
                                                                                                        </div> 
                                                                                                        <div class="listing-logo"><img decoding="async" src="<?php echo base_url(BASE_WEB_IMAGES_PATH."logo-listing-3.jpg") ?>" alt="The Pastry Corner" /></div>



                                                                                                        <a href="job/the-pastry-corner/index.html" class="link-overlay"></a>
                                                                                                    </div>   

                                                                                                    <div class="listing-content">
                                                                                                        <div class="content-inner">
                                                                                                            <h3 class="title"><a href="job/the-pastry-corner/index.html">The Pastry Corner</a></h3>

                                                                                                            <div class="listing-tagline">One of the best Restaurant</div>


                                                                                                            <div class="listing-meta">
                                                                                                                <div class="location">          
                                                                                                                    <i class="icon fas fa-map-marker-alt"></i>
                                                                                                                    <span class="regions">
                                                                                                                        <a href="region/new-york/index.html">New York</a>
                                                                                                                        <span>,&nbsp;</span><a href="region/united-states/index.html">United States</a>
                                                                                                                    </span>
                                                                                                                </div>


                                                                                                                <div class="phone"><i class="icon fas fa-phone-alt"></i><a href="tel:+84-666-888-99">+84-666-888-99</a></div>


                                                                                                            </div>    

                                                                                                            <div class="content-footer clearfix">
                                                                                                                <div class="lt_block-category">
                                                                                                                    <div class="cat-item first-cat"><a href="job-category/party-center/index.html"><span class="icon"><i class="la la-glass"></i></span><span class="cat-name">Party Center</span></a></div><div class="more-cat"><div class="more-cat-number">+1</div><div class="more-cat-content"><div class="cat-item "><a href="job-category/traveling/index.html"><span class="icon"><i class="las la-tram"></i></span><span class="cat-name">Traveling</span></a></div></div></div>            </div>

                                                                                                                <div class="lt-review-show-start"><div class="review-results"><div class="base-stars"><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span></div><div class="votes-stars" style="width: 80%;"><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span><span><i class="star dashicons dashicons-star-filled la la-star"></i></span></div></div></div>   


                                                                                                            </div> 
                                                                                                        </div>   
                                                                                                    </div> 



                                                                                                </div>

                                                                                            </div>			</div>
                                                                                    </div>		
                                                                                </div>
                                                                                <div class="swiper-pagination"></div>	<div class="swiper-nav-next"></div><div class="swiper-nav-prev"></div> 
                                                                            </div>

                                                                        </div>		</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                <?php */ ?>
                                                <?php /* ?>
                                                <section class="elementor-section elementor-top-section elementor-element elementor-element-4f5b100 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="4f5b100" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                                    <div class="elementor-container elementor-column-gap-default">
                                                        <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-da97dca" data-id="da97dca" data-element_type="column">
                                                            <div class="elementor-widget-wrap elementor-element-populated">
                                                                <div class="elementor-element elementor-element-e447ee7 elementor-widget__width-auto elementor-widget elementor-widget-gva-video-box" data-id="e447ee7" data-element_type="widget" data-widget_type="gva-video-box.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="gva-element-gva-video-box gva-element">

                                                                            <div class="widget gsc-video-box clearfix style-2">
                                                                                <div class="video-inner">
                                                                                    <div class="video-content">
                                                                                        <div class="video-action">
                                                                                            <a href="https://www.youtube.com/watch?v=8PNTZEv-e54" class="popup-video"><span><i class="fa fa-play"></i></span></a>  
                                                                                        </div>
                                                                                        <div class="title">Play Video</div>
                                                                                    </div>    
                                                                                </div>
                                                                            </div> 



                                                                        </div>		</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-d069488" data-id="d069488" data-element_type="column">
                                                            <div class="elementor-widget-wrap elementor-element-populated">
                                                                <div class="elementor-element elementor-element-6acbb1b elementor-widget elementor-widget-gva-heading-block" data-id="6acbb1b" data-element_type="widget" data-widget_type="gva-heading-block.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="gva-element-gva-heading-block gva-element">   <div class="align-left style-1 widget gsc-heading box-align-left auto-responsive">
                                                                                <div class="content-inner">



                                                                                    <div class="sub-title">
                                                                                        <span class="tagline">Checkout List ..</span> 
                                                                                    </div>


                                                                                    <h2 class="title">
                                                                                        <span>Professional planners
                                                                                            for your vacation</span>
                                                                                    </h2>
                                                                                    <div class="title-desc">Risus urnas Iaculis per amet vestibulum luctus tincidunt ultricies aenean
                                                                                        quam eros eleifend sodales cubilia mattis quam.</div>

                                                                                    <div class="heading-action">
                                                                                        <a href="wp/fioxen/listings/" class="btn-cta btn-theme-2 ">
                                                                                            <span>Explore List +</span>
                                                                                        </a>

                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>		</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                <?php */ ?>
                                                <?php /* ?>
                                                <section class="elementor-section elementor-top-section elementor-element elementor-element-a6b2848 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="a6b2848" data-element_type="section">
                                                    <div class="elementor-container elementor-column-gap-default">
                                                        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-4709e6d" data-id="4709e6d" data-element_type="column">
                                                            <div class="elementor-widget-wrap elementor-element-populated">
                                                                <section class="elementor-section elementor-inner-section elementor-element elementor-element-b63a4b7 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="b63a4b7" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                                                    <div class="elementor-container elementor-column-gap-default">
                                                                        <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-6f21872" data-id="6f21872" data-element_type="column">
                                                                            <div class="elementor-widget-wrap elementor-element-populated">
                                                                                <div class="elementor-element elementor-element-34f0733 elementor-position-left elementor-vertical-align-middle icon-box-left elementor-view-default elementor-mobile-position-top elementor-widget elementor-widget-icon-box" data-id="34f0733" data-element_type="widget" data-widget_type="icon-box.default">
                                                                                    <div class="elementor-widget-container">
                                                                                        <div class="elementor-icon-box-wrapper">
                                                                                            <div class="elementor-icon-box-icon">
                                                                                                <span class="elementor-icon elementor-animation-" >
                                                                                                    <i aria-hidden="true" class=" flaticon2-email-3"></i>				</span>
                                                                                            </div>
                                                                                            <div class="elementor-icon-box-content">
                                                                                                <h3 class="elementor-icon-box-title">
                                                                                                    <span  >
                                                                                                        Get Special Rewards					</span>
                                                                                                </h3>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-adde38e" data-id="adde38e" data-element_type="column">
                                                                            <div class="elementor-widget-wrap elementor-element-populated">
                                                                                <div class="elementor-element elementor-element-cb1f15a elementor-widget elementor-widget-shortcode" data-id="cb1f15a" data-element_type="widget" data-widget_type="shortcode.default">
                                                                                    <div class="elementor-widget-container">
                                                                                        <div class="elementor-shortcode"><script>(function () {
                                                                                                window.mc4wp = window.mc4wp || {
                                                                                                    listeners: [],
                                                                                                    forms: {
                                                                                                        on: function (evt, cb) {
                                                                                                            window.mc4wp.listeners.push(
                                                                                                                    {
                                                                                                                        event: evt,
                                                                                                                        callback: cb
                                                                                                                    }
                                                                                                            );
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                            })();
                                                                                            </script><!-- Mailchimp for WordPress v4.9.1 - https://wordpress.org/plugins/mailchimp-for-wp/ --><form id="mc4wp-form-1" class="mc4wp-form mc4wp-form-199" method="post" data-id="199" data-name="Newsletter" ><div class="mc4wp-form-fields"><div class="newsletter-form">
                                                                                                        <div class="content-form">
                                                                                                            <input type="email" name="EMAIL" placeholder="Email address" required />
                                                                                                            <input class="newsletter-submit" type="submit" value="Subscribe +" />
                                                                                                        </div>
                                                                                                    </div></div><label style="display: none !important;">Leave this field empty if you're human: <input type="text" name="_mc4wp_honeypot" value="" tabindex="-1" autocomplete="off" /></label><input type="hidden" name="_mc4wp_timestamp" value="1676199438" /><input type="hidden" name="_mc4wp_form_id" value="199" /><input type="hidden" name="_mc4wp_form_element_id" value="mc4wp-form-1" /><div class="mc4wp-response"></div></form><!-- / Mailchimp for WordPress Plugin --></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </section>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                <?php */ ?>
                                                <?php /* ?>
                                                <section class="elementor-section elementor-top-section elementor-element elementor-element-31288bf elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="31288bf" data-element_type="section">
                                                    <div class="elementor-container elementor-column-gap-default">
                                                        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-83a7d8e" data-id="83a7d8e" data-element_type="column">
                                                            <div class="elementor-widget-wrap elementor-element-populated">
                                                                <div class="elementor-element elementor-element-cb8892f elementor-widget elementor-widget-gva-brand" data-id="cb8892f" data-element_type="widget" data-widget_type="gva-brand.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="gva-element-gva-brand gva-element">
                                                                            <div class="gva-brand-carousel style-1 ">
                                                                                <div class="swiper-content-inner">
                                                                                    <div class="init-carousel-swiper swiper" data-carousel="{&quot;items&quot;:5,&quot;items_lg&quot;:5,&quot;items_md&quot;:4,&quot;items_sm&quot;:3,&quot;items_xs&quot;:2,&quot;items_xx&quot;:2,&quot;effect&quot;:&quot;slide&quot;,&quot;space_between&quot;:30,&quot;loop&quot;:1,&quot;speed&quot;:600,&quot;autoplay&quot;:1,&quot;autoplay_delay&quot;:4500,&quot;autoplay_hover&quot;:1,&quot;navigation&quot;:1,&quot;pagination&quot;:0,&quot;dynamic_bullets&quot;:0,&quot;pagination_type&quot;:&quot;bullets&quot;}">
                                                                                        <div class="swiper-wrapper">

                                                                                            <div class="swiper-slide item brand-item"><div class="brand-item-content"><div class="brand-item-image"><img decoding="async" src="<?php echo base_url(BASE_WEB_IMAGES_PATH."brand.png") ?>" alt="" class="brand-img"/></div></div></div><div class="swiper-slide item brand-item"><div class="brand-item-content"><div class="brand-item-image"><img decoding="async" src="<?php echo base_url(BASE_WEB_IMAGES_PATH."brand.png") ?>" alt="" class="brand-img"/></div></div></div><div class="swiper-slide item brand-item"><div class="brand-item-content"><div class="brand-item-image"><img decoding="async" src="<?php echo base_url(BASE_WEB_IMAGES_PATH."brand.png") ?>" alt="" class="brand-img"/></div></div></div><div class="swiper-slide item brand-item"><div class="brand-item-content"><div class="brand-item-image"><img decoding="async" src="<?php echo base_url(BASE_WEB_IMAGES_PATH."brand.png") ?>" alt="" class="brand-img"/></div></div></div><div class="swiper-slide item brand-item"><div class="brand-item-content"><div class="brand-item-image"><img decoding="async" src="<?php echo base_url(BASE_WEB_IMAGES_PATH."brand.png") ?>" alt="" class="brand-img"/></div></div></div><div class="swiper-slide item brand-item"><div class="brand-item-content"><div class="brand-item-image"><img decoding="async" src="<?php echo base_url(BASE_WEB_IMAGES_PATH."brand.png") ?>" alt="" class="brand-img"/></div></div></div>
                                                                                        </div>
                                                                                    </div>   
                                                                                </div>
                                                                                <div class="swiper-pagination"></div>   
                                                                                <div class="swiper-nav-next"></div>
                                                                                <div class="swiper-nav-prev"></div>
                                                                                
                                                                            </div>
                                                                        </div>		
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                <?php */ ?>
                                                <?php /* ?>
                                                <section class="elementor-section elementor-top-section elementor-element elementor-element-7bf2a097 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="7bf2a097" data-element_type="section">
                                                    <div class="elementor-container elementor-column-gap-default">
                                                        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-9176c9f" data-id="9176c9f" data-element_type="column">
                                                            <div class="elementor-widget-wrap elementor-element-populated">
                                                                <div class="elementor-element elementor-element-12054f2f animated-fast elementor-invisible elementor-widget elementor-widget-gva-heading-block" data-id="12054f2f" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="gva-heading-block.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="gva-element-gva-heading-block gva-element">   <div class="align-center style-1 widget gsc-heading box-align-center auto-responsive">
                                                                                <div class="content-inner">



                                                                                    <div class="sub-title">
                                                                                        <span class="tagline"> .. Recent Articles ..</span> 
                                                                                    </div>


                                                                                    <h2 class="title">
                                                                                        <span>Every Single Journal</span>
                                                                                    </h2>


                                                                                </div>
                                                                            </div>
                                                                        </div>		</div>
                                                                </div>
                                                                <div class="elementor-element elementor-element-de01d19 elementor-widget elementor-widget-gva-posts" data-id="de01d19" data-element_type="widget" data-widget_type="gva-posts.default">
                                                                    <div class="elementor-widget-container">
                                                                        <div class="gva-element-gva-posts gva-element">
                                                                            <div class="gva-posts-carousel gva-posts swiper-slider-wrapper " data-filter="hffh">
                                                                                <div class="swiper-content-inner">
                                                                                    <div class="init-carousel-swiper swiper" data-carousel="{&quot;items&quot;:3,&quot;items_lg&quot;:3,&quot;items_md&quot;:2,&quot;items_sm&quot;:2,&quot;items_xs&quot;:2,&quot;items_xx&quot;:2,&quot;effect&quot;:&quot;slide&quot;,&quot;space_between&quot;:30,&quot;loop&quot;:1,&quot;speed&quot;:600,&quot;autoplay&quot;:0,&quot;autoplay_delay&quot;:4500,&quot;autoplay_hover&quot;:1,&quot;navigation&quot;:1,&quot;pagination&quot;:0,&quot;dynamic_bullets&quot;:0,&quot;pagination_type&quot;:&quot;bullets&quot;}">
                                                                                        <div class="swiper-wrapper">
                                                                                            <div class="swiper-slide">
                                                                                                <article id="post-1" class="post post-style-1 post-1 type-post status-publish format-standard hentry category-uncategorized">



                                                                                                    <div class="entry-content has-no-thumbnail">
                                                                                                        <div class="content-inner">

                                                                                                            <div class="entry-meta">
                                                                                                                <div class="clearfix meta-inline post-meta-1"><span class="author vcard"><i class="far fa-user-circle"></i>sample@1</span><span class="post-comment"><i class="far fa-comments"></i>1 Comment</span></div>            </div>

                                                                                                            <h3 class="entry-title"><a href="2023/02/12/hello-world/index.html" rel="bookmark">Hello world!</a></h3>

                                                                                                            <div class="entry-desc">
                                                                                                                Welcome to WordPress. This is your first post. Edit or delete it, then start writing!               </div>   

                                                                                                            <div class="content-footer">
                                                                                                                <div class="entry-category"><span class="cat-links"><i class="las la-tags"></i><a href="category/uncategorized/index.html" rel="category tag">Uncategorized</a></span></div>               <div class="read-more">
                                                                                                                    <a href="2023/02/12/hello-world/index.html"><i class="arrow fa-solid fa fa-arrow-right"></i></a>
                                                                                                                </div>
                                                                                                            </div>   

                                                                                                        </div>
                                                                                                    </div>   
                                                                                                </article>   

                                                                                            </div><div class="swiper-slide">
                                                                                                <article id="post-48" class="post post-style-1 post-48 type-post status-publish format-standard has-post-thumbnail hentry category-tours-travel tag-adventure tag-beach tag-lifestyle">

                                                                                                    <div class="post-thumbnail">
                                                                                                        <a href="2020/12/08/top-8-amazing-places-to-stay-in-canada-with-map/index.html">
                                                                                                            <img width="580" height="410" src="<?php echo base_url(BASE_WEB_IMAGES_PATH."post-1-580x410.jpg") ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="Top 8 Amazing Places to Stay in Canada with Map" decoding="async" loading="lazy" />            </a>
                                                                                                        <div class="entry-date">
                                                                                                            <span class="date">08</span>
                                                                                                            <span class="month">Dec</span>
                                                                                                        </div>
                                                                                                    </div>   


                                                                                                    <div class="entry-content has-thumbnail">
                                                                                                        <div class="content-inner">

                                                                                                            <div class="entry-meta">
                                                                                                                <div class="clearfix meta-inline post-meta-1"><span class="author vcard"><i class="far fa-user-circle"></i>sample@1</span><span class="post-comment"><i class="far fa-comments"></i>3 Comments</span></div>            </div>

                                                                                                            <h3 class="entry-title"><a href="2020/12/08/top-8-amazing-places-to-stay-in-canada-with-map/index.html" rel="bookmark">Top 8 Amazing Places to Stay in Canada with Map</a></h3>

                                                                                                            <div class="entry-desc">
                                                                                                                There are many variations of but the majority have simply free text.               </div>   

                                                                                                            <div class="content-footer">
                                                                                                                <div class="entry-category"><span class="cat-links"><i class="las la-tags"></i><a href="category/tours-travel/index.html" rel="category tag">Tours &amp; Travel</a></span></div>               <div class="read-more">
                                                                                                                    <a href="2020/12/08/top-8-amazing-places-to-stay-in-canada-with-map/index.html"><i class="arrow fa-solid fa fa-arrow-right"></i></a>
                                                                                                                </div>
                                                                                                            </div>   

                                                                                                        </div>
                                                                                                    </div>   
                                                                                                </article>   

                                                                                            </div><div class="swiper-slide">
                                                                                                <article id="post-47" class="post post-style-1 post-47 type-post status-publish format-standard has-post-thumbnail hentry category-tours-travel tag-lifestyle tag-parks tag-tourisms">

                                                                                                    <div class="post-thumbnail">
                                                                                                        <a href="2020/12/08/attract-and-retain-quality-high-paying-customers-2/index.html">
                                                                                                            <img width="580" height="410" src="<?php echo base_url(BASE_WEB_IMAGES_PATH."post-2-580x410.jpg") ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="Attract and retain quality high paying customers" decoding="async" loading="lazy" />            </a>
                                                                                                        <div class="entry-date">
                                                                                                            <span class="date">08</span>
                                                                                                            <span class="month">Dec</span>
                                                                                                        </div>
                                                                                                    </div>   


                                                                                                    <div class="entry-content has-thumbnail">
                                                                                                        <div class="content-inner">

                                                                                                            <div class="entry-meta">
                                                                                                                <div class="clearfix meta-inline post-meta-1"><span class="author vcard"><i class="far fa-user-circle"></i>sample@1</span><span class="post-comment"><i class="far fa-comments"></i>0 Comments</span></div>            </div>

                                                                                                            <h3 class="entry-title"><a href="2020/12/08/attract-and-retain-quality-high-paying-customers-2/index.html" rel="bookmark">Attract and retain quality high paying customers</a></h3>

                                                                                                            <div class="entry-desc">
                                                                                                                There are many variations of but the majority have simply free text.               </div>   

                                                                                                            <div class="content-footer">
                                                                                                                <div class="entry-category"><span class="cat-links"><i class="las la-tags"></i><a href="category/tours-travel/index.html" rel="category tag">Tours &amp; Travel</a></span></div>               <div class="read-more">
                                                                                                                    <a href="2020/12/08/attract-and-retain-quality-high-paying-customers-2/index.html"><i class="arrow fa-solid fa fa-arrow-right"></i></a>
                                                                                                                </div>
                                                                                                            </div>   

                                                                                                        </div>
                                                                                                    </div>   
                                                                                                </article>   

                                                                                            </div><div class="swiper-slide">
                                                                                                <article id="post-46" class="post post-style-1 post-46 type-post status-publish format-standard has-post-thumbnail hentry category-job-feed tag-adventure tag-lifestyle tag-parks">

                                                                                                    <div class="post-thumbnail">
                                                                                                        <a href="2020/12/08/what-you-do-today-improve-your-tomorrows/index.html">
                                                                                                            <img width="580" height="410" src="<?php echo base_url(BASE_WEB_IMAGES_PATH."post-3-580x410.jpg") ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="What you do today improve your tomorrows" decoding="async" loading="lazy" />            </a>
                                                                                                        <div class="entry-date">
                                                                                                            <span class="date">08</span>
                                                                                                            <span class="month">Dec</span>
                                                                                                        </div>
                                                                                                    </div>   


                                                                                                    <div class="entry-content has-thumbnail">
                                                                                                        <div class="content-inner">

                                                                                                            <div class="entry-meta">
                                                                                                                <div class="clearfix meta-inline post-meta-1"><span class="author vcard"><i class="far fa-user-circle"></i>sample@1</span><span class="post-comment"><i class="far fa-comments"></i>0 Comments</span></div>            </div>

                                                                                                            <h3 class="entry-title"><a href="2020/12/08/what-you-do-today-improve-your-tomorrows/index.html" rel="bookmark">What you do today improve your tomorrows</a></h3>

                                                                                                            <div class="entry-desc">
                                                                                                                There are many variations of but the majority have simply free text.               </div>   

                                                                                                            <div class="content-footer">
                                                                                                                <div class="entry-category"><span class="cat-links"><i class="las la-tags"></i><a href="category/job-feed/index.html" rel="category tag">Job &amp; Feed</a></span></div>               <div class="read-more">
                                                                                                                    <a href="2020/12/08/what-you-do-today-improve-your-tomorrows/index.html"><i class="arrow fa-solid fa fa-arrow-right"></i></a>
                                                                                                                </div>
                                                                                                            </div>   

                                                                                                        </div>
                                                                                                    </div>   
                                                                                                </article>   

                                                                                            </div><div class="swiper-slide">
                                                                                                <article id="post-45" class="post post-style-1 post-45 type-post status-publish format-standard has-post-thumbnail hentry category-tours-travel tag-adventure tag-beach tag-tourisms">

                                                                                                    <div class="post-thumbnail">
                                                                                                        <a href="2020/12/08/money-markets-finding-the-best-accounts/index.html">
                                                                                                            <img width="580" height="410" src="<?php echo base_url(BASE_WEB_IMAGES_PATH."post-4-580x410.jpg") ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="Money markets finding the best accounts" decoding="async" loading="lazy" />            </a>
                                                                                                        <div class="entry-date">
                                                                                                            <span class="date">08</span>
                                                                                                            <span class="month">Dec</span>
                                                                                                        </div>
                                                                                                    </div>   


                                                                                                    <div class="entry-content has-thumbnail">
                                                                                                        <div class="content-inner">

                                                                                                            <div class="entry-meta">
                                                                                                                <div class="clearfix meta-inline post-meta-1"><span class="author vcard"><i class="far fa-user-circle"></i>sample@1</span><span class="post-comment"><i class="far fa-comments"></i>0 Comments</span></div>            </div>

                                                                                                            <h3 class="entry-title"><a href="2020/12/08/money-markets-finding-the-best-accounts/index.html" rel="bookmark">Money markets finding the best accounts</a></h3>

                                                                                                            <div class="entry-desc">
                                                                                                                There are many variations of but the majority have simply free text.               </div>   

                                                                                                            <div class="content-footer">
                                                                                                                <div class="entry-category"><span class="cat-links"><i class="las la-tags"></i><a href="category/tours-travel/index.html" rel="category tag">Tours &amp; Travel</a></span></div>               <div class="read-more">
                                                                                                                    <a href="2020/12/08/money-markets-finding-the-best-accounts/index.html"><i class="arrow fa-solid fa fa-arrow-right"></i></a>
                                                                                                                </div>
                                                                                                            </div>   

                                                                                                        </div>
                                                                                                    </div>   
                                                                                                </article>   

                                                                                            </div><div class="swiper-slide">
                                                                                                <article id="post-44" class="post post-style-1 post-44 type-post status-publish format-standard has-post-thumbnail hentry category-fitness-zone tag-beach tag-lifestyle tag-parks">

                                                                                                    <div class="post-thumbnail">
                                                                                                        <a href="2020/12/08/money-markets-rates-finding-the-best-accounts/index.html">
                                                                                                            <img width="580" height="410" src="<?php echo base_url(BASE_WEB_IMAGES_PATH."post-5-580x410.jpg") ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="Money markets rates finding the best accounts" decoding="async" loading="lazy" />            </a>
                                                                                                        <div class="entry-date">
                                                                                                            <span class="date">08</span>
                                                                                                            <span class="month">Dec</span>
                                                                                                        </div>
                                                                                                    </div>   


                                                                                                    <div class="entry-content has-thumbnail">
                                                                                                        <div class="content-inner">

                                                                                                            <div class="entry-meta">
                                                                                                                <div class="clearfix meta-inline post-meta-1"><span class="author vcard"><i class="far fa-user-circle"></i>sample@1</span><span class="post-comment"><i class="far fa-comments"></i>0 Comments</span></div>            </div>

                                                                                                            <h3 class="entry-title"><a href="2020/12/08/money-markets-rates-finding-the-best-accounts/index.html" rel="bookmark">Money markets rates finding the best accounts</a></h3>

                                                                                                            <div class="entry-desc">
                                                                                                                There are many variations of but the majority have simply free text.               </div>   

                                                                                                            <div class="content-footer">
                                                                                                                <div class="entry-category"><span class="cat-links"><i class="las la-tags"></i><a href="category/fitness-zone/index.html" rel="category tag">Fitness Zone</a></span></div>               <div class="read-more">
                                                                                                                    <a href="2020/12/08/money-markets-rates-finding-the-best-accounts/index.html"><i class="arrow fa-solid fa fa-arrow-right"></i></a>
                                                                                                                </div>
                                                                                                            </div>   

                                                                                                        </div>
                                                                                                    </div>   
                                                                                                </article>   

                                                                                            </div>				</div>
                                                                                    </div>	
                                                                                </div>	
                                                                                <div class="swiper-nav-next"></div><div class="swiper-nav-prev"></div> 
                                                                            </div>
                                                                        </div>		</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                <?php */ ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>    
        </div>      
    </div>   
</section>



<section style="border-top:#ccc solid 1px;">
    <img src="<?php echo base_url(BASE_WEB_IMAGES_PATH . "logo_slider1.jpg"); ?>" alt="Partners"/>
</section>



<section style="background:url(https://i.postimg.cc/L41kb538/link.png); padding-top:50px !important;padding-bottom:50px !important;">

    <div class="row">
        <div class="col-12 col-md-9" style="padding-top:10px;"><h4><center>Need More Assistance, Do Not Hesitate. Feel free to contact us</center></h4></div>
        <div class="col-12 col-md-2 text-center" style="padding-top:5px;"><div class="elementor-widget-container"> <a class="btn-theme" href="<?php echo base_url('contact-us'); ?>"> Contact Now </a></div></div>

    </div>
</section>
<style type="text/css">
    .swiper-slider-wrapper .swiper-nav-next, .swiper-slider-wrapper .swiper-nav-prev {background:#fffff !important;}
</style>


<script type="text/javascript">
    var myCarousel = document.querySelectorAll('#featureContainer .carousel .carousel-item');
    myCarousel.forEach((el) => {
        const minPerSlide = 5
        let next = el.nextElementSibling
        for (var i=1; i<minPerSlide; i++) {
            
            if (!next) {
                // wrap carousel by using first child
                next = myCarousel[0]
            }
            let cloneChild = next.cloneNode(true)
            el.appendChild(cloneChild.children[0])
            next = next.nextElementSibling
        }
    });
    $(function(){
        get_listing();
    })
    function get_listing() {
       commonAjx("<?php echo base_url("listing/index") ?>", "listing_record","lt-search-form-main");
    }
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "WebSite",
  "name": "ClassHud",
  "url": "<?php echo $this->base_url ?>",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "<?php echo base_url("listing/all_listing") ?>",
  }
}
</script>
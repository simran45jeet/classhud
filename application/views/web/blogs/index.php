<style type="text/css">
    .post-thumbnail{position: absolute !important;width: 100%;height: 400px;left: 0;top: 0;}
    .post-thumbnail .entry-date{bottom:auto !important  ;top:47%;}
    .post-thumbnail a {position: absolute;width: 100%;height:56%;left: 0;top: 0;}
    .post-thumbnail a i {position: absolute;width: 100%;height: 100%;left: 0;top: 0;}
    .post .has-thumbnail {margin-top:60%; border-radius: 0 !important; z-index:12 !important;}
    .post .entry-date {bottom:auto !important;top:190px;z-index:15 !important;}
</style>
<section id="wp-main-content" class="clearfix main-page">
    <div class="main-page-content">
        <div class="content-page">      
            <div id="wp-content" class="wp-content clearfix">
                <div data-elementor-type="wp-post" data-elementor-id="879" class="elementor elementor-879">
                    <section class="elementor-section elementor-top-section elementor-element elementor-element-d32ca1a elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="d32ca1a" data-element_type="section">
                        <div class="elementor-container elementor-column-gap-default">
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-35470d0" data-id="35470d0" data-element_type="column">
                                <div class="elementor-widget-wrap elementor-element-populated p-0">
                                    <div class="elementor-element elementor-element-957f029 elementor-widget elementor-widget-gva_post_breadcrumb"  data-element_type="widget" >
                                        <div class="elementor-widget-container">
                                            <div class="gva-element-gva_post_breadcrumb gva-element">   
                                                <div class="post-breadcrumb">
                                                    <div class="custom-breadcrumb " >
                                                        <div class="breadcrumb-main">
                                                            <div class="container">
                                                                <div class="breadcrumb-container-inner">
                                                                    <ol class="breadcrumb"><li><a href="<?php echo $this->base_url ?>">Home</a> </li> <li class="active"><a href=""><?php echo $this->lang->line("heading_blogs_title") ?></a></li></ol>          
                                                                </div>  
                                                            </div>   
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
                    <section class="mt-5 mb-5">
                        <div class="container">
                            <?php if( !empty($records) ) { ?>
                            <div class="gva-posts-grid clearfix gva-posts">
                                <div class="gva-content-items">
                                    <div class="lg-block-grid-3 md-block-grid-3 sm-block-grid-2 xs-block-grid-2 xx-block-grid-1">
                                        <?php 
                                        foreach($records as $key=>$record) { 
                                            $blog_date = ( $record["added_date"]!="0000-00-00" && !empty($record["added_date"]) )?$record["added_date"]:$record["created_at"] ;
                                        ?>
                                        <div class="item-columns">
                                            <article id="post-48" class="post post-style-1 post-48 type-post status-publish format-standard has-post-thumbnail hentry category-tours-travel tag-adventure tag-beach tag-lifestyle position-relative d-inline-block col-sm-12 col-12">
                                                <div class="post-thumbnail col-sm-12 d-inline-block position-relative"> 
                                                    <a href="<?php echo base_url("blogs/view/{$record["slug"]}") ?>"> 
                                                        <i style="background: url('<?php echo $record["image_url"]  ?>') no-repeat center top / cover"></i>

                                                    </a>
                                                </div>
                                                <div class="entry-date"> 
                                                    <span class="date"><?php echo date("d",strtotime($blog_date)) ?></span> 
                                                    <span class="month d-block"><?php echo date("M",strtotime($blog_date) ) ?></span>
                                                </div>
                                                <div class="entry-content has-thumbnail">
                                                    <div class="content-inner">
                                                        <h3 class="entry-title">
                                                            <a href="<?php echo base_url("blogs/view/{$record["slug"]}") ?>" rel="bookmark"><?php echo stripcslashes($record["name"]) ?></a></h3>
                                                        <div class="entry-desc"><?php echo $record["short_description"]?:"<p>&nbsp;</p>"; ?></div>
                                                        <div class="content-footer">
                                                            <div class="entry-category">
                                                                <span class="cat-links"><i class="las la-tags"></i>
                                                                    <a href="<?php echo base_url("blogs/view/{$record["slug"]}") ?>" rel="category tag"><?php echo $record["category_name"] ?></a></span>
                                                            </div>
                                                            <div class="read-more"> 
                                                                <a href="<?php echo base_url("blogs/view/{$record["slug"]}") ?>"><i class="arrow fa-solid la la-arrow-right"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php echo $links ?>
                                
                            </div>
                            <?php }else{ ?>
                            <div class="job_listings listings-list-inner col-12">
                                <div class="alert alert-warning"><?php echo $this->lang->line("message_no_records"); ?></div>
                            </div>
                            <?php } ?>
                        </div>
                    </section>
                </div>
            </div>    
        </div>      
    </div>

</section>
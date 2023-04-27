<section id="wp-main-content" class="clearfix main-page">
    <div class="main-page-content">
        <div class="content-page">      
            <div id="wp-content" class="wp-content clearfix">
                <div data-elementor-type="wp-post" data-elementor-id="879" class="elementor elementor-879">
                    <section>
                        <div class="elementor-container elementor-column-gap-default"  >
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-35470d0" data-id="35470d0" data-element_type="column">
                                <div class="elementor-widget-wrap elementor-element-populated p-0">
                                    <div class="elementor-element elementor-element-957f029 elementor-widget elementor-widget-gva_post_breadcrumb" data-id="957f029" data-element_type="widget" data-widget_type="gva_post_breadcrumb.default">
                                        <div class="elementor-widget-container">
                                            <div class="gva-element-gva_post_breadcrumb gva-element">   
                                                <div class="post-breadcrumb">
                                                    <div class="custom-breadcrumb" style="background-image: #000;">
                                                        <div class="breadcrumb-main">
                                                            <div class="container">
                                                                <div class="breadcrumb-container-inner">
                                                                    <ol class="breadcrumb">
                                                                        <li>
                                                                            <a href="<?php echo $this->base_url ?>"><?php echo $this->lang->line("heading_home") ?></a> 
                                                                        </li> 
                                                                        <li class="active">
                                                                            <a href=""><?php echo stripcslashes($record["name"]) ?></a>
                                                                        </li>
                                                                    </ol>          
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
                    <section class="elementor-section elementor-top-section elementor-element elementor-element-396a7e6 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="396a7e6" data-element_type="section" style="margin:70px 0;">
                        <div class="col-md-8 offset-md-2 container">
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-efbcfb5" data-id="efbcfb5" data-element_type="column">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div class="elementor-element elementor-element-5fd0863 elementor-widget elementor-widget-gva_post_thumbnail" data-id="5fd0863" data-element_type="widget" data-widget_type="gva_post_thumbnail.default">
                                        <div class="elementor-widget-container">
                                            <div class="gva-element-gva_post_thumbnail gva-element">
                                                <img   src="<?php echo $record["image_url"] ?>" class="attachment-full size-full wp-post-image" alt="<?php echo stripcslashes($record["name"]) ?>" decoding="async" loading="lazy"/>
                                            </div>		
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-09e030b elementor-widget__width-auto elementor-widget elementor-widget-gva_author_name" data-id="09e030b" data-element_type="widget" data-widget_type="gva_author_name.default" style="display:flex;padding:10px;">
                                        <div class="elementor-widget-container" style="margin-right:10px;">
                                            <div class="gva-element-gva_author_name gva-element">   
                                                <div class="post-author-name">
                                                    <a href="">
                                                        <i class="la la-user-circle">
                                                        </i>
                                                        <?php echo $record["author_name"] ?>
                                                    </a>
                                                </div>      

                                            </div>		
                                        </div>
                                        <div class="elementor-widget-container">
                                            <div class="gva-element-gva_post_category gva-element">	
                                                <div class="post-category">
                                                    <i class="las la-tags"></i>
                                                    <a href="" rel="category tag"><?php echo $record["category_name"] ?></a>
                                                </div>
                                            </div>		
                                        </div>

                                    </div>
                                    <div class="elementor-element elementor-element-c391bd6 elementor-widget elementor-widget-gva_post_name" data-id="c391bd6" data-element_type="widget" data-widget_type="gva_post_name.default" >
                                        <div class="elementor-widget-container">
                                            <div class="gva-element-gva_post_name gva-element">
                                                <div class="fioxen-post-title">
                                                    <h1 class="post-title">
                                                        <span><?php echo stripcslashes($record["name"]) ?></span>
                                                    </h1>
                                                </div>   
                                            </div>		
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-4174e45 elementor-widget elementor-widget-gva_post_content" data-id="4174e45" data-element_type="widget" data-widget_type="gva_post_content.default">
                                        <div class="elementor-widget-container">
                                            <div class="gva-element-gva_post_content gva-element">   
                                                <div class="post-content"><?php echo stripcslashes($record["description"]); ?></div> 
                                            </div>		
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-fa3b2c3 elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="fa3b2c3" data-element_type="widget" data-widget_type="divider.default">
                                        <div class="elementor-widget-container">
                                            <div class="elementor-divider">
                                                <span class="elementor-divider-separator">
                                                </span>
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
</section>
<?php
$schema_arr = array(
    "@context" => "https://schema.org",
    "@type" => "BlogPosting",
    "headline" => stripcslashes($record["name"]),
    "image" => $record["image_url"],
    "description" => strip_tags($record["description"]),
    "author" => array(
        "@type" => "Person",
        "name" => $record["author_name"],
    ),
    "datePublished" => date(DEFAULT_SQL_ONLY_DATE_FORMAT,strtotime($record["created_at"]))
);
?>
<script type="application/ld+json">
    <?php echo stripcslashes(json_encode($schema_arr)) ?>
</script>
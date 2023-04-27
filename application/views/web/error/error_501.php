<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo  $this->lang->line("heading_web_meta_title"); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="keywords" content="<?php echo  $this->lang->line("heading_web_meta_keywords"); ?>">
        <meta name="description" content="<?php echo $this->lang->line("heading_web_meta_description"); ?>">
        <link rel="shortcut icon" href="<?php echo base_url(BASE_WEB_IMAGES_PATH."favicon.ico"); ?>" type="image/png">
        <script src="<?php echo base_url(BASE_WEB_JS_PATH."vendor/jquery-3.6.0.min.js"); ?>"></script>
        <link rel="stylesheet" href="<?php echo base_url(BASE_ASSETS_PATH."web/fonts/themify-icons/themify-icons.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url(BASE_WEB_CSS_PATH."style.css?v=1.1"); ?>">
        <link rel="stylesheet" href="<?php echo base_url(BASE_WEB_CSS_PATH."bootstrap.min.css"); ?>">
    </head>
    <body>
        <?php $this->load->view("web/common/flash_message"); ?>
        <div class="preloader ">
            <div class="loader">
                <img src="<?php echo base_url(BASE_WEB_IMAGES_PATH."loader.gif"); ?>" alt="loader"/>
            </div>
        </div>
        
        <div class="loader_div d-none">
            <img src="<?php echo base_url(BASE_WEB_IMAGES_PATH."loader.gif"); ?>" alt="loader"/>
        </div>

        <header class="header-area header-area-two">
            <div class="header-navigation">
                <div class="container-fluid">
                    <div class="primary-menu">
                        <div class="row align-items-center">
                            <div class="col-lg-2 col-5">
                                <div class="site-branding">
                                    <a href="<?php echo $this->base_url ?>" class="brand-logo">
                                        <img src="<?php echo base_url(BASE_WEB_IMAGES_PATH . "logo/logo-2.png"); ?>" alt="Brand Logo">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-2">
                                <div class="nav-menu">
                                    <div class="navbar-close">
                                        <i class="ti-close"></i>
                                    </div>
                                    <nav class="main-menu">
                                        <ul>
                                            <li class="menu-item has-children-new">
                                                <a href="<?php echo $this->base_url ?>" class="active">Home</a>
<!--                                                <ul class="sub-menu">
                                                    <li class="menu-item"><a href="index.html">Home One</a></li>
                                                    <li class="menu-item"><a href="index-2.html">Home Two</a></li>
                                                    <li class="menu-item"><a href="index-3.html">Home Three</a></li>
                                                </ul>-->
                                            </li>
                                            <li class="menu-item"><a href="about.html">About us</a></li>
                                            <li class="menu-item has-children"><a href="#">Listings</a>
                                                <ul class="sub-menu">
                                                    <li class="menu-item"><a href="listing-list.html">Listing List</a></li>
                                                    <li class="menu-item"><a href="listing-grid.html">Listing Grid</a></li>
                                                    <li class="menu-item"><a href="listing-map.html">Listing Map Grid</a></li>
                                                    <li class="menu-item"><a href="listing-details-1.html">Listing Details One</a></li>
                                                    <li class="menu-item"><a href="listing-details-2.html">Listing Details Two</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item has-children"><a href="#">Pages</a>
                                                <ul class="sub-menu">
                                                    <li class="menu-item"><a href="add-listing.html">Add Listing</a></li>
                                                    <li class="menu-item has-children"><a href="#">Products</a>
                                                        <ul class="sub-menu">
                                                            <li><a href="products.html">Our Products</a></li>
                                                            <li><a href="product-details.html">Products Details</a></li>

                                                        </ul>
                                                    </li>
                                                    <li class="menu-item"><a href="how-work.html">How Work</a></li>
                                                    <li class="menu-item"><a href="pricing.html">Pricing</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item has-children"><a href="#">Article</a>
                                                <ul class="sub-menu">
                                                    <li class="menu-item"><a href="blog.html">Our Blog</a></li>
                                                    <li class="menu-item"><a href="blog-details.html">Blog details</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item"><a href="contact.html">Contact</a></li>
                                            <li class="nav-btn"><a href="add-listing.html" class="main-btn icon-btn">Add Listing</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-lg-4 col-5">
                                <div class="header-right-nav">
                                    <ul class="d-flex align-items-center">
                                        <li><a href="index.html"><i class="ti-heart"></i><span>Wishlist</span></a></li>
                                        <li><a href="index.html"><i class="ti-shopping-cart"></i><span>Cart</span></a></li>
                                        <li class="user-btn">
                                            <a href="<?php echo !empty($this->user_data['id']) ? base_url("profile"):base_url("users/signin"); ?>" class="icon"><i class="flaticon-avatar"></i></a>
                                        </li>

                                        <li class="hero-nav-btn">
                                            <a href="<?php echo !empty($this->user_data['id']) ? base_url("add-listing"):base_url("users/signin"); ?>" class="main-btn icon-btn">Add Listing</a>
                                        </li>
                                        <li class="nav-toggle-btn">
                                            <div class="navbar-toggler">
                                                <span></span><span></span><span></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="main_content">
            <div class="row">
                <div class="col-md-12 text-center" style="padding: 50px 0">
                <h1>Access Forbidden</h1>
                        <div class="error_flash_message">
                            <?php echo $error_message; ?>
                        </div>
                    <div class="button">

                    </div>
                </div>
            </div>
        </div>
        <footer class="footer-area">
            <div class="footer-wrapper-one dark-black pt-90">
                <div class="footer-widget pb-60">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="widget about-widget mb-40 wow fadeInUp" data-wow-delay="10ms">
                                    <h4 class="widget-title">Mobile Experience</h4>
                                    <ul class="button">
                                        <li>
                                            <a href="#" class="app-btn android-btn">
                                                <div class="icon">
                                                    <i class="ti-android"></i>
                                                </div>
                                                <div class="info">
                                                    <span>get it on</span>
                                                    <h6>Goole Play</h6>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="app-btn apple-btn">
                                                <div class="icon">
                                                    <i class="ti-apple"></i>
                                                </div>
                                                <div class="info">
                                                    <span>get it on</span>
                                                    <h6>App Store</h6>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="footer-social">
                                        <h4>Follow Us</h4>
                                        <ul class="social-link">
                                            <li><a href="#"><i class="ti-facebook"></i></a></li>
                                            <li><a href="#"><i class="ti-twitter-alt"></i></a></li>
                                            <li><a href="#"><i class="ti-pinterest"></i></a></li>
                                            <li><a href="#"><i class="ti-instagram"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="widget recent-post-widget mb-40 wow fadeInUp" data-wow-delay="20ms">
                                    <h4 class="widget-title">Recent News</h4>
                                    <ul class="post-widget-list">
                                        <li class="post-content-item">
                                            <div class="post-title-date">
                                                <span class="posted-on"><a href="#">22 August - 2021</a></span>
                                                <h6 class="title"><a href="blog-details.html">Facilisis a ultricies quis
                                                        dictumst fredom...</a></h6>
                                            </div>
                                        </li>
                                        <li class="post-content-item">
                                            <div class="post-title-date">
                                                <span class="posted-on"><a href="#">22 August - 2021</a></span>
                                                <h6 class="title"><a href="blog-details.html">Facilisis a ultricies quis
                                                        dictumst fredom...</a></h6>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12">
                                <div class="widget categories-widget mb-40 wow fadeInUp" data-wow-delay="30ms">
                                    <h4 class="widget-title">Categories</h4>
                                    <ul class="categories-link">
                                        <li><a href="#">Restaurant</a></li>
                                        <li><a href="#">Museum</a></li>
                                        <li><a href="#">Party Center</a></li>
                                        <li><a href="#">Game Field</a></li>
                                        <li><a href="#">Shopping</a></li>
                                        <li><a href="#">Art & Gallery</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="widget newsletter-widget mb-40 wow fadeInUp" data-wow-delay="40ms">
                                    <h4 class="widget-title">Newsletter</h4>
                                    <p>Caoreet massa torto pon interdum
                                        sestibulum suscipit duis.</p>
                                    <form>
                                        <div class="form_group">
                                            <input type="email" class="form_control" placeholder="Enter Email" name="email" required>
                                        </div>
                                        <div class="form_group">
                                            <button class="main-btn">Subscribe</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="copyright-area">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="copyright-text">
                                    <p>Copyright &copy; 2021. All rights reserved to <span>Webtend</span></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="copyright-link">
                                    <ul>
                                        <li><a href="#">Terms & Conditins</a></li>
                                        <li><a href="#">Services</a></li>
                                        <li><a href="#">Career</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <a href="#" class="back-to-top" ><i class="ti-angle-up"></i></a>
        <script src="<?php echo base_url(BASE_WEB_JS_PATH."popper.min.js"); ?>"></script>
        <script src="<?php echo base_url(BASE_WEB_JS_PATH."bootstrap.min.js"); ?>"></script>
        <script src="<?php echo base_url(BASE_WEB_JS_PATH."slick.min.js"); ?>"></script>
        <script src="<?php echo base_url(BASE_WEB_JS_PATH."jquery.magnific-popup.min.js"); ?>"></script>
        <script src="<?php echo base_url(BASE_WEB_JS_PATH."isotope.pkgd.min.js"); ?>"></script>
        <script src="<?php echo base_url(BASE_WEB_JS_PATH."imagesloaded.pkgd.min.js"); ?>"></script>
        <script src="<?php echo base_url(BASE_WEB_JS_PATH."jquery.nice-select.min.js"); ?>"></script>
        <script src="<?php echo base_url(BASE_WEB_JS_PATH."jquery.counterup.min.js"); ?>"></script>
        <script src="<?php echo base_url(BASE_WEB_JS_PATH."jquery.waypoints.js"); ?>"></script>
        <script src="<?php echo base_url(BASE_WEB_JS_PATH."jquery-ui.min.js"); ?>"></script>
        <script src="<?php echo base_url(BASE_WEB_JS_PATH."wow.min.js"); ?>"></script>
        <script src="<?php echo base_url(BASE_WEB_JS_PATH."main.js"); ?>"></script>
        <link rel="stylesheet" href="<?php echo base_url(BASE_ASSETS_PATH."web/fonts/flaticon/flaticon.css"); ?>" />
        <link rel="stylesheet" href="<?php echo base_url(BASE_WEB_CSS_PATH."magnific-popup.css"); ?>" />
        <link rel="stylesheet" href="<?php echo base_url(BASE_WEB_CSS_PATH."slick.css"); ?>" />
        <link rel="stylesheet" href="<?php echo base_url(BASE_WEB_CSS_PATH."nice-select.css"); ?>" />
        <link rel="stylesheet" href="<?php echo base_url(BASE_WEB_CSS_PATH."jquery-ui.min.css"); ?>" />
        <link rel="stylesheet" href="<?php echo base_url(BASE_WEB_CSS_PATH."animate.css"); ?>" />
        
        <script src="<?php echo base_url(BASE_ASSETS_PATH."web/plugins/global/plugins.bundle.js") ?>"></script>
        <script src="<?php echo base_url(BASE_WEB_JS_PATH."scripts.bundle.js") ?>"></script>
        
        <link href="<?php echo base_url(BASE_ASSETS_PATH."web/css/style.bundle.css"); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(BASE_ASSETS_PATH."web/plugins/global/plugins.bundle.css") ?>" rel="stylesheet" type="text/css" />
    </body>
</html>
<?php die; ?>
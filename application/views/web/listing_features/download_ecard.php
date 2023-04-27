<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>E-card</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo base_url(BASE_WEB_CSS_PATH."roboto.css") ?>" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
        
        <link rel="stylesheet" href="<?php echo base_url(BASE_WEB_CSS_PATH."ecard.css") ?>" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<!--        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>-->
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/"crossorigin="anonymous"></script>
        <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
        <script src="<?php echo base_url(BASE_WEB_JS_PATH."main.js") ?>"></script>
        <style type="text/css">
            svg.colimg{width:60; height: 60px;display: none }
        </style>
    </head>
    <body>
        <canvas id="canvas" width="400" height="400" style="display:none"></canvas>
        <main id="main">
            <section class="top-card">
                <div class="topredline"></div>
                <div class="e3_63" style="background-image:url('<?php echo $record["cover_image_url"] ?>')"></div>
                <div class="photo text-center">
                    <img class="img" src="<?php echo $record["logo_url"] ?>" alt="<?php echo $record["name"] ?>" />
                </div>

                <section class="middle-card">
                    <center>
                        <h3 class="e3_58"><?php echo $record["name"] ?></h3>
                        <p class="e3_57"><?php echo $record["address"] ?></p>
                        <div class="rateyo" data-rateyo-rating="<?php echo (float)$record["average_rating"] ?>" data-rateyo-num-stars="5"></div>

                        <div class="verified">
                            <img src="<?php echo base_url(BASE_WEB_IMAGES_PATH."vector.png") ?>" />
                            <span>Verified Profile</span>
                        </div>
                    </center>
                </section>
                <div class="buttontop">
                    <a href="tel:<?php echo $record["user_phone_no"] ?>" class="buttoncall">
                        <i class="fa-solid fa-phone-volume" style="color: #ffffff;"></i>&nbsp;&nbsp; CALL NOW
                    </a>
                </div>
                <section class="middle-card">
                    <!--<h4 class="little">A Little Bit About Us</h4>-->
                    <h4 class="e3_58" style="font-size:30px;margin-top:30px;">A Little Bit About Us</h4>
                    <div class="description">
                        <?php echo $record["description"]; ?>
                    </div>
                </section>
            </section>
            
            <section class="slidersection">
                <?php  /*?>
                <h4 class="infra">Our infrastructure</h4>
                <div class="slider">
                    <div class="slider-container">
                        <div class="slide active">
                            <img src="assets/images/dr-holmes-academy.png" alt="Slide 1">
                        </div>
                        <div class="slide">
                            <img src="assets/images/schoolprofile.png" alt="Slide 2">
                        </div>
                        <div class="slide">
                            <img src="assets/images/dr-holmes-academy.png" alt="Slide 3"> 
                        </div>
                        <div class="slide">
                            <img src="assets/images/schoolprofile.png" alt="Slide 3"> 
                        </div>
                    </div>
                    <div class="slider-arrows">
                        <button class="prev">&#8249;</button>
                        <button class="next">&#8250;</button>
                    </div>
                    <div class="slider-dots">
                        <button class="dot active"></button>
                        <button class="dot"></button>
                        <button class="dot"></button>
                        <button class="dot"></button>
                    </div>
                </div>
                <?php */ ?>
            </section>
            
            <?php if( !empty($record["listing_amenities_data"]) ) {?>
            <section class="top-card" style="padding:25px;">
                <h4 style="font-size: 30px; text-align: center; font-variant: all-small-caps; color: #E12829;">Our Facilities</h4>
                <div class="colmain">
                    <?php foreach( $record["listing_amenities_data"] as $key => $listing_amenity) { ?>
                    <div class="col">
                        <span class="listing_amenity_img">
                            <?php 
                            $img_ext = strtolower( end( explode(".",$listing_amenity["image_url"]) ) );
                            if( $img_ext=="svg" )  {

                                $svg = file_get_contents($listing_amenity["image_url"]);
                                preg_match("/<svg(.*?)>(.*?)<\/svg>/si",$svg,$matches);
                                $svg_inner_html = $matches[2];
                                $svg_obj = simplexml_load_string($svg);
                                $svg_atributes = current($svg_obj);
                                unset($svg_atributes["width"],$svg_atributes["height"],$svg_atributes["xmlns"]);
                                $svg_atributes_str = ' width="400" height="400"  ';
                                foreach( $svg_atributes as $attribute_key=>$attribute_value ) {
                                    $svg_atributes_str .= $attribute_key.'='.'"'.$attribute_value.'" ';
                                }
                                echo "<svg {$svg_atributes_str} class='colimg'>{$svg_inner_html}</svg>";                                    
                            }?>
                            <img src="<?php echo $listing_amenity["image_url"] ?>" alt="<?php echo $listing_amenity["name"] ?>"  class="colimg">
                        </span>
                        
                        <h5  class="colh5"><?php echo $listing_amenity["name"] ?></h5>
                    </div>
                    <?php } ?>
                    
                </div>

                
            </section>
            <?php } ?>
            <!-- A div with card__details class to hold the details in the card  -->
            <div class="card_details">
                <p class="contactus">CONTACT US</p>
                <p class="contactdes">We're always here to help, so feel free to
                    contact us whenever you need to.</p>
                <center>
                    <div style="border-bottom: 1px solid #D8DDE5; width: 30%; text-align: center; margin-bottom: 20px;"></div>
                </center>
                <div class="contactadd">
                    <div class="contacticon">
                        <i class="fa fa-solid fa-map-marker-alt"></i>
                    </div>
                    <div class="conatctinfo">
                        <p class="textmail"><?php echo $record["google_location"] ?></p>

                    </div>
                </div>

                <div class="contactadd">
                    <div  class="contacticon">
                        <i class="fa fa-solid fa-envelope"></i>
                    </div>
                    <div class="conatctinfo">
                        <p class="textmail">
                            <?php echo $record["primary_email"]; ?>
                            <?php echo !empty($record["website"]) ? "<br/>{$record["website"]}":""; ?>
                        </p>
                    </div>
                </div>
                <?php if( !empty($record["primary_phone_no"]) || !empty($record["landline"]) ) { ?>
                <div class="contactadd">
                    <div  class="contacticon">
                        <i class="fa fa-solid fa-phone-volume"></i>
                    </div>
                    <div class="conatctinfo">
                        <p class="textmail">
                            <?php 
                            $phone_nos = array();
                            if( !empty($record["primary_phone_no"]) ) {
                                $phone_nos[] = $record["primary_phone_code_name"].$record["primary_phone_no"];
                            }
                            if( !empty($record["landline"]) ) {
                                $phone_nos[] = $record["landline"];
                            }
                            echo implode("<br/>",$phone_nos);
                            ?>
                        </p>
                    </div>
                </div>
                <?php } ?>
                <hr />
                <?php if (!empty($record["social_media"])) { ?>
                <div class="row" style="justify-content: center; margin-top:20px;">
                    <?php foreach ($record["social_media"] as $listing_social_media) { ?>
                    <a class="laicon" target="_blank" href="<?php echo "http://" . str_replace(array("http://", "https://"), "", $listing_social_media["username"]) ?>" rel="nofollow">
                        <i class="fa fa-brands fa-<?php echo $listing_social_media["icon_class"] ?>" style="color: white;font-size: 26px;"></i>
                    </a>
                    <?php } ?>
                </div>
                <?php } ?>
            </div>
            

            <center class="footerpower">
                <p class="e3_7">Powered by</p>
                <img class="footerimg" src="<?php echo base_url(BASE_WEB_IMAGES_PATH."logo/class-hud-logo.svg") ?>" alt="<?php echo $this->lang->line("heading_logo_alt") ?>" />
                <!--<p class="e3_90">TagLine Comes Here</p>-->
            </center>

            <center>
                <div class="menu_container">
                    <div class="menu_item"  style="cursor: pointer;border-right: 1px solid white">  <a href="tel:<?php echo $record["primary_phone_code_name"].$record["primary_phone_no"] ?>" target="_blank"><img src="<?php echo base_url(BASE_WEB_IMAGES_PATH."phone.png") ?>" style="height: 25px;"><div class="link_btn">Call Now</div></a></div>

                    <div class="menu_item" id="share_box_pop" style="border-right: 1px solid white"><a href="mailto:<?php echo $record["primary_email"] ?>" target="_blank"><i class="fa-sharp fa-regular fa-envelope" style="color: #ffffff;"></i><div class="link_btn">Email</div></a></div>
                    <?php
                    if(!empty($record["primary_whatsapp_no"])) { 
                        $whats_app_text = urlencode("Hello {$record["name"]}\nGot your information from your *ClassHud*");
                    ?>

                    <div class="menu_item"><a href="https://api.whatsapp.com/send?text=<?php echo $whats_app_text ?>&phone=<?php echo str_replace("+","",$record["primary_whatsapp_code_name"]).$record["primary_whatsapp_no"]?>" target="_blank" style="border-right: 1px solid white"><i class="fa-brands fa-whatsapp" style="color: #ffffff;"></i><div class="link_btn">Whatsapp</div></a></div>
                    <?php } ?>

                </div>
            </center>
        </main>
        <script type="text/javascript">
            $(function () {
                // initialize rateYo plugin with rating of 4.5
                $(".rateyo").rateYo({
                    starWidth: "25px",
                    rating: <?php echo (float)$record["average_rating"] ?>
                }).on("rateyo.change", function (e, data) {
                    var rating = data.rating;
                    $(this).parent().find('.result').text('rating :' + rating);
                    $(this).attr('data-rateyo-rating', rating);
                });
            });
            <?php if( $download==true ) {?>
            function savePDF() {
                html2canvas(document.getElementById("main"),{
                    allowTaint: true,
                    useCORS: true
                }).then(function (canvas) {
                    var anchorTag = document.createElement("a");
                    document.body.appendChild(anchorTag);
                    anchorTag.download = "<?php echo $record["name"]." - ".SITE_NAME?>.png";
                    anchorTag.href = canvas.toDataURL();
                    anchorTag.target = '_blank';
                    anchorTag.click();
                }); 
            }
            
            if( $("svg").length>0 ) {
                $("svg").each(function(){
                    var $this =  $(this);
                    //console.log( $(this) ) ;
                    var svgString = new XMLSerializer().serializeToString(this);
                    var canvas = document.getElementById("canvas");
                    var ctx = canvas.getContext("2d");
                    var DOMURL = self.URL || self.webkitURL || self;
                    var img = new Image();
                    var svg = new Blob([svgString], {type: "image/svg+xml;charset=utf-8"});
                    var url = DOMURL.createObjectURL(svg);
                    var imageHtml=""
                    img.onload = function() {
                        ctx.drawImage(img, 0, 0);
                        var png = canvas.toDataURL("image/png");
                        imageHtml = '<img src="'+png+'" class="colimg"/>'
                        //document.querySelector('#png-container').innerHTML += imageHtml;
                        $this.parent().replaceWith(imageHtml);
                        DOMURL.revokeObjectURL(png);

                    };
                    img.src = url;
                });
                setTimeout("savePDF();",1000);
            }else{
                savePDF();
            }
            <?php } ?>
           
        </script>
    </body>
</html>

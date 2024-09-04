<!doctype html>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<!--<![endif]-->
<!--<![endif]-->
<html lang="en">

    <!-- Mirrored from codelayers.net/templates/hasta/medical/fullwidth/index.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Sep 2015 13:09:30 GMT -->
    <head>
        <title>Contacto</title>
        <?php require './head.php';
        require './funciones.php';
        ?>  

        <style>
            .feature-box-86{
                background-color: #3fc35f !important;
            }

            .bg-color-light{
                background-color: #4ece6d !important;
            }
        </style>
    </head>

    <body>
        <div class="site_wrapper">
            <?php
            if ($_SESSION['usuario'] != "admin") {
                if (validarFicha($_SESSION['usuario'])) {
                    require './header.php';
                } else {
                    require './headerFicha.php';
                }
            }else{
                require './header.php';
            }
            ?>  
            <!-- masterslider -->

            <section>
                <div class="header-inner two">
                    <div class="inner text-center">
                        <h4 class="title text-white uppercase">Contacto</h4>
                        <h5 class="text-white uppercase">Pongase en contacto con nosotros</h5>
                    </div>
                    <div class="overlay bg-opacity-5"></div>
                    <img src="images/header-contact.jpg" alt="" class="img-responsive"/> </div>
            </section>
            <!-- end header inner -->
            <div class="clearfix"></div>

            <section class="sec-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="smart-forms bmargin">
                                <h3>Contact Us</h3>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse et justo. Praesent mattis commodo augue. Aliquam ornare hendrerit consectetuer adipiscing elit. Suspendisse et justo. augue.</p>
                                <br/>
                                <br/>
                                <form method="post" action="http://codelayers.net/templates/hasta/medical/fullwidth/php/smartprocess.php" id="smart-form">
                                    <div>
                                        <div class="section">
                                            <label class="field prepend-icon">
                                                <input type="text" name="sendername" id="sendername" class="gui-input" placeholder="Enter name">
                                                <span class="field-icon"><i class="fa fa-user"></i></span> </label>
                                        </div>
                                        <!-- end section -->

                                        <div class="section">
                                            <label class="field prepend-icon">
                                                <input type="email" name="emailaddress" id="emailaddress" class="gui-input" placeholder="Email address">
                                                <span class="field-icon"><i class="fa fa-envelope"></i></span> </label>
                                        </div>
                                        <!-- end section -->

                                        <div class="section colm colm6">
                                            <label class="field prepend-icon">
                                                <input type="tel" name="telephone" id="telephone" class="gui-input" placeholder="Telephone">
                                                <span class="field-icon"><i class="fa fa-phone-square"></i></span> </label>
                                        </div>
                                        <!-- end section -->

                                        <div class="section">
                                            <label class="field prepend-icon">
                                                <input type="text" name="sendersubject" id="sendersubject" class="gui-input" placeholder="Enter subjec">
                                                <span class="field-icon"><i class="fa fa-lightbulb-o"></i></span> </label>
                                        </div>
                                        <!-- end section -->

                                        <div class="section">
                                            <label class="field prepend-icon">
                                                <textarea class="gui-textarea" id="sendermessage" name="sendermessage" placeholder="Enter message"></textarea>
                                                <span class="field-icon"><i class="fa fa-comments"></i></span> <span class="input-hint"> <strong>Hint:</strong> Please enter between 80 - 300 characters.</span> </label>
                                        </div>
                                        <!-- end section --> 

                                        <!--<div class="section">
                                                    <div class="smart-widget sm-left sml-120">
                                                        <label class="field">
                                                            <input type="text" name="captcha" id="captcha" class="gui-input sfcode" maxlength="6" placeholder="Enter CAPTCHA">
                                                        </label>
                                                        <label class="button captcode">
                                                            <img src="php/captcha/captcha.php?<?php echo time(); ?>" id="captchax" alt="captcha">
                                                            <span class="refresh-captcha"><i class="fa fa-refresh"></i></span>
                                                        </label>
                                                    </div> 
                                                </div>-->

                                        <div class="result"></div>
                                        <!-- end .result  section --> 

                                    </div>
                                    <!-- end .form-body section -->
                                    <div class="form-footer">
                                        <button type="submit" data-btntext-sending="Sending..." class="button btn-primary blue">Submit</button>
                                        <button type="reset" class="button"> Cancel </button>
                                    </div>
                                    <!-- end .form-footer section -->
                                </form>
                            </div>
                            <!-- end .smart-forms section --> 

                        </div>
                        <div class="col-md-4 bmargin">
                            <h3>Address Info</h3>

                            <h6><strong>Company Name</strong></h6>
                            No.28 - 63739 street lorem ipsum City, Country <br />
                            Telephone: +1 1234-567-89000<br />
                            FAX: +1 0123-4567-8900<br />
                            <br />
                            E-mail: <a href="mailto:mail@companyname.com">mail@companyname.com</a><br />
                            Website: <a href="index.html">www.yoursitename.com</a>
                            <div class="clearfix"></div>
                            <br/>
                            <h3>Find the Address</h3>
                            <div id="map" class="map">
                                <p>This will be replaced with the Google Map.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- end section -->
            <div class="clearfix"></div>
            <?php require './footer.php'; ?>
        </div>
        <!-- end site wraper --> 

        <!-- ============ JS FILES ============ --> 

        <script type="text/javascript" src="js/universal/jquery.js"></script> 
        <script src="js/bootstrap/bootstrap.min.js" type="text/javascript"></script> 
        <script src="js/masterslider/jquery.easing.min.js"></script> 
        <script src="js/masterslider/masterslider.min.js"></script> 
        <script type="text/javascript">
            (function ($) {
                "use strict";
                var slider = new MasterSlider();
                // adds Arrows navigation control to the slider.
                slider.control('arrows');
                slider.control('bullets');

                slider.setup('masterslider', {
                    width: 1600, // slider standard width
                    height: 630, // slider standard height
                    space: 0,
                    speed: 45,
                    layout: 'fullwidth',
                    loop: true,
                    preload: 0,
                    autoplay: true,
                    view: "parallaxMask"
                });

            })(jQuery);
        </script> 
        <script type="text/javascript">
            (function ($) {
                "use strict";
                var slider = new MasterSlider();

                slider.setup('masterslider2', {
                    width: 570, // slider standard width
                    height: 300, // slider standard height
                    space: 0,
                    speed: 27,
                    layout: 'boxed',
                    loop: true,
                    preload: 0,
                    autoplay: true,
                    view: "basic",
                });
            })(jQuery);
        </script> 
        <script src="js/mainmenu/customeUI.js"></script>  
        <script src="js/owl-carousel/owl.carousel.js"></script> 
        <script src="js/owl-carousel/custom.js"></script> 
        <script type="text/javascript" src="js/tabs/smk-accordion.js"></script>
        <script type="text/javascript" src="js/tabs/custom.js"></script> 
        <script src="js/scrolltotop/totop.js"></script> 
        <script src="js/mainmenu/jquery.sticky.js"></script> 
        <script src="js/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script> 
        <script src="js/style-swicher/style-swicher.js"></script> 
        <script src="js/style-swicher/custom.js"></script> 
        <script type="text/javascript" src="js/smart-forms/jquery.form.min.js"></script> 
        <script type="text/javascript" src="js/smart-forms/jquery.validate.min.js"></script> 
        <script type="text/javascript" src="js/smart-forms/additional-methods.min.js"></script> 
        <script type="text/javascript" src="js/smart-forms/smart-form.js"></script> 
        <script src="js/scripts/functions.js" type="text/javascript"></script>

    </body>

    <!-- Mirrored from codelayers.net/templates/hasta/medical/fullwidth/index.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Sep 2015 13:09:39 GMT -->
</html>

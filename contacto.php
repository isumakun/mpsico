<!DOCTYPE html>
<html>

    <!-- Mirrored from preview.oklerthemes.com/porto/4.4.0/contact-us.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Jan 2016 16:52:09 GMT -->
    <head>

        <!-- Basic -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">	

        <title>MPsicocupacional</title>	

        <?php require './head.php'; ?>

    </head>
    <body>

        <div class="body">
            <?php require './header.php'; ?>

            <div role="main" class="main">

                <div class="container-fluid p-0 m-0">
                    <div class="row p-0 m-0">
                        <div class="col-md-6 px-0">
                            <section class="section bg-primary-4">
                                <div class="row justify-content-end m-0">
                                    <div class="col-half-section pr-md-5 appear-animation animated fadeInUpShorter appear-animation-visible" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="600" style="animation-delay: 600ms;">
                                        <div class="row">
                                            <div class="col">
                                                <span class="top-sub-title text-color-light opacity-6">CONTACTO</span>
                                                <h2 class="text-color-light font-weight-bold mb-4">Envíanos un mensaje</h2>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <form class="form-style-3 form-errors-light" action="enviarMail.php" method="POST">
                                                    <?php if ($_GET['state']=='enviado') {
                                                       ?>
                                                       <div class="contact-form-success alert alert-success">
                                                            <strong>Perfecto!</strong> Su correo ha sido enviado.
                                                        </div>
                                                       <?php
                                                    }elseif ($_GET['state']=='error') {
                                                       ?>
                                                       <div class="contact-form-error alert alert-dange">
                                                            <strong>Error!</strong> Por favor reintente.
                                                            <span class="mail-error-message d-block"></span>
                                                        </div>
                                                       <?php
                                                    } ?>
                                                    
                                                    <div class="form-row">
                                                        <div class="form-group col-lg-6">
                                                            <input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="name" id="name" placeholder="Nombre" required="">
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <input type="email" value="" data-msg-required="Hizo falta este campo" data-msg-email="Por favor ingrese un correo válido" maxlength="100" class="form-control" name="email" id="email" placeholder="E-mail" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-lg-6">
                                                            <input type="text" value="" maxlength="100" class="form-control" name="company" id="company" placeholder="Empresa" required="">
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <input type="text" value="" data-msg-required="Revise este campo"  maxlength="100" class="form-control" name="tel" id="tel" placeholder="Télefono" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label class="text-color-light">Seleccione la opción de interés:</label>
                                                                <div class="radio-group text-color-light" data-msg-required="Por favor seleccione una opción">
                                                                    <label class="radio-inline">
                                                                        <input type="radio" name="radios" id="inlineRadio1" value="option1"> Cotización
                                                                    </label>
                                                                    <label class="radio-inline">
                                                                        <input type="radio" name="radios" id="inlineRadio2" value="option2" data-msg-required="Por favor seleccione una opción"> Información General
                                                                    </label>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col">
                                                            <textarea maxlength="5000" data-msg-required="Please enter your message." rows="5" class="form-control" name="message" id="message" placeholder="Mensaje" required=""></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mt-2">
                                                        <div class="col">
                                                            <input type="submit" value="ENVIAR MENSAJE" class="btn btn-dark btn-rounded btn-4 font-weight-semibold text-0" data-loading-text="Loading...">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="section bg-primary">
                                <div class="row justify-content-end m-0">
                                    <div class="col-half-section pr-md-5">
                                        <div class="icon-box icon-box-style-4 align-items-center mb-4 appear-animation animated fadeInUpShorter appear-animation-visible" data-appear-animation="fadeInUpShorter" style="animation-delay: 100ms;">
                                            <div class="icon-box-icon bg-dark-4">
                                                <i class="lnr lnr-apartment text-color-light"></i>
                                            </div>
                                            <div class="icon-box-info">
                                                <div class="icon-box-info-title">
                                                    <h2 class="font-weight-bold text-color-light text-4 mb-0">Dirección</h2>
                                                </div>
                                                <p class="text-color-light text-2 opacity-8 mb-0">1234 Street Name, City Name, USA</p>
                                            </div>
                                        </div>
                                        <div class="icon-box icon-box-style-4 align-items-center mb-4 appear-animation animated fadeInUpShorter appear-animation-visible" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200" style="animation-delay: 200ms;">
                                            <div class="icon-box-icon bg-dark-4">
                                                <i class="lnr lnr-envelope text-color-light"></i>
                                            </div>
                                            <div class="icon-box-info">
                                                <div class="icon-box-info-title">
                                                    <h2 class="font-weight-bold text-color-light text-4 mb-0">Email de contacto</h2>
                                                </div>
                                                <a href="mailto:gerencia@mpsicocupacional.com" class="link-color-light-2 text-2 opacity-8">gerencia@mpsicocupacional.com</a>
                                            </div>
                                        </div>
                                        <div class="icon-box icon-box-style-4 align-items-center appear-animation animated fadeInUpShorter appear-animation-visible" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400" style="animation-delay: 400ms;">
                                            <div class="icon-box-icon bg-dark-4">
                                                <i class="lnr lnr-phone-handset text-color-light"></i>
                                            </div>
                                            <div class="icon-box-info">
                                                <div class="icon-box-info-title">
                                                    <h2 class="font-weight-bold link-color-light-2 text-4 mb-0">Télefono</h2>
                                                </div>
                                                <span class="d-block text-color-light"><a href="tel:+3016762043" class="link-color-light-2 text-2 opacity-8">301 676 2043</a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-6 px-0">
                            <!-- Go to the bottom of the page to change settings and map location. -->
                            <div id="googlemaps" class="google-map min-height-370 h-100" style="position: relative; overflow: hidden;"><div style="height: 100%; width: 100%;"></div></div>
                        </div>
                    </div>
                </div>

            </div>
            <?php require './footer.php'; ?>
        </div>

        <?php require './scripts.php'; ?>

        <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <script>

            /*
             Map Settings
             
             Find the Latitude and Longitude of your address:
             - http://universimmedia.pagesperso-orange.fr/geo/loc.htm
             - http://www.findlatitudeandlongitude.com/find-address-from-latitude-and-longitude/
             
             */

            // Map Markers
            var mapMarkers = [{
                    address: "New York, NY 10017",
                    html: "<strong>New York Office</strong><br>New York, NY 10017",
                    icon: {
                        image: "img/pin.png",
                        iconsize: [26, 46],
                        iconanchor: [12, 46]
                    },
                    popup: true
                }];

            // Map Initial Location
            var initLatitude = 40.75198;
            var initLongitude = -73.96978;

            // Map Extended Settings
            var mapSettings = {
                controls: {
                    draggable: (($.browser.mobile) ? false : true),
                    panControl: true,
                    zoomControl: true,
                    mapTypeControl: true,
                    scaleControl: true,
                    streetViewControl: true,
                    overviewMapControl: true
                },
                scrollwheel: false,
                markers: mapMarkers,
                latitude: initLatitude,
                longitude: initLongitude,
                zoom: 16
            };

            var map = $("#googlemaps").gMap(mapSettings);

            // Map Center At
            var mapCenterAt = function (options, e) {
                e.preventDefault();
                $("#googlemaps").gMap("centerAt", options);
            }

        </script>

        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '../../../www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-42715764-5', 'auto');
            ga('send', 'pageview');
        </script>
        <script src="master/analytics/analytics.js"></script>

    </body>
</html>

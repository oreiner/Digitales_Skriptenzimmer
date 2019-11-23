<!-- Footer Area section -->
<footer>
    <div class="container">
        <div class="row">
            <div class=" col-sm-12 footer-content-box">
                <div class="col-sm-4">
                    <h3><span><i class="fa fa-graduation-cap footer-h-icon"></i></span> Skriptenzimmer Köln</h3>
                    <p>Zusammen mit dem Verein der Freunde der Humanmedizinstudierendenschaft Köln (FdHmsK e.V.) betreiben wir diesen sagenumwobenen Ort, an dem ihr alles findet, was euer Studierendenherz begehrt!</p>
                    <ul class="list-unstyled">
                        <!--<li><span><i class="fa fa-phone footer-icon"></i></span>0123-456-789</li>!-->
                        <li><span><i class="fa fa-envelope footer-icon"></i></span><?php echo e(config('mail.from.address')); ?></li>
                        <li><span><i class="fa fa-map-marker footer-icon"></i></span>LFI, Bettenhaus</li>
                    </ul>
                </div>

                <div class="col-sm-2">
                    <h3>Links</h3>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo e(url('login')); ?>"><span><i class="fa fa-long-arrow-right footer-icon"></i></span>Anmeldung</a></li>
                        <li><a href="<?php echo e(url('register')); ?>"><span><i class="fa fa-long-arrow-right footer-icon"></i></span>Registrierung</a></li>
                        <li><a href="<?php echo e(url('mailpdf')); ?>"><span><i class="fa fa-long-arrow-right footer-icon"></i></span>Protokolle</a></li>
                        <li><a href="<?php echo e(url('download')); ?>"><span><i class="fa fa-long-arrow-right footer-icon"></i></span>Skripte</a></li>
                        <li><a href="<?php echo e(url('terms')); ?>"><span><i class="fa fa-long-arrow-right footer-icon"></i></span>AGB</a></li>
                    </ul>
                </div>

                <div class="col-sm-2">
                    <h3>Externe Links</h3>
                    <ul class="list-unstyled">
                        <li><a href="http://www.fsmed-koeln.de/20848.html" target="_blank"><span><i class="fa fa-long-arrow-right footer-icon"></i></span>Angebot</a></li>
                        <li><a href="http://www.fsmed-koeln.de/20794.html" target="_blank"><span><i class="fa fa-long-arrow-right footer-icon"></i></span>Preis der Lehre</a></li>
                        <li><a href="https://www.wpbgutachter.xyz" target="_blank"><span><i class="fa fa-long-arrow-right footer-icon"></i></span>WPB-Gutachter</a></li>
                    </ul>
                </div>
<!--
                <div class="col-sm-2">
                    <h3>Support</h3>
                    <ul class="list-unstyled">
                        <li><a href="#"><span><i class="fa fa-long-arrow-right footer-icon"></i></span>Documentation</a></li>
                        <li><a href="#"><span><i class="fa fa-long-arrow-right footer-icon"></i></span>Forums</a></li>
                        <li><a href="#"><span><i class="fa fa-long-arrow-right footer-icon"></i></span>Language Packs</a></li>
                        <li><a href="#"><span><i class="fa fa-long-arrow-right footer-icon"></i></span>Release Status</a></li>
                        <li><a href="#"><span><i class="fa fa-long-arrow-right footer-icon"></i></span>Documentation</a></li>
                        <li><a href="#"><span><i class="fa fa-long-arrow-right footer-icon"></i></span>Forums</a></li>
                    </ul>
                </div>

                <div class="col-sm-3">
                    <h3>Get in touch</h3>
                    <p>Enter your email and we'll send you more information.</p>

                    <form action="#">
                        <div class="form-group">
                            <input placeholder="Your Email" type="email" required="">
                            <div class="submit-btn">
                                <button type="submit" class="text-center">Subscribe</button>
                            </div>
                        </div>
                    </form>
                </div>!-->
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-inner">
                <div class="row">
                    <div class="col-md-6 col-sm-12 footer-no-padding">
                        <p>&copy; Copyright 2019 EcologyTheme | All rights reserved</p>
                    </div>
                    <div class="col-md-6 col-sm-12 footer-no-padding">
                        <ul class="list-unstyled footer-menu text-right">
                            <li>Folgt uns:</li>
                            <li><a href="<?php echo e(config('app.facebook')); ?>"><i class="fa fa-facebook facebook"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- ./ End footer-bottom -->
</footer><!-- ./ End Footer Area-->
@extends('layouts.master')
@section('title', 'Contact Us')
@section('content')
    <body class="contact">
    <!-- Preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <header id="header">
        @include('layouts.topmenu')

        <div class="header-body">
            @include('layouts.topnavbar')

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="intro-text ">
                            <h1>Kontaktieren</h1>
                            <p><span><a href="#">Startseite <i class='fa fa-angle-right'></i></a></span> <span class="b-active">Kontaktieren</span></p>
                        </div>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div>
    </header>
    <!--  End header section-->
    <!-- Contact Area section -->
    <section class="contact-area-02">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 contact-info">
                    <div class="col-sm-12 contact-title">
                        <h2>Kontaktangaben</h2>
                        <p class="content-sub_p">Brauchst du hilfe? Dann schick uns gerne eine Nachricht oder komm vorbei</p>
                    </div>
                    <div class="col-sm-12 contact-box">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 single-address-box">
                                <div class="single-address">
								
                                    <i class="fa fa-facebook"></i>

                                    <h4>Facebookseite</h4>

                                    <a href="https://www.facebook.com/SkriptenzimmerKoeln">hier</a>
									
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6  single-address-box">
                                <div class="single-address">
                                    <i class="fa fa-envelope"></i>

                                    <h4>E-Mail</h4>

                                    <p>skriptenzimmer@gmail.com </p>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 single-address-box">
                                <div class="single-address">
                                    <i class="fa fa-map-marker"></i>
                                    <h4>ORT:</h4>

                                    <p>Skriptenzimmer, LFI, Bettenhaus</p>
                                </div>
                            </div>
                            <div class="col-sm-12 single-address-box">
                                <ul class="list-unstyled">
                                    <li><a href="#"><i class="fa fa-facebook teacher-icon"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter teacher-icon"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus teacher-icon"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin teacher-icon"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram teacher-icon"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6  col-sm-offset-1 contact-form">
                    <div class="row">
                        <div class="col-sm-12 contact-title-btm">
                            <h2>Schick eine Nachricht</h2>
                            <p class="content-sub_p">Dieses Formular funktioniert zurzeit nicht!!!</p>
                        </div>
                    </div>
                    <div class="input-contact-form">


                        <div id="contact">
                            <div id="message"></div>
 <!-- Das muss aktualisiert werden sowie unten den Submit Button wiederherstellen <form method="post" action="https://skripte.koeln/theme/eduread/contact.php" name="contactform" id="contactform"> !-->
								{!! Form::open(array('route' => 'contact.store', 'role'=>'form', 'id'=>'my-form')) !!}
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Name" name="name" id="name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="E-Mail" name="email" id="email">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Betreff" name="subject" id="subject">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea class="form-control" rows="6" placeholder="Nachricht" name="comments" id="comments"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="full-width">
                                             <input value="Submit" type="submit" name="submit" id="submit"> 
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ./ End Contact Area section -->
    </body>
@endsection

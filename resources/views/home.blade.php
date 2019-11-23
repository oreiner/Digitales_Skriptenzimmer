@extends('layouts.master')
@section('title', 'Home')
@section('content')
    <!-- Preloader  removed for performance
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
		-->
    <header id="header">
        @include('layouts.topmenu')


        <div class="header-body">
            @include('layouts.topnavbar')
            @include('layouts.messages')
        </div>

        <!--==================
           Slider
       ===================
        <div class="rev_slider_wrapper">
            <div id="rev_slider_1" class="rev_slider" style="display:none">

                <!-- BEGIN SLIDES LIST 
                <ul>
                    <li data-transition="boxfade" data-title="Slide Title" data-param1="Additional Text" data-thumb="images/index/slider-01.jpg">
                        <div class="slider-overlay"></div>
                        <!-- SLIDE'S MAIN BACKGROUND IMAGE 
                        <img src="images/skriptenzimmer/merged.png" alt="Sky" class="rev-slidebg">
                        <!-- BEGIN BASIC TEXT LAYER 
                        <!-- LAYER NR. 1 
                        <div class="tp-caption sfr font-extra-bold tp-resizeme letter-space-4 header-1 title-line-1"
                             data-x="left" data-hoffset="0"
                             data-y="center" data-voffset="-140"
                             data-frames='[{"delay":0,"speed":3000,"frame":"0","from":"x:[175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:1;","mask":"x:[-100%];y:0;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                             style="z-index: 6; font-size:60px; color:#fff; font-family: 'Montserrat', sans-serif;, serif; white-space: nowrap;font-weight:700;">Prüfung protokollieren,
                        </div>

                        <!-- LAYER NR. 2
                        <div class="tp-caption sfr font-extra-bold tp-resizeme letter-space-4 header-1 title-line-2"
                             data-x="left" data-hoffset="0"
                             data-y="center" data-voffset="-80"
                             data-frames='[{"delay":1000,"speed":3000,"frame":"0","from":"x:[175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:1;","mask":"x:[-100%];y:0;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                             style="z-index: 6; font-size:60px; color:#fff; font-family: 'Montserrat', sans-serif;, serif; white-space: nowrap;font-weight:700;">Das Nächste Protokoll herunterladen 
                        </div>

                        <!-- LAYER NR. 3 
                        <div class="tp-caption sfr font-extra-bold tp-resizeme letter-space-4 header-p"
                             data-x="left" data-hoffset="0"
                             data-y="center" data-voffset="-10"
                             data-frames='[{"delay":1000,"speed":3000,"frame":"0","from":"x:[175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:1;","mask":"x:[-100%];y:0;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                             style="z-index: 6; line-height:25px; font-size:15px; color:#fff; font-family: 'Open Sans', sans-serif;, serif; white-space: nowrap;"><br><!--platz für einen Text!
                        </div>

                        <!-- LAYER NR. 4 
                        <div class="tp-caption lfb tp-resizeme header-btn"
                             data-x="left" data-hoffset="0"
                             data-y="center" data-voffset="90"
                             data-frames='[{"delay":0,"speed":2000,"frame":"0","from":"y:bottom;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                             style="z-index: 8;"><a href="#Anleitung Protokolle" class="el-btn-regular slider-btn-left">Anleitung Protokolle</a> @guest <a href="#freischaltung" class="el-btn-regular">Anleitung Freischaltung</a> @endguest
                        </div>
                    </li>
                    <li data-transition="random" data-title="Slide Title" data-param1="Additional Text" data-thumb="images/index/slider-02.jpg">
                        <div class="slider-overlay"></div>
                        <!-- SLIDE'S MAIN BACKGROUND IMAGE 
                        <img src="images/index/slider-02.jpg" alt="Sky" class="rev-slidebg">
                        <!-- BEGIN BASIC TEXT LAYER 
                        <!-- LAYER NR.1 
                        <div class="tp-caption sfr font-extra-bold tp-resizeme letter-space-4 header-1 title-line-1"
                             data-x="left" data-hoffset="0"
                             data-y="center" data-voffset="-140"
                             data-frames='[{"delay":0,"speed":3000,"frame":"0","from":"x:[175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:1;","mask":"x:[-100%];y:0;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                             style="z-index: 6; font-size:60px; color:#fff; font-family: 'Montserrat', sans-serif;, serif; white-space: nowrap;font-weight:700;">Zusammen
                        </div>

                        <!-- LAYER NR. 2 
                        <div class="tp-caption sfr font-extra-bold tp-resizeme letter-space-4  header-1 title-line-2"
                             data-x="left" data-hoffset="0"
                             data-y="center" data-voffset="-80"
                             data-frames='[{"delay":1000,"speed":3000,"frame":"0","from":"x:[175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:1;","mask":"x:[-100%];y:0;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                             style="z-index: 6; font-size:60px; color:#fff; font-family: 'Montserrat', sans-serif;, serif; white-space: nowrap;font-weight:700;">die Prüfungen bestehen
                        </div>

                        <!-- LAYER NR. 3 
                        <div class="tp-caption font-lora sfb tp-resizeme letter-space-5 header-p"
                             data-x="left" data-hoffset="0"
                             data-y="center" data-voffset="-10"
                             data-frames='[{"delay":0,"speed":2000,"frame":"0","from":"y:top;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                             style="z-index: 6; line-height:25px; font-size:15px; color:#fff; font-family: 'Open Sans', sans-serif;, serif; white-space: nowrap;"><br><!--platz für einen Text 
                        </div>

                        <!-- LAYER NR. 4 
                        <div class="tp-caption lfb tp-resizeme header-btn"
                             data-x="left" data-hoffset="0"
                             data-y="center" data-voffset="90"
                             data-frames='[{"delay":0,"speed":2000,"frame":"0","from":"y:bottom;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                             style="z-index: 8;"><a href="#Anleitung Protokolle" class="el-btn-regular slider-btn-left">Anleitung Protokolle</a> <a href="#freischaltung" class="el-btn-regular">Anleitung Freischaltung</a>
                        </div>
                    </li>
                </ul><!-- END SLIDES LIST 

            </div><!-- END SLIDER CONTAINER 
        </div><!-- END SLIDER CONTAINER WRAPPER -->
		<div class="thumbnail img-responsive hidden-xs">
			<img src="images/skriptenzimmer/merged2b.jpg" alt="Sky" class="rev-slidebg">
		</div>
		<div class="thumbnail img-responsive visible-xs">
			<img src="images/skriptenzimmer/FSmobile.jpg" alt="Sky" class="rev-slidebg">
		</div>
    </header>
    <!--  End header section-->


	
    <section class="slider-content-bottom">
        <div class="container">
            <div class="row sider-btm-row-inner">
                <div class="col-sm-4 content_body slide_cont_box_01">
                    <div class="slider-btm-box btm-item_01">
                        <img src="images/index/slide-bottom-01.png" alt="" class="btm-item-icon">
                        @guest
                        <h3>Anmeldung</h3>
                        <p>Es geht ganz einfach. Wie?</p>
                        <a href="#Anleitung Protokolle">Lese hier<i class="fa fa-long-arrow-right slider-b-btn-icon"></i></a>
						<p>Du bist schon freigeschaltet?</p>
                        <a href="/login">anmelden<i class="fa fa-long-arrow-right slider-b-btn-icon"></i></a>
						@else
						<h3>Protokolle</h3>
                        <p>Wenn du mehr als ein Protokoll abgeben willst, kannst du uns mailen!</p>
                        <a href="/mailpdf">Protokolle herunterladen oder zusenden<i class="fa fa-long-arrow-right slider-b-btn-icon"></i></a>	
						<br><br>
						<h3>Skripte</h3>
                        <p>Skripte für dein Semester herunterladen. Immer griffbereit.</p>
                        <a href="/download">Skripte herunterladen<i class="fa fa-long-arrow-right slider-b-btn-icon"></i></a>
						@endguest
                    </div>
                </div>

                <div class="col-sm-4 content_body slide_cont_box_02">
                    <div class="slider-btm-box btm-item_02">
                        <img src="images/index/slide-bottom-02.png" alt="" class="btm-item-icon">
                        
                        <h3>Weitere Kollaborationen</h3>
                        <p>Preis der Lehre</p>
                        <a href="http://www.fsmed-koeln.de/20794.html" target="_blank">Hier klicken<i class="fa fa-long-arrow-right slider-b-btn-icon"></i></a>
						<p>WPB-Gutachter</p>
                        <a href="#WPB">Hier klicken<i class="fa fa-long-arrow-right slider-b-btn-icon"></i></a>
						<p>Medizinbüchermark Uni Köln</p>
                        <a href="https://www.facebook.com/groups/917724168254664/">Hier klicken<i class="fa fa-long-arrow-right slider-b-btn-icon"></i></a>
                        
                    </div>
                </div>

                <div class="col-sm-4 content_body slide_cont_box_03">
                    <div class="slider-btm-box btm-item_03">
                        <img src="images/index/slide-bottom-03.png" alt="" class="btm-item-icon">
                        <h3>Angebot</h3>
                        <p>von Kittel und Präpbesteck zu EKG-Lineal und Stethoskop - alles, was du für dein Studium benötigst.</p>
                        <a href="#Angebot">Zum Shop<i class="fa fa-long-arrow-right slider-b-btn-icon"></i></a>
                        <br><br>
                  		<h3>Häufig gestellte Fragen</h3>
                        <p>Du brauchst hilfe?</p>
                        <a href="{{url('faq')}}">Zu den FAQ<i class="fa fa-long-arrow-right slider-b-btn-icon"></i></a>
                  </div>
                </div>

            </div>
        </div>
    </section>
	
    <!-- Start Welcome Area section -->
    <section class="Welcome-area">
        <div class="container" id="Anleitung Protokolle">
            <div class="row">
                <div class="col-sm-6 Welcome-area-text">
                    <div class="row">
                        <div class="col-sm-12 section-header-box">
                            <div class="section-header section-header-l">
                                <h2>Anleitung Protokolle</h2>
                            </div><!-- ends: .section-header -->
                        </div>
                    </div>
                    <p>Wie funktioniert das Ganze eigentlich?</p>
                    <p>Wie der Kittelautomat funktioniert, weißt du bereits.
Den ersten Kittel darfst du einfach ziehen. Wenn du einen neuen haben willst, musst du erst deinen alten Kittel abgeben.
Und so ist das auch mit den Protokollen. Das erste Protokoll bekommst du vorgestreckt. Für das nächste Protokoll musst du deine absolvierte Prüfung protokollieren und einreichen.
Also, los geht's!</p>

                    <a href="{{url('faq')}}" class="read_more-btn fa fa-long-arrow-right">lese mehr</a>
                </div><!-- Ends: . -->

                <div class="col-sm-6 welcome-img">				@guest					<img src="images/index/welcome.jpg" alt="" class="img-responsive">				@else
                     <img src="images/index/trio.jpg" alt="" class="img-responsive">	 @endguest
				</div><!-- Ends: . -->
            </div>
        </div>
    </section><!-- Ends: . -->
    <!-- ./ End Welcome Area section -->
	
	<!-- Start Wie findest du uns section -->
    <section class="Ort-area">
        <div class="container" id="Skrizi_Ort">
            <div class="row">
                <div class="col-sm-6 Ort-area-text">
                    <div class="row">
                        <div class="col-sm-12 section-header-box">
                            <div class="section-header section-header-l">
                                <h2>Hier findest du uns</h2>
                            </div><!-- ends: .section-header -->
                        </div>
                    </div>
                    <p>Im Herzen des LFI-Gebäudes, direkt hinter der LFI-Fachschaft. Genau zwischen Hörsaal 2 und 5.  </p>
					<br>
					@guest
					<div class="row" id="freischaltung">
                        <div class="col-sm-12 section-header-box">
                            <div class="section-header section-header-l">
                                <h2>So schaltest du deinen Account frei</h2>
                            </div><!-- ends: .section-header -->
                        </div>
                    </div>
                    <p>Einfach erst hier auf der Seite registrieren. Wenn du einen Kreuzmich-User hast, kannst du uns im Anschluß eine E-Mail schicken. Sonst komme persönlich beim Skriptenzimmer vorbei. Dann schalten wir dich frei!  </p>
					<a href="/register" class="read_more-btn fa fa-long-arrow-right">Zur Registrierung</a>
					@endguest
                </div><!-- Ends: . -->
				
				<br>
                <div class="col-sm-6 Ort-img">
                    <img src="/images/skriptenzimmer/Ort.gif" alt="" class="img-responsive">
                </div><!-- Ends: . -->
            </div>
        </div>
    </section><!-- Ends: . -->
    <!-- ./ End Wie findest du uns section -->
	
    <!--Start Courses Area Section-->
    <section class="Courses-area"  id="Angebot">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 section-header-box">
                    <div class="section-header">
                        <h2>Angebot</h2>
                    </div><!-- ends: .section-header -->
                </div>
            </div>

            <div class="row courses-r-margin-bottom">
                <div class="col-sm-4 single-courses-box">
                    <div class="single-courses">
                        <figure>
                            <div class="figure-img"><img src="images/skriptenzimmer/kittel.jpg" alt="" class="img-responsive"></div> 
                            <figcaption>
                                <div><a href="{{ config('app.shop') }}" target='_blank' class="read_more-btn">Kauf bei uns im Skriptenzimmer</a></div>
                            </figcaption>
                        </figure>
                        <div class="courses-content-box">
                            <div class="courses-content">
                                <h3><a href="{{ config('app.shop') }}" target='_blank' >Kittel</a></h3>
                                <!--<div class="rank-icons">
                                    <ul class="list-unstyled">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                    <span>0 Reviews</span>
                                </div> !-->

                            </div>
                            <div class="courses-content-bottom">
                                <ul class="list-unstyled">
                                   <!-- <li><i class="fa fa-user"></i> 80</li>
                                    <li><i class="fa fa-heart"></i> 35</li> !-->
                                    <li><span>€19</span></li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- Ends: .single courses -->
                </div><!-- Ends: . -->


				<div class="col-sm-4 single-courses-box">
                    <div class="single-courses">
                        <figure>
                             <div class="figure-img"><img src="images/skriptenzimmer/hammer.jpg" alt="" class="img-responsive"></div> 
                            <figcaption>
                                <div><a href="{{ config('app.shop') }}" target='_blank' class="read_more-btn">Kauf bei uns im Skriptenzimmer</a></div>
                            </figcaption>
                        </figure>
                        <div class="courses-content-box">
                            <div class="courses-content">
                                <h3><a href="{{ config('app.shop') }}" target='_blank' >Reflexhammer</a></h3>
                                <!--<div class="rank-icons">
                                    <ul class="list-unstyled">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                    <span>0 Reviews</span>
                                </div> !-->
                            </div>
                            <div class="courses-content-bottom">
                                <ul class="list-unstyled">
                                    <li><span>€18</span></li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- Ends: .single courses -->
                </div><!-- Ends: . -->
				
                <div class="col-sm-4 single-courses-box">
                    <div class="single-courses">
                        <figure>
                            <div class="figure-img"><img src="images/skriptenzimmer/stethoscope.jpg" alt="" class="img-responsive"></div>
                            <figcaption>
                                <div><a href="{{ config('app.shop') }}" target='_blank' class="read_more-btn">Kauf bei uns im Skriptenzimmer</a></div>
                            </figcaption>
                        </figure>
                        <div class="courses-content-box">
                            <div class="courses-content">
                                <h3><a href="{{ config('app.shop') }}" target='_blank'>Stethoskope</a></h3>
                                <!--<div class="rank-icons">
                                    <ul class="list-unstyled">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                    <span>0 Reviews</span>
                                </div> !-->
                            </div>
                            <div class="courses-content-bottom">
                                <ul class="list-unstyled">
                                    <li><span>€64-€130</span></li>
									<li><span><i class="fa fa-stethoscope" aria-hidden="true"></i> 5</span></li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- Ends: .single courses -->
                </div><!-- Ends: . -->
            </div><!--End .row-->

            <div class="row courses-r-margin-bottom">
                <div class="col-sm-4 single-courses-box">
                    <div class="single-courses">
                        <figure>
                             <div class="figure-img"><img src="images/skriptenzimmer/handschuhe.jpg" alt="" class="img-responsive"></div> 
                            <figcaption> 
                                  <div><a href="{{ config('app.shop') }}" target='_blank' class="read_more-btn">Kauf bei uns im Skriptenzimmer</a></div>
                            </figcaption>
                        </figure>
                        <div class="courses-content-box">
                            <div class="courses-content">
                                <h3><a href="{{ config('app.shop') }}" target='_blank'>Handschuhe S,M,L</a></h3>
                                <!--<div class="rank-icons">
                                    <ul class="list-unstyled">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                    <span>0 Reviews</span>
                                </div> !-->
                            </div>
                            <div class="courses-content-bottom">
                                <ul class="list-unstyled">
                                    <li><span>€6,5</span></li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- Ends: .single courses -->
                </div><!-- Ends: . -->

                <div class="col-sm-4 single-courses-box">
                    <div class="single-courses">
                        <figure>
                            <div class="figure-img"><img src="images/skriptenzimmer/praepset.jpg" alt="" class="img-responsive"></div> 
                            <figcaption>
                                <div><a href="{{ config('app.shop') }}" target='_blank' class="read_more-btn">Kauf bei uns im Skriptenzimmer</a></div>
                            </figcaption>
                        </figure>
                        <div class="courses-content-box">
                            <div class="courses-content">
                                <h3><a href="{{ config('app.shop') }}" target='_blank'>Präparierset</a></h3>
                                <!--<div class="rank-icons">
                                    <ul class="list-unstyled">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                    <span>0 Reviews</span>
                                </div> !-->
                            </div>
                            <div class="courses-content-bottom">
                                <ul class="list-unstyled">
                                    <li><span>€13,5</span></li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- Ends: .single courses -->
                </div><!-- Ends: . -->

                <div class="col-sm-4 single-courses-box">
                    <div class="single-courses">
                        <figure>
                            <div class="figure-img"><img src="images/skriptenzimmer/leuchte.jpg" alt="" class="img-responsive"></div> 
                            <figcaption>
                                <div><a href="{{ config('app.shop') }}" target='_blank' class="read_more-btn">Kauf bei uns im Skriptenzimmer</a></div>
                            </figcaption>
                        </figure>
                        <div class="courses-content-box">
                            <div class="courses-content">
                                <h3><a href="{{ config('app.shop') }}" target='_blank' >Diagnostikleuchte</a></h3>
                                <!--<div class="rank-icons">
                                    <ul class="list-unstyled">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                    <span>0 Reviews</span>
                                </div> !-->
                            </div>
                            <div class="courses-content-bottom">
                                <ul class="list-unstyled">
                                    <!--<li><i class="fa fa-user"></i> 80</li>
                                    <li><i class="fa fa-heart"></i> 35</li>-->
                                    <li><span>€9,5</span></li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- Ends: .single courses -->
                </div><!-- Ends: . -->
            </div>
		
        </div>
    </section><!-- Ends: . -->
    <!-- ./ End Courses Area section !-->

    <!-- Start Video Area Section ->
    <section class="video-main-area video" id="PDL">
        <div class="container">
            <div class="row">
            <!--
                <div class="col-sm-12 video-play-btn">
                    <a href="https://youtu.be/j08SB1i1Grw" class="video-iframe"><i class="fa fa-play"></i></a>
                </div>
            ->
                <div class="col-sm-12 section-header-box">
                  <div class="section-header">
                          <h2>Preis der Lehre</h2>
                 </div>
                </div>
               <!-- ends: .section-header ->
               
               <div class="col-sm-12 section">
					<div class="video-content center-block embed-responsive embed-responsive-16by9"">
						<iframe class="center-block" src="https://www.youtube.com/embed/j08SB1i1Grw" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" frameborder="0"></iframe>   
					</div>
				</div>
				
				<div class="col-sm-12 section">
					<div class ="text-center">
						<h3><a href="http://www.fsmed-koeln.de/20794.html" class="btn-success">Lese mehr</a></h3>
					</div>
				</div>
            </div>
        </div>
    </section>
		!-->

	<!--
	<section class="events-area">
	
		<script>
			(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2';
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
		</script>
		<div class="container">
			<div class="row">
				<div class="col-xs-1"></div>
				<div class="col-xs-5">
						<div class="fb-page" data-href="https://www.facebook.com/SkriptenzimmerKoeln/" data-tabs="timeline" data-width="500" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/SkriptenzimmerKoeln/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/SkriptenzimmerKoeln/">Skriptenzimmer Medizin Köln</a></blockquote></div>
				</div>
				<div class="col-xs-5">	
						<div class="fb-page" data-href="https://www.facebook.com/FachschaftMedizinKoeln/" data-tabs="timeline" data-width="500" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/FachschaftMedizinKoeln/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/FachschaftMedizinKoeln/">Fachschaft-Medizin</a></blockquote></div>
				</div>
				<div class="col-xs-1"></div>
			</div>
		</div>
	</section>
	-->
    <!-- Start Counter Area section -->
	<section class="counter-area" id="WPB">
        <div class="container">
            <div class="row">		
                <div class="col-12 col-offset-0 col-sm-5 col-sm-offset-0 counters">
					<!-- grab  some Data to populate the numbers !-->
					<?php 
						$file = @file_get_contents('{{ config(\'app.wpb\') }}/site_statistics.php'); //@supress any warning
						if ($file){
							$stats = explode ("/", substr($file,-12));
						} else {
							$stats = ["?","?","?"]; //in case URL not found, doesn't break page
						} 
					?>
					
                    <div class="row">
                        <div class="col-sm-6 counters-item">
                            <div class="section counter-box" >
                                <img src="images/skriptenzimmer/wal.png" alt="" width="105">
                                <div class="project-count counter">1</div>
                                <span>Walphisch</span>
                            </div>
                        </div>

                        <div class="col-sm-6 counters-item">
                            <div class="section counter-box">
                                <img src="images/index/counter-icon-06.png" alt="">
                                <div class="project-count counter"><?php echo $stats[0] ; ?></div> <!-- something wierd is happening here, but I get NaN instead of ? either way !-->
                                <span>Wahlpflichtblöcke</span>
                            </div>
                        </div>

                        <div class="col-sm-6 counters-item">
                            <div class="section counter-box">
                                <img src="images/index/counter-icon-02.png" alt="">
                                <div class="project-count counter"><?php echo (isset($stats[1]) ? $stats[1] : '?'); ?></div>
                                <span>Textkommentare </span>
                            </div>
                        </div>

                        <div class="col-sm-6 counters-item">
                            <div class="section counter-box">
                                <img src="images/index/counter-icon-05.png" alt="">
                                <div class="project-count counter"><?php echo (isset($stats[2]) ? $stats[2] : '?'); ?></div>
                                <span> Notenvergaben</span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-12 col-offset-0 col-sm-5 col-sm-offset-0 counter-text-bottom">
                    <div class="counter-text-box  hidden-xs">
                        <div class="counter-text">
                            <div class="row">
                                <div class="col-sm-12 section-header-box">
                                    <div class="section-header" >
                                        <h2>Wahlpflichtblock-Gutachter</h2>
                                    </div><!-- ends: .section-header -->
                                </div>
                            </div>
                            <p>Es werden viele Wahlpflichtblöcke angeboten. Verschaffe dir ein Überblick! Hier kannst du Bewertungen durch deine Kommilitonen lesen und deine eigenen Evaluationen abgegben.</p>
                        </div>

                        <div class="counter-btn">
                            <a href="{{ config('app.wpb') }}">Direktzugang zum WPB-Gutachter</a>
                        </div>
                    </div>

					<div class="counter-text-box visible-xs">
						<div class="counter-btn">
								<a href="{{ config('app.wpb') }}">WPB-Gutachter</a>
						</div>
					</div>
				</div>
            </div>
        </div>
    </section>
    <!-- ./ End Counter Area section -->

    <!-- Publication Area section 
    <section class="publication-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 section-header-box">
                    <div class="section-header">
                        <h2>Our Publication</h2>
                    </div><!-- ends: .section-header 
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 col-md-3 single-book">
                    <div class="publication-single-item">
                        <a href="#"><img src="images/index/publicaton-01.jpg" alt="" class="img-responsive"></a>
                        <div class="publication-text">
                            <h3><a href="#">Lorem ipsum</a></h3>
                            <ul class="list-unstyled">
                                <li>$90</li>
                                <li><a href="#">buy now</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3  single-book">
                    <div class="publication-single-item">
                        <a href="#"><img src="images/index/publicaton-02.jpg" alt="" class="img-responsive"></a>
                        <div class="publication-text">
                            <h3><a href="#">Etiam maecenas</a></h3>
                            <ul class="list-unstyled">
                                <li>$90</li>
                                <li><a href="#">buy now</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3  single-book">
                    <div class="publication-single-item">
                        <a href="#"><img src="images/index/publicaton-03.jpg" alt="" class="img-responsive"></a>
                        <div class="publication-text">
                            <h3><a href="#">Ac penatibus</a></h3>
                            <ul class="list-unstyled">
                                <li>$90</li>
                                <li><a href="#">buy now</a></li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="col-sm-6 col-md-3  single-book">
                    <div class="publication-single-item">
                        <a href="#"><img src="images/index/publicaton-04.jpg" alt="" class="img-responsive"></a>
                        <div class="publication-text">
                            <h3><a href="#">Pede enim</a></h3>
                            <ul class="list-unstyled">
                                <li>$90</li>
                                <li><a href="#">buy now</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ./ End Publication Area section -->

    <!-- Start News Area section 
    <section class="news-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 section-header-box">
                    <div class="section-header">
                        <h2>Latest News</h2>
                    </div><!-- ends: .section-header 
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 news-single">
                    <div class="news-single-box">
                        <div class="news-img-box">
                            <img src="images/index/news-01.jpg" alt="" class="img-responsive">
                        </div>
                        <div class="news-content">
                            <h3><a href="#">The future of Web Design</a></h3>
                            <p class="news-time">
							<span>
								<i class="fa fa-calendar event-icon"></i>
								12 July, 2018
							</span>
                                <span>
								<i class="fa fa-user"></i>
								John Doe
							</span>
                                <span>
								<i class="fa fa-comment"></i>
								12
							</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 news-single">
                    <div class="news-single-box">
                        <div class="news-img-box">
                            <img src="images/index/news-02.jpg" alt="" class="img-responsive">
                        </div>
                        <div class="news-content">
                            <h3><a href="#">The future of Web Design</a></h3>
                            <p class="news-time">
							<span>
								<i class="fa fa-calendar event-icon"></i>
								12 July, 2018
							</span>
                                <span>
								<i class="fa fa-user"></i>
								John Doe
							</span>
                                <span>
								<i class="fa fa-comment"></i>
								12
							</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 news-single">
                    <div class="news-single-box">
                        <div class="news-img-box">
                            <img src="images/index/news-03.jpg" alt="" class="img-responsive">
                        </div>
                        <div class="news-content">
                            <h3><a href="#">The future of Web Design</a></h3>
                            <p class="news-time">
							<span>
								<i class="fa fa-calendar event-icon"></i>
								12 July, 2018
							</span>
                                <span>
								<i class="fa fa-user"></i>
								John Doe
							</span>
                                <span>
								<i class="fa fa-comment"></i>
								12
							</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ./ End News Area section -->

    <!-- ./ End Students Say Area section 
    <section class="students-say-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 section-header-box">
                    <div class="section-header">
                        <h2>What Students Parent SAY</h2>
                    </div><!-- ends: .section-header
                </div>
            </div>

            <div class="row">
                <div class="img-full-box">
                    <div class="col-sm-3 col-sm-offset-4">
                        <div class="carousel-images slider-nav">
                            <div>
                                <img src="images/index/stu-parent-01.jpg" alt="1" class="img-responsive img-circle">
                            </div>
                            <div>
                                <img src="images/index/stu-parent-02.jpg" alt="2" class="img-responsive img-circle">
                            </div>
                            <div>
                                <img src="images/index/stu-parent-03.jpg" alt="3" class="img-responsive img-circle">
                            </div>
                            <div>
                                <img src="images/index/stu-parent-04.jpg" alt="3" class="img-responsive img-circle">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-8 col-sm-offset-2">
                    <div class="carousel-text slider-for">
                        <div class="single-box">
                            <p>Lorem ipsum dolor sit amet, consecteituer adipiscing eluit, sed diapm nonummy nibh euismod tincidunt ut laoreet dolor you magna aliquam eratm volutpat. Ut wisiyp oenim adefra miniumyp veniam, quis nostrud exerci tation ullavolutpat ipsum.</p>
                            <ul class="list-unstyled rank-icons">
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                            </ul>
                            <h3>Jhonthan Smith</h3>
                            <span>Alexis, Parents</span>
                        </div>

                        <div class="single-box">
                            <p>Maecenas ut dui vitae magna vestibulum fermentum ut non est. Fusce finibus viverra enim, et laoreet metus fringilla sit amet. Ut dui nunc, aliquet ut malesuada sit amet, sagittis aliquam laoreet lorem. In hac habitasse platea dictumst.</p>
                            <ul class="list-unstyled rank-icons">
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                            </ul>
                            <h3>Jhon Doe</h3>
                            <span>Martin, Parent</span>
                        </div>

                        <div class="single-box">
                            <p>Aenean at leo hendrerit, congue erat ut, volutpat felis. Suspendisse et sapien purus. Aenean tincidunt diam ac magna scelerisque dapibus. Quisque non elit et justo tristique semper. Sed a urna eros. Etiam tempus tempus leo vel aliquam.</p>
                            <ul class="list-unstyled rank-icons">
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                            </ul>
                            <h3>Jhonthan Smith</h3>
                            <span>Alexis, Parents</span>
                        </div>

                        <div class="single-box">
                            <p>Cras ut ipsum et erat accumsan aliquam. Cras feugiat eu dolor a imperdiet. Vestibulum ornare, nunc a pulvinar pellentesque, mi ipsum elementum velit, lobortis convallis lacus ipsum eget nisl. Mauris eget est lorem praesent et metus laoreet.</p>
                            <ul class="list-unstyled rank-icons">
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                            </ul>
                            <h3>Jessica Alaba</h3>
                            <span>Martin, Parent</span>
                        </div>
                    </div>
                </div><!-- /.block-text
            </div>	<!--./End row
        </div>
    </section>
    <!-- ./ End Students Say Area section -->

    <!-- Instraction Area section 
    <section class="instraction-area">
        <div class="container">
            <div class="row inspiration-full-box">
                <div class="col-md-9 section-header-l">
                    <h2>Like to become an instructor?</h2>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit,</p>
                </div>

                <div class="col-md-3">
                    <div class="instraction-btn">
                        <a href="#" class="">get strated now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ./ End Instruction Area section -->

@endsection

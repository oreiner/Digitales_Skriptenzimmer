@extends('layouts.mailpdf')
@section('title', 'Freischaltung')
<style>
    .form-group .form-control {
        -moz-appearance: none;
        background-color: #fff;
        background-image: {{asset("images/index-03/down-arrow.png")}};
        background-position: 98% 50%;
        background-repeat: no-repeat;
        padding-left: 15px;
        border-radius: 0px;
        color: #666;
        padding-right: 15px;
        box-shadow: 0 0 0 rgba(0, 0, 0, 0.075) inset;
        height: 50px;
        opacity: 1;
    }
    .contact .contact-area-02 .contact-form .input-contact-form form input, .contact .contact-area-02 .contact-form .input-contact-form form textarea {
        background-color: transparent;
        border-radius: 0;
        box-shadow: none;
        font-size: 15px;
        margin: 0px 0 !important;
        padding: 10px 20px;
        outline: none;
    }


    .select2-container--bootstrap .select2-selection--multiple .select2-selection__choice {
        margin: 7px 0px 0 4px !important;
        padding: 3px 6px !important;
    }

    .select2-container--bootstrap .select2-selection--multiple .select2-selection__rendered {
        margin: 2px !important;
        width: 99% !important;
    }

		.verify-text {
			color: gainsboro;
		}


</style>

@section('content')



    <body class="contact">
    <!-- Preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <header id="header">
        @include('layouts.topmenu')

        <div class="header-body">
            <div class="container">

               <div class="row">

                  <div class="col-md-12">

                     <div class="intro-text ">
					 
						<h1>Danke, dass du deine Mail bestätigt hast.</h1><br>
                        <h1>Dein Account muss jetzt manuell von uns freigeschaltet werden.</h1><br>

                        <h3 class="verify-text ">Wenn du deinen Kreuzmich-Benutzernamen eingegeben hast, musst du eine kurze Zeit warten, bis wir dich manuell freischaltet haben.<br>Wenn nicht, schick uns eine E-Mail mit dem Benutzernamen oder komm einfach im Skriptenzimmer vorbei.</h3>

                        <p>

							<span>

								<a href="mailto:skriptenzimmer@gmail.com?cc=info@skripte.koeln">

                        <h1>skriptenzimmer@gmail.com</h1>
							
								</a>
								
							</span>
						</p>                    

                     </div>

                  </div>

               </div>
		   </div>
        </div>
    </header>
    <!--  End header section-->
    <!-- Contact Area section -->

    </body>
	
@endsection


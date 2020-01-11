@extends('layouts.mailpdf')
@section('title', 'Pdf Request')
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



</style>

@section('content')



    <body class="contact">
    <!-- Preloader  removed for performance
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
	--> 
    <header id="header">
        @include('layouts.topmenu')

        <div class="header-body">
            @include('layouts.topnavbar')

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="intro-text ">
                            <h1>Protokoll herunterladen</h1>
                            <p><span><a href="/">Startseite <i class='fa fa-angle-right'></i></a></span> <span class="b-active">Protokoll herunterladen</span></p>
                        </div>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div>
    </header>
    <!--  End header section-->
    <!-- Contact Area section -->
    <section class="contact-area-02">
        @include('layouts.messages')
        <div class="container">
            <div class="row">
                

                <div class="col-sm-6  contact-form">
                    <div class="row">
                        <div class="col-sm-12 contact-title-btm">
                            <h2>Protokoll zusenden lassen</h2>
                            <p class="content-sub_p">Durchsuche die relevanten Protokolle nach Prüfung und Prüfer. Du erhältst sie anschließend per Email.</p>
                        </div>
                    </div>
                    <div class="input-contact-form">
                          <div id="contact">
                            <div id="message"></div>
                            {!! Form::open(array('route' => 'mailpdf.store', 'role'=>'form', 'id'=>'my-form' ,'onsubmit'=>'return confirm("Bist du sicher, dass alles richtig ist?")')) !!}
                                <div class="row">
									<!-- choose test !-->
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            {{Form::select('test_id', $tests ,null,['class'=>'form-control','placeholder'=>'Prüfung auswählen','id'=>'test_id', 'onchange'=>"loadExaminerByTestid(); loadFachByTestid(); loadDatepickerDates();"])}}
                                            <span class="alertrequired">{!!$errors->first('test_id')!!}</span>
                                        </div>
                                    </div>
									<!-- choose subject !-->
                                    <div class="col-sm-12">
                                        <input type="hidden" id="subject" name="subject" value="{{ old('subject') }}">
                                        <div class="form-group" id="fachpicker">
											{{Form::select('fach', $mailPdf->getFaecherByTestId(old('test_id')) ,null,['name'=>'fachlist[]','class'=>'form-control','multiple'=>'multiple','placeholder'=>'--- FACH AUSWÄHLEN (optional) ---','id'=>'fach', 'style'=>'width:99%', 'onchange'=>"loadExaminerByFach();"])}}
                                            
                                            <span class="alertrequired">{!!$errors->first('fachlist')!!}</span>
                                        </div>
                                    </div>
									<!-- choose examiner !-->
                                    <div class="col-sm-12">
                                        <input type="hidden" id="minimum" name="minimum" value="{{ old('minimum') }}">
                                        <div class="form-group">
                                            <select name="examinerlist[]" id="examiner" multiple="multiple" class="form-control" data-placeholder="--- PRÜFER AUSWÄHLEN ---" style="width:99%;"/>
                                            <?php
                                            $testExaminers =$mailPdf->getExaminerByTestId(old('test_id'))
											
                                            ?>
                                               @foreach($testExaminers as $testExaminer)
                                                 <option value="{{$testExaminer->examiner_id}}">{{$testExaminer->examiner->name}}</option>
                                               @endforeach
                                            </select>
                                            <span class="alertrequired">{!!$errors->first('examinerlist')!!}</span>
                                        </div>
                                    </div>
									<!-- choose date of test !-->
									<div class="col-sm-12">
                                        {!! Form::label('date', 'Prüfungstermin: ', ['id' => 'datelabel'] ) !!}
										<div class="form-group">
											<div class="input-group date" id="datepicker">
												{!! Form::text('date', null, ['class' => 'form-control']) !!}
												<span class="input-group-addon">
													<!--<span class="glyphicon glyphicon-calendar">!--><span class="fa fa-calendar"></span>
												</span>
											</div>
										</div>
                                    </div>
									<!-- moderators can choose if to receive Protocols or not !-->
									<div>
									@if (Auth::user()->type=="user")
										<input type="hidden" name="with_email" value=1>
									@else
										<label><input type="checkbox" id="with_email_checkbox" name="with_email" checked> Protokolle per E-Mail erhalten</label>
									@endif      
									</div>
									<!-- send button !-->
									<div class="row">
										<div class="col-sm-12">
											<div class="full-width">
												<input value="Versenden" type="submit" name="submit" id="submit">
											</div>
										</div>
									</div>
									<div class="row">					
										<div class="full-width"><p>Bitte das Protokoll nur runterladen, wenn du deinen Prüfer zugeteilt bekommen hast.<br>Verstöße gegen die Regeln werden zur Sperrung führen!</p></div>          								
									</div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
				
				<div class="col-sm-5 col-sm-offset-1 contact-info ">
                    <div class="col-sm-12 contact-title">
                        <h2>Kontakt</h2>
                        <p class="content-sub_p">Brauchst du hilfe? Dann schick uns gerne eine Nachricht oder komm vorbei.</p>
                    </div>
                    <div class="col-sm-12 contact-box">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 single-address-box">
                                <div class="single-address">
                                    <i class="fa fa-facebook"></i>
                                    <h4>Facebookseite</h4>
                                    <a href="https://www.facebook.com/SkriptenzimmerKoeln" target="_blank">hier</a>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6  single-address-box">
                                <div class="single-address">
                                    <i class="fa fa-envelope"></i>
                                    <h4>E-Mail</h4>
                                    <a href="mailto:{{ config('mail.from.address') }}?cc=info@skripte.koeln" target="_top">{{ config('mail.from.address') }}</a>
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
				
				
            </div>
        </div>
    </section>
    <!-- ./ End Contact Area section -->

    </body>
	
@endsection


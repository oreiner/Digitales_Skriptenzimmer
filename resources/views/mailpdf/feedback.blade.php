@extends('layouts.master')
@section('title', 'Feedback')
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
                            <h1>Protokoll abschicken</h1>
                            <p><span><a href="#">Startseite <i class='fa fa-angle-right'></i></a></span> <span class="b-active">Protokoll abschicken</span></p>
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
                <div class="col-sm-12 contact-title">
                    <h2>Deine letzte Prüfung war</h2>
                </div>
			</div>	
			<div class="row">
				<div class="col-sm-12 contact-form">
					<div class="input-contact-form">
						<div class="view_more_btn" style="float: center">
							{!! Form::model($usertotest, ['route'=>['mailpdf.resend',$usertotest->id],'method'=>'GET','role'=>'form','id'=>'resend-form']) !!}
								<button value="Altprotokoll nochmal versenden" type="submit" class="btn view-more-item" name="resend" id="resend">Altprotokoll nochmal versenden &nbsp; &nbsp;<i class="fa fa-paper-plane" aria-hidden="true"></i></button>
							{!! Form::close() !!}
						</div>
					</div>
				</div>	
			</div>	
			<div class="row">
				<br><p>Beachte: Sowohl Fragen als auch Antworten müssen jeweils mindestens 10 Zeichen lang sein.</p>
			</div>
			<div class="row">
                {!! Form::model($usertotest, ['route'=>['mailpdf.update',$usertotest->id],'method'=>'PUT','role'=>'form','id'=>'my-form']) !!}
                <div id="contact">
                <div class="col-sm-6 contact-form">


                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach




                            <div class="input-contact-form">
                                    <div class="row">

                                                <div class="col-sm-8">
                                                    <label>Prüfungsangaben :</label>
                                                    <div class="form-group">
                                                        <input type="hidden" name="test_id" value="<?php echo $usertotest->test->id; ?>">
                                                        <input value="{{$usertotest->test->name}}"   type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"  required autofocus placeholder="Name" readonly>
                                                    </div>
                                                </div>
                                                 <div class="col-sm-4">
                                                     <label>Semester :</label>
                                                    <div class="form-group">
                                                        {{Form::select('semester_session', $sessions ,$mailPdfRequestDate,['class'=>'form-control','placeholder'=>'Select Session','id'=>'test_id'])}}
                                                        <span class="alertrequired">{!!$errors->first('semester_session')!!}</span>
                                                    </div>
                                                 </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                               <label>Deine Prüfer waren :</label>
                                               @foreach($usertotest->mailpdfs as $mailpdf)
                                                <div class="form-group">
                                                   <input value="<?php echo $mailpdf->examiner->name; ?>"   type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"  required autofocus placeholder="Name" readonly>
                                                 </div>
                                               @endforeach
                                        </div>

                                        <div class="col-sm-12">
                                            <label>Zusätzliche Informationen (Atmosphäre, Prüfungsmodus etc.) :</label>
                                                <div class="form-group">
                                                    <textarea name="extra_information" rows="6" style="resize: both;" class="form-control{{ $errors->has('extra_information') ? ' is-invalid' : '' }}"  placeholder="Extra Information">{{ old('extra_information') }}</textarea>
                                                </div>
                                        </div>
                                    </div>





                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>Welche Note hast du bekommen? (anonym) :</label>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="grade" id="gridRadios2" value="Ich will nicht mitteilen" checked>
                                                    &nbsp;&nbsp; Ich möchte meine Note nicht mitteilen.
                                                </label>
                                            </div>

                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="grade" id="gridRadios1" value="1">
                                                   &nbsp;&nbsp; 1
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="grade" id="gridRadios2" value="2">
                                                    &nbsp;&nbsp; 2
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="grade" id="gridRadios2" value="3">
                                                    &nbsp;&nbsp; 3
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="grade" id="gridRadios2" value="4">
                                                    &nbsp;&nbsp; 4
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="grade" id="gridRadios2" value="failed">
                                                    &nbsp;&nbsp; durchgefallen
                                                </label>
                                            </div>


                                        </div>
							</div>
						</div>
                   </div>

					<div class="col-sm-6 contact-form">
						<div class="input-contact-form">
							<div class="row">
								<div class="col-sm-12">
									<div class="col-sm-12">
										<?php $num=0; ?>
										@foreach($usertotest->mailpdfs as $mailpdf)
											<input type="hidden" name="mailpdflist[]" value="<?php echo $mailpdf->id; ?>">
											<input type="hidden" name="examinerlist[]" value="<?php echo $mailpdf->examiner->id; ?>">
											<div class="form-group">
												<label>Fragen <?php echo $mailpdf->examiner->name; ?> </label>
												<textarea class="form-control" placeholder="Die gestellte Fragen hier" name="questions[]" rows="6" style="resize: both;">{{ old('questions.'.$num) }}</textarea>
												<span class="alertrequired">{!!$errors->first('questions.'.$num)!!}</span>
											</div>
											<div class="form-group">
												<label>Antworten</label>
											<textarea class="form-control" placeholder="Deine Antworten und die erwartete Antworten hier" name="answers[]" rows="6" style="resize: both;">{{ old('answers.'.$num) }}</textarea>
												<span class="alertrequired">{!!$errors->first('answers.'.$num)!!}</span>
											</div>
											<?php $num++ ?>
										@endforeach
										<p>Es empflielt sich, die Texte in einem externen Texteditor zu schreiben und sie im Anschluss in das Formular zu übertragen.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

                <div class="col-sm-12">
					<div class="row">	
						<div class="col-sm-12 contact-form">
							<div class="input-contact-form">
								<div class="view_more_btn" style="float: right">
									<button value="Protokoll abgeben" type="submit" class="btn view-more-item" name="submit" id="submit">Protokoll abgeben &nbsp; &nbsp;<i class="fa fa-cloud-upload" aria-hidden="true"></i></button>
								</div>
							</div>
						</div>
					</div>
					<div class="row">		
						<div class="col-sm-8"></div>				
						<div class="col-sm-4"><p>Die Prüfung ist zu lange her und du weißt gar nicht mehr, was du gefragt wurdest? Hat einer der Prüfer gewechselt und du brauchst ein neues Protokoll? Oder hast du ein anderes Problem mit dem Protokoll?<br>Bitte schreib nichts Sinnloses. Dies würden sonst all deine NachfolgerInnen bekommen!<br>Kontaktiere uns und wir schalten dich frei.</p></div>         								
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </section>

    </body>
@endsection

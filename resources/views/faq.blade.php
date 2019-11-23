@extends('layouts.faq')
@section('title', 'FAQ')
@section('content')


    <!-- Teachers Area section -->
    <section class="register-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
					<div id="faq" role="tablist" aria-multiselectable="true">		
					   <h2>Häufig gestellte Fragen</h2><br>
						<p>
							<h3>Freischaltung</h3>
							
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="questionOne">
									<h5 class="panel-title">
									<a data-toggle="collapse" data-parent="#faq" href="#answerOne" aria-expanded="false" aria-controls="answerOne">
									Ich möchte ein Protokoll herunterladen aber unter "Protokolle" steht, dass ich noch freigeschaltet werden muss. Wie und wann passiert das?
									</a>
									</h5>
								</div>
								<div id="answerOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="questionOne">
									<div class="panel-body">
									Erst musst du dein E-Mail bestätigen. Bitte schaue in deinem Posteingang oder ggf. Spamordner nach. Wenn du keine E-Mail bekommen hast, kannst du von der "<a href="{{url('mailpdf')}}">Protokolle</a>"-Seite eine E-Mail nachsenden lassen.<br><br>
									Zudem müssen wir dich manuell freischalten. In der Regel passiert das während der Öffnungszeiten des Skriptenzimmers. Allerdings können wir dich nur freischalten, wenn du deinen echten Namen eingegeben hast und du auf Kreuzmich zu finden bist. <br><br>
									Wenn du deinen Namen ändern möchtest, schicke uns bitte eine E-Mail.<br><br>
									Wenn du keinen Kreuzmich-Account hast oder uns diesen nicht mitteilen möchtest, musst du bei der Skriptenzimmer vorbeikommen und deinen Studienausweis zeigen.<br>						
									</div>
								</div>
							</div>
							<br>
							
							<h3>Protokolle</h3>
							
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="questionTwo">
									<h5 class="panel-title">
									<a class="collapsed" data-toggle="collapse" data-parent="#faq" href="#answerTwo" aria-expanded="false" aria-controls="answerTwo">
									Darf ich einfach ein Protokoll herunterladen? Was passiert wenn ich ein Protokoll gewählt und auf "Versenden" geklickt habe?
									</a>
									</h5>
								</div>
								<div id="answerTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="questionTwo">
									<div class="panel-body">
									Erst musst du deine Prüfer offiziel von der Uni zugeteilt bekommen.<br>
                                    Wenn du diese Information hast, kannst du auf "<a href="{{url('mailpdf')}}">Protokolle</a>" gehen, die richtige Prüfung aussuchen und die entsprechende Prüfer wählen. Um die Suche zu vereinfachen, kannst du auch das Fach eingeben oder den Prüfername mit der Tastatur selber eintippen.<br>
									Wenn du alle Prüfer gefunden hast und auf "Versenden" geklickt hast, bekommst du die Protokolle per E-Mail, an der Adresse die unter deinem Profil steht.<br>
									</div>
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="questionThree">
									<h5 class="panel-title">
									<a class="collapsed" data-toggle="collapse" data-parent="#faq" href="#answerThree" aria-expanded="true" aria-controls="answerThree">
									Ich habe eine Meldung bekommen, dass eine Mail mit einem Protokoll geschickt wurde. Ich habe aber nichts bekommen. Was nun?
									</a>
									</h5>
								</div>
								<div id="answerThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="questionThree">
									<div class="panel-body">
									Erstmal Geduld üben! Jenachdem wie stark der Server ausgelastet ist, kann es ein bisschen dauern.<br>
                                    Bitte kontrolliere, ob die E-Mail-Adresse unter deinem Profil richtig ist und schaue in deinem Posteingang und Spamordner nach.<br>
                                    Falls du die Adresse korrigieren musstest, kannst du die Protokolle nochmal versenden, indem du auf "<a href="{{url('mailpdf')}}">Protokolle</a>" gehst und oben auf "Protokolle nochmal versenden" klickst.<br>
                                    Wenn es noch immer Probleme gibt, schreib uns bitte an. Bitte <b>NICHT</b> einfach irgendetwas reinschreiben und auf "versenden" klicken, um nochmal ein Protokoll aussuchen zu können - das führt zu einem permanenten Bann.<br>
                                    </div>
                                </div> 
							</div>
							
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="question4">
									<h5 class="panel-title">
									<a class="collapsed" data-toggle="collapse" data-parent="#faq" href="#answer4" aria-expanded="true" aria-controls="answer4">
									Mein Prüfer hat gewechselt bzw. ich habe ein falsches Protokoll ausgewählt. Was soll ich jetzt tun?
									</a>
									</h5>
								</div>
								<div id="answer4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="question4">
									<div class="panel-body">
									Wir müssen dich manuell entsperren, bitte schreib uns direkt an. dann kannst du im Anschluß die Prüfer erneuet aussuchen und die richtigen Protokolle versenden lassen.<br>  
                                    Bitte <b>NICHT</b> einfach irgendetwas reinschreiben und auf "versenden" klicken, um nochmal ein Protokoll aussuchen zu können.<br> 
                                </div>
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="question5">
									<h5 class="panel-title">
									<a class="collapsed" data-toggle="collapse" data-parent="#faq" href="#answer5" aria-expanded="true" aria-controls="answer5">
									Ich hatte jetzt meine Prüfung absolviert. Was soll ich jetzt tun?
									</a>
									</h5>
								</div>
								<div id="answer5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="question5">
									<div class="panel-body">
									Erstmal herzlichen Glückwunsch!<br> 
                                    Du kannst jetzt nochmal auf "<a href="{{url('mailpdf')}}">Protokolle</a>" gehen. Da du schon Protokolle erhalten hast, findest du dort nun die Auflistung deiner Prüfer und Text-Kästen für die Fragen & Antworten.<br> 
                                    Bitte schreib so ausführlich, wie du kannst, sodass andere davon so viel, wie möglich profitieren können!<br> 
                                    Übrigens: falls dir etwas einfällt, nachdem du dein Protokoll abgegeben hast, kannst du einfach die Prüfer nochmal aussuchen und ihre Protokolle versenden lassen. So kommst du wieder auf der Protokollabgabe Seite und kannst noch weitere Details ergänzen.</div>
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="question6">
									<h5 class="panel-title">
									<a class="collapsed" data-toggle="collapse" data-parent="#faq" href="#answer6" aria-expanded="true" aria-controls="answer6">
									Ich habe vergessen, damals ein Protokoll abzugeben, aber jetzt brauche ich ein neues Protokoll für die nächste Prüfung. Soll ich einfach irgendetwas reinschreiben um mich zu entsperren?
                                     </a>
									</h5>
								</div>
								<div id="answer6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="question6">
									<div class="panel-body">
									Definitiv <b>NICHT!</b><br>
									bitte schreib uns direkt an, schildere deine Situation und wir werden dich wieder für weitere Protokolle entsperren.<br>
                                    Wenn du einfach irgendetwas in dem Protokoll reinschreibst, wird der Quatsch verweigt und deine Nachfolger belasten. Das wäre ggf. ein Grund, dich von der Seite und allen weiteren Prüfungen zu bannen.<br>
                                    Um dies zu vermeiden,versuch bitte die Protokoll möglichst früh nach deiner Prüfung einzureichen.<br>
                                  </div>
								</div>
							</div>		

							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="question7">
									<h5 class="panel-title">
									<a class="collapsed" data-toggle="collapse" data-parent="#faq" href="#answer7" aria-expanded="true" aria-controls="answer7">
									Ich habe eine PDF mit einer Seite, worauf steh, dass es kein Protokoll für diesen Prüfer gibt. Was nun?
									</a>
									</h5>
								</div>
								<div id="answer7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="question7">
									<div class="panel-body">
									Wir haben leider kein Protokoll für den Prüfer in unserer Datenbank. Entweder hat er noch nie bei uns geprüft oder keiner hat seine Erfahrungen protokolliert.<br>
                                    Daher ist es umso wichtiger, dass du im Anschluß deiner Prüfung etwas zu dem Prüfer schreibst!<br><br>
                                    Für manche Prüfer sind die Protokolle aus unserem Archiv leider verloren gegangen. In dem Fall, dass du von Kommilitonen doch ein Protokoll organisieren könntest, bitte sende es an uns weiter! Dann könnten wir das Protokoll hochladen und wieder zu Verfügung stellen.<br>
                                    Danke!
									</div>
								</div>
							</div>	

							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="question8">
									<h5 class="panel-title">
									<a class="collapsed" data-toggle="collapse" data-parent="#faq" href="#answer8" aria-expanded="true" aria-controls="answer8">
									Mein Prüfer steht nicht in der Liste. Was nun?
									</a>
									</h5>
								</div>
								<div id="answer8" class="panel-collapse collapse" role="tabpanel" aria-labelledby="question8">
									<div class="panel-body">
									Bitte schreib uns direkt an. Dann können wir ihn hinzufügen und das Protokollieren für diesen ermöglichen!
									</div>
								</div>
							</div>			
								
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="question9">
									<h5 class="panel-title">
									<a class="collapsed" data-toggle="collapse" data-parent="#faq" href="#answer9" aria-expanded="true" aria-controls="answer9">
									Wir haben als Gruppe ein Sammelprotokoll erstellt, reicht das ein Protokoll abuzgeben?
									</a>
									</h5>
								</div>
								<div id="answer9" class="panel-collapse collapse" role="tabpanel" aria-labelledby="question9">
									<div class="panel-body">
									Prinzipiell ja, nur werden nicht alle Prüflinge automatisch für die nächste Prüfung freigestellt.<br>
                                    Falls ihr das so machen möchtet, sollte bitte der Prüfling, der das Protokoll einreicht, auch eine E-Mail  mit den Namen der Anderen an uns schreiben.<br>
                                    Dann werden wir die anderen Gruppenmitglieder manuell entsperren. Bitte NICHT jeder das gleiche Protokoll einreichen!
									</div>
								</div>
							</div>			
								
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="question10">
									<h5 class="panel-title">
									<a class="collapsed" data-toggle="collapse" data-parent="#faq" href="#answer10" aria-expanded="true" aria-controls="answer10">
									Ich komme mit dem Verfassen am Computer gar nicht klar. geht das irgendwie anders?
									</a>
									</h5>
								</div>
								<div id="answer10" class="panel-collapse collapse" role="tabpanel" aria-labelledby="question10">
									<div class="panel-body">
									Klar! Das physische Skriptenzimmer mit dem alten System ist noch immer in Betrieb.<br> 
                                    Komm einfach beim Skriptenzimmer im LFI vorbei, zahle das Pfand (10€ bzw. 25€) und dann bekommst du ein ausgedrucktes Protokoll.<br>
                                    Wenn du dein Pfand zurück haben möchtest, schick uns dein Protokoll per E-Mail und komm vorbei, um deinen Pfandschein abzugeben.
                                  </div>
								</div>
							</div>			
							<br>
							
							<h3>Skripte</h3>	
								
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="question11">
									<h5 class="panel-title">
									<a class="collapsed" data-toggle="collapse" data-parent="#faq" href="#answer11" aria-expanded="true" aria-controls="answer11">
									Kann ich kostenlos einfach so viele Dateien herunterladen, wie ich möchte?
									</a>
									</h5>
								</div>
								<div id="answer11" class="panel-collapse collapse" role="tabpanel" aria-labelledby="question11">
									<div class="panel-body">
									Anders, als bei den Prüfungsprotokolle, ja! Viel Spaß mit den <a href="{{url('download')}}">Skripten</a>.
									</div>
								</div>
							</div>			
								
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="question12">
									<h5 class="panel-title">
									<a class="collapsed" data-toggle="collapse" data-parent="#faq" href="#answer12" aria-expanded="true" aria-controls="answer12">
									Ich hätte ein Skript, das ich hochladen möchte. Wie geht das?
									</a>
									</h5>
								</div>
								<div id="answer12" class="panel-collapse collapse" role="tabpanel" aria-labelledby="question12">
									<div class="panel-body">
									Super!<br> 
                                    Bitte schick uns die Datei per E-Mail, und wir laden sie für dich hoch. Dann können all deine Kommilitonen davon profitieren.
									</div>
								</div>
							</div>			
								
							<h3>Sonstiges</h3>		
								
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="question14">
									<h5 class="panel-title">
									<a class="collapsed" data-toggle="collapse" data-parent="#faq" href="#answer14" aria-expanded="true" aria-controls="answer14">
									Meine Frage steht nicht auf der FAQ-Liste.
									</a>
									</h5>
								</div>
								<div id="answer14" class="panel-collapse collapse" role="tabpanel" aria-labelledby="question14">
									<div class="panel-body">
									Schicke uns eine E-Mail an: <a href="mailto:{{ config('mail.from.address') }}" target="_top">{{ config('mail.from.address') }}</a>!
									</div>
								</div>
							</div>					
						</p>
					</div>
                </div>
            </div>
        </div>
    </section>
    <!-- ./ End Teachers Area section -->
{{--<div class="container">--}}
    {{--<div class="row justify-content-center">--}}
        {{--<div class="col-md-8">--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">{{ __('Register') }}</div>--}}

                {{--<div class="card-body">--}}
                    {{--<form method="POST" action="{{ route('register') }}">--}}
                        {{--@csrf--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>--}}

                                {{--@if ($errors->has('name'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('name') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>--}}

                                {{--@if ($errors->has('email'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>--}}

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row mb-0">--}}
                            {{--<div class="col-md-6 offset-md-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--{{ __('Register') }}--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
@endsection


<script>
// Set to the same value as the web property used on the site
var gaProperty = 'UA-134069936-1';

// Disable tracking if the opt-out cookie exists.
var disableStr = 'ga-disable-' + gaProperty;
if (document.cookie.indexOf(disableStr + '=true') > -1) {
  window[disableStr] = true;
}

// Opt-out function
function gaOptout() {
  document.cookie = disableStr + '=true; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
  window[disableStr] = true;
}
</script>

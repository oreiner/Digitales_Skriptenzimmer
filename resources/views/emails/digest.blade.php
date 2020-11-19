@component('mail::message')
# Liebes Team,

anbei findet Ihr alle neue Benutzer von letzer Woche, die noch nicht freigeschaltet worden. (auch die, die zurecht noch nicht freigeschaltet worden)<br>
Zusätzlich alle neue Kommetare von Letzer Woche.<br>
Bitte Kontrolliert sie auf Sinnhaftigkeit etc.<br>
<strong>Gegebenenfalls müsst ihr auf " Vollständige Nachricht ansehen" klicken!</strong><br>
<br><u><strong>Neue Benutzer</strong></u><br>
@forelse ($new_users as $user)

		 Name: {{$user->name}}
		 E-Mail: {{$user->email}}
		 Skriptenzimmer-Benutzername: {{$user->bio}}
		 Kreuzmich-Benutzername: {{$user->bio}}
@empty
	
	Keine neue Benutzer
@endforelse
	

<br><br><u><strong>Neue Kommentare</strong></u><br>
@forelse ($ids as $id)
<!-- the use of first() needed because this is a weird workaround with the ids !-->
<?php $usertotest=$new_comments->where('id',$id)->first() ?>
<u>Empfangenes Protokoll-ID:</u> {{$usertotest->id}}

<u>Name:</u> {{$usertotest->user->name}}

<u>Fragen:</u> <br> @foreach ($usertotest->mailpdfs->pluck('questions') as $key => $q) Einzelprotokoll {{$key+1}} (von {{count($usertotest->mailpdfs->pluck('questions'))}}): {{($q)}} <br><br>
			@endforeach
		
<u>Antworten:</u> <br> @foreach ($usertotest->mailpdfs->pluck('answers') as $a) Einzelprotokoll {{$key+1}} (von {{count($usertotest->mailpdfs->pluck('answers'))}}): {{($a)}} <br><br>
			@endforeach

<u>Tipps:</u> <br> @foreach ($usertotest->mailpdfs->pluck('personal_extra') as $a) Einzelprotokoll {{$key+1}} (von {{count($usertotest->mailpdfs->pluck('answers'))}}): {{($a)}} <br> <br>
			@endforeach
		
<u>Extra Informationen:</u>  <br> {{$usertotest->extra_information}} 

--------------------

@empty
	
	Keine neue Kommentare
@endforelse
	




<!--
<br><br><u><strong>Neue Kommentare</strong></u><br>
@forelse ($new_comments as $usertotest)
{{$usertotest}}
<u>Empfangenes Protokoll-ID:</u> {{$usertotest->id}}

<u>Name:</u> {{$usertotest->user->name}}

<u>Fragen:</u> @foreach ($usertotest->mailpdfs->pluck('questions') as $q) {{($q)}} 
			@endforeach
		
<u>Antworten:</u> @foreach ($usertotest->mailpdfs->pluck('answers') as $a) {{($a)}} 
			@endforeach

<u>Tipps:</u> @foreach ($usertotest->mailpdfs->pluck('personal_extra') as $a) {{($a)}} 
			@endforeach
		
<u>Extra Informationen:</u> {{$usertotest->extra_information}} 

--------------------

@empty
	
	Keine neue Kommentare
@endforelse
!-->
<br>
Vielen Dank!<br>
Viele Grüße<br>
Der Skriptenzimmer Roboter
@endcomponent
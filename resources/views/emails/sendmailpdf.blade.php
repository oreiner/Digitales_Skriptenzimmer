@component('mail::message')
# Hallo {{$content['username']}},

anbei die Protokolle, die du angefragt hast.<br>
Bitte vergiss nicht, kurz nach der Prüfung dein eigenes Protokoll abzugeben, sodass die nächsten Semester davon profitieren können und du wieder freigeschaltet wirst.<br>

Vielen Dank und viel Erfolg bei der Prüfung!<br>
Beste Grüße<br>
Dein Skriptenzimmer-Team<br><br>

<hr>
<p><small>
Dies ist eine automatisch generierte E-Mail von einer System-E-Mail-Adresse.<br>
Bitte antworten Sie nicht auf diese E-Mail.<br>
Bitte wenden Sie sich bei Fragen direkt an <a href="mailto:{{ config('mail.from.address') }}" target="_top">{{ config('mail.from.address') }}</a><br>
Vielen Dank.<br>
</small></p>
@endcomponent
@component('mail::message')
# Hallo {{$name}},<br>

bisher hast du dein Protokoll noch nicht abgegeben.<br>
Wir würden uns freuen, wenn du uns möglichst bald dein Protokoll schickst.<br>
Nur so können deine Kommilitonen von deinem Engagement profitieren und nur so wirst du anschließend für die nächste Prüfung freigeschaltet.<br>
<a href="{{config('app.url'}}/mailpdf">Hier kannst du dein Protokoll abgeben.</a><br>
Vielen lieben Dank!<br>

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
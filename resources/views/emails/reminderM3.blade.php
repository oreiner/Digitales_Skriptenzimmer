@component('mail::message')
# Hallo {{$name}},<br>

falls, du deine Prüfung noch nicht absolviert hast, bitte ignoriere diese E-Mail.<br><br>

Gratulation erst einmal! Die letzte Prüfung des Studiums liegt hinter dir!<br>
<!--Nach unseren Informationen hast du am {{-- $?date --}} deine Prüfung absolviert.<br>-->
Leider hast du noch kein Protokoll abgegeben.<br>
Das geht ganz schnell und hilft deinen Nachfolgern—genau wie du Hilfe von deinen Vorgängern bekommen hast.<br>
<a href="https://www.skripte.koeln/mailpdf">Hier kannst du dein Protokoll abgeben.</a><br>

Besonders für die M3 ist das Protokollieren wichtig. Für manche Prüfer gibt es nur sehr wenige Protokolle, obwohl sie schon jahrelang prüfen.<br>
Vielen Dank im Voraus für dein Engagement!<br>


Beste Grüße<br>
Dein Skriptenzimmer-Team
@endcomponent
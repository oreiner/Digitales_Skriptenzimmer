# Digitales Skriptenzimmer

Diese Anleitung ist noch nicht vollständig! 
Sie wird im Verlauf berarbeitet.

#### Nutzer können
  - Protokolle herunterladen
  - Anschließend Protokoll ergänzen
  - ...
  
#### Moderator können
 - Nutzer freischalten und verwalten
 - Prüfer erstellen
 - Protokolle hochladen
 - Zeiträume für Erinnerungs-E-Mail anpassen
 - ...

#### Administratoren können
 - wie Moderatoren fungieren
 - Prüfungen erstellen
 - Verschiedene Sachen löschen
 - ...

## Installation

Die Webseite ist Laravel basiert. Um sie für euer Uni zu installieren, müsst ihr 
1. Dateien auf einem Hosting hochladen.
2. Datenbank erstellen mit import db_vorlage_skrizi.sql 
bzw. Laravel installieren (siehe https://laravel.com/docs/5.7/installation) und auf dem Server 
>> php artisan migrate
3. .env Datei mit euren URLs, Mail-Daten usw. konfigurieren.
>>[...]
4. nachdem .env fertig ist 
>>php artisan config:cache

bei jeder Änderung der .env Datei muss man die Cache nochmal  mit diesem Befehl aktualisieren

5. Alle Texte unter /resources/views/ für euch anpassen

## Webseite für eure Prüfungen bereitstellen
1. Admin User auf der Seite registrieren und in der Datenbank auf type:admin ändern
2. einloggen auf https://URL/admin
2. Im Admin-Panel Prüfer und Prüfungen erstellen, dann Protokolle hochladen.
...

## Weitere Funktionen
Sind auf der admin Startseite beschrieben
[...]

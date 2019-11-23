# Digitales Skriptenzimmer

Diese Anleitung ist noch nicht vollständig! 
Sie wird im Verlauf berarbeitet.

#### Nutzer können:
  - Protokolle nach dem "Kittelautomat"-System erhalten. Erstes Protokoll herunterladen und anschließend eigenes Protokoll ergänzen um sich wieder freizuschalten.
  - Skripte unbegrenzt herunterladen
  - ...
  
#### Moderator können:
 - Nutzer freischalten und verwalten
 - Prüfer erstellen
 - Protokolle und Skripte hochladen
 - Kommentare von Nutzer löschen
 - Zeiträume für Erinnerungs-E-Mail anpassen
 - ...

#### Administratoren können:
 - Alle Moderatoren Funktionen
 - Nutzer ein Ban geben
 - Prüfungen erstellen
 - Nutzer, Prüfer, Protokolle,  etc. löschen
 - ...

#### Der Skriptenzimmer-Roboter kann:

 - Digest über neuen Nutzer und neuen abgegebenen Protokolle an die Moderatoren herumschicken 
 
## Installation

Die Webseite ist Laravel basiert. Um sie für euer Uni zu installieren, müsst ihr: 
1. Dateien auf einem Hosting hochladen.
2. Datenbank erstellen und in phpmyadmin die Vorlage importieren 
>> /database/db_vorlage_skrizi.sql  

bzw. Laravel installieren (siehe https://laravel.com/docs/5.7/installation) und mit dem Server mit ssh verbinden. Dann:  
>> php artisan migrate
3. .env Datei mit euren URLs, Mail-Daten usw. konfigurieren.
>>  /.env
4. nachdem .env fertig ist 
>>php artisan config:cache

bei jeder Änderung der .env Datei muss man die Cache nochmal mit diesem Befehl aktualisieren.
Alternative kann man in .env APP_ENV=local einstellen, so wird aber die Seite langsamer.

5. Alle Texte unter /resources/views/ für euch anpassen
>Tabelle findet sich hier bald.

## Webseite für eure Prüfungen bereitstellen
1. Admin User auf der Seite registrieren und in der Datenbank auf type:admin ändern
2. einloggen auf https://URL/admin
3. Im Admin-Panel Prüfer und Prüfungen erstellen, dann Protokolle hochladen.
4. ...

## Weitere Funktionen
Sind auf der admin Startseite beschrieben

[...]

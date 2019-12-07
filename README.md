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
 
### Beispielseite
Ein Demo findet ihr hier: https://demoskriptenzimmer.000webhostapp.com/  
Fühlr euch frei mit der Seite rumzuspielen.
Admin-Panel findet ihr unter: https://demoskriptenzimmer.000webhostapp.com/admin
Username: admin1
Passwort: 123123
 
### Installation

Die Webseite ist Laravel basiert. Um sie für euer Uni zu installieren, müsst ihr: 
1. Dateien auf einem Hosting hochladen.
2. Datenbank erstellen und in phpmyadmin die Vorlage importieren 
>> /database/db_vorlage_skrizi.sql  

bzw. Laravel installieren (siehe https://laravel.com/docs/5.7/installation) und mit dem Server mit ssh verbinden. Dann:  
>> $ php artisan migrate
3. .env Datei mit euren URLs, Mail-Daten usw. konfigurieren.
>>  /.env
4. nachdem .env fertig ist 
>> $ php artisan config:cache

bei jeder Änderung der .env Datei muss man die Cache nochmal mit diesem Befehl aktualisieren.
Alternative kann man in .env APP_ENV=local einstellen, so wird aber die Seite langsamer.

*Wenn ihr shared hosting benutzt (kostenloses Server) kann es komplizierter sein. Ein gutes Tutorial dafür ist   https://www.000webhost.com/forum/t/deploy-laravel-project-into-000webhost-site/127323

5. Alle Texte unter /resources/views/ für euch anpassen
>Tabelle findet sich hier bald.

### Webseite für eure Prüfungen bereitstellen
1. Admin User auf der Seite registrieren und in der Datenbank unter Users auf type:admin ändern
2. einloggen auf https://URL/admin
3. Im Admin-Panel Prüfer und Prüfungen erstellen, dann Protokolle hochladen.
>> wichtig! Die Protokolle müssen PDF in version 1.4 (bzw. adobe acrobbat 5) sein!  
>> Ihr könntet eure Dateien mit acrobat (nicht reader) anpassen oder online. z.B. auf  
>> https://docupub.de/pdfconvert/
4. ...

### Weitere Funktionen
Sind auf der admin Startseite beschrieben

[...]

## Weiterentwicklung

### extra Features
Ein Paar Ideen, die ich im Verlauf implementieren möchte sind: 
1. Möglichkeit per Prüfung zu entscheiden, ob Fragen+Antworten abzugeben sind oder nur ein Box
2. Erinnerung an die Moderatoren die Prüfungstermine für das Semester anzupassen.  
3.
4. [...]

### Cleanup & Refactoring
Es gibt leider relativ viel schlechter Code und mehrere Dateien und Funktionen die komplett umgebracht sind.  
Man muss aber natürlich beim Löschen sicher sein, dass sie wirklich nutzlos sind.
Außerdem sind noch einige kleine Bugs
1. Seitenwähler am Adminpanel ist irgendwie defekt.
2. Layouts mit Header-Datei umschreiben.
3. Statistik-Übersicht
4.
5. [...]
Ich freue mich auf Kollaborationen! Falls ihr ein Feature vorschlagen möchtet oder ihr selbst entwickeln, schreibt mir, öffnet ein Issue oder macht einfach ein Pull Request.

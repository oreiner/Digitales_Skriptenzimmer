# Digitales Skriptenzimmer

Diese Anleitung ist noch nicht vollständig! 
Sie wird im Verlauf berarbeitet.

#### Nutzer können:
  - Protokolle nach dem "Kittelautomat"-System erhalten. Das erste Protokoll können die Prüflinge einfach herunterladen aber werden dann für weitere Protokolle gespert bis sie anschließend ein eigenes Protokoll eingeben. Nach der Eingabe des Protokolls werden sie automatisch für das nächste Protokoll freigeschaltet. 
  - Für jeden Prüfer müssen die Prüflinge mindestens 10 Zeichen in jeweils einem Textfeld für Fragen und Antworten. Zusätzlich können sie Tipps zum Prüfer eingeben sowie für die gesamte Prüfung, wenn sie von mehreren Prüfer geprüft wurden.
  - Die Prüflinge können zwei Protokolle pro Tag abfragen. Dies sollte misbrauch des System verhindern ohne die Prüflinge zu stark einzuschränken. (Diese Zahl kann im Backend angepasst werden).
  - Angemeldete Nutzer können angebotene Skripte oder andere bereitgestellte Dokumente unbegrenzt herunterladen.
  
#### Moderator können
 - Nutzer für die Protokolle freischalten und verwalten.
 - Prüfer erstellen und entsprechend Protokolle (z.B. alte PDFs von eurer alten Datenbank) hochladen.
 - Neue Einzelprotokolle von der Nutzer-Oberfläche abgeben, z.B. wenn die Prüflinge das selber nicht hinkriegen zu Machen. Die Moderatoren können 100 Protokolle pro Tag herunterladen und müssten dabei keine Mail bekommen, wenn sie es nicht brauchen.
 - Skripte und andere allgemeine Dokumenten vom Admin-Panel hochladen. 
 - Die Prüfer von einzelnen Nutzern anpassen und Protokolle erneut versenden.
 - Kommentare von Nutzern löschen.
 - Nutzer ein Ban erteilen oder zurückziehen. 
 - Zeiträume für Erinnerungs-E-Mail anpassen.
 - Statistik zu Protokolle Anfragen und Abgaben anschauen (Diese Funktion ist derzeit nicht ganz richtig implemintiert).

#### Administratoren können:
 - Alle Moderatoren Funktionen
 - Prüfungen erstellen
 - Nutzer, Prüfer, Protokolle,  etc. löschen
 - Nutzer-Typ von Studierenden und Moderatoren ändern 

#### Der Skriptenzimmer-Roboter kann:

 - Digest über neuen Nutzer und neuen abgegebenen Protokolle an die Moderatoren herumschicken 
 
### Beispielseite

Ein Demo findet ihr hier: https://demoskriptenzimmer.000webhostapp.com/  
Fühlt euch frei mit der Seite rumzuspielen.  
Username: testuser  
Passwort: 123123  
Das Admin-Panel findet ihr unter: https://demoskriptenzimmer.000webhostapp.com/admin  
Username: admin1  
Passwort: 123123  
(Ihr könnt auch ruhig weitere Nuzter erstellen)  
 
### Installation

Die Webseite ist Laravel basiert. Um sie für euer Uni zu installieren, müsst ihr: 
1. Dateien auf einem Hosting-Server hochladen.
2. Datenbank erstellen und in phpmyadmin die Vorlage importieren 
>> /database/db_vorlage_skrizi.sql  

bzw. Laravel installieren (siehe https://laravel.com/docs/5.7/installation) und mit dem Server mit ssh verbinden. Dann:  
>> $ php artisan migrate
3. .env Datei mit euren URLs, Mail-Daten usw. konfigurieren.
>>  /.env
4. nachdem .env fertig ist 
>> $ php artisan config:cache

Bei jeder Änderung der .env Datei muss man die Cache nochmal mit diesem Befehl aktualisieren.
Alternative kann man in .env APP_ENV=local einstellen, so wird aber die Seite langsamer.

*Wenn ihr shared hosting benutzt (kostenloses Server) kann es komplizierter sein. Ein gutes Tutorial dafür ist   https://www.000webhost.com/forum/t/deploy-laravel-project-into-000webhost-site/127323

5. Alle Texte unter /resources/views/ für euch anpassen
>Tabelle findet sich hier bald.

### Webseite für eure Prüfungen bereitstellen
1. Admin User auf der Seite registrieren und in der Datenbank unter Users auf type:admin ändern
2. einloggen auf https://euerURL/admin
3. Im Admin-Panel Prüfer und Prüfungen erstellen, dann Protokolle über die "Prüfungen" Leiste hochladen.
>> wichtig! Die Protokolle müssen PDF in version 1.4 (bzw. adobe acrobbat 5) sein!  
>> Ihr könntet eure Dateien mit acrobat (nicht reader) anpassen oder online. z.B. auf  
>> https://docupub.de/pdfconvert/

### Weitere Funktionen
Sind auf der admin Startseite beschrieben

[...]

## Weiterentwicklung

[lese hier](Weiterentwicklung.MD)

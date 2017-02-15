=== DMSGuestbook ===
Contributors: danielschurter
Donate link: http://danielschurter.net/
Tags: guestbook, plugin, manage, admin, page, sidebar, widget
Requires at least: 2.1
Tested up to: 4.1
Stable tag: 1.17.5
License: GPLv2

DMSGuestbook is an easy configurable guestbook with a lot of features.

== Description ==
**After about 7 years and more than 320'000 downloads, DMSGuestbook has reached end of life and will not longer supported by the owner.**<br />

**Nach �ber 7 Jahren und mehr als 320'000 Downloads wird die Entwicklung und der Support von DMSGuestbook eingestellt.**<br />

DMSGuestbook is an easy configurable guestbook with a lot of features.<br />
You can customize the whole DMSGuestbook to your desire.

Features:

* Simple work on the attitudes over front-end (e.g. text color, guestbook width, border color...)
* Extended attitude possibility over the css file
* Preset DMSGuestbook caption text in different languages (e.g: german, english, swissgerman :-))
* Every guestbook have his own language template (NEW in 1.15.0)
* Make your own language template in few minutes
* Set mandatory fields where user must be filled out
* Set text hidden in the DMSGuestbook (e.g. ip address)
* Captcha antispam (image, mathematically, NEW in 1.15.0 reCAPTCHA)
* Manage the DMSGuestbook user entries. (e.g. name, message, url, ip address)
* Sidebar widget
* Email notification when guestbook post was to submit
* Administrator can review posts before shown this
* Create your own guestbook template (beta)
* Administrator can search entries in guestbook
* Gravatar function
* Multiple guestbooks (NEW in 1.13.0)
* Define a selectbox and fill this with your own data (NEW in 1.14.0)
* Super Guestbook: One guestbook can have more than one languages (NEW in 1.17.0)

Enjoy it :-)

* Das ganze DMSGuestbook laesst sich nach deinen Wuenschen einstellen.
* Breite des DMSGuestbook und des Separators
* Die Position auf der Seite
* Anzahl Eintraege pro Seite
* Textfarbe und Rahmenfarbe
* Antispam (Antirobot, Captcha, reCAPTCHA) Textfarbe
* Navigations-Style und Textfarbe
* Datum, Zeitformat und Offset
* Das Input-Formular kann oben oder unten angezeigt werden
* Vorgefertige Beschreibungstetxe wie Deutsch, Englisch, Schweizerdeutsch  :-)
* Eigene Sprachvorlagen lassen sich in wenigen Minuten erstellen
* Setze die Felder welche zwingend ausgefuellt werden muessen
* Verstecke Felder im DMSGuestbook (z.B. IP Adresse)
* Die DMSGuestbook Eintraege der Benutzer lassen sich nachtraeglich bearbeiten (z.B. Name, Message, Url, IP Adresse)
* Backup Funktion um die Gaestebuch Optionen schnell und einfach zu sichern
* Sidebar Widget
* Der Administrator kann die einzelnen Eintraege vor dem Anzeigen ueberpruefen.
* Eigene Gaestebuch Templates koennen erstellt werden. (beta)
* Suchfunktion fuer den Administrator.
* Multiple Gaestebuecher koennen erstellt werden. (NEU in 1.13.0)
* Akismet Funktion (NEU in 1.14.0)
* SuperGuestbook: Ein Gaestebuch kann in mehreren Sprachen angezeigt werden (NEU in 1.17.0)

Viel Spass damit :-)

== Installation ==
Requirement:

* Wordpress 2.1 or above

1. Download the DMSGuestbook plugin.
2. Deactivate the old DMSGuestbook plugin, if is exist.
3. Unpack the file and copy the whole dmsguestbook folder to the wordpress plugins folder.
4. Activate the DMSGuestbook in the plugins section of wordpress.

Dont't overwrite an old DMSGuestbook plugin without deactivating it before.

== Frequently Asked Questions ==
= DMSGuestbook FAQ: =

**English**

**1.) The guestbook isn't shown**<br />
Was the page added in "Guestbook settings -> Basic"?<br />

**2.) The guestbook isn't shown correctly, what could I do?**<br />
- Switch to an standard theme and test it again.<br />
- Deactivate all plugins except DMSGuestbook and test it again.<br />

**3.) Role group in "Guestbook settings -> Role" has no effect**<br />
The role can be disable. Open the file "admin.php" in "dmsguestbook" folder and search to this entry: define('ROLE', "1");. Replace this with this one: define('ROLE', "0");<br />

**4.) Although DMSGuestbook is activated I don't see any entries in the adminpanel, why?**<br />
It could be a problem with the user roles.<br />
The role can be disable. Open the file "admin.php" in "dmsguestbook" folder and search to this entry: define('ROLE', "1");. Replace this with this one: define('ROLE', "0");<br />

**5.) I got a error message like this:: Warning: fopen(/xxxxx/wp-content/plugins/dmsguestbook/language/0) What can I do?**<br />
- Release your guestbook allocation by pressing "Clear" on the "Basic" page<br />
- Chose your favourite language from the list<br />
- Bind new language to your guestbook page by pressing "Set"<br />
- Finalize that by pressing "Save" button<br />

**6.) I got a error message like this:: Fatal error: Allowed memory size of ****** bytes exhausted**<br />
A possible solution: http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP <br />

**7.) Although I've set a valid email address, no notification email I got.**<br />
Some hoster needs a sender email address where you are registered otherwise it won't works. See here: http://faq.hosteurope.de/index.php?cpid=11073. To change this open dmsguestbook.php and goto this code: '$mail->From = "DMSGuestbook@".$host;'. Replace this part 'DMSGuestbook@".$host' with your email address which it's works.<br />
Attention: You have to repeat these steps after a DMSGuestbook update!<br />

**8.) Image and Math Captcha won't work**<br />
Maybe the Suhosin patch is installed (http://www.hardened-php.net/suhosin/) that setting could prevent any codes after submitting a post.<br />
You can apparently bypass this behavior by setting the following in your php.ini. If don't have permission on this file ask you ISP or using reCAPTCHA, the next generation captcha method.<br />
suhosin.srand.ignore = Off<br />
suhosin.mt_srand.ignore = Off<br />

**Deutsch**

**1.) Das G�stebuch wird nicht angezeigt**<br />
Wurde die Seite unter "Guestbook settings -> Basic" hinzugef�gt?<br />

**2.) Das G�stebuch wird nicht richtig angezeigt, was soll ich tun?**<br />
- Teste das G�stebuch auf ein Standard Theme<br />
- Deaktiviere zu Testzwecke alle Plugins ausser DMSGuestbook<br />

**3.) Die Rollenzuteilung unter "Guestbook settings -> Role" zeigt keinen Effekt**<br />
Die Benutzerverwaltung kann deaktiviert werden. �ffne dazu die Datei "admin.php" im Ordner "dmsguestbook" und suche den Eintrag: define('ROLE', "1"); und �ndere diesen ab auf: define('ROLE', "0");<br />

**4.) Obwohl DMSGuestbook aktiviert ist, sehe ich keinen Eintrag im Adminpanel, warum?**<br />
Dies kann auf ein Problem der Benutzerverwaltung zur�ckzuf�hren sein.<br />
Die Benutzerverwaltung kann deaktiviert werden. �ffne dazu die Datei "admin.php" im Ordner "dmsguestbook" und suche den Eintrag: define('ROLE', "1"); und �ndere diesen ab auf: define('ROLE', "0");<br />

**5.) Ich bekomme eine Fehlermeldung in der Art: Warning: fopen(/xxxxx/wp-content/plugins/dmsguestbook/language/0) Was soll ich tun?**<br />
- Benutze den "Clear" Button unter "Basic" um die Zuordnung des G�stebuches zu l�sen.<br />
- W�hle nun aus der Liste die gew�nschte Sprache aus.<br />
- Dr�cke nun auf "Set" bei der gew�nschten Seite, welche das G�stebuch anzeigen soll.<br />
- Dr�cke "Save" um es zu speichern.<br />

**6.) Ich bekomme eine Fehlermeldung in der Art: Fatal error: Allowed memory size of ****** bytes exhausted**<br />
Eine m�gliche L�sung: http://faq.wordpress-deutschland.org/exhausted-php-memory <br />

**7.)Ich bekomme keine E-Mail Benachrichtigung, obwohl ich die entsprechende Option aktiviert habe.**<br />
Es k�nnte sein, dass dein Provider (sicher ist es bei Hosteurope) f�r die mail()-Funktion die Angabe einer g�ltigen Absenderadresse verlangt. Siehe http://faq.hosteurope.de/index.php?cpid=11073. <br />
�ffne die Datei "dmsguestbook.php" und suche die Zeile mit dem Eintrag: '$mail->From = "DMSGuestbook@".$host;'.<br />
Ersetze nun den Teil 'DMSGuestbook@".$host' durch die E-Mail Adresse die dein Hoster fordert.<br />
Achtung: Dieser Vorgang muss nach einem Update von DMSGuestbook wiederholt werden!<br />

**8.) Image and Math Captcha funktionieren nicht**<br />
M�glicherweise ist der Suhosin Patch auf dem Server installiert (http://www.hardened-php.net/suhosin/). Dieser kann verhindern, dass ein G�stebucheintrag versendet werden kann. Dies l�sst sich evt. mittels Einstellung in der php.ini beheben. Solltest du keinen Zugriff auf diese Datei haben, so frage deinen Provider oder benutze das neue reCAPTCHA.<br />
suhosin.srand.ignore = Off<br />
suhosin.mt_srand.ignore = Off<br />

== Screenshots ==
http://www.danielschurter.net/dmsguestbook/screenshots/

== Credits ==

Author: Daniel Schurter<br />
Url: http://DanielSchurter.net<br />

DMSGuestbook is released under the GNU General Public License
http://www.gnu.org/licenses/gpl.html<br />
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU General Public License for more details.

Icons by Umut Pulat: http://12m3.deviantart.com/<br />
http://www.iconarchive.com/category/system/tulliana-2-icons-by-umut-pulat.html

== Changelog == 

= 14.04.14 =
**After about 7 years and more than 320'000 downloads, DMSGuestbook has reached end of life and will not longer supported by the owner.**<br />

**Nach �ber 7 Jahren und mehr als 320'000 Downloads wird die Entwicklung und der Support von DMSGuestbook eingestellt.**

= 1.17.5 - 07.01.15 =
* Fixed unauthenticated data injection
* ###
* Das Problem mit dem Data Injection wurde behoben 


= 1.17.4 - 15.04.13 =
* Fixed sending multiple notification mails
* Add UTF-8 handler for notification mails (Thanks to Marc Wiegand!) 
* Fixed problem if using another reCAPTCHA plugin 
* ###
* Das Problem mit dem Versenden von mehreren Benachrichtigungsmails wurde behoben
* UTF-8 fuer Bestaetigungsmail hinzugefuegt (Dank an Marc Wiegand!)
* Das Problem beim Einbinden eines anderen reCAPTCHA Plugins wurde behoben


= 1.17.3 - 27.02.13 =
* Fixed adding widget if more than one sidebar is available. Thank you kj.rehsi!
* ###
* Das Problem mit dem Widget bei mehr als einer Sidebar wurde behoben. Danke kj.rehsi!


= 1.17.2 - 29.08.12 =
* Fixed adding widget
* Fixed PHP notice
* Fixed jQuery namespace 
* Language list in 'Basic' is sorted now
* Updated jQuery to version 1.7.2
* ###
* Das Problem mit dem hinzufuegen des Widgets wurde behoben
* PHP Meldungen abgefangen
* jQuery Namensbereich angepasst 
* Die Sprachauswahl unter 'Basic' ist nun sortiert
* jQuery Bibliothek Update nach 1.7.2


= 1.17.1 - 18.10.10 =
* DMSGuestbook is now Chrome compatible
* New jQuery color picker
* New jQuery quicktags
* Russian .mo File by Mykola Buryak
* ###
* DMSGuestbook ist nun Chrome kompatibel
* Neuer jQuery Color Picker
* Neue jQuery Quicktags
* Russisches .mo File von Mykola Buryak


= 1.17.0 - 20.08.10 =
* SuperGuestbook: One guestbook can have more than one language
* ###
* SuperGuestbook: Ein Gaestebuch kann nun in mehreren Sprachen angezeigt werden


= 1.16.0 - 16.03.10 =
* DMSGuestbook is now I18n compatible
* Update of the jQuery library
* ###
* DMSGuestbook ist nun I18n Kompatibel
* jQuery Bibliothek Update


= 1.15.6 - 22.01.10 =
* A minor bug with URL's and "Google Analytics for WordPress" has been fixed
* ###
* Ein kleiner Fehler mit URL's und "Google Analytics for WordPress" wurde behoben


= 1.15.5 - 07.12.09 =
* A minor bug in the mail function has been fixed
* ###
* Ein kleiner Bug in der Mail Funktion wurde behoben


= 1.15.4 - 03.12.09 =
* The the_content() problem has been solved
* The backup header() function has been removed
* ###
* Das the_content() Problem wurde geloest
* Die Backup header() Funktion wurde entfernt


= 1.15.3 - 21.10.09 =
* Base64 coding has been added. This feature can be switched on in admin.php
* The Gravatar e-mail address is not longer case sensitive
* Editing an external reCAPTCHA plugin path in admin.php
* ###
* Base64 Codierung wurde fuer ein paar Textfelder im Adminpanel hinzugefuegt. Dies kann bei Bedarf unter admin.php aufgeschaltet werden.
* Die Gravatar E-mail Adresse ist jetzt nicht mehr laenger case sensitive
* Der Pfad eines reCAPTCHA Plugin kann nun unter admin.php geaendert werden


= 1.15.2 - 17.06.09 =
* A smilies problem has been fixed (Many thanks to Herbert!)
* ###
* Ein Problem bei der Anzeige von Smilies wurde behoben (Vielen Dank Herbert!)


= 1.15.1 - 13.06.09 =
* A multiple guestbook language selection problem has been fixed
* The Widget runs now without errors
* ###
* Ein Problem in der multiplen Gaestebuch Sprachauswahl wurde behoben
* Das Widget laeuft nun wieder korrekt


= 1.15.0 - 01.06.09 =
* reCAPTCHA support
* Every guestbook have his own language template
* Multiple notification mails
* Define the maximum length of the message text
* Gravatar widget support (Thank you Trina!)
* ###
* reCHAPTCHA Unterstuetzung
* Individuelle Sprachauswahl fuer jedes Gaestebuch
* Multiple Bestaetigungsmail
* Individuelle Zeichenbegrenzung fuer die Textmeldung
* Gravatar Unterstuetzung im Widget (Danke Trina!)


= 1.14.0 - 12.04.09 =
* Support Akismet (microakismet)
* New E-Mail engine with SMTP support (phpmailer)
* Add your guestbook page easily with a mouse click
* Add your own additional selectbox to your guestbook
* Role settings
* Widget was redesigned
* UI was redesigned (WP 2.7 style)
* Add dashboard
* ###
* Akismet Unterstuetzung (microakismet)
* Neue E-Mail Engine mit SMTP Unterstuetzung (phpmailer)
* Einfaches Hinzufuegen der Gaestebuecher mit einem Mausklick
* Eigene Selectbox laesst sich auf der Gaestebuch Seite hinzufuegen.
* Berechtigungsstufen hinzugefuegt
* Widget wurde ueberarbeitet
* UI wurde ueberarbeitet (WP 2.7 Style)
* Ein Dashboard wurde hinzugefuegt


= 1.13.0 - 19.12.08 =
* Added multiple guestbooks
* Guestbook(s) can be placed on protected site(s)
* Few UI changes
* Changed widget tags
* ###
* Multiple Gaestebuecher sind nun moeglich.
* Kleine aenderungen wurden am UI vorgenommen.
* Die Tags im Widget wurden geaendert.


= 1.12.1 - 27.08.08 =
* Removed admin and editor role. Why?
* After submit a guestbook post, user can not longer add the same post again which refreshing page
* Italian language template. Thanks to Lucky
* ###
* Admin und Editor Rechte wieder entfernt. Warum?
* Nach einem Gaestebuch Eintrag wird bei einem Seiten-Refresh nicht noch einmal der selbe Eintrag gespeichert.
* Italienisches Sprach-Template von Lucky.


= 1.12.0 - 20.07.08 =
* Add admin and editor role
* CSS is saved on external file if permission are given.
* Select or deselect the nofollow tag.
* Russia language template. Thanks to Willi Waefler
* Turkish language template. Thanks to Ersin Dogan
* ###
* Verschiedene Admin und Editor Rechte vergeben.
* Die CSS Eintraege werden jetzt auch in einem File gespeichert, sofern der Zugriff darauf erlaubt ist.
* Russisches Sprach-Template von Willi Waefler.
* Tuerkisches Sprach-Template von Ersin Dogan.


= 1.11.0 - 08.06.08 =
* Gravatar function added
* Antispam $_SESSION removed, replaced with a md5 hash key.
* Options update function improved
* Danish language template. Thanks to Thomas Jorgensen
* Romana language template. Thanks to RO
* Swedish language template. Thanks to Lisa Smith
* ###
* Gravatar Funktion wurde hinzugefuegt.
* Antispam $_SESSION wurde entfernt und durch einem MD5 Hash key ersetzt.
* Die Update Funktion der Optionen wurde verbessert.
* Daenisches Sprach-Template von Thomas Jorgensen.
* Rumaenisches Sprach-Template von RO.
* Swedisches Sprach-Template Lisa Smith.


= 1.10.0 - 09.04.08 =
* Admin menu was redesigned (dbx)
* All CSS entries will save in wp_options table
* Guestbook form and guestbook entries are available as template (beta)
* Define your own email and website imgage
* Define your own mandatory char
* Six ways to mask the ip adress
* Administrator can search entries in guestbook (beta)
* Polish language template. Thanks to Grzegorz Gibas
* ###
* Admin Menu wurde ueberarbeitet, Menues werden als Docking boxes (dbx) dargestellt.
* Alle CSS Einstellungen werden nun direkt in der wp_options gespeichert. Das Bearbeiten der Einstellungen wurde vereinfacht.
* Das Gaestebuch Eingabeformular und die Gaestebuch Eintraege koennen ueber ein Template komplett veraendert werden. (beta)
* Der Email & Website Image Pfad kann individuell bestimmt werden.
* Das Mandatory Zeichen kann frei definiert werden.
* Die Art der IP Maskierung kann aus sechs verschiedenen Variationen gewaehlt werden.
* Eine Gaestebuch Suchfunktion wurde fuer den Administrator hinzugefuegt. (beta)
* Polnisches Sprach-Template von Grzegorz Gibas


= 1.9.1 - 06.03.08 =
* Total of guestbook numbers was not displayed by some person -> fixed
* URL icon shows if http:// is missing in DB -> fixed
* Add an guestbook URL overruler
* French language template. Thanks to blancreg
* Dutch language template. Thanks to Joris Heyndrickx
* ###
* Das Total der Gaestebuch Eintraege wurde bei manchen Personen nicht angezeigt -> behoben
* Das URL Icon wurde angezeigt wenn das http:// in der DB fehlte -> behoben
* Die Guestbuch URL kann nun manuell ueberschrieben werden.
* Franzoesisches Sprach-Template von blancreg
* Hollaendisches Sprach-Template von Joris Heyndrickx


= 1.9.0 - 10.02.08 =
* XSS issue was fixed
* Set an direct linkt from widget to the guestbook post with SHOW_POST
* Widget: SHOW_NR and SHOW_ID added
* Norwegian language template. Thanks to Torjus Faersnes
* ###
* Das XSS Problem wurde behoben
* Es lassen sich direkte links zum Gaestebuch mit SHOW_POST im Widget hinzufuegen
* SHOW_NR und SHOW_ID im Widget hinzugefuegt
* Norwegisches Sprach-Template von Torjus Faersnes


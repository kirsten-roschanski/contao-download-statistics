# Contao Download-Dokumentation und -Statistik

Dieses Projekt erweitert Contao um die Funktionalität, Downloads im Frontend zu dokumentieren und sowohl für Mitglieder als auch Administratoren im Backend zugänglich zu machen.

## Features

* **Download-Dokumentation:** Jeder Download eines Mitglieds im Frontend wird mit Zeitstempel und Benutzerdaten protokolliert.
* **Mitgliederbereich:** Eingeloggte Mitglieder können eine Liste ihrer Downloads im Mitgliederbereich einsehen.
* **Backend-Statistiken:** Im Backend werden verschiedene Statistiken zu den Downloads generiert, z.B.:
    * Gesamtzahl der Downloads
    * Downloads pro Datei
    * Downloads pro Mitglied
    * Downloads pro Zeitraum
* **Exportfunktion:** Die Download-Statistiken können im Backend als CSV- oder Excel-Datei exportiert werden.

## Installation

1. **Download des Erweiterungspakets:** Laden Sie das Erweiterungspaket direkt von GitHub herunter: [https://github.com/kirsten-roschanski/contao-download-statistics](https://github.com/kirsten-roschanski/contao-download-statistics)
2. **Installation über den Contao Manager:** Installieren Sie das Paket über den Contao Manager.
3. **Datenbankupdate:** Führen Sie ein Datenbankupdate durch.
4. **Konfiguration:** Konfigurieren Sie die Erweiterung im Contao Backend unter dem Menüpunkt "Download-Dokumentation".

## Verwendung

* **Frontend:** Die Erweiterung dokumentiert automatisch alle Downloads über die Standard-Download-Elemente von Contao.
* **Mitgliederbereich:** Fügen Sie im Mitgliederbereich ein Modul vom Typ "Download-Liste" ein, um die Downloads des Mitglieds anzuzeigen.
* **Backend:** Rufen Sie im Backend den Menüpunkt "Download-Dokumentation" auf, um die Statistiken einzusehen und zu exportieren.

## Entwicklung

**Technologien:**

* PHP
* MySQL
* Contao Framework

**Dateistruktur:**

* `src/`: Enthält den Quellcode der Erweiterung.
* `templates/`: Enthält die Templates für die Ausgabe der Download-Liste im Frontend.
* `config/`: Enthält die Konfigurationsdateien der Erweiterung.
* `languages/`: Enthält die Sprachdateien der Erweiterung.

**Mitwirken:**

* Bug reports und Feature requests sind willkommen! Erstellen Sie dazu ein Issue auf GitHub: [https://github.com/kirsten-roschanski/contao-download-statistics/issues](https://github.com/kirsten-roschanski/contao-download-statistics/issues)
* Pull requests sind ebenfalls willkommen! Bitte halten Sie sich an die Contao Coding Standards.

## Lizenz

Diese Erweiterung ist unter der **GPL-3.0-or-later** Lizenz veröffentlicht.
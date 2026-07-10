<div align="center">  
  <a href="README.md"   >   TR <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/TR.png" alt="TR" height="20" /></a>  
  <a href="README-EN.md"> | EN <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/US.png" alt="EN" height="20" /></a>  
  <a href="README-AZ.md"> | AZ <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/AZ.png" alt="AZ" height="20" /></a>  
  <a href="README-DE.md"> | DE <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/DE.png" alt="DE" height="20" /></a>  
  <a href="README-FR.md"> | FR <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/FR.png" alt="FR" height="20" /></a>  
  <a href="README-AR.md"> | AR <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/AR.png" alt="AR" height="20" /></a>  
  <a href="README-NL.md"> | NL <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/NL.png" alt="NL" height="20" /></a>  
</div>

# FOSSBilling DomainNameApi Modul

Dieses Modul ist die offizielle DomainNameApi-Integration für FOSSBilling. Sie können Domains direkt im FOSSBilling-Panel registrieren, übertragen, verlängern und verwalten.

## 📦 Download — immer die Releases verwenden!

⬇️ **Die neueste getestete Version finden Sie hier: https://github.com/domainreseller/fossbilling-dna/releases/latest**

> ⚠️ Verwenden Sie **nicht** den grünen **Code → Download ZIP**-Button — dieser lädt den rohen Entwicklungszweig herunter. Release-Pakete sind versioniert, getestet und produktionsbereit.

## Voraussetzungen

- FOSSBilling 1.0 oder höher
- PHP 8.0 oder höher
- PHP SOAP-Erweiterung aktiviert

## Installation

1. Laden Sie diesen Modulordner in das Verzeichnis `library/Registrar/Adapter/` Ihrer FOSSBilling-Installation hoch.
2. Melden Sie sich im FOSSBilling-Adminpanel an.
3. Gehen Sie zu Einstellungen > Domain-Registrar-Module und aktivieren Sie "DomainNameApi".
4. Tragen Sie Ihren DomainNameApi-Benutzernamen und Ihr Passwort ein.
5. Speichern und nutzen Sie das Modul.

## 🔑 API-Zugangsdaten — Benutzername/Passwort oder Reseller ID/API Key?

Beides wird unterstützt — tragen Sie die Daten in dieselben zwei Modulfelder ein; das Modul erkennt automatisch, welche API verwendet wird:

| Sie haben | Feld „Benutzername" | Feld „Passwort" | Verwendete API |
|---|---|---|---|
| **Neue Panel-Zugangsdaten** (empfohlen) | Reseller ID — UUID wie `xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx` | API Key | REST |
| **Alte (Legacy-)Zugangsdaten** | API-Benutzername | API-Passwort | SOAP |

> 💡 Ihre **Reseller ID** und Ihren **API Key** finden Sie in Ihrem DomainNameAPI-Panel unter **API-Einstellungen**.
> ⚠️ Dies sind **API-Zugangsdaten** — Ihre Panel-Login-E-Mail und Ihr Passwort funktionieren hier **nicht**.

Es ist keine zusätzliche Konfiguration nötig — enthält das Benutzernamen-Feld eine UUID, verwendet das Modul die moderne REST-API, andernfalls klassisches SOAP.

## Update

- Laden Sie die neueste Version herunter und überschreiben Sie die bestehenden Dateien.
- Ihre Einstellungen bleiben erhalten, nur der Code wird aktualisiert.

## Funktionen

- Domain-Registrierung, Transfer und Verlängerung
- Nameserver (DNS) Verwaltung
- Whois/Kontaktinformationen aktualisieren
- Domain-Lock/Unlock (Registrar Lock)
- Whois-Privatsphäre (Privacy Protection)
- Volle Unterstützung für .TR-Domains
- Fehler- und Vorgangsprotokollierung
- Mehrsprachige Unterstützung (inkl. Deutsch)

## Häufige Fehlercodes

| Code  | Beschreibung                                   | Details                                                                                 |
|-------|-----------------------------------------------|-----------------------------------------------------------------------------------------|
| 1000  | Befehl erfolgreich ausgeführt                  | Vorgang erfolgreich abgeschlossen                                                      |
| 1001  | Befehl erfolgreich; Aktion ausstehend          | Vorgang erfolgreich, aber Aktion ist in der Warteschlange                              |
| 2003  | Erforderlicher Parameter fehlt                 | Z.B.: Telefonnummer in den Kontaktdaten fehlt                                          |
| 2105  | Objekt ist nicht zur Verlängerung berechtigt   | Domain ist für Updates gesperrt, Status darf nicht "clientupdateprohibited" sein       |
| 2200  | Authentifizierungsfehler                       | API-Benutzername/Passwort falsch oder Domain bei anderem Registrar                     |
| 2302  | Objekt existiert                               | Domain oder Nameserver existiert bereits in der Datenbank                              |
| 2303  | Objekt nicht gefunden                          | Domain oder Nameserver nicht gefunden, neue Registrierung erforderlich                 |
| 2304  | Objektstatus verbietet Aktion                  | Domain ist für Updates gesperrt, Status darf nicht "clientupdateprohibited" sein       |

## Support & Mitwirkung

- [FOSSBilling Offizielle Website](https://fossbilling.org/)
- [DomainNameApi](https://www.domainnameapi.com/)
- Support: support@domainnameapi.com

---

> Für andere Sprachen klicken Sie auf die Flaggen oben. Jede Sprache enthält aktuelle Inhalte und technische Details.

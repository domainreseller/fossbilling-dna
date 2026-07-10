<div align="center">  
  <a href="README.md"   >   TR <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/TR.png" alt="TR" height="20" /></a>  
  <a href="README-EN.md"> | EN <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/US.png" alt="EN" height="20" /></a>  
  <a href="README-AZ.md"> | AZ <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/AZ.png" alt="AZ" height="20" /></a>  
  <a href="README-DE.md"> | DE <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/DE.png" alt="DE" height="20" /></a>  
  <a href="README-FR.md"> | FR <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/FR.png" alt="FR" height="20" /></a>  
  <a href="README-AR.md"> | AR <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/AR.png" alt="AR" height="20" /></a>  
  <a href="README-NL.md"> | NL <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/NL.png" alt="NL" height="20" /></a>  
</div>

# FOSSBilling DomainNameApi Module

Deze module is de officiële DomainNameApi-integratie voor FOSSBilling. Registreer, verhuis, verleng en beheer domeinen eenvoudig vanuit je FOSSBilling-beheeromgeving.

## 📦 Downloaden — gebruik altijd de Releases!

⬇️ **Download hier de nieuwste geteste versie: https://github.com/domainreseller/fossbilling-dna/releases/latest**

> ⚠️ Gebruik **niet** de groene knop **Code → Download ZIP** — die downloadt de ruwe ontwikkelbranch. Release-pakketten zijn geversioneerd, getest en klaar voor productie.

## Vereisten

- FOSSBilling 1.0 of hoger
- PHP 8.0 of hoger
- PHP SOAP-extensie geactiveerd

## Installatie

1. Upload deze modulemap naar `library/Registrar/Adapter/` in je FOSSBilling-installatie.
2. Log in op het FOSSBilling-beheerpanel.
3. Ga naar Instellingen > Domeinregistrar-modules en activeer "DomainNameApi".
4. Vul je DomainNameApi API-gebruikersnaam en wachtwoord in.
5. Sla op en begin met het gebruik van de module.

## 🔑 API-gegevens — Gebruikersnaam/Wachtwoord of Reseller ID/API Key?

Beide worden ondersteund — vul ze in dezelfde twee modulevelden in; de module detecteert automatisch welke API wordt gebruikt:

| Je hebt | Veld "Gebruikersnaam" | Veld "Wachtwoord" | Gebruikte API |
|---|---|---|---|
| **Nieuwe panelgegevens** (aanbevolen) | Reseller ID — UUID zoals `xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx` | API Key | REST |
| **Oude (legacy) gegevens** | API-gebruikersnaam | API-wachtwoord | SOAP |

> 💡 Je vindt je **Reseller ID** en **API Key** in je DomainNameAPI-panel onder **API-instellingen**.
> ⚠️ Dit zijn **API-gegevens** — het e-mailadres en wachtwoord waarmee je op het panel inlogt, werken hier **niet**.

Er is geen extra configuratie nodig — bevat het gebruikersnaamveld een UUID, dan gebruikt de module de moderne REST API, anders klassiek SOAP.

## Update

- Download de nieuwste versie en overschrijf de bestaande bestanden.
- Je instellingen blijven behouden, alleen de code wordt bijgewerkt.

## Functies

- Domeinregistratie, verhuizing en verlenging
- Nameserver (DNS) beheer
- Whois/contactinformatie bijwerken
- Domein vergrendelen/ontgrendelen (Registrar Lock)
- Whois privacy (Privacy Protection)
- Volledige ondersteuning voor .TR-domeinen
- Fout- en bewerkingslogboek
- Meertalige ondersteuning (inclusief Nederlands)

## Veelvoorkomende foutcodes

| Code  | Uitleg                                          | Details                                                                                 |
|-------|-------------------------------------------------|-----------------------------------------------------------------------------------------|
| 1000  | Opdracht succesvol uitgevoerd                   | Actie succesvol afgerond                                                               |
| 1001  | Opdracht succesvol; actie in behandeling        | Actie succesvol, maar staat in de wachtrij                                             |
| 2003  | Vereiste parameter ontbreekt                    | Bijvoorbeeld: Telefoonnummer ontbreekt in contactgegevens                              |
| 2105  | Object komt niet in aanmerking voor verlenging  | Domein is vergrendeld voor update, status mag niet "clientupdateprohibited" zijn       |
| 2200  | Authenticatiefout                               | API-gebruikersnaam/wachtwoord onjuist of domein bij andere registrar                   |
| 2302  | Object bestaat                                  | Domein of nameserver bestaat al in de database                                         |
| 2303  | Object bestaat niet                             | Domein of nameserver niet gevonden, nieuwe registratie vereist                         |
| 2304  | Objectstatus verbiedt actie                     | Domein is vergrendeld voor update, status mag niet "clientupdateprohibited" zijn       |

## Support & Bijdragen

- [FOSSBilling Officiële Website](https://fossbilling.org/)
- [DomainNameApi](https://www.domainnameapi.com/)
- Support: support@domainnameapi.com

---

> Voor andere talen, klik op de vlaggen hierboven. Elke taal bevat actuele inhoud en technische details.

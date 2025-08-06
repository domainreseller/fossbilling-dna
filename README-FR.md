<div align="center">  
  <a href="README.md"   >   TR <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/TR.png" alt="TR" height="20" /></a>  
  <a href="README-EN.md"> | EN <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/US.png" alt="EN" height="20" /></a>  
  <a href="README-AZ.md"> | AZ <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/AZ.png" alt="AZ" height="20" /></a>  
  <a href="README-DE.md"> | DE <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/DE.png" alt="DE" height="20" /></a>  
  <a href="README-FR.md"> | FR <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/FR.png" alt="FR" height="20" /></a>  
  <a href="README-AR.md"> | AR <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/AR.png" alt="AR" height="20" /></a>  
  <a href="README-NL.md"> | NL <img style="padding-top: 8px" src="https://raw.githubusercontent.com/yammadev/flag-icons/master/png/NL.png" alt="NL" height="20" /></a>  
</div>

# Module DomainNameApi pour FOSSBilling

Ce module est l'intégration officielle de DomainNameApi pour FOSSBilling. Gérez l'enregistrement, le transfert, le renouvellement et la gestion des domaines directement depuis votre panneau d'administration FOSSBilling.

## Prérequis

- FOSSBilling 1.0 ou supérieur
- PHP 8.0 ou supérieur
- Extension PHP SOAP activée

## Installation

1. Téléchargez ce dossier de module dans `library/Registrar/Adapter/` de votre installation FOSSBilling.
2. Connectez-vous au panneau d'administration FOSSBilling.
3. Allez dans Paramètres > Modules d'enregistrement de domaine et activez "DomainNameApi".
4. Saisissez votre nom d'utilisateur et mot de passe API DomainNameApi.
5. Enregistrez et commencez à utiliser le module.

## Mise à jour

- Téléchargez la dernière version et écrasez les fichiers existants.
- Vos paramètres seront conservés, seul le code sera mis à jour.

## Fonctionnalités

- Enregistrement, transfert et renouvellement de domaines
- Gestion des serveurs de noms (DNS)
- Mise à jour des informations Whois/contact
- Verrouillage/déverrouillage du domaine (Registrar Lock)
- Protection de la vie privée Whois
- Prise en charge complète des domaines .TR
- Journalisation des erreurs et des opérations
- Prise en charge multilingue (y compris le français)

## Codes d'erreur courants

| Code  | Explication                                   | Détails                                                                                 |
|-------|-----------------------------------------------|-----------------------------------------------------------------------------------------|
| 1000  | Commande exécutée avec succès                  | Opération terminée avec succès                                                          |
| 1001  | Commande exécutée avec succès ; action en attente | Opération réussie, mais action en file d'attente                                      |
| 2003  | Paramètre requis manquant                      | Par exemple : Numéro de téléphone manquant dans les informations de contact             |
| 2105  | L'objet n'est pas éligible au renouvellement   | Domaine verrouillé pour mise à jour, statut ne doit pas être "clientupdateprohibited"  |
| 2200  | Erreur d'authentification                      | Nom d'utilisateur/mot de passe API incorrect ou domaine chez un autre registrar         |
| 2302  | L'objet existe                                 | Domaine ou serveur de noms déjà existant dans la base de données                       |
| 2303  | L'objet n'existe pas                           | Domaine ou serveur de noms introuvable, nouvel enregistrement requis                    |
| 2304  | Le statut de l'objet interdit l'opération      | Domaine verrouillé pour mise à jour, statut ne doit pas être "clientupdateprohibited"  |

## Support & Contribution

- [Site officiel FOSSBilling](https://fossbilling.org/)
- [DomainNameApi](https://www.domainnameapi.com/)
- Support : support@domainnameapi.com

---

> Pour les autres langues, cliquez sur les drapeaux ci-dessus. Chaque langue contient un contenu et des détails techniques à jour.

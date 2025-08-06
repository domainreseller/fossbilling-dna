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

This is the official DomainNameApi integration module for FOSSBilling. Easily register, transfer, renew, and manage domains directly from your FOSSBilling admin panel.

## Requirements

- FOSSBilling 1.0 or higher
- PHP 8.0 or higher
- PHP SOAP extension enabled

## Installation

1. Upload this module folder to `library/Registrar/Adapter/` in your FOSSBilling installation.
2. Log in to your FOSSBilling admin panel.
3. Go to Settings > Domain Registrar Modules and activate "DomainNameApi".
4. Enter your DomainNameApi API username and password.
5. Save and start using the module.

## Update

- Download the latest version and overwrite the existing files.
- Your settings will be preserved, only the code will be updated.

## Features

- Domain registration, transfer, and renewal
- Nameserver (DNS) management
- Whois/contact information update
- Domain lock/unlock (Registrar Lock)
- Whois privacy (Privacy Protection)
- Full support for .TR domains
- Error and operation logging
- Multi-language support (including English)

## Common Error Codes

| Code  | Description                                   | Details                                                                                 |
|-------|-----------------------------------------------|-----------------------------------------------------------------------------------------|
| 1000  | Command completed successfully                | Operation completed successfully                                                       |
| 1001  | Command completed successfully; action pending| Operation successful, but action is queued                                             |
| 2003  | Required parameter missing                    | For example: Missing phone number in contact information                               |
| 2105  | Object is not eligible for renewal            | Domain is locked for update, status must not be "clientupdateprohibited"              |
| 2200  | Authentication error                         | API username/password incorrect or domain is with another registrar                    |
| 2302  | Object exists                                 | Domain or nameserver already exists in the database                                    |
| 2303  | Object does not exist                         | Domain or nameserver not found, new registration required                              |
| 2304  | Object status prohibits operation             | Domain is locked for update, status must not be "clientupdateprohibited"              |

## Support & Contribution

- [FOSSBilling Official Website](https://fossbilling.org/)
- [DomainNameApi](https://www.domainnameapi.com/)
- Support: support@domainnameapi.com

---

> For other languages, click the flags above. Each language contains up-to-date content and technical details.


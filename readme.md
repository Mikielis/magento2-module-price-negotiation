
# Magento 2 Price Negotiation

This Magento 2 extension adds a form to each product page that can be used for sending negotiation offer.<br /><br />
The form contains following fields:
- name
- email
- phone number
- requested price
- quantity
- message

When the form is correctly sent (data is valid), admin is automatically notified about received new negotiation offer and a user receives confirmation email.<br />
The content of both emails (subjects and texts) as well as admin's email address are easily editable.<br /><br />

The module saves sent form data into database and displays all negotiation offers in clear way in Magento admin.
Each negotiation offer can be viewed, rejected and deleted anytime.<br />
The list offers advanced filtering and sorting options.<br /><br />


# Screenshots
![form](https://user-images.githubusercontent.com/7327076/69728157-38f07900-1124-11ea-8ceb-e56e33c57bd7.png)

![admin-notification](https://user-images.githubusercontent.com/7327076/69728156-3857e280-1124-11ea-9e92-ffe57410d3a5.png)

![list](https://user-images.githubusercontent.com/7327076/69728153-3857e280-1124-11ea-9d0f-3901bbac1969.png)

![actions](https://user-images.githubusercontent.com/7327076/69728152-3857e280-1124-11ea-853b-4e9df033419c.png)

![filters](https://user-images.githubusercontent.com/7327076/69728150-3857e280-1124-11ea-95d1-5ccd96694621.png)

![single-offer-view](https://user-images.githubusercontent.com/7327076/69728149-37bf4c00-1124-11ea-83c4-04a983d9a604.png)

![module-settings](https://user-images.githubusercontent.com/7327076/69728155-3857e280-1124-11ea-9af7-7448b304131d.png)

<br /><br />
 



# Installation

Pull in the extension through Composer:

```php
composer require "mikielis/magento2-module-price-negotiation:*"
```

OR<br />

download zipped extension and add its files to [magento root directory]/app/code/Mikielis/PriceNegotiation directory and follow listed steps from the official guide:
https://devdocs.magento.com/guides/v2.3/comp-mgr/install-extensions.html

# Compatibility
The extension is compatible with Magento version 2.3 and higher (see declarative schema guide: https://devdocs.magento.com/guides/v2.3/extension-dev-guide/declarative-schema/db-schema.html) <br />
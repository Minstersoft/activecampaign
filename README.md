# ActiveCampaign PHP SDK


[![License](https://poser.pugx.org/testmonitor/activecampaign/license)](https://packagist.org/packages/testmonitor/activecampaign)

This package provides a PHP SDK for the ActiveCampaign API (v3).

It is forked from [testmonitor/activecampaign](https://github.com/testmonitor/activecampaign)

For more information on the ActiveCampaign API, refer to their [developer documentation](https://developers.activecampaign.com/reference).

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [Tests](#tests)
- [Changelog](#changelog)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)
  
## Installation

This package can be installed through Composer:

```sh
$ composer config repositories.minstersoft/activecampaign '{"type": "vcs", "url": "https://github.com/Minstersoft/activecampaign"}'
$ composer require minstersoft/activecampaign
```

To install this locally:
```sh
$ composer config repositories.minstersoft/activecampaign '{"type": "path", "url": "/home/vagrant/activecampaign"}'
$ composer require minstersoft/activecampaign
```

Make sure to use Composer's autoload:

```php
require __DIR__.'/../vendor/autoload.php';
```

Add 'use' before class name

```php
use Minstersoft\ActiveCampaign\ActiveCampaign;

class ClassName { 
 //...
}
``` 

Start by creating a new instance:

```php
$activeCampaign = new ActiveCampaign(ACTIVE_CAMPAIGN_URL, ACTIVE_CAMPAIGN_KEY);
``` 

Your API key can be found in your account on the Settings page under the "Developer" tab.

## Usage

Once instantiated, you can simply call one of the methods provided by the SDK:

```php
$activeCampaign->contacts();
```

This will provide you with a list of available contacts.

To create a contact, you can use the `createContact` method:

```php
$contact = $activeCampaign->createContact(
    'email' => 'johndoe@example.com',
    'firstName' => 'John',
    'lastName' => 'Doe',
);
```

When the request was successful, `$contact` will contain a Contact object with the contact details.

To retrieve an existing contact or create it when it is missing:

```php
$contact = $activeCampaign->findOrCreateContact(
    'email' => 'johndoe@example.com',
    'firstName' => 'John',
    'lastName' => 'Doe',
);
```

When the request was successful, `$contact` will contain a Contact object with the contact details.

## Tests

The package contains integration tests. You can run them using PHPUnit.

```
$ vendor/bin/phpunit
```

## Changelog

Refer to [CHANGELOG](CHANGELOG.md) for more information.

- [Thijs Kok](https://www.testmonitor.com/)
- [Stephan Grootveld](https://www.testmonitor.com/)
- [Frank Keulen](https://www.testmonitor.com/)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Refer to the [License](LICENSE.md) for more information.

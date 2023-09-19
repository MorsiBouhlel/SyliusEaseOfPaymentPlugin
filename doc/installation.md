## Installation

1. Enable the plugin in bundles.php

```php
<?php
// config/bundles.php

return [
    // ...
    Dotit\SyliusEaseOfPaymentPlugin\DotitSyliusEaseOfPaymentPlugin::class => ['all' => true],
];
```

2. Import the plugin configurations

```yml
# config/packages/_sylius.yaml
imports:
    # ...
    - { resource: "@DotitSyliusEaseOfPaymentPlugin/Resources/config/config.yaml" }
```

4. Add the admin routes

```yml
# config/routes.yaml
dotit_sylius_ease_of_payment_plugin_admin:
    resource: "@DotitSyliusEaseOfPaymentPlugin/Resources/config/routing/admin.yaml"
    prefix: /admin
```
4. Update the database schema
```
php bin/console d:s:u -f
```
5. Clear cache for translations
```
php bin/console cache:clear
```
6. Add this code to the ProductNormalizer

```php
use Dotit\SyliusEaseOfPaymentPlugin\Service\EaseOfPaymentService;
.
.
$productEaseOfPayment=$this->easeOfPaymentService->getEaseOfPaymentForProduct($dataVariantPrice);
$data['ProductEaseOfPayment']= $productEaseOfPayment->isHaveProductEaseOfPaymentModalities();
$data['ProductEaseOfPaymentModalities']= $productEaseOfPayment->getEaseOfPaymentModalities();
.
.
return $data;
```

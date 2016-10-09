Pagination
==========

This is a PHP 5.4 paginator with a totally different core concept.

## Setup and Configuration
FDevsPagination uses Composer, please checkout the [composer website](http://getcomposer.org) for more information.

The simple following command will install `pagination-bridge` into your project. It also add a new
entry in your `composer.json` and update the `composer.lock` as well.
```bash
$ composer require fdevs/pagination-bridge
```

## Usage with [Symfony framework](http://symfony.com/)

###Enable the bundle in the kernel

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new FDevs\Bridge\Pagination\FDevsPaginationBundle(),
        // ...
    );
}
```

#### default configuration

```yml
f_devs_pagination:

    # set default pagination class MUST implement "FDevs\Pagination\Model\PaginationInterface".
    pagination_class:     FDevs\Pagination\Model\Pagination

    # Select the types, allowed "array,doctrine_mongodb,doctrine_orm".
    type_list:

        # Defaults:
        - array
        - doctrine_mongodb
        - doctrine_orm

```

## Usage with [The DependencyInjection Component ](http://symfony.com/doc/current/components/dependency_injection/introduction.html)

```php
<?php
use Symfony\Component\DependencyInjection\ContainerBuilder;
use FDevs\Bridge\Pagination\DependencyInjection\FDevsPaginationExtension;

$container = new ContainerBuilder();
// $container configuration...

$container->registerExtension(FDevsPaginationExtension());

$paginator = $container->get('f_devs_pagination.paginator');


// init you target
$target = ..
// example $target = $em->createQuery('SELECT a FROM Entity\Article a');

$paginator->paginate($target);
```

---
Created by [4devs](http://4devs.pro/) - Check out our [blog](http://4devs.io/) for more insight into this and other open-source projects we release.

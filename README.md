# DoctrineODMMongoDBBridge
> Adapter to make User compatible with Doctrine ODM MongoDB

[![Build Status](https://travis-ci.org/BenGorUser/DoctrineODMMongoDBBridge.svg?branch=master)](https://travis-ci.org/BenGorUser/DoctrineODMMongoDBBridge)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/BenGorUser/DoctrineODMMongoDBBridge/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/BenGorUser/DoctrineODMMongoDBBridge/?branch=master)
[![Total Downloads](https://poser.pugx.org/bengor-user/doctrine-odm-mongodb-bridge/downloads)](https://packagist.org/packages/bengor-user/doctrine-odm-mongodb-bridge/)
[![Latest Stable Version](https://poser.pugx.org/bengor-user/doctrine-odm-mongodb-bridge/v/stable.svg)](https://packagist.org/packages/bengor-user/doctrine-odm-mongodb-bridge/)
[![Latest Unstable Version](https://poser.pugx.org/bengor-user/doctrine-odm-mongodb-bridge/v/unstable.svg)](https://packagist.org/packages/bengor-user/doctrine-odm-mongodb-bridge/)

##Requirements
PHP >= 5.5

##Installation
The easiest way to install this component is using [Composer][6]
```bash
$ composer require bengor-user/doctrine-odm-mongodb-bridge
```

##Documentation
All the documentation is stored inside the [user library](https://github.com/BenGorUser/User/blob/master/docs/index.md).

##Tests
This library is completely tested by **[PHPSpec][1], SpecBDD framework for PHP**.

Run the following command to launch tests:
```bash
$ vendor/bin/phpspec run -fpretty
```

##Contributing
If you have any doubt or maybe you want to share some opinion, you can use our **Gitter** chat.

[![Join the chat at https://gitter.im/BenGorUser/User](https://badges.gitter.im/BenGorUser/User.svg)](https://gitter.im/BenGorUser/User?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

BenGorUser uses [Crowdin][7] as tool to manage translations so, please help us translating your favorite language
via this service. Pull requests about translations will not be accepted.

[![Crowdin](https://d322cqt584bo4o.cloudfront.net/bengoruser/localized.svg)](https://crowdin.com/project/bengoruser)

This library follows PHP coding standards, so pull requests need to execute the Fabien Potencier's [PHP-CS-Fixer][5].
Furthermore, if the PR creates some not-PHP file remember that you have to put the license header manually. In order
to simplify we provide a Composer script that wraps all the commands related with this process.
```bash
$ composer run-script cs
```

There is also a policy for contributing to this project. Pull requests must be explained step by step to make the
review process easy in order to accept and merge them. New methods or code improvements must come paired with
[PHPSpec][1] tests.

If you would like to contribute it is a good point to follow Symfony contribution standards, so please read the
[Contributing Code][2] in the project documentation. If you are submitting a pull request, please follow the guidelines
in the [Submitting a Patch][3] section and use the [Pull Request Template][4].

##Credits
This library is created by:
>
**@benatespina** - [benatespina@gmail.com](mailto:benatespina@gmail.com)<br>
**@gorkalaucirica** - [gorka.lauzirika@gmail.com](mailto:gorka.lauzirika@gmail.com)

##Licensing Options
[![License](https://poser.pugx.org/bengor-user/doctrine-odm-mongodb-bridge/license.svg)](https://github.com/BenGorUser/DoctrineODMMongoDBBridge/blob/master/LICENSE)

[1]: http://www.phpspec.net/
[2]: http://symfony.com/doc/current/contributing/code/index.html
[3]: http://symfony.com/doc/current/contributing/code/patches.html#check-list
[4]: http://symfony.com/doc/current/contributing/code/patches.html#make-a-pull-request
[5]: http://cs.sensiolabs.org/
[6]: http://getcomposer.org
[7]: https://crowdin.com/

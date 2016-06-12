<?php

/*
 * This file is part of the BenGorUser package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BenGorUser\DoctrineODMMongoDBBridge\Infrastructure\Persistence;

use BenGorUser\DoctrineODMMongoDBBridge\Infrastructure\Persistence\Types\UserEmailType;
use BenGorUser\DoctrineODMMongoDBBridge\Infrastructure\Persistence\Types\UserIdType;
use BenGorUser\DoctrineODMMongoDBBridge\Infrastructure\Persistence\Types\UserPasswordType;
use BenGorUser\DoctrineODMMongoDBBridge\Infrastructure\Persistence\Types\UserRolesType;
use BenGorUser\DoctrineODMMongoDBBridge\Infrastructure\Persistence\Types\UserTokenType;
use Doctrine\MongoDB\Connection;
use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Driver\YamlDriver;
use Doctrine\ODM\MongoDB\Types\Type;

/**
 * Doctrine ODM MongoDB document manager factory class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class DocumentManagerFactory
{
    /**
     * Creates an document manager instance enabling mappings and custom types.
     *
     * @param Connection|null $aConnection The MongoDB connection, it can be null
     *
     * @return DocumentManager
     */
    public function build(Connection $aConnection = null)
    {
        Type::addType('user_email', UserEmailType::class);
        Type::addType('user_id', UserIdType::class);
        Type::addType('user_password', UserPasswordType::class);
        Type::addType('user_roles', UserRolesType::class);
        Type::addType('user_token', UserTokenType::class);

        $configuration = new Configuration();
        $driver = new YamlDriver([__DIR__ . '/Mapping']);
        $configuration->setMetadataDriverImpl($driver);
        $configuration->setProxyDir(__DIR__ . '/Proxies');
        $configuration->setProxyNamespace('Proxies');
        $configuration->setHydratorDir(__DIR__ . '/Hydrators');
        $configuration->setHydratorNamespace('Hydrators');

        return DocumentManager::create($aConnection, $configuration);
    }
}

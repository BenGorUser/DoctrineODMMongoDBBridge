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

namespace BenGorUser\DoctrineODMMongoDBBridge\Infrastructure\Persistence\Types;

use BenGorUser\User\Domain\Model\UserToken;
use Doctrine\ODM\MongoDB\Types\StringType;

/**
 * Doctrine ODM MongoDB user email custom type class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class UserTokenType extends StringType
{
    /**
     * {@inheritdoc}
     */
    public function convertToDatabaseValue($value)
    {
        return json_encode([$value->token(), $value->createdOn()]);
    }

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value)
    {
        list($token, $createdOn) = json_decode($value);

        $return = new UserToken($token);

        $reflectionClass = new \ReflectionClass($return);
        $reflectionProperty = $reflectionClass->getProperty('createdOn');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($return, new \DateTimeImmutable($createdOn));

        return $return;
    }

    /**
     * {@inheritdoc}
     */
    public function closureToMongo()
    {
        return '$return = json_encode([$value->token(), $value->createdOn()]);';
    }

    /**
     * {@inheritdoc}
     */
    public function closureToPHP()
    {
        return 'list($token, $createdOn) = json_decode($value);' .
        '$return = new \BenGorUser\User\Domain\Model\UserToken($token);' .
        '$reflectionClass = new \ReflectionClass($return);$reflectionProperty = $reflectionClass->getProperty("createdOn");$reflectionProperty->setAccessible(true);$reflectionProperty->setValue($return, new \DateTimeImmutable($createdOn));';
    }
}

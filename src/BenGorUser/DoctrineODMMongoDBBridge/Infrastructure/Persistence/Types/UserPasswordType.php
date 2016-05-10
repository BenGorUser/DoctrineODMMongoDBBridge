<?php

/*
 * This file is part of the BenGorUser library.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BenGorUser\DoctrineODMMongoDBBridge\Infrastructure\Persistence\Types;

use BenGorUser\User\Domain\Model\UserPassword;
use Doctrine\ODM\MongoDB\Types\Type;

/**
 * Doctrine ODM MongoDB user password custom type class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class UserPasswordType extends Type
{
    /**
     * {@inheritdoc}
     */
    public function convertToDatabaseValue($value)
    {
        return json_encode([$value->encodedPassword(), $value->salt()]);
    }

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value)
    {
        list($encodedPassword, $salt) = json_decode($value);

        return UserPassword::fromEncoded($encodedPassword, $salt);
    }

    /**
     * {@inheritdoc}
     */
    public function closureToMongo()
    {
        return '$return = json_encode([$value->encodedPassword(), $value->salt()]);';
    }

    /**
     * {@inheritdoc}
     */
    public function closureToPHP()
    {
        return 'list($encodedPassword, $salt) = json_decode($value);' .
        '$return = \BenGor\User\Domain\Model\UserPassword::fromEncoded($encodedPassword, $salt);';
    }
}

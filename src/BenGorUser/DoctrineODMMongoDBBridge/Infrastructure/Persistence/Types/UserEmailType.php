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

use BenGorUser\User\Domain\Model\UserEmail;
use Doctrine\ODM\MongoDB\Types\StringType;

/**
 * Doctrine ODM MongoDB user email custom type class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class UserEmailType extends StringType
{
    /**
     * {@inheritdoc}
     */
    public function convertToDatabaseValue($value)
    {
        return $value->email();
    }

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value)
    {
        return new UserEmail($value);
    }

    /**
     * {@inheritdoc}
     */
    public function closureToMongo()
    {
        return '$return = $value->email();';
    }

    /**
     * {@inheritdoc}
     */
    public function closureToPHP()
    {
        return '$return = new \BenGorUser\User\Domain\Model\UserEmail($value);';
    }
}

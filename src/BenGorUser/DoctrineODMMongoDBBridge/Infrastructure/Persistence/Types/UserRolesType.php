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

use BenGorUser\User\Domain\Model\UserRole;
use Doctrine\ODM\MongoDB\Types\Type;

/**
 * Doctrine ODM MongoDB user role collection custom type class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class UserRolesType extends Type
{
    /**
     * {@inheritdoc}
     */
    public function convertToDatabaseValue($value)
    {
        $roles = array_map(function (UserRole $role) {
            return $role->role();
        }, $value);

        return json_encode($roles);
    }

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value)
    {
        $userRoles = array_map(function ($role) {
            return new UserRole($role);
        }, json_decode($value));

        return $userRoles;
    }

    /**
     * {@inheritdoc}
     */
    public function closureToMongo()
    {
        return '$roles = array_map(function (UserRole $role) {return $role->role();}, $value);' .
        '$return = json_encode($roles);';
    }

    /**
     * {@inheritdoc}
     */
    public function closureToPHP()
    {
        return '$userRoles = array_map(function ($role) {return new \BenGor\User\Domain\Model\UserRole($role);},' .
        'json_decode($value));$return = $userRoles;';
    }
}

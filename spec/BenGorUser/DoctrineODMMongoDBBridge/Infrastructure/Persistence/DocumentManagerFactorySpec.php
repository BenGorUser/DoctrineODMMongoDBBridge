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

namespace spec\BenGorUser\DoctrineODMMongoDBBridge\Infrastructure\Persistence;

use BenGorUser\DoctrineODMMongoDBBridge\Infrastructure\Persistence\DocumentManagerFactory;
use Doctrine\MongoDB\Connection;
use Doctrine\ODM\MongoDB\DocumentManager;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of DocumentManager class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class DocumentManagerFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DocumentManagerFactory::class);
    }

    function it_builds(Connection $connection)
    {
        $this->build($connection)->shouldReturnAnInstanceOf(DocumentManager::class);
    }
}

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

namespace BenGorUser\DoctrineODMMongoDBBridge\Infrastructure\Persistence;

use BenGorUser\User\Domain\Model\UserEmail;
use BenGorUser\User\Domain\Model\UserGuest;
use BenGorUser\User\Domain\Model\UserGuestId;
use BenGorUser\User\Domain\Model\UserGuestRepository;
use BenGorUser\User\Domain\Model\UserToken;
use Doctrine\ODM\MongoDB\DocumentRepository;

/**
 * Doctrine ODM MongoDB user guest repository class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class DoctrineODMMongoDBUserGuestRepository extends DocumentRepository implements UserGuestRepository
{
    /**
     * {@inheritdoc}
     */
    public function userGuestOfId(UserGuestId $anId)
    {
        return $this->find($anId->id());
    }

    /**
     * {@inheritdoc}
     */
    public function userGuestOfEmail(UserEmail $anEmail)
    {
        return $this->findOneBy(['email.email' => $anEmail->email()]);
    }

    /**
     * {@inheritdoc}
     */
    public function userGuestOfInvitationToken(UserToken $anInvitationToken)
    {
        return $this->findOneBy(['invitationToken.token' => $anInvitationToken->token()]);
    }

    /**
     * {@inheritdoc}
     */
    public function persist(UserGuest $aUserGuest)
    {
        $this->getDocumentManager()->persist($aUserGuest);
    }

    /**
     * {@inheritdoc}
     */
    public function remove(UserGuest $aUserGuest)
    {
        $this->getDocumentManager()->remove($aUserGuest);
    }

    /**
     * {@inheritdoc}
     */
    public function size()
    {
        $queryBuilder = $this->createQueryBuilder();

        return $queryBuilder
            ->count()
            ->getQuery()
            ->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function nextIdentity()
    {
        return new UserGuestId();
    }
}

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

use BenGorUser\DoctrineODMMongoDBBridge\Infrastructure\Persistence\DoctrineODMMongoDBUserRepository;
use BenGorUser\User\Domain\Model\User;
use BenGorUser\User\Domain\Model\UserEmail;
use BenGorUser\User\Domain\Model\UserId;
use BenGorUser\User\Domain\Model\UserRepository;
use BenGorUser\User\Domain\Model\UserToken;
use Doctrine\MongoDB\CursorInterface;
use Doctrine\MongoDB\Query\Builder;
use Doctrine\MongoDB\Query\Query;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\DocumentRepository;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\ODM\MongoDB\Persisters\DocumentPersister;
use Doctrine\ODM\MongoDB\UnitOfWork;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of DoctrineODMMongoDBUserRepository class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class DoctrineODMMongoDBUserRepositorySpec extends ObjectBehavior
{
    function let(DocumentManager $manager, UnitOfWork $unitOfWork, ClassMetadata $metadata)
    {
        $this->beConstructedWith($manager, $unitOfWork, $metadata);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(DoctrineODMMongoDBUserRepository::class);
    }

    function it_implements_user_doctrine_repository()
    {
        $this->shouldImplement(UserRepository::class);
    }

    function it_extends_document_repository()
    {
        $this->shouldHaveType(DocumentRepository::class);
    }

    function it_get_user_of_id(
        User $user,
        UnitOfWork $unitOfWork,
        DocumentPersister $documentPersister,
        ClassMetadata $metadata
    ) {
        $unitOfWork->tryGetById('user-id', $metadata)->shouldBeCalled()->willReturn(null);
        $unitOfWork->getDocumentPersister(null)->shouldBeCalled()->willReturn($documentPersister);
        $documentPersister->load(['_id' => 'user-id'])->shouldBeCalled()->willReturn($user);

        $this->userOfId(new UserId('user-id'))->shouldReturn($user);
    }

    function it_get_all(
        User $user,
        UnitOfWork $unitOfWork,
        DocumentPersister $documentPersister,
        CursorInterface $cursor
    ) {
        $unitOfWork->getDocumentPersister(null)->shouldBeCalled()->willReturn($documentPersister);
        $documentPersister->loadAll([], null, null, null)->shouldBeCalled()->willReturn($cursor);
        $cursor->toArray(false)->shouldBeCalled()->willReturn([$user]);

        $this->all()->shouldReturn([$user]);
    }

    function it_get_user_of_email(User $user, UnitOfWork $unitOfWork, DocumentPersister $documentPersister)
    {
        $unitOfWork->getDocumentPersister(null)->shouldBeCalled()->willReturn($documentPersister);
        $documentPersister->load(['email' => 'bengor@user.com'])->shouldBeCalled()->willReturn($user);

        $this->userOfEmail(new UserEmail('bengor@user.com'))->shouldReturn($user);
    }

    function it_get_user_of_confirmation_token(User $user, UnitOfWork $unitOfWork, DocumentPersister $documentPersister)
    {
        $unitOfWork->getDocumentPersister(null)->shouldBeCalled()->willReturn($documentPersister);
        $documentPersister->load(['confirmationToken' => 'confirmation-token'])->shouldBeCalled()->willReturn($user);

        $this->userOfConfirmationToken(new UserToken('confirmation-token'))->shouldReturn($user);
    }

    function it_get_user_of_invitation_token(User $user, UnitOfWork $unitOfWork, DocumentPersister $documentPersister)
    {
        $unitOfWork->getDocumentPersister(null)->shouldBeCalled()->willReturn($documentPersister);
        $documentPersister->load(['invitationToken' => 'invitation-token'])->shouldBeCalled()->willReturn($user);

        $this->userOfInvitationToken(new UserToken('invitation-token'))->shouldReturn($user);
    }

    function it_get_user_of_remember_password_token(
        User $user,
        UnitOfWork $unitOfWork,
        DocumentPersister $documentPersister
    ) {
        $unitOfWork->getDocumentPersister(null)->shouldBeCalled()->willReturn($documentPersister);
        $documentPersister->load([
            'rememberPasswordToken' => 'remember-password-token',
        ])->shouldBeCalled()->willReturn($user);

        $this->userOfRememberPasswordToken(new UserToken('remember-password-token'))->shouldReturn($user);
    }

    function it_persist(DocumentManager $manager, User $user)
    {
        $manager->persist($user)->shouldBeCalled();

        $this->persist($user);
    }

    function it_remove(DocumentManager $manager, User $user)
    {
        $manager->remove($user)->shouldBeCalled();

        $this->remove($user);
    }

    function it_gets_the_user_table_size(
        DocumentManager $manager,
        Builder $queryBuilder,
        Query $query
    ) {
        $manager->createQueryBuilder(null)->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->count()->shouldBeCalled()->willReturn($queryBuilder);
        $queryBuilder->getQuery()->shouldBeCalled()->willReturn($query);
        $query->execute()->shouldBeCalled()->willReturn(2);

        $this->size()->shouldReturn(2);
    }
}

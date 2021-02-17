<?php
namespace LeoGalleguillos\CommentTest\Model\Entity;

use DateTime;
use LeoGalleguillos\Comment\Model\Entity as CommentEntity;
use LeoGalleguillos\User\Model\Entity as UserEntity;
use PHPUnit\Framework\TestCase;

class CommentTest extends TestCase
{
    protected function setUp(): void
    {
        $this->commentEntity = new CommentEntity\Comment();
    }

    public function testGettersAndSetters()
    {
        $created = new DateTime();
        $this->commentEntity->setCreated($created);
        $this->assertSame(
            $created,
            $this->commentEntity->getCreated()
        );

        $message = 'this is the message';
        $this->commentEntity->setMessage($message);
        $this->assertSame(
            $message,
            $this->commentEntity->getMessage()
        );

        $name = 'My Name';
        $this->assertSame(
            $this->commentEntity,
            $this->commentEntity->setName($name)
        );
        $this->assertSame(
            $name,
            $this->commentEntity->getName()
        );

        $userEntity = new UserEntity\User();
        $this->commentEntity->setUserEntity($userEntity);
        $this->assertSame(
            $userEntity,
            $this->commentEntity->getUserEntity()
        );
    }
}

<?php
namespace LeoGalleguillos\CommentTest\Model\Entity;

use DateTime;
use LeoGalleguillos\Comment\Model\Entity as CommentEntity;
use PHPUnit\Framework\TestCase;

class CommentTest extends TestCase
{
    protected function setUp()
    {
        $this->commentEntity = new CommentEntity\Comment();
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(
            CommentEntity\Comment::class,
            $this->commentEntity
        );
    }

    public function testGettersAndSetters()
    {
        $userId = 123;
        $this->commentEntity->setUserId($userId);
        $this->assertSame(
            $userId,
            $this->commentEntity->getUserId()
        );

        $created = new DateTime();
        $this->commentEntity->setCreated($created);
        $this->assertSame(
            $created,
            $this->commentEntity->getCreated()
        );
    }
}

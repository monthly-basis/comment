<?php
namespace MonthlyBasis\CommentTest\Model\Entity;

use MonthlyBasis\Comment\Model\Service as CommentService;
use MonthlyBasis\Comment\Model\Table as CommentTable;
use PHPUnit\Framework\TestCase;

class CountTest extends TestCase
{
    protected function setUp(): void
    {
        $this->commentTableMock = $this->createMock(
            CommentTable\Comment::class
        );
        $this->countCommentsService = new CommentService\Comments\Count(
            $this->commentTableMock
        );
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(
            CommentService\Comments\Count::class,
            $this->countCommentsService
        );
    }
}

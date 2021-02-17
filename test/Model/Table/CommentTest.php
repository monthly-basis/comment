<?php
namespace LeoGalleguillos\CommentTest\Model\Table;

use Generator;
use LeoGalleguillos\Comment\Model\Table as CommentTable;
use LeoGalleguillos\Test\TableTestCase;

class CommentTest extends TableTestCase
{

    protected function setUp(): void
    {
        $this->commentTable = new CommentTable\Comment(
            $this->getAdapter()
        );

        $this->dropTable('comment');
        $this->createTable('comment');
    }

    public function testInsertAndSelectCount()
    {
        $this->assertSame(
            0,
            $this->commentTable->selectCount()
        );
        $this->assertSame(
            1,
            $this->commentTable->insert(1, 2, 3, 4, null, 'message')
        );
        $this->assertSame(
            2,
            $this->commentTable->insert(1, 2, 3, null, 'name', 'message')
        );
        $this->assertSame(
            2,
            $this->commentTable->selectCount()
        );
    }

    public function testSelectCountWhereEntityTypeIdAndTypeId()
    {
        $this->assertSame(
            0,
            $this->commentTable->selectCountWhereEntityTypeIdAndTypeId(3, 4)
        );
        $this->commentTable->insert(1, 2, 3, 4, null, 'the message');
        $this->commentTable->insert(1, 2, 3, null, 'name', 'the message');
        $this->assertSame(
            2,
            $this->commentTable->selectCountWhereEntityTypeIdAndTypeId(2, 3)
        );
    }

    public function testSelectWhereCommentId()
    {
        $this->commentTable->insert(1, 2, 3, 4, null, 'the message');
        $array = $this->commentTable->selectWhereCommentId(1);

        $this->assertSame(
            $array['comment_id'],
            '1'
        );
        $this->assertSame(
            $array['entity_id'],
            '1'
        );
        $this->assertSame(
            $array['entity_type_id'],
            '2'
        );
        $this->assertSame(
            $array['type_id'],
            '3'
        );
        $this->assertSame(
            $array['user_id'],
            '4'
        );
        $this->assertSame(
            $array['message'],
            'the message'
        );
    }

    public function testSelectWhereEntityTypeIdAndTypeId()
    {
        $generator = $this->commentTable->selectWhereEntityTypeIdAndTypeId(
            1,
            2
        );
        $this->assertInstanceOf(
            Generator::class,
            $generator
        );
        $this->assertNull($generator->current());

        $this->commentTable->insert(1, 2, 3, 4, null, 'the message');
        $this->commentTable->insert(1, 2, 3, null, 'name', 'another message');
        $generator = $this->commentTable->selectWhereEntityTypeIdAndTypeId(
            2,
            3
        );
        $this->assertInstanceOf(
            Generator::class,
            $generator
        );
        $array = $generator->current();
        $this->assertSame(
            'the message',
            $array['message']
        );
        $generator->next();
        $array = $generator->current();
        $this->assertSame(
            'another message',
            $array['message']
        );
    }
}

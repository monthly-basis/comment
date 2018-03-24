<?php
namespace LeoGalleguillos\CommentTest\Model\Table;

use Generator;
use LeoGalleguillos\Comment\Model\Table as CommentTable;
use LeoGalleguillos\CommentTest\TableTestCase;
use Zend\Db\Adapter\Adapter;
use PHPUnit\Framework\TestCase;

class CommentTest extends TableTestCase
{
    /**
     * @var string
     */
    protected $sqlPath = __DIR__ . '/../../..' . '/sql/leogalle_test/comment/';

    protected function setUp()
    {
        $configArray     = require(__DIR__ . '/../../../config/autoload/local.php');
        $configArray     = $configArray['db']['adapters']['leogalle_test'];
        $this->adapter   = new Adapter($configArray);
        $this->commentTable = new CommentTable\Comment($this->adapter);

        $this->dropTable();
        $this->createTable();
    }

    protected function dropTable()
    {
        $sql = file_get_contents($this->sqlPath . 'drop.sql');
        $result = $this->adapter->query($sql)->execute();
    }

    protected function createTable()
    {
        $sql = file_get_contents($this->sqlPath . 'create.sql');
        $result = $this->adapter->query($sql)->execute();
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(
            CommentTable\Comment::class,
            $this->commentTable
        );
    }

    public function testInsertAndSelectCount()
    {
        $this->assertSame(
            0,
            $this->commentTable->selectCount()
        );
        $this->assertSame(
            1,
            $this->commentTable->insert(1, 2, 3, 4, 'message')
        );
        $this->assertSame(
            2,
            $this->commentTable->insert(1, 2, 3, 4, 'message')
        );
        $this->assertSame(
            2,
            $this->commentTable->selectCount()
        );
    }

    public function testSelectWhereCommentId()
    {
        $this->commentTable->insert(1, 2, 3, 4, 'the message');
        $array = $this->commentTable->selectWhereCommentId(1);

        $this->assertSame(
            $array['comment_id'],
            '1'
        );
        $this->assertSame(
            $array['user_id'],
            '1'
        );
        $this->assertSame(
            $array['entity_id'],
            '2'
        );
        $this->assertSame(
            $array['entity_type_id'],
            '3'
        );
        $this->assertSame(
            $array['type_id'],
            '4'
        );
        $this->assertSame(
            $array['message'],
            'the message'
        );
    }
}

<?php
namespace MonthlyBasis\Comment\Model\Table;

use Generator;
use Laminas\Db\Adapter\Adapter;

class Comment
{
    /**
     * @var Adapter
     */
    protected $adapter;

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function insert(
        int $entityId = null,
        int $entityTypeId,
        int $typeId,
        int $userId = null,
        string $name = null,
        string $message
    ) : int {
        $sql = '
            INSERT
              INTO `comment` (
                       `entity_id`,
                       `entity_type_id`,
                       `type_id`,
                       `user_id`,
                       `name`,
                       `message`,
                       `created`
                   )
            VALUES (?, ?, ?, ?, ?, ?, UTC_TIMESTAMP())
                 ;
        ';
        $parameters = [
            $entityId,
            $entityTypeId,
            $typeId,
            $userId,
            $name,
            $message,
        ];
        return (int) $this->adapter
                          ->query($sql)
                          ->execute($parameters)
                          ->getGeneratedValue();
    }

    public function selectCount()
    {
        $sql = '
            SELECT COUNT(*) AS `count`
              FROM `comment`
                 ;
        ';
        $row = $this->adapter->query($sql)->execute()->current();
        return (int) $row['count'];
    }

    public function selectWhereCommentId(int $commentId) : array
    {
        $sql = '
            SELECT `comment_id`
                 , `entity_id`
                 , `entity_type_id`
                 , `type_id`
                 , `user_id`
                 , `name`
                 , `message`
                 , `created`
              FROM `comment`
             WHERE `comment_id` = ?
                 ;
        ';
        return $this->adapter->query($sql)->execute([$commentId])->current();
    }

    public function selectCountWhereEntityTypeIdAndTypeId(
        int $entityTypeId,
        int $typeId
    ) : int {
        $sql = '
            SELECT COUNT(*) AS `count`
              FROM `comment`
             WHERE `entity_type_id` = ?
               AND `type_id` = ?
        ';
        $parameters = [
            $entityTypeId,
            $typeId,
        ];
        return (int) $this->adapter
                          ->query($sql)
                          ->execute($parameters)
                          ->current()['count'];
    }

    public function selectWhereEntityTypeIdAndTypeId(
        int $entityTypeId,
        int $typeId
    ) : Generator {
        $sql = '
            SELECT `comment_id`
                 , `entity_id`
                 , `entity_type_id`
                 , `type_id`
                 , `user_id`
                 , `name`
                 , `message`
                 , `created`
              FROM `comment`
             WHERE `entity_type_id` = ?
               AND `type_id` = ?
        ';
        $parameters = [
            $entityTypeId,
            $typeId,
        ];
        foreach ($this->adapter->query($sql)->execute($parameters) as $array) {
            yield $array;
        }
    }
}

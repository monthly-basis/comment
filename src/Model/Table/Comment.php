<?php
namespace LeoGalleguillos\Comment\Model\Table;

use Generator;
use Zend\Db\Adapter\Adapter;

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
        int $userId,
        string $name,
        string $slug,
        string $description
    ) {
        $sql = '
            INSERT
              INTO `comment` (
                       `user_id`, `name`, `slug`, `description`, `created`
                   )
            VALUES (?, ?, ?, ?, UTC_TIMESTAMP())
                 ;
        ';
        $parameters = [
            $userId,
            $name,
            $slug,
            $description
        ];
        return $this->adapter
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

    public function selectCountWhereUserId(int $userId)
    {
        $sql = '
            SELECT COUNT(*) AS `count`
              FROM `comment`
             WHERE `comment`.`user_id` = :userId
                 ;
        ';
        $parameters = [
            'userId' => $userId,
        ];
        $row = $this->adapter->query($sql)->execute($parameters)->current();
        return (int) $row['count'];
    }

    public function selectOrderByCreatedDesc() : Generator
    {
        $sql = '
            SELECT `comment_id`
                 , `user_id`
                 , `name`
                 , `slug`
                 , `description`
                 , `views`
                 , `created`
              FROM `comment`
             ORDER
                BY `created` DESC
             LIMIT 100
                 ;
        ';
        foreach ($this->adapter->query($sql)->execute() as $row) {
            yield($row);
        }
    }

    public function selectWhereCommentId(int $commentId) : array
    {
        $sql = '
            SELECT `comment_id`
                 , `user_id`
                 , `name`
                 , `slug`
                 , `description`
                 , `views`
                 , `created`
              FROM `comment`
             WHERE `comment_id` = ?
                 ;
        ';
        return $this->adapter->query($sql)->execute([$commentId])->current();
    }

    public function selectWhereSlug(string $slug) : array
    {
        $sql = '
            SELECT `comment_id`
                 , `user_id`
                 , `name`
                 , `slug`
                 , `description`
                 , `views`
                 , `created`
              FROM `comment`
             WHERE `slug` = ?
                 ;
        ';
        return $this->adapter->query($sql)->execute([$slug])->current();
    }

    public function selectWhereUserId(int $userId) : Generator
    {
        $sql = '
            SELECT `comment_id`
                 , `user_id`
                 , `name`
                 , `slug`
                 , `description`
                 , `website`
                 , `views`
                 , `created`
              FROM `comment`
             WHERE `user_id` = :userId
             ORDER
                BY `comment`.`name` ASC
                 ;
        ';
        $parameters = [
            'userId' => $userId,
        ];
        foreach ($this->adapter->query($sql)->execute($parameters) as $array) {
            yield $array;
        }
    }

    public function updateViewsWhereCommentId(int $commentId) : bool
    {
        $sql = '
            UPDATE `comment`
               SET `comment`.`views` = `comment`.`views` + 1
             WHERE `comment`.`comment_id` = ?
                 ;
        ';
        $parameters = [
            $commentId
        ];
        return (bool) $this->adapter->query($sql)->execute($parameters)->getAffectedRows();
    }

    public function updateWhereUserId(ArrayObject $arrayObject, int $userId) : bool
    {
        $sql = '
            UPDATE `user`
               SET `user`.`welcome_message` = ?
             WHERE `user`.`user_id` = ?
                 ;
        ';
        $parameters = [
            $arrayObject['welcome_message'],
            $userId
        ];
        return (bool) $this->adapter->query($sql, $parameters)->getAffectedRows();
    }
}

<?php
namespace LeoGalleguillos\Comment\Model\Factory;

use DateTime;
use LeoGalleguillos\Comment\Model\Entity as CommentEntity;
use LeoGalleguillos\Comment\Model\Table as CommentTable;

class Comment
{
    /**
     * Construct
     *
     * @param CommentTable\Comment $commentTable
     */
    public function __construct(
        CommentTable\Comment $commentTable
    ) {
        $this->commentTable = $commentTable;
    }

    /**
     * Build from array.
     *
     * @param array $array
     * @return CommentEntity\Comment
     */
    public function buildFromArray(
        array $array
    ) : CommentEntity\Comment {
        $commentEntity = new CommentEntity\Comment();
        $commentEntity->setCommentId($array['comment_id'])
                      ->setCreated(new DateTime($array['created']))
                      ->setMessage($array['message'])
                      ->setUserId($array['user_id'])
                      ->setViews($array['views']);

        return $commentEntity;
    }

    /**
     * Build from comment ID.
     *
     * @param int $commentId
     * @return CommentEntity\Comment
     */
    public function buildFromCommentId(
        int $commentId
    ) : CommentEntity\Comment {
        return $this->buildFromArray(
            $this->commentTable->selectWhereCommentId($commentId)
        );
    }
}

<?php
namespace LeoGalleguillos\Comment\Model\Factory;

use DateTime;
use LeoGalleguillos\Comment\Model\Entity as CommentEntity;
use LeoGalleguillos\Comment\Model\Table as CommentTable;
use LeoGalleguillos\User\Model\Factory as UserFactory;

class Comment
{
    /**
     * Construct
     *
     * @param CommentTable\Comment $commentTable
     * @param UserFactory\User $userFactory
     */
    public function __construct(
        CommentTable\Comment $commentTable,
        UserFactory\User $userFactory
    ) {
        $this->commentTable = $commentTable;
        $this->userFactory  = $userFactory;
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
                      ->setMessage($array['message']);

        if (!empty($array['user_id'])) {
            $commentEntity->setUserEntity(
                $this->userFactory->buildFromUserId($array['user_id'])
            );
        }

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

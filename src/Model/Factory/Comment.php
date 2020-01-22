<?php
namespace LeoGalleguillos\Comment\Model\Factory;

use DateTime;
use LeoGalleguillos\Comment\Model\Entity as CommentEntity;
use LeoGalleguillos\Comment\Model\Table as CommentTable;
use LeoGalleguillos\User\Model\Factory as UserFactory;

class Comment
{
    public function __construct(
        CommentTable\Comment $commentTable,
        UserFactory\User $userFactory
    ) {
        $this->commentTable = $commentTable;
        $this->userFactory  = $userFactory;
    }

    public function buildFromArray(
        array $array
    ): CommentEntity\Comment {
        $commentEntity = new CommentEntity\Comment();
        $commentEntity
            ->setCommentId($array['comment_id'])
            ->setCreated(new DateTime($array['created']))
            ->setMessage($array['message']);

        if (isset($array['name'])) {
            $commentEntity->setName($array['name']);
        }
        if (isset($array['user_id'])) {
            $commentEntity->setUserEntity(
                $this->userFactory->buildFromUserId($array['user_id'])
            );
        }

        return $commentEntity;
    }

    public function buildFromCommentId(
        int $commentId
    ): CommentEntity\Comment {
        return $this->buildFromArray(
            $this->commentTable->selectWhereCommentId($commentId)
        );
    }
}

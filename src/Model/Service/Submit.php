<?php
namespace LeoGalleguillos\Comment\Model\Service;

use Exception;
use LeoGalleguillos\Flash\Model\Service as FlashService;
use LeoGalleguillos\Comment\Model\Entity as CommentEntity;
use LeoGalleguillos\Comment\Model\Factory as CommentFactory;
use LeoGalleguillos\Comment\Model\Service as CommentService;
use LeoGalleguillos\Comment\Model\Table as CommentTable;
use LeoGalleguillos\String\Model\Service as StringService;
use LeoGalleguillos\User\Model\Entity as UserEntity;

class Submit
{
    /**
     * Construct.
     *
     * @param FlashService\Flash $flashService,
     * @param CommentFactory\Comment $commentFactory,
     * @param CommentTable\Comment $commentTable,
     */
    public function __construct(
        FlashService\Flash $flashService,
        CommentFactory\Comment $commentFactory,
        CommentTable\Comment $commentTable
    ) {
        $this->flashService       = $flashService;
        $this->commentFactory        = $commentFactory;
        $this->commentTable          = $commentTable;
    }

    /**
     * Submit.
     *
     * @param $userId
     * @return CommentEntity\Comment
     */
    public function create(
        UserEntity\User $userEntity = null,
        int $entityId = null,
        int $entityTypeId,
        int $typeId
    ) : CommentEntity\Comment {
        $errors = [];

        if (empty($_POST['message'])) {
            $errors[] = 'Invalid message.';
        }

        if ($errors) {
            $this->flashService->set('errors', $errors);
            throw new Exception('Invalid form input.');
        }

        $commentId = $this->commentTable->insert(
            $userEntity->getUserId(),
            $entityId,
            $entityTypeId,
            $typeId,
            $_POST['message']
        );

        return $this->commentFactory->buildFromCommentId($commentId);
    }
}

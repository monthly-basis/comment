<?php
namespace LeoGalleguillos\Comment\Model\Service;

use Exception;
use LeoGalleguillos\Flash\Model\Service as FlashService;
use LeoGalleguillos\Comment\Model\Entity as CommentEntity;
use LeoGalleguillos\Comment\Model\Factory as CommentFactory;
use LeoGalleguillos\Comment\Model\Table as CommentTable;
use LeoGalleguillos\ReCaptcha\Model\Service as ReCaptchaService;

class SubmitWithReCaptcha
{
    public function __construct(
        FlashService\Flash $flashService,
        CommentFactory\Comment $commentFactory,
        CommentTable\Comment $commentTable,
        ReCaptchaService\Valid $validService
    ) {
        $this->flashService       = $flashService;
        $this->commentFactory        = $commentFactory;
        $this->commentTable          = $commentTable;
        $this->validService = $validService;
    }

    public function submitWithReCaptcha(
        int $entityId = null,
        int $entityTypeId,
        int $typeId,
        string $name,
        string $message
    ): CommentEntity\Comment {
        $errors = [];

        if (!$this->validService->isValid()) {
            $errors[] = 'Invalid reCAPTCHA.';
            $this->flashService->set('errors', $errors);
            throw new Exception('Invalid form input.');
        }

        if (empty($name)) {
            $errors[] = 'Invalid name.';
        }

        if (empty($message)) {
            $errors[] = 'Invalid message.';
        }

        if ($errors) {
            $this->flashService->set('errors', $errors);
            throw new Exception('Invalid form input.');
        }

        $commentId = $this->commentTable->insert(
            $entityId,
            $entityTypeId,
            $typeId,
            null,
            $name,
            $message
        );

        return $this->commentFactory->buildFromCommentId($commentId);
    }
}
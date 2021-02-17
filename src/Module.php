<?php
namespace LeoGalleguillos\Comment;

use LeoGalleguillos\Comment\Model\Factory as CommentFactory;
use LeoGalleguillos\Comment\Model\Service as CommentService;
use LeoGalleguillos\Comment\Model\Table as CommentTable;
use LeoGalleguillos\Comment\View\Helper as CommentHelper;
use MonthlyBasis\Flash\Model\Service as FlashService;
use MonthlyBasis\ReCaptcha\Model\Service as ReCaptchaService;
use MonthlyBasis\User\Model\Factory as UserFactory;

class Module
{
    public function getConfig()
    {
        return [
            'view_helpers' => [
                'aliases' => [
                ],
                'factories' => [
                ],
            ],
        ];
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                CommentFactory\Comment::class => function ($serviceManager) {
                    return new CommentFactory\Comment(
                        $serviceManager->get(CommentTable\Comment::class),
                        $serviceManager->get(UserFactory\User::class)
                    );
                },
                CommentService\Comments::class => function ($serviceManager) {
                    return new CommentService\Comments(
                        $serviceManager->get(CommentFactory\Comment::class),
                        $serviceManager->get(CommentTable\Comment::class)
                    );
                },
                CommentService\Comments\Count::class => function ($serviceManager) {
                    return new CommentService\Comments\Count(
                        $serviceManager->get(CommentTable\Comment::class)
                    );
                },
                CommentService\Submit::class => function ($serviceManager) {
                    return new CommentService\Submit(
                        $serviceManager->get(FlashService\Flash::class),
                        $serviceManager->get(CommentFactory\Comment::class),
                        $serviceManager->get(CommentTable\Comment::class)
                    );
                },
                CommentService\SubmitWithReCaptcha::class => function ($serviceManager) {
                    return new CommentService\SubmitWithReCaptcha(
                        $serviceManager->get(FlashService\Flash::class),
                        $serviceManager->get(CommentFactory\Comment::class),
                        $serviceManager->get(CommentTable\Comment::class),
                        $serviceManager->get(ReCaptchaService\Valid::class)
                    );
                },
                CommentTable\Comment::class => function ($serviceManager) {
                    return new CommentTable\Comment(
                        $serviceManager->get('comment')
                    );
                },
            ],
        ];
    }
}

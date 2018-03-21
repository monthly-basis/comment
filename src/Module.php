<?php
namespace LeoGalleguillos\Comment;

use LeoGalleguillos\Comment\Model\Factory as CommentFactory;
use LeoGalleguillos\Comment\Model\Service as CommentService;
use LeoGalleguillos\Comment\Model\Table as CommentTable;
use LeoGalleguillos\Comment\View\Helper as CommentHelper;
use LeoGalleguillos\Flash\Model\Service as FlashService;
use LeoGalleguillos\String\Model\Service as StringService;

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
                CommentTable\Comment::class => function ($serviceManager) {
                    return new CommentTable\Comment(
                        $serviceManager->get('main')
                    );
                },
            ],
        ];
    }
}

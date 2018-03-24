<?php
namespace LeoGalleguillos\Comment\Model\Service;

use Generator;
use LeoGalleguillos\Comment\Model\Entity as CommentEntity;
use LeoGalleguillos\Comment\Model\Factory as CommentFactory;
use LeoGalleguillos\Comment\Model\Table as CommentTable;

class Comments
{
    /**
     * Construct.
     *
     * @param CommentFactory\Comment $commentFactory
     * @param CommentTable\Comment $commentTable
     */
    public function __construct(
        CommentFactory\Comment $commentFactory,
        CommentTable\Comment $commentTable
    ) {
        $this->commentFactory        = $commentFactory;
        $this->commentTable          = $commentTable;
    }

    /**
     * Get.
     *
     * @param int $entityTypeId
     * @param int $typeId
     * @yield CommentEntity\Comment
     * @return Generator
     */
    public function get(
        int $entityTypeId,
        int $typeId
    ) : Generator {
        $arrays = $this->commentTable->selectWhereEntityTypeIdAndTypeId(
            $entityTypeId,
            $typeId
        );
        foreach ($arrays as $array) {
            yield $this->commentFactory->buildFromArray($array);
        }
    }
}

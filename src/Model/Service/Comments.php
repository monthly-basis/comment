<?php
namespace LeoGalleguillos\Comment\Model\Service;

use Generator;
use LeoGalleguillos\Comment\Model\Entity as CommentEntity;
use LeoGalleguillos\Comment\Model\Factory as CommentFactory;
use LeoGalleguillos\Comment\Model\Table as CommentTable;
use LeoGalleguillos\Entity\Model\Entity as EntityEntity;

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
     * @param EntityEntity\EntityType $entityTypeEntity
     * @param int $typeId
     * @yield CommentEntity\Comment
     * @return Generator
     */
    public function get(
        EntityEntity\EntityType $entityTypeEntity,
        int $typeId
    ) : Generator {
        $arrays = $this->commentTable->selectWhereEntityTypeIdAndTypeId(
            $entityTypeEntity->getEntityTypeId(),
            $typeId
        );
        foreach ($arrays as $array) {
            yield $this->commentFactory->buildFromArray($array);
        }
    }
}

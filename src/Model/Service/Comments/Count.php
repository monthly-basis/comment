<?php
namespace LeoGalleguillos\Comment\Model\Service\Comments;

use Generator;
use LeoGalleguillos\Comment\Model\Entity as CommentEntity;
use LeoGalleguillos\Comment\Model\Factory as CommentFactory;
use LeoGalleguillos\Comment\Model\Table as CommentTable;
use LeoGalleguillos\Entity\Model\Entity as EntityEntity;

class Count
{
    /**
     * Construct.
     *
     * @param CommentTable\Comment $commentTable
     */
    public function __construct(
        CommentTable\Comment $commentTable
    ) {
        $this->commentTable          = $commentTable;
    }

    /**
     * Count
     *
     * @param EntityEntity\EntityType $entityTypeEntity
     * @param int $typeId
     * @return int
     */
    public function count(
        EntityEntity\EntityType $entityTypeEntity,
        int $typeId
    ) : Generator {
        return $this->commentTable->selectCountWhereEntityTypeIdAndTypeId(
            $entityTypeEntity->getEntityTypeId(),
            $typeId
        );
    }
}

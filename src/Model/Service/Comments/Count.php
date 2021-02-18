<?php
namespace MonthlyBasis\Comment\Model\Service\Comments;

use Generator;
use MonthlyBasis\Comment\Model\Entity as CommentEntity;
use MonthlyBasis\Comment\Model\Factory as CommentFactory;
use MonthlyBasis\Comment\Model\Table as CommentTable;
use MonthlyBasis\Entity\Model\Entity as EntityEntity;

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
    ) : int {
        return $this->commentTable->selectCountWhereEntityTypeIdAndTypeId(
            $entityTypeEntity->getEntityTypeId(),
            $typeId
        );
    }
}

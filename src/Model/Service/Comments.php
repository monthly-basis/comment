<?php
namespace MonthlyBasis\Comment\Model\Service;

use Generator;
use MonthlyBasis\Comment\Model\Entity as CommentEntity;
use MonthlyBasis\Comment\Model\Factory as CommentFactory;
use MonthlyBasis\Comment\Model\Table as CommentTable;
use MonthlyBasis\Entity\Model\Entity as EntityEntity;

class Comments
{
    public function __construct(
        CommentFactory\Comment $commentFactory,
        CommentTable\Comment $commentTable
    ) {
        $this->commentFactory = $commentFactory;
        $this->commentTable   = $commentTable;
    }

    /**
     * @yield CommentEntity\Comment
     */
    public function get(
        EntityEntity\EntityType $entityTypeEntity,
        int $typeId
    ): Generator {
        $arrays = $this->commentTable->selectWhereEntityTypeIdAndTypeId(
            $entityTypeEntity->getEntityTypeId(),
            $typeId
        );
        foreach ($arrays as $array) {
            yield $this->commentFactory->buildFromArray($array);
        }
    }
}

<?php
namespace LeoGalleguillos\Comment\Model\Entity;

use DateTime;
use LeoGalleguillos\Comment\Model\Entity as CommentEntity;
use LeoGalleguillos\User\Model\Entity as UserEntity;

class Comment
{
    protected $commentId;
    protected $created;
    protected $message;
    protected $userEntity;

    public function getCommentId() : int
    {
        return $this->commentId;
    }

    public function getCreated() : DateTime
    {
        return $this->created;
    }

    public function getMessage() : string
    {
        return $this->message;
    }

    public function getUserEntity() : UserEntity\User
    {
        return $this->userEntity;
    }

    public function setCreated(DateTime $created) : CommentEntity\Comment
    {
        $this->created = $created;
        return $this;
    }

    public function setMessage(string $message) : CommentEntity\Comment
    {
        $this->message = $message;
        return $this;
    }

    public function setCommentId(int $commentId) : CommentEntity\Comment
    {
        $this->commentId = $commentId;
        return $this;
    }

    public function setUserEntity(UserEntity\User $userEntity) : CommentEntity\Comment
    {
        $this->userEntity = $userEntity;
        return $this;
    }
}

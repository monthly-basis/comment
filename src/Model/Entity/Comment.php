<?php
namespace LeoGalleguillos\Comment\Model\Entity;

use DateTime;
use LeoGalleguillos\Comment\Model\Entity as CommentEntity;

class Comment
{
    protected $commentId;
    protected $created;
    protected $message;
    protected $userId;
    protected $views;

    public function getCommentId() : int
    {
        return $this->commentId;
    }

    public function getCreated() : DateTime
    {
        return $this->created;
    }

    public function getDescription() : string
    {
        return $this->message;
    }

    public function getUserId() : int
    {
        return $this->userId;
    }

    public function getViews() : int
    {
        return $this->views;
    }

    public function setCreated(DateTime $created) : CommentEntity\Comment
    {
        $this->created = $created;
        return $this;
    }

    public function setDescription(string $message) : CommentEntity\Comment
    {
        $this->message = $message;
        return $this;
    }

    public function setCommentId(int $commentId) : CommentEntity\Comment
    {
        $this->commentId = $commentId;
        return $this;
    }

    public function setUserId(int $userId) : CommentEntity\Comment
    {
        $this->userId = $userId;
        return $this;
    }

    public function setViews(int $views) : CommentEntity\Comment
    {
        $this->views = $views;
        return $this;
    }
}

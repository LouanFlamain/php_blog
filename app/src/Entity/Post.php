<?php

namespace App\Entity;

class Post extends BaseEntity
{
    private int $id;
    private string $content;
    private string $user;
    private string $userType;
    private string $datetime;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Post
     */
    public function setId(int $id): Post
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Post
     */
    public function setContent(string $content): Post
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return int
     */
    public function getuser(): string
    {
        return $this->user;
    }

    /**
     * @param int $user
     * @return Post
     */
    public function setuser(string $user): Post
    {
        $this->user = $user;
        return $this;
    }
    public function getdate():string
    {
        return $this->datetime;
    }
    public function setdate(string $datetime):Post
    {
        $this->datetime = $datetime;
        return $this;
    }
    public function getuserType():string
    {
        return $this->userType;
    }
    public function setuserType(string $userType):Post
    {
        $this->userType = $userType;
        return $this;
    }
}

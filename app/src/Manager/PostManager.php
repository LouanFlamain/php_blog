<?php

namespace App\Manager;

use App\Entity\Post;
use DateTime;

class PostManager extends BaseManager
{
    /**
     * @return Post[]
     */
    public function getAllPosts(): array
    {
        $query = $this->pdo->query("SELECT * from Post");
        $posts = [];
        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $posts[] = new Post($data);
        }
        return $posts;
    }
    public function getMyPosts(string $user): array
    {
        $query = $this->pdo->query("SELECT * from Post WHERE user = '$user'");

        $posts = [];
        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $posts[] = new Post($data);
        }
        return $posts;
    }

    public function verifyUser(string $id): bool
    {
        $query = $this->pdo->prepare("SELECT user FROM Post WHERE id = :id");
        $query->bindValue('id', $id, \PDO::PARAM_STR);
        $query->execute();
        $data = $query->fetch(\PDO::FETCH_ASSOC);
        if($data['user'] === $_SESSION['user']){
            return true;
        }else{
            return false;
        }
    }
    public function verifyAdmin(string $id): bool
    {
        $query = $this->pdo->prepare("SELECT type FROM Post WHERE id = :id");
        $query->bindValue('id', $id, \PDO::PARAM_STR);
        $query->execute();
        $data = $query->fetch(\PDO::FETCH_ASSOC);
        if($data['type'] === 'admin'){
            return true;
        }else{
            return false;
        }
    }
    public function insertPost(Post $post)
    {
        $query = $this->pdo->prepare("INSERT INTO Post (content, user, userType, datetime) VALUES (:content, :user, :userType, :datetime)");
        $query->execute(array( 
            'content' => ($post->getContent()),
            'user' => ($post->getUser()),
            'userType' => ($post->getUserType()),
            'datetime' => ($post->getDate())
        ));
    }
    public function deletePost(string $id)
    {
        $query = $this->pdo->prepare('DELETE FROM Post WHERE id = :id');
        $query->execute(array(
            'id' => $id
        ));
    }
    public function updatePost(Post $post, string $id)
    {
        $date = new DateTime();
        $date = $date->format('d/m/Y H:i:s');
        $query = $this->pdo->prepare('UPDATE Post SET content = ?, user = ?, userType = ?, datetime = ? WHERE id = '.$id );
        $query->execute(array(
            $post->getContent(),
            $post->getUser(),
            $post->getUserType(),
            $post->getDate()
        ));
    }
}

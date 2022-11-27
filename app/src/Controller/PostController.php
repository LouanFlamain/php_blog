<?php

namespace App\Controller;

use App\Factory\PDOFactory;
use App\Entity\Post;
use App\Manager\PostManager;
use App\Route\Route;
use DateTime;

class PostController extends AbstractController
{
    #[Route('/update/{id}', name: "update", methods: ["GET"])]
    public function update($id)
    { 
        return $this->render("access/update.php", [
            "id" => $id
        ]);
    }
    #[Route('/addpost', name: "addpost", methods: ["POST"])]
    public function addpost()
    {
        $formContent = htmlspecialchars($_POST['content']);
        $postManager = new PostManager(new PDOFactory());
        $date = new DateTime();
        $date = $date->format('d/m/Y H:i:s');
        $newPost = new Post();
        $newPost->setContent($formContent);
        $newPost->setUser($_SESSION['user']);
        $newPost->setUserType($_SESSION['type']);
        $newPost->setDate($date);
        $postManager->insertPost($newPost);
        header('Location: /blog');

    }

    #[Route('/delete/{id}', name: "delete_post", methods: ["GET"])]
    public function deletePost($id)
    {
        $postManager = new PostManager((new PDOFactory()));
        if(!$postManager->verifyUser($id)){
            header('Location: /blog');
            exit;
        }
        $postManager->deletePost($id);
        header('Location: /blog');
    }
    #[Route('/setupdate/{id}', name: "set_update_post", methods: ["POST"])]
    public function setupdatePost($id)
    {
        $formContent = htmlspecialchars($_POST['content']);
        $postManager = new PostManager((new PDOFactory()));
        $date = new DateTime();
        $date = $date->format('d/m/Y H:i:s');

        if(!$postManager->verifyUser($id)){
            header('Location: /blog');
            exit;
        }
        $updatePost = new Post();
        $updatePost->setContent($formContent);
        $updatePost->setUser($_SESSION['user']);
        $updatePost->setUserType($_SESSION['type']);
        $updatePost->setDate($date);
        $postManager->updatePost($updatePost ,$id);
        header('Location: /blog');
    }
    
    
    #[Route('/blog', name: "blog", methods: ["GET"])]
    public function blog()
    {
        $manager = new PostManager(new PDOFactory());
        $posts = $manager->getAllPosts();
        //var_dump($posts);die;
        $this->render("users/blog.php", [
            "posts" => $posts
        ]);
    }
    #[Route('/mesarticles', name: "mesarticles", methods: ["GET"])]
    public function mesArticles()
    {
        $manager = new PostManager(new PDOFactory());
        $posts = $manager->getmyPosts($_SESSION['user']);
        //var_dump($posts);die;
        $this->render("users/mesArticles.php", [
            "posts" => $posts
        ]);
    }

    /**
     * @param $id
     * @param $truc
     * @param $machin
     * @return void
     */
    /*#[Route('/post/{id}/{truc}/{machin}', name: "francis", methods: ["GET"])]
    public function showOne($id, $truc, $machin)
    {
        var_dump($id, $truc);
    }*/
}

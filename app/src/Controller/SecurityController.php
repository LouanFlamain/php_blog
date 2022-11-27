<?php

namespace App\Controller;

use App\Factory\PDOFactory;
use App\Manager\UserManager;
use App\Manager\PostManager;
use App\Route\Route;
use App\Entity\User;
use stdClass;

class SecurityController extends AbstractController{
    #[Route('/', name: "redirect", methods: ["GET"])]
    public function redirect()
    { 
        session_destroy();
        header('Location: /login');
        exit;
        //return $this->render(view: "access/login.php");
    }
    
    #[Route('/userManagement', name: "login", methods: ["GET"])]
    public function userManagement()
    { 
        if($_SESSION['type'] !== 'admin'){
            header('Location: /blog');
        }
        return $this->render(view: "admin/userManagement.php");
    }
    #[Route('/user', name: "user", methods: ["POST"])]
    public function user()
    { 
        if($_SESSION['type'] !== 'admin'){
            header('Location: /blog');
        }
        $content = htmlspecialchars($_POST['user']);
        $userManager = new UserManager((new PDOFactory()));
        $result = $userManager->getUserId($content);
        header('Location:/ficheUser/'.$result);
    }
    #[Route('/ficheUser/{id}', name: "ficheUser", methods: ["GET"])]
    public function ficheUser($id)
    { 
        $manager = new UserManager(new PDOFactory());
        $users = $manager->getUserbyId($id);
        return $this->render("admin/ficheUser.php", [
            "users" => $users
        ]);
        //return $this->render(view: "admin/ficheUser.php");
    }

    #[Route('/deleteUser/{id}', name: "deleteUser", methods: ["GET"])]
    public function deleteUser($id)
    { 
        $userManager = new UserManager((new PDOFactory()));

        $userManager->deleteUser($id);
        header('Location: /blog');
    }

    #[Route('/login', name: "login", methods: ["GET"])]
        public function login()
        { 
            return $this->render(view: "access/login.php");
        }

    #[Route('/register', name: "register", methods: ["GET"])]
    public function register()
    {
        return $this->render(view: "access/register.php");
    }
    #[Route('/blog', name: "blog", methods: ["GET"])]
    public function blog()
    {
        return $this->render(view: "users/blog.php");
    }

    #[Route('/setlogin', name: "setlogin", methods: ["POST"])]
    public function setlogin()
    {
        $formUser = $_POST['user'];
        $formPassword = $_POST['password'];

        $userManager = new UserManager(new PDOFactory());

        $user = $userManager->getByUsername($formUser);
        if (!$user) {
            header("Location: /login?error=user_not_found");
            exit;
        }
        $formPasswordVerif = $user->passwordMatch($formPassword);
        if($formPasswordVerif){
            $type = $user->getTypeUser();
            $_SESSION['user'] = $formUser;
            $_SESSION['type'] = $type;
            header('Location: /blog');
        }else header('Location: /login?match=false');
        exit;

        /*if ($user->passwordMatch($formPassword)) {

            header('Location: /?error=logged');
            exit;

        }

        header("Location: /?error=notfound2");
        exit;*/
    }
    #[Route('/setregister', name: "setregister", methods: ["POST"])]
    public function setregister()
    {
        $formUser = htmlspecialchars($_POST['user']);
        $formPassword = htmlspecialchars($_POST['password']);
        $formPasswordVerif = htmlspecialchars($_POST['verifpassword']);

        $userManager = new UserManager(new PDOFactory());
        if($userManager->verifyUser($formUser)){
            header('Location: /register?error=user_exist');
            exit;
        }

        if(strlen($formUser) > 30){
            header('Location: /register?error=userNameStr');
            exit;
        }
        if($formPassword !== $formPasswordVerif){
            header("Location: /register?error=passwordDiff");
            exit;
        }

        $newUser = new User();
        $newUser->setUser($formUser);
        $newUser->setPassword($newUser->hashPassword($formPassword));

        $userManager->insertUser($newUser);


        /*$insert = $this->pdo->prepare('INSERT INTO User(user, password, type) VALUES(:user, :password, :type)');
        $insert->execute(array(
            'user' => $user,
            'password' => $password,
            'type' => 'user'
        ));*/
        header('Location: /login?error=logged');
    }
    #[Route('/disconnect', name: "disconnect", methods: ["GET"])]
    public function disconnect()
    {
        session_destroy();
        header('Location: /login');
    }
}

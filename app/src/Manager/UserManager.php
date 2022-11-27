<?php

namespace App\Manager;

use App\Entity\User;

class UserManager extends BaseManager
{

    /**
     * @return User[]
     * 
     * 
     */

    public function getAllUsers(): array
    {
        $query = $this->pdo->query("select * from User");

        $users = [];

        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $users[] = new User($data);
        }

        return $users;
    }
    public function verifyAdmin(string $id): bool
    {
        $query = $this->pdo->prepare("SELECT type FROM User WHERE id = :id");
        $query->bindValue('id', $id, \PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetch(\PDO::FETCH_ASSOC);
        var_dump($data); die;
        if($data['type'] === 'admin'){
            return true;
        }else{
            return false;
        }
    }
    public function verifyUser(string $user): bool
    {
        var_dump($user);
        $query = $this->pdo->prepare("SELECT * FROM User WHERE user = :user");
        $query->bindValue('user', $user, \PDO::PARAM_STR);
        $query->execute();
        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if($data){
            return true;
        }else{
            return false;
        }
    }

    public function getByUsername(string $username): ?User
    {
        $query = $this->pdo->prepare("SELECT * FROM User WHERE user = :user");
        $query->bindValue("user", $username, \PDO::PARAM_STR);
        $query->execute();
        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if ($data) {
            return new User($data);
        }

        return null;
    }
    public function getUserbyId(string $id): array
    {

        $query = $this->pdo->prepare("SELECT id, user, type FROM User WHERE id = :id");
        $query->bindValue("id", $id, \PDO::PARAM_STR);
        $query->execute();
        $users = [];
        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $users[] = new User($data);
        }
        return $users;

    }
    public function getUserId(string $username): ?int
    {
        $query = $this->pdo->prepare("SELECT id FROM User WHERE user = :user");
        $query->bindValue("user", $username, \PDO::PARAM_STR);
        $query->execute();
        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if ($data) {
            return $data['id'];
        }

        return null;
    }
    

    public function insertUser(User $user)
    {
        $query = $this->pdo->prepare("INSERT INTO User (user, password, type) VALUES (:user, :password, :type)");
        //$query->bindValue("user", $user->getUsername(), \PDO::PARAM_STR);
        //$query->bindValue("password", $user->getPassword(), \PDO::PARAM_STR);
        //$query->bindValue('type', $user->getType(), \PDO::PARAM_STR);
        //$query->execute();
        $query->execute(array( 
            'user' => ($user->getUser()),
            'password' => ($user->getPassword()),
            'type' => ($user->getType())
        ));
    }
    public function deleteUser(string $id)
    {
        $query = $this->pdo->prepare('DELETE FROM User WHERE id = :id');
        $query->execute(array(
            'id' => $id
        ));
    }
}

<?php

namespace App\Repository;

use App\Model\User;
use Config\RepositoryBase;
use PDO;

class UserRepository extends RepositoryBase
{
    public function getUser(array $args): ?User {
        $sql = $this->getBDD()->prepare("SELECT * FROM users WHERE " . $this->generateWhere($args));
        $this->bindParams($sql, $args);
        $sql->execute();

        if($sql->rowCount() == 1) {
            $sql->setFetchMode(PDO::FETCH_CLASS, User::class);
            foreach($sql as $user) {
                return $user;
            }
        }
        return NULL;
    }

    public function getUsers(array $args): ?array
    {
        $sql = $this->getBDD()->prepare("SELECT * FROM users WHERE " . $this->generateWhere($args));
        $this->bindParams($sql, $args);
        $sql->execute();

        if($sql->rowCount() == 1) {
            return $sql->fetchAll(PDO::FETCH_CLASS, User::class);
        }
        return null;
    }

    public function createUser(string $name, string $surname, string $email, string $psw, int $isAdmin, int $isEmploye): bool {
        $sql = $this->getBDD()->prepare("INSERT INTO users (name, surname, email, password, isAdmin, isEmploye) VALUES(?, ?, ?, ?, ?, ?)");
        $sql->execute([$name, $surname, $email, $psw, $isAdmin, $isEmploye]);
        return true;
    }

    public function updateUser(User $user): bool {
        $sql = $this->getBDD()->prepare("UPDATE users SET name = :name, surname = :surname, email = :email, password = :password, isAdmin = :isAdmin, isEmploye = :isEmploye WHERE id = :id");
        $name = $user->getName();
        $sql->bindParam("name", $name);
        $surname = $user->getSurname();
        $sql->bindParam("surname", $surname);
        $email = $user->getEmail();
        $sql->bindParam("email", $email);
        $password = $user->getPassword();
        $sql->bindParam("password", $password);
        $isAdmin = $user->getIsAdmin();
        $sql->bindParam("isAdmin", $isAdmin);
        $isEmploye = $user->getIsEmploye();
        $sql->bindParam("isEmploye", $isEmploye);
        $id = $user->getId();
        $sql->bindParam("id", $id);
        $sql->execute();
        return true;
    }

    public function deleteUser(User $user): bool {
        $sql = $this->getBDD()->prepare("DELETE FROM users WHERE id = :id");
        $id = $user->getId();
        $sql->bindParam("id", $id);
        $sql->execute();
        return true;
    }

    public function generatePassword(): string {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = [];
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }
}
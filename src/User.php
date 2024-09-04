<?php

declare(strict_types=1);

namespace App;

use PDO;

class User
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Db::connect();
    }

    public function createUser(
        string $username,
        string $position,
        string $gender,
        string $phone,
        string $email,
        string $password
    ): bool {
        $query = "INSERT INTO users (username, position, gender, phone, created_at, email, password)
                  VALUES (:username, :position, :gender, :phone, NOW(), :email, :password)";
        $stmt  = $this->pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':position', $position);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        return $stmt->execute();
    }

    public function getUser(int $id)
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt  = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUsers()
    {
        $query = "SELECT * FROM users";
        $stmt  = $this->pdo->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByUsername(string $username){
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function checkUser(string $email, string $password)
    {
        $query = "SELECT * FROM users WHERE email = :email AND password = :password";
        $stmt  = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['user'] = [
                'email' => $user['email'],
                'id' => $user['id'],
            ];

            unset($_SESSION['message']['error']);
            header('Location: /');
            exit();
        }

        $_SESSION['message']['error'] = "Wrong email or password";
        header('Location: /login');
        return $user;
    }

    public function updateUser(
        int    $id,
        string $username,
        string $position,
        string $gender,
        string $phone
    ): void {
        $query = "UPDATE users SET username = :username, position = :position, gender = :gender, phone = :phone, updated_at = NOW()
                  WHERE id = :id";
        $stmt  = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':position', $position);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();
    }

    public function deleteUser(int $id): void
    {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt  = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}

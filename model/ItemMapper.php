<?php

//require_once 'Item.php';
require_once __DIR__.'/../Database.php';

class ItemMapper
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

//    public function get(
//        string $email
//    ):User {
//        try {
//            $stmt = $this->database->connect()->prepare('SELECT * FROM users WHERE email = :email;');
//            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
//            $stmt->execute();
//
//            $user = $stmt->fetch(PDO::FETCH_ASSOC);
//            return new User($user['name'], $user['surname'], $user['email'], $user['password']);
//        }
//        catch(PDOException $e) {
//            return 'Error: ' . $e->getMessage();
//        }
//    }

    public function getItems()
    {
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM items;');
            $stmt->execute();

            $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //  echo $items;
            return $items;
        }
        catch(PDOException $e) {
            die();
        }
    }

//    public function addUser(
//        string $name, string $surname, string $email, string $password
//    ) {
//        try {
//            $stmt = $this->database->connect()->prepare('INSERT INTO users (email, password, name, surname, id_role) VALUES (:email, :password, :name, :surname, 1);');
//            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
//            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
//            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
//            $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
//            $stmt->execute();
//            $user = $stmt->fetch(PDO::FETCH_ASSOC);
//            return 'User registered!';
//        }
//        catch(PDOException $e) {
//            return 'Error: ' . $e->getMessage();
//        }
//    }

    public function delete(int $id): void
    {
        try {
            console.log($id);
            $stmt = $this->database->connect()->prepare('DELETE FROM items WHERE id_item = :id;');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        }
        catch(PDOException $e) {
            die();
        }
    }
}
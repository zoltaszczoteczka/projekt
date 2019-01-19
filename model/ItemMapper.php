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



    public function addItem(
        string $name, int $price
    ) {
        try {
            $stmt = $this->database->connect()->prepare('INSERT INTO items (name, price) VALUES (:name, :price);');
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':price', $price, PDO::PARAM_INT);
            $stmt->execute();
            $items = $stmt->fetch(PDO::FETCH_ASSOC);
            return 'Item added';
        }
        catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
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
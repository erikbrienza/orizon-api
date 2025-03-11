<?php

require_once '../app/config/database.php';

class Country
{
    public static function getAll()
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM countries");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getById($id)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM countries WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public static function create($name)
    {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO countries (name) VALUES (?)");
        $stmt->bind_param("s", $name);
        $stmt->execute();
    }

    public static function update($id, $name)
    {
        global $conn;
        $stmt = $conn->prepare("UPDATE countries SET name = ? WHERE id = ?");
        $stmt->bind_param("si", $name, $id);
        $stmt->execute();
    }

    public static function delete($id)
    {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM countries WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
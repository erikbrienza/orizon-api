<?php

require_once '../app/config/database.php';

class Trip
{
    public static function getAll()
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM trips");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getById($id)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM trips WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public static function create($country_id, $seats_available)
    {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO trips (country_id, seats_available) VALUES (?, ?)");
        $stmt->bind_param("ii", $country_id, $seats_available);
        $stmt->execute();
    }

    public static function update($id, $country_id, $seats_available)
    {
        global $conn;
        $stmt = $conn->prepare("UPDATE trips SET country_id = ?, seats_available = ? WHERE id = ?");
        $stmt->bind_param("iii", $country_id, $seats_available, $id);
        $stmt->execute();
    }

    public static function delete($id)
    {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM trips WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
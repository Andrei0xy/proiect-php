<?php

class Artist {
    public static function getAllArtists() {
        global $pdo;
        $sql = "SELECT * 
                FROM artists";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>
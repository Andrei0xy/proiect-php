<?php
class Song{
    public static function getAllSongs() {
        global $pdo;
        $sql = "SELECT * 
                FROM songs";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getSong($song_id) {
        global $pdo;

        $sql = "SELECT * 
                FROM songs 
                WHERE id = :song_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(":song_id" => $song_id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function editSong($song_id, $name, $length){
        global $pdo;
        $sql = "UPDATE songs
                SET name = :name,length = :length
                where id = :song_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(":song_id"=>$song_id,":name"=>$name,":length"=>$length));
    }

    public static function createSong($name,$length,$album_id){
        global $pdo;
        $sql = "INSERT INTO songs (name, album_id, length) 
                VALUES (:name,:album_id,:length)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(":name"=>$name,":album_id"=>$album_id,":length"=>$length));
    }

    public static function deleteSong($song_id){
        global $pdo;
        $sql = "DELETE FROM songs
                WHERE id=:song_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([":song_id"=>$song_id]);
    }
}

class UserRole {
    public static function getAllRoles() {
        global $pdo;
        $sql = "SELECT * 
                FROM user_roles";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getRole($role_id) {
        global $pdo;

        $sql = "SELECT *
                FROM user_roles 
                WHERE id = :role_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(":role_id" => $role_id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
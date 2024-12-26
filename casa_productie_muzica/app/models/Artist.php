<?php

class Artist {
    public static function getAllArtists() {
        global $pdo;
        $sql = "SELECT * 
                FROM artists";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getArtist($artist_id) {
        global $pdo;

        $sql = "SELECT * 
                FROM artists 
                WHERE id = :artist_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(":artist_id" => $artist_id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public static function editArtist($artist_id, $name, $join_date, $origin, $description){
        global $pdo;
        // if(empty($artist_id) || empty($name) || empty($join_date) || empty($origin) || empty($description)){
        //     $errorMessage="All the fields are required ";
        //     $_SESSION['error'] = $errorMessage;
        //     return $_SESSION['error'];
        // }
        // else{
        $sql = "UPDATE artists
                SET name = :name,join_date = :join_date,origin = :origin,description = :description
                where id = :artist_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(":artist_id"=>$artist_id,":name"=>$name,":join_date"=>$join_date,":origin"=>$origin,":description"=>$description));
    }

    public static function createArtist($name,$join_date,$origin,$description){
        global $pdo;
        // if(empty($name) || empty($join_date) || empty($origin) || empty($description)){
        //     $errorMessage="All the fields are required ";
        //     $_SESSION['error'] = $errorMessage;
        //     return $_SESSION['error'];
        // }
        $sql = "INSERT INTO artists (name, join_date, origin, description) 
                VALUES (:name,:join_date,:origin,:description)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(":name"=>$name,":join_date"=>$join_date,":origin"=>$origin,":description"=>$description));
        // $successMessage="Artist added successfully";
        // return $successMessage;
        
        
    }
    public static function deleteArtist($artist_id){
        global $pdo;
        $sql = "DELETE FROM artists
                WHERE id=:artist_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([":artist_id"=>$artist_id]);
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
<?php

class Album{
    public static function getAllAlbums() {
        global $pdo;
        $sql = "SELECT * 
                FROM albums";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getAlbum($album_id) {
        global $pdo;

        $sql = "SELECT * 
                FROM albums 
                WHERE id = :album_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(":album_id" => $album_id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getAlbumsSongs($album_id){
        global $pdo;
        $sql = "SELECT *
                FROM songs
                WHERE album_id = :album_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(":album_id" => $album_id));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function editAlbum($album_id, $name, $release_date, $price, $genre, $stoc, $image){
        global $pdo;
        $sql = "UPDATE albums
                SET name = :name,release_date = :release_date,price = :price,genre = :genre,stoc = :stoc,image = :image
                where id = :album_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(":album_id"=>$album_id,":name"=>$name,":release_date"=>$release_date,":price"=>$price,":genre"=>$genre,":stoc"=>$stoc,":image"=>$image));
    }

    public static function createAlbum($name, $release_date, $price, $genre, $stoc, $artist_id, $image){
        global $pdo;
        $sql = "INSERT INTO albums (name, release_date, price, genre, stoc, artist_id,image) 
                VALUES (:name,:release_date,:price,:genre,:stoc,:artist_id,:image)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(":name"=>$name,":release_date"=>$release_date,":price"=>$price,":genre"=>$genre,":stoc"=>$stoc,":artist_id"=>$artist_id,":image"=>$image));
    }

    public static function deleteAlbum($album_id){
        global $pdo;
        $sql = "DELETE FROM albums
                WHERE id=:album_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([":album_id"=>$album_id]);
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
class ArtistName{
    public static function getAllArtists() {
        global $pdo;
        $sql = "SELECT * 
                FROM artists";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
<?php
require_once "app/models/Artist.php";

class ArtistController{
    public static function index() {

        $artists = Artist::getAllArtists();
        require_once "app/views/artists/index.php";
    }

    // public static function show() {
    //     $user_id = $_GET['user_id'];
    //     $user = User::getUser($user_id);

    //     if ($user) {
    //         require_once "app/views/users/show.php";
    //     } else {
    //         $_SESSION['error'] = "User not found";
    //         require_once "app/views/404.php";
    //     }

    // }
}
?>
<?php
require_once "app/models/Song.php";

class SongController{

    public static function index() {

        $songs = Song::getAllSongs();
        require_once "app/views/songs/index.php";
    }
    public static function show() {
        $song_id = $_GET['id'];
        $song = Song::getSong($song_id);

        if ($song) {
            require_once "app/views/songs/show.php";
        } else {
            $_SESSION['error'] = "Song not found";
            require_once "app/views/404.php";
        }
    }

    static function check_role(){
        $role = UserRole::getRole($_SESSION["request_user"]["role_id"]);
        if ($role["name"] != "admin"){
            $_SESSION["error"]= "Invalid permissions";
            require_once "app/views/404_page.php";
            return 0;
        }
        return 1;
    } 

    static function validate(){
        $errors=[];
        $len_name=strlen($_POST['name']);
        $string=preg_replace('/\s+/','',$_POST['name']);
        
        if (($len_name < 1 || $len_name > 50) || $string=='') {
            $errors['name_error'] = 'Album name must be between 1 and 40 characters';  
        }
        if(empty($_POST['length'])){
            $errors['length_error'] = 'Field required';
        }
        if(!is_numeric($_POST['length'])){
            $errors['length_error'] = 'Invalid value';
        }

        return $errors;
    }

    public static function edit() {
        $song_id = $_GET['id'] ? $_GET['id'] : $_POST['id'];
        // $user_id=$_SESSION["request_user"]["id"];
        // echo $user_id;
        $role = UserRole::getRole($_SESSION["request_user"]["role_id"]);
        if ($role["name"] != "admin" && $role["name"] != "user"){
            $_SESSION["error"]= "Invalid permissions";
            require_once "app/views/404_page.php";
            return ;
        }
        $song = Song::getSong($song_id);

        if(!$song){
            $_SESSION['error'] = "Song not found";
            require_once "app/views/404_page.php";
            return;
        }

        if(isset($_POST['id'])){
            $_SESSION["edit_song"]=[];

            $errors=self::validate();

            if(count($errors)>0){
                $_SESSION["edit_song"]=$errors;
                header("Location: edit?id=".$_POST['id']);
                return;
            }
            
            Song::editSong($song_id,htmlentities($_POST['name']),htmlentities($_POST['length']));
            // echo $_POST['id'];
            $_SESSION['success'] = 'Record updated';
            header("Location: edit?id=".$_POST['id']);
            return;
            }
        else{
            require_once "app/views/songs/edit.php";
        }
    }

    public static function create(){
        if(!self::check_role()){
            return ;
        }
        $album_id=$_SESSION["id_album"];

        if(isset($_POST["song_post"])){
            $_SESSION["create_song"]["song"] = $_POST;
            $errors=self::validate();

            if(count($errors)>0){
                $_SESSION["create_song"]["errors"]=$errors;
                header("Location: create");
                return;
            }
            

            Song::createSong(htmlentities($_POST["name"]),htmlentities($_POST["length"]),$_SESSION["id_album"]);
            header("Location: index?id=$album_id");
        }
        if (!isset($_SESSION["create_song"]["song"])){
            $_SESSION["create_song"]["song"] = [
                "name" => "",
                "length" => ""
            ];
        }
        
        require_once "app/views/songs/create.php";
    }

    public static function delete(){
        if(!self::check_role()){
            return ;
        }
        $song_id = $_GET['id'];
        $song=Song::getSong($song_id);
        $album_id=$song["album_id"];
        require_once "app/views/songs/delete.php";
        if(isset($_POST["cancel"])){
            header("location: /casa_productie_muzica/songs/index?id=$album_id");
            exit;
        }
        if(isset($_POST["delete"])){
            Song::deleteSong($song_id);
            header("location: /casa_productie_muzica/songs/index?id=$album_id");
            exit;
        }
    }
}

?>
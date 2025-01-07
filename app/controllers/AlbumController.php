<?php
require_once "app/models/Album.php";

class AlbumController{
    public static function index() {

        $albums = Album::getAllAlbums();
        require_once "app/views/albums/index.php";
    }
    public static function show() {
        $album_id = $_GET['id'];
        $album = Album::getAlbum($album_id);

        if ($album) {
            require_once "app/views/albums/show.php";
            // echo $album["artist_id"];
        } else {
            $_SESSION['error'] = "Album not found";
            require_once "app/views/404.php";
        }
    }

    public static function showsongs(){
        $album_id = $_GET['id'];
        $_SESSION["id_album"]=$album_id;
        $songs=Album::getAlbumsSongs($album_id);
        require_once "app/views/songs/index.php";
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
        if(empty(preg_replace('/\s+/','',$_POST['release_date'])) || strpos($_POST['release_date'],'-')===false || strpos($_POST['release_date'],'-',strpos($_POST['release_date'],'-')+1)===false){
            $errors['date_error'] = 'Field required';
        }
        if(empty($_POST['price'])){
            $errors['price_error'] = 'Field required';
        }
        if(!is_numeric($_POST['price'])){
            $errors['price_error'] = 'Invalid value';
        }
        if(!is_numeric($_POST['stoc'])){
            $errors['stoc_error'] = 'Invalid value';
        }

        return $errors;
    }

    public static function upload(){
        $file=$_FILES['file'];
        $fileName=$_FILES['file']['name'];
        $fileTmpName=$_FILES['file']['tmp_name'];
        $fileSize=$_FILES['file']['size'];
        $fileError=$_FILES['file']['error'];
        $fileType=$_FILES['file']['type'];

        $fileExt=explode('.', $fileName);
        $fileActualExt=strtolower(end($fileExt));
        $allowed=array('jpg', 'jpeg', 'png');

        if(in_array($fileActualExt,$allowed)){
            if($fileError === 0){
                if($fileSize<5000000){
                    $fileNameNew=preg_replace('/\s+/','',$_POST['name']).".".$fileActualExt;
                    $fileDestination='/xampp/htdocs/casa_productie_muzica/files/'.$fileNameNew;
                    $fileDestination2='/casa_productie_muzica/files/'.$fileNameNew;
                    move_uploaded_file($fileTmpName,$fileDestination);
                    return $fileDestination2;
                }else{
                    return 0;
                }
            }else{
                return 0;
            }
        }
        else{
            return 0;
        }
    }

    public static function edit() {
        $album_id = $_GET['id'] ? $_GET['id'] : $_POST['id'];
        // $user_id=$_SESSION["request_user"]["id"];
        // echo $user_id;
        $role = UserRole::getRole($_SESSION["request_user"]["role_id"]);
        if ($role["name"] != "admin" && $role["name"] != "user"){
            $_SESSION["error"]= "Invalid permissions";
            require_once "app/views/404_page.php";
            return ;
        }
        $album = Album::getAlbum($album_id);

        if(!$album){
            $_SESSION['error'] = "Album not found";
            require_once "app/views/404_page.php";
            return;
        }

        if(isset($_POST['id'])){
            $_SESSION["edit_album"]=[];

            $errors=self::validate();

            if(count($errors)>0){
                $_SESSION["edit_album"]=$errors;
                header("Location: edit?id=".$_POST['id']);
                return;
            }else{
                $resfile=self::upload();
                // echo $resfile;
                if($resfile == 0){
                    $_SESSION["edit_album"]['file_error']='There was a problem uploading your file';
                    header("Location: edit?id=".$_POST['id']);
                    return;
                }
            }
            
            Album::editAlbum($album_id,htmlentities($_POST['name']),htmlentities($_POST['release_date']),htmlentities($_POST['price']),htmlentities($_POST['genre']),htmlentities($_POST['stoc']),htmlentities($resfile));
            // echo $_POST['id'];
            $_SESSION['success'] = 'Record updated';
            header("Location: edit?id=".$_POST['id']);
            return;
            }
        else{
            require_once "app/views/albums/edit.php";
        }
    }


    public static function create(){
        if(!self::check_role()){
            return ;
        }

        if(isset($_POST["album_post"])){
            $_SESSION["create_album"]["album"] = $_POST;
            $errors=self::validate();

            if(count($errors)>0){
                $_SESSION["create_album"]["errors"]=$errors;
                header("Location: create");
                return;
            } else{
                $resfile=self::upload();
                // echo $resfile;
                if($resfile == 0){
                    $_SESSION["create_album"]["errors"]['file_error']='There was a problem uploading your file';
                    header("Location: create");
                    return;
                }
            }

            Album::createAlbum(htmlentities($_POST["name"]),htmlentities($_POST["release_date"]),htmlentities($_POST["price"]),htmlentities($_POST["genre"]),htmlentities($_POST["stoc"]),htmlentities($_POST["artist_id"]),htmlentities($resfile));
            header("Location: index");
        }
        if (!isset($_SESSION["create_album"]["album"])){
            $_SESSION["create_album"]["album"] = [
                "name" => "",
                "release_date" => "",
                "price" => "",
                "genre" => "",
                "stoc" => ""
            ];
        }
        $artists=ArtistName::getAllArtists();
        require_once "app/views/albums/create.php";
    }

    public static function delete(){
        if(!self::check_role()){
            return ;
        }
        $album_id = $_GET['id'];
        require_once "app/views/albums/delete.php";
        if(isset($_POST["cancel"])){
            header("location: /casa_productie_muzica/albums/index");
            exit;
        }
        if(isset($_POST["delete"])){
            Album::deleteAlbum($album_id);
            header("location: /casa_productie_muzica/albums/index");
            exit;
        }
    }
}

?>
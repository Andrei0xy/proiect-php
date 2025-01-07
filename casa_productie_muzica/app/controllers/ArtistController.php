<?php
require_once "app/models/Artist.php";

class ArtistController{
    public static function index() {

        $artists = Artist::getAllArtists();
        $create_permission = (
            isset($_SESSION["request_user"])  &&
            UserRole::getRole($_SESSION["request_user"]["role_id"])["name"]=="admin"
        );
        require_once "app/views/artists/index.php";
    }
    public static function show() {
        $artist_id = $_GET['id'];
        $artist = Artist::getArtist($artist_id);

        if ($artist) {
            require_once "app/views/artists/show.php";
        } else {
            $_SESSION['error'] = "Artist not found";
            require_once "app/views/404.php";
        }
    }

    public static function showfor(){
        $artist_id = $_GET['id'];
        $albums=Artist::getArtsitsAlbums($artist_id);
        require_once "app/views/albums/showfor.php";
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
        $date = date('Y-m-d');
        $string=preg_replace('/\s+/','',$_POST['name']);
        
        if (($len_name < 1 || $len_name > 40) || $string=='') {
            $errors['name_error'] = 'Name must be between 1 and 40 characters';  
        }
        if(empty(preg_replace('/\s+/','',$_POST['join_date'])) || strpos($_POST['join_date'],'-')===false || strpos($_POST['join_date'],'-',strpos($_POST['join_date'],'-')+1)===false){
            $errors['date_error'] = 'Field required';
        }
        else if ($_POST['join_date'] > $date){
            $errors['date_error'] = 'Date can not take this value';
        }
        if(empty($_POST['origin'])){
            $errors['origin_error'] = 'Field required';
        }

        return $errors;
    }

    public static function edit() {
        $artist_id = $_GET['id'] ? $_GET['id'] : $_POST['id'];
        // $user_id=$_SESSION["request_user"]["id"];
        // echo $user_id;
        $role = UserRole::getRole($_SESSION["request_user"]["role_id"]);
        if ($role["name"] != "admin" && $role["name"] != "user"){
            $_SESSION["error"]= "Invalid permissions";
            require_once "app/views/404_page.php";
            return ;
        }
        $artist = Artist::getArtist($artist_id);

        if(!$artist){
            $_SESSION['error'] = "Artist not found";
            require_once "app/views/404_page.php";
            return;
        }

        if(isset($_POST['id'])){
            $_SESSION["edit_artist"]=[];

            $errors=self::validate();

            if(count($errors)>0){
                $_SESSION["edit_artist"]=$errors;
                header("Location: edit?id=".$_POST['id']);
                return;
            }
            
            Artist::editArtist($artist_id,htmlentities($_POST['name']),htmlentities($_POST['join_date']),htmlentities($_POST['origin']),htmlentities($_POST['description']));
            // echo $_POST['id'];
            $_SESSION['success'] = 'Record updated';
            header("Location: edit?id=".$_POST['id']);
            return;
            }
        else{
            require_once "app/views/artists/edit.php";
        }
    }

    public static function upload(){
        $file=$_FILES['file'];
        // var_dump($file);
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
                    // $errors['3']='Your file is too big';
                    return 0;
                }
            }else{
                // $errors['2']='There was a problem uploading your file';
                return 0;
            }
        }
        else{
            // $errors['1']='You can not upload files of this type';
            return 0;
        }
    }

    public static function create(){
        if(!self::check_role()){
            return ;
        }

        if(isset($_POST["artist_post"])){
            $_SESSION["create_artist"]["artist"] = $_POST;
            $errors=self::validate();

            if(count($errors)>0){
                $_SESSION["create_artist"]["errors"]=$errors;
                header("Location: create");
                return;
            }
            else{
                $resfile=self::upload();
                // echo $resfile;
                if($resfile == 0){
                    $_SESSION["create_artist"]["errors"]['file_error']='There was a problem uploading your file';
                    header("Location: create");
                    return;
                }
            }

            Artist::createArtist(htmlentities($_POST["name"]),htmlentities($_POST["join_date"]),htmlentities($_POST["origin"]),htmlentities($_POST["description"]),htmlentities($resfile));
            header("Location: index");
        }
        if (!isset($_SESSION["create_artist"]["artist"])){
            $_SESSION["create_artist"]["artist"] = [
                "name" => "",
                "join_date" => "",
                "origin" => "",
                "description" => ""
            ];
        }
        require_once "app/views/artists/create.php";
    }

    public static function delete(){
        if(!self::check_role()){
            return ;
        }
        $artist_id = $_GET['id'];
        // $artist = Artist::getArtist($artist_id);
        require_once "app/views/artists/delete.php";
        if(isset($_POST["cancel"])){
            header("location: /casa_productie_muzica/artists/index");
            exit;
        }
        if(isset($_POST["delete"])){
            $delArtist = Artist::deleteArtist($artist_id);
            echo $delArtist;
            header("location: /casa_productie_muzica/artists/index");
            exit;
        }
    }
}

?>
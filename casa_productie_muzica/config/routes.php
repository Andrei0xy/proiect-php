<?php
$routes = [
    "casa_productie_muzica/users/index" => ["UserController", "index"],
    "casa_productie_muzica/users/edit" => ["UserController", "edit"],
    "casa_productie_muzica/users/create" => ["UserController", "create"],
    "casa_productie_muzica/users/show" => ["UserController", "show"],
    "casa_productie_muzica/users/delete" => ["UserController", "delete"],
    "casa_productie_muzica/users/export_excel" => ["UserController", "excel_export"],
    "casa_productie_muzica/users/export_word" => ["UserController", "word_export"],
    "casa_productie_muzica/users/export_pdf" => ["UserController", "pdf_export"],

    "casa_productie_muzica/artists/index" => ["ArtistController", "index"],
    "casa_productie_muzica/artists/show" => ["ArtistController", "show"],
    "casa_productie_muzica/artists/edit" => ["ArtistController", "edit"],
    "casa_productie_muzica/artists/create" => ["ArtistController", "create"],
    "casa_productie_muzica/artists/delete" => ["ArtistController", "delete"],

    "casa_productie_muzica/albums/index" => ["AlbumController", "index"],
    "casa_productie_muzica/albums/show" => ["AlbumController", "show"],
    "casa_productie_muzica/albums/edit" => ["AlbumController", "edit"],
    "casa_productie_muzica/albums/create" => ["AlbumController", "create"],
    "casa_productie_muzica/albums/showfor" => ["ArtistController", "showfor"],
    "casa_productie_muzica/albums/delete" => ["AlbumController", "delete"],

    "casa_productie_muzica/songs/index" => ["AlbumController", "showsongs"],
    "casa_productie_muzica/songs/edit" => ["SongController", "edit"],
    "casa_productie_muzica/songs/delete" => ["SongController", "delete"],
    "casa_productie_muzica/songs/create" => ["SongController", "create"],

    "casa_productie_muzica/authentification/login" => ["loginController", "log"],
    "casa_productie_muzica/authentification/signup" => ["loginController", "signup"],
    "casa_productie_muzica/authentification/logout" => ["loginController", "logout"],
    "casa_productie_muzica/authentification/signupsuccess" => ["loginController", "success"],

    "casa_productie_muzica/contact/email" => ["ContactController", "email"],
    "casa_productie_muzica" => ["loginController", "home_page"]
];

class Router {
    private $uri;

    public function __construct() {
        // Get the current URI
        $this->uri = trim(parse_url($_SERVER["REQUEST_URI"],PHP_URL_PATH), "/");
    }

    public function direct() {
        global $routes;
        //echo $_GET['id'];
        //echo $this->uri;
        //echo $routes[$this->uri];
        //unset($_SESSION['user_id']);
        if (array_key_exists($this->uri, $routes)) {

            // Get the controller and method
            [$controller, $method] = $routes[$this->uri];

            // Load the controller file if it hasn't been autoloaded
            require_once "app/controllers/{$controller}.php";

            // Call the method
            return $controller::$method();
        }
        // else if (!isset($_SESSION['user_id'])) {
        //     [$controller, $method] = ["login","log"];
        //     require_once "app/controllers/{$controller}.php";
        //     return $controller::$method();
        // }
        // else{
        //     header("Location: /casa_productie_muzica/artists/index");
        // }
        // if($this->uri == "casa_productie_muzica/index")
        //     require_once "app/views/home.php";
        require_once "app/views/404_page.php";
    }
}

?>
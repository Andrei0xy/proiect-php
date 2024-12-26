<?php
require_once "config/routes.php";
require_once "config/pdo.php"; 

// Start the session (optional, if using sessions)
session_start();
session_regenerate_id(true);

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
if(empty($_SESSION['token_expire'])){
    $_SESSION['token_expire']=time() + 3600;
}

// Initialize the router and route the request
$router = new Router();
$router->direct();
?>
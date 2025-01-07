<?php
require_once "config/routes.php";
require_once "config/pdo.php"; 

// Start the session (optional, if using sessions)
session_start();
function regenerate_session_id(){
    session_regenerate_id();
    $_SESSION['last_regeneration']=time();
}
if(!isset($_SESSION['last_regeneration'])){
    regenerate_session_id();
}else{
    $interval=60*30;
    if(time()-$_SESSION['last_regeneration']>=$interval){
        regenerate_session_id();
    }
}


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
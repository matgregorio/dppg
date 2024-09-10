<?php
    require_once '../Simposio/core/router.php';
    
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    var_dump($url);

    Router::route($url);
?>
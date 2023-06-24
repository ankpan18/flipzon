<?php 
function redirect_to($url)
{
    header("Location: $url");
    exit;
}
function print_get_attr($attr){
    if (isset($_GET[$attr])) echo $_GET[$attr];
}

$roles=array(
    "user" => "user",
    "seller" => "seller",
    "admin" => "admin"
    )



?>
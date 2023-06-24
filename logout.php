<?php require_once("helper.php") ?>
<?php

session_start();
session_destroy();
redirect_to("index.php");

?>
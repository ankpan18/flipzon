<?php

// $che=false;
//function to return conn 

// $server = "localhost";
$server = "127.0.0.1";
$username = "root";
$password = "";
$database = "Flipzon";

$conn = new mysqli($server, $username, $password, $database);

$conn->autocommit(true);
// if ($conn -> connect_errno) {
//     echo "##############################################";
//     echo "Failed to connect to MySQL: " . $conn -> connect_error;
//     exit();
//   }
 if (!$conn){

     die("Error". mysqli_connect_error());
 }

// function run_query($query){
//     global $conn;
//     $result=$conn->query($query);
//     if($result==null) die("error in query :\t".$query);
//     return $result;
// }

function input_filter($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}
function run_query_no_args($query){
    global $conn;
    $result=$conn->query($query);
    if($result==null) die("error in query :\t".$query);
    return $result;
}

function run_query($query,$signature,$values){
    global $conn;

    // global input_filter;

    $count = count($values);
    $keys = array_keys($values);
    
    for($i = 0; $i < $count; $i++) {
        
        $values[$keys[$i]]=input_filter($values[$keys[$i]]);
        $values[$keys[$i]]=$conn -> real_escape_string($values[$keys[$i]]);
    }
    
    // print_r($values);

    if(($stmt = $conn->prepare($query))==null)  die("Error in query:\t".$query);
    
    call_user_func_array(array($stmt, "bind_param"), array_merge(array($signature), $values));
    // $stmt->bind_param($signature, $value1,$value2,$value3);

    if(!$stmt->execute())    die("Error while inserting values in query:\t".$query);
    $result = $stmt->get_result();
    $stmt->close();

    return $result;
}
// $values="panthriankur1@gmail.com";
// $params = array(&$values);
// $result=run_query("select `email`,`password` from `user` where `email`=?;","s",$params);

// $row=$result->fetch_assoc();
// if ($row==null)
//     echo("no rows");
// print_r($row);
// run_query("select `email` from `user`;","s",$values,$values);


?>

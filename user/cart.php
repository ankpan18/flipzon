<?php require_once("../connection.php") ?>
<?php require_once("../helper.php") ?>

<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    redirect_to("login.php?message=login first");
}

// echo $_SESSION["seller_id"];
// $params = array(&$_SESSION["seller_id"]);
// $result = run_query("SELECT name,id from seller where id=?", "s", $params);
// $seller_detail = $result->fetch_assoc();



$incartonly='1';
$params = array(&$_SESSION["user_id"],&$incartonly);
$result = run_query("SELECT * from `product` p join `order` o on p.id=o.product_id and user_id=? and `incartonly`=?;", "ss", $params);


// print_r($result->fetch_all());

// $myObj = new stdClass();
// $myObj->id=array("1","2");
// $myObj->name=array("Realme","Redmi");
// $myObj->description=array("Realme phone","Redmi phone");

?>

<?php
if (isset($_POST['remove_from_cart'])) {

    $params = array(&$_SESSION["user_id"],&$_POST['remove_from_cart']);
    $result=run_query("DELETE FROM `order` where `user_id`=? and `product_id`=?;","ss",$params);
    redirect_to("cart.php");
    
}
else if (isset($_POST['confirm_booking'])) {
    
    $params = array(&$_SESSION["user_id"]);
    $result=run_query("UPDATE `order` set `incartonly`= '0' where `user_id`=?;","s",$params);
    redirect_to("myorder.php");
    
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop on Flipzon</title>
    <link rel="stylesheet" href="../styles/user/myaccount.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <?php require_once('header.php'); ?>
    <form method="POST">
    <div class="confirm_booking" style=""><button type="submit" name="confirm_booking" class="btn btn-success">Confirm Booking</button> </div>
    </form>
    <?php
    if($result->num_rows==0){
        echo "<h2>Cart Empty</h2>";
    }
    ?>

    <div class="all-products">
        <?php
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="card col-12 col-md-3 m-4">
                <img src="../assets/<?php echo $row['image'] ?>" class="card-img-top" alt="Realme C5" height="300px"
                    width="200px" style="object-fit: contain;">
                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo $row['name'] ?>
                    </h5>
                    <p class="card-text">
                        <?php echo $row['desc'] ?>
                    </p>
                    <p class="card-text">
                        <?php echo $row['price'] ?>
                    </p>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method='POST'>
                        <button type="submit" class="btn btn-danger" name="remove_from_cart" value=<?php echo $row['id'] ?>>Remove</button>
                    </form>
                </div>
            </div>

        <?php } ?>
       
    </div>
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <?php require_once('footer.php'); ?>
</body>

</html>
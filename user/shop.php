<?php require_once("../connection.php") ?>
<?php require_once("../helper.php") ?>

<?php
session_start();



// echo $_SESSION["seller_id"];
// $params = array(&$_SESSION["seller_id"]);
// $result = run_query("SELECT name,id from seller where id=?", "s", $params);
// $seller_detail = $result->fetch_assoc();



$result = run_query_no_args("select * from `product`");


// print_r($result->fetch_all());

// $myObj = new stdClass();
// $myObj->id=array("1","2");
// $myObj->name=array("Realme","Redmi");
// $myObj->description=array("Realme phone","Redmi phone");

?>

<?php
// add item
if (isset($_POST['add_to_cart'])) {

    if (!isset($_SESSION["user_id"])) {
        redirect_to("login.php?message=login first");
    }
    else{
        $incartonly='1';
        $params = array(&$_SESSION["user_id"],&$_POST['add_to_cart'],&$incartonly);
        print_r($params);
        $result=run_query("INSERT INTO `order`(`user_id`,`product_id`,`incartonly`) VALUES(?,?,?);","sss",$params);
        redirect_to("shop.php");
    }
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

    <h1>Checking.............</h1>

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
                        <button type="submit" class="btn btn-danger" name="add_to_cart" value=<?php echo $row['id'] ?>>Add to Cart</button>
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
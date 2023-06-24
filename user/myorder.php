<?php require_once("../connection.php") ?>
<?php require_once("../helper.php") ?>
<?php
session_start();
if (!isset($_SESSION["user_id"])){
    redirect_to("login.php?message=login first");
}


$incartonly='0';
$params = array(&$_SESSION["user_id"],&$incartonly);
$result = run_query("SELECT * from `product` p join `order` o on p.id=o.product_id and user_id=? and `incartonly`=?;", "ss", $params);

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Login</title>
    <link rel="stylesheet" href="../styles/user/myaccount.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <?php require_once('header.php'); ?>

    <h1 style="text-align: center;  background-color:#aaf5f5; height: 20vh;
    display: grid;
    align-items: center;"> Your Orders</h1>

    <h4>Your account</h4>

    <?php
    if($result->num_rows==0){
        echo "<h2>No Orders</h2>";
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
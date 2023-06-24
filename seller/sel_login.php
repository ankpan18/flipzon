<?php require_once("../connection.php") ?>
<?php require_once("../helper.php") ?>
<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // print_r($_POST);
    // echo("<br>");
    
    $params = array(&$_POST['email']);
    $result=run_query("select `password` from `seller` where `id`=?","s",$params);
    // $result=run_query_no_args("select `password` from `user`");

    $row=$result->fetch_assoc();
    if ($row==null)
        redirect_to("sel_login.php?message=no account associated with this email");

    if(!password_verify($_POST['password'],$row['password']))
        redirect_to("sel_login.php?email=".$_POST['email']."&message=password not matching");
    
    //set login session & redirect to home page
    
    // $session_id=session_create_id();
    // echo $session_id;

    session_start();
    $_SESSION["seller_id"] = $_POST['email'];
    redirect_to("sel_dash.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seller Login</title>
    <link rel="stylesheet" href="../styles/seller/myaccount.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <?php require_once('../user/header.php'); ?>

    <h1 style="text-align: center;  background-color:#d8b8f1; height: 20vh;
    display: grid;
    align-items: center;"> Seller Login</h1>

    <h4>Don't have a account yet? <a href="sel_signup.php">Sign Up</a></h4>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
        <div class="container box pb-5">
            <div class="mb-3 message">
            
            <?php print_get_attr("message")?>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email*</label>
                <input type="email" name="email" class="form-control" placeholder="" value="<?php print_get_attr("email")?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password*</label>
                <input type="password" name="password" class="form-control" placeholder="" required>
            </div>
            <button type="submit" class="btn btn-primary">Login </button>
        </div>

    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <?php require_once('../user/footer.php'); ?>
</body>

</html>
<?php require_once("../connection.php") ?>
<?php require_once("../helper.php") ?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    print_r($_POST);
    echo("<br>");
    
    $params = array(&$_POST['email']);
    $result=run_query("select `id` from `seller` where `id`=?","s",$params);

    $row=$result->fetch_assoc();
    
    if ($row!=null) // means that this email is already used to some other account
        redirect_to("sel_signup.php?message=email already used");

    $hash=password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $params = array(&$_POST['email'],&$_POST['name'],&$hash);
    run_query("insert into `seller`(`id`,`name`,`password`) values (?,?,?)","sss",$params);
    
    
    
    redirect_to("sel_login.php");
    
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seller Signup </title>
    <link rel="stylesheet" href="../styles/seller/myaccount.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <?php require_once('../user/header.php'); ?>

    <h3>Be a Seller on our platform </h3>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" onsubmit="check_confirm_pass(event);">
        <div class="container box">
            <div class="mb-3 message">

                <?php print_get_attr("message") ?>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email*</label>
                <input type="email" name="email" class="form-control" placeholder=""
                    value="<?php print_get_attr("email") ?>" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name*</label>
                <input type="text" name="name" class="form-control" placeholder="" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password*</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm-Password*</label>
                <input type="password" id="confirm_password" class="form-control" placeholder="" required>
            </div>
            <button type="submit" class="btn btn-primary mb-5">Login </button>
        </div>

    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <?php require_once('../user/footer.php'); ?>
</body>

<script>
    function check_confirm_pass(event){
        if(password.value!=confirm_password.value){
            event.preventDefault();
            confirm_password.style.border="red solid 2px";
        }
    }
    
</script>

</html>
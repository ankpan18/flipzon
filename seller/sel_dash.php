<?php require_once("../connection.php") ?>
<?php require_once("../helper.php") ?>

<?php
session_start();

if (!isset($_SESSION["seller_id"])) {
    redirect_to("sel_login.php?message=login first");
}

// echo $_SESSION["seller_id"];
$params = array(&$_SESSION["seller_id"]);
$result = run_query("SELECT name,id from seller where id=?", "s", $params);
$seller_detail = $result->fetch_assoc();


$params = array(&$_SESSION["seller_id"]);
$result=run_query("select * from `product` where `seller_id`=? ","s",$params);


// print_r($result->fetch_all());

// $myObj = new stdClass();
// $myObj->id=array("1","2");
// $myObj->name=array("Realme","Redmi");
// $myObj->description=array("Realme phone","Redmi phone");

?>

<?php
// add item
if (isset($_POST['deleteItem'])) {
    $params = array(&$_POST['deleteItem']);
    $result=run_query("DELETE FROM `product` where `id`=? ","s",$params);
    redirect_to("sel_dash.php");
}

if (isset($_POST['add_prod'])) {
    
    print_r($_POST);
    echo("<br>");

    do{
    $random_id=session_create_id();
    $params = array(&$random_id);
    $result=run_query("select `id` from `product` where `id`=?","s",$params);
    $row=$result->fetch_assoc();
    }while($row!=null);
    
    echo($random_id);
    // $
    $allowed_extensions=array("png","jpg",'jpeg');
    $file_extension=pathinfo($_FILES["image_upload"]['name'],PATHINFO_EXTENSION);

    if(!in_array($file_extension,$allowed_extensions)){
        // redirect_to("sel_dash.php");
    }
    else{

        $filename= time().".".$file_extension;
        $params = array(&$random_id,&$_POST['item'],&$_POST['desc'],&$_SESSION["seller_id"],&$filename,&$_POST["price"]);
        run_query("insert into `product`(`id`,`name`,`desc`,`seller_id`,`image`,`price`) values(?,?,?,?,?,?)","ssssss",$params);
        move_uploaded_file($_FILES['image_upload']["tmp_name"],"../assets/".$filename);
        redirect_to("sel_dash.php");
    }
    
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seller Dashboard</title>
    <link rel="stylesheet" href="../styles/seller/dash.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <?php require_once('header.php'); ?>
    <div class="container" style="display: flex;
    flex-direction: column;
    align-items: center;">
        <h2>Seller Dashboard</h2>

        <p> Seller Name:
            <?php echo $seller_detail["name"] ?>
        </p>
        <p> Seller Email:
            <?php echo $seller_detail["id"] ?>
        </p>

        <h3>All Items Offered</h3>
    </div>
    <form class="container" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>"  method="POST" enctype="multipart/form-data">
    
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Item Name</label>
            <input type="text" class="form-control" name="item" id="exampleFormControlInput1" placeholder="Enter Item" required>
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput2" class="form-label">Price</label>
            <input type="text" class="form-control" name="price" id="exampleFormControlInput2"
                placeholder="Enter Price" required>
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Upload Product Image</label>
            <input class="form-control" name="image_upload" type="file" id="formFile" required>
        </div>
        <button type="submit" name='add_prod' class="btn btn-success">Save</button>

    </form>


    <div class="all-products">
<?php 
while($row=$result->fetch_assoc()){
?>
         <div class="card col-12 col-md-3 m-4">
            <img src="../assets/<?php echo$row['image']?>" class="card-img-top" alt="Realme C5" height="300px" width="200px" style="object-fit: contain;">
            <div class="card-body">
                <h5 class="card-title"><?php echo$row['name']?></h5>
                <p class="card-text"><?php echo$row['desc']?></p>
                <p class="card-text"><?php echo$row['price']?></p>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method='POST'>
                <button type="submit" class="btn btn-danger" name="deleteItem" value=<?php echo$row['id']?> >Delete</button>
                </form>
            </div>
        </div>
        
<?php } ?>
         
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    
    <script>
    var el=document.querySelectorAll(".tripledot");
    el.onclick=function(event){
        el.querySelector('.options').classList.toggle("hidden");
    }
    
    </script>
</body>

</html>
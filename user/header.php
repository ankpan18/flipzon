<link rel="stylesheet" href="../styles/user/header.css">


<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"> <img src="../assets/logo.jpg" style="width: 97px;height: 70px;object-fit: cover;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/flipzon">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../user/shop.php">Shop</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Book Now</a>
        </li>
    
      </ul>

      <div class="nav navbar-nav2" style="
    display: flex;
    align-items: center;
">
                    <a href="../user/myorder.php" class="btn btn2">My Order</a>
                    <?php 
                    if (isset($_SESSION["user_id"]))
                      echo('<a href="../logout.php" class="btn btn2">Sign out</a>');
                    else
                      echo('<a href="../user/login.php" class="btn btn2">Sign in</a>');
                    ?>
                    

                    <!-- <a href="#" class="btn btn2"><i class="fas fa-search"></i></a> -->
                    <a href="../user/cart.php" class="btn btn2"><i class="fas fa-shopping-cart"></i></a>
                </div>
      <form class="d-flex" role="search" style="
    margin: 0;
">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

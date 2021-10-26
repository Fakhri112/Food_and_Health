<?php 

require 'function.php';
session_start();


?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEZHEALTY</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style><?php include 'gaya.css'; ?></style>
</head>
<body>
    <!-- Nav ---------------------------------------------------->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top p-3 navbar4bg">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="container">
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">

          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link text-white" href="index.php">Home </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="kitchen-tips.php">Kitchen Tips</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="category.php">Category</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="submit-recipe.php">Submit Resep</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Tools</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="healthcalculator.php">Health Calculator</a>
                <a class="dropdown-item" href="foodcomposer.php">Food Composer</a>
              </div>
            </li>
          </ul>

        <form class="form-inline my-2 my-lg-0" action="result.php" method="get">
           <input class="form-control me-2" style="width:200px" name="keyword" placeholder="Search" aria-label="Search">
        </form>
        <span>
        <?php if (!apply_foto_profil()) : ?>
            <a class="navbar-brand ml-4" href="login.php">
              <img class="rounded-circle" src="img/avatar.jpg" alt="..." height="36" width="36" />
            </a>
          <?php else : ?>
            <a class="navbar-brand ml-4" href="login.php">
              <img class="rounded-circle" src="upload/foto-profil/<?=apply_foto_profil()?>" alt="..." height="36" width="36" />
            </a>
            <?php endif ?>
      </span>
      </div>
      </div>
    </nav>

    <div class="container" style="margin-top: 110px;">
        <h3>Category</h3>
        <hr>
        <div class="d-flex justify-content-center">
        <form action="search-category.php" method="post">
            <div class="row mt-5">
            <input type="submit" name="submit_ct" id="submit" class="btn btn-info" value="Makanan Basah" />
            <input type="submit" name="submit_ct" id="submit" class="btn btn-info ml-5" value="Sayur"/>
            <input type="submit" name="submit_ct" id="submit" class="btn btn-info ml-5" value="Goreng"/>
            <input type="submit" name="submit_ct" id="submit" class="btn btn-info ml-5" value="Minuman"/>
            <input type="submit" name="submit_ct" id="submit" class="btn btn-info ml-5" value="Rebus"/>
            </div>
            <div class="row mt-5 justify-content-center">
            <input type="submit" name="submit_ct" id="submit" class="btn btn-info" value="Breakfast"/>
            <input type="submit" name="submit_ct" id="submit" class="btn btn-info ml-5" value="Sambal"/>
            <input type="submit" name="submit_ct" id="submit" class="btn btn-info ml-5" value="Pedas"/>
            <input type="submit" name="submit_ct" id="submit" class="btn btn-info ml-5" value="Camilan"/>
            <input type="submit" name="submit_ct" id="submit" class="btn btn-info ml-5" value="Lauk"/>
            </div>
            <div class="row  mt-5 justify-content-center">
            <input type="submit" name="submit_ct" id="submit" class="btn btn-info" value="Kuah"/>
            </div>
        </form>
        </div>
    </div>

    <?php 
    if( isset($_POST["submit_resep"])){
        kirim_resep();
    }
    ?>

<footer class="bg-dark footer-category">
    <div class="container">
      <div class="py-4 footer-blog">
      <div class="row">
        <div class="col-9">
            <ul class="nav">
            <li class="nav-item"><a href="../contact.php" class="nav-link px-2 text-muted contact-about">Contact</a></li>
            <li class="nav-item"><a href="../about.php" class="nav-link px-2 text-muted contact-about">About</a></li>
            </ul>
        </div>
        <div class="col-3">
            <ul class="nav justify-content-end">
            <li class="nav-item"><a class="nav-link copyright">&copy; 2021 LEZHEALTY</a></li>
            </ul>
        </div>
        </div>
    </div>
    </div>
  </footer>

</body>
</html>
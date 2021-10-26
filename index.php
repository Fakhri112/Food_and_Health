<?php
  session_start();
  require 'function.php';

  //pagination
  $jumlahDataPerHalaman = 6;
  $jumlahData = count(queryResep("SELECT * FROM resep"));
  $jumlahHalaman = ceil($jumlahData/$jumlahDataPerHalaman);
  $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
  $awalData = ($jumlahDataPerHalaman*$halamanAktif)-$jumlahDataPerHalaman;
  
  $recipe = queryResep("SELECT * FROM resep ORDER BY id DESC LIMIT $awalData, $jumlahDataPerHalaman");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags ---------------------------------------------------->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap CSS ---------------------------------------------------->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- CSS ---------------------------------------------------->
    <style><?php include 'gaya.css'; ?></style>
    <!-- JS ---------------------------------------------------->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <title>Lezhealty</title>
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
                <a class="dropdown-item" href="health-calculator.php">Health Calculator</a>
                <a class="dropdown-item" href="food-composer.php">Food Composer</a>
              </div>
            </li>
          </ul>

        <form class="form-inline my-2 my-lg-0" action="result.php" method="get">
           <input class="form-control me-2" style="width:200px" name="keyword" placeholder="Search" aria-label="Search">
        </form>
        <span>
        <?php if (!apply_foto_profil()) : ?>
            <a class="navbar-brand ml-4" href="login.php">
              <img class="rounded-circle" src="img/avatar.jpg" alt="..." height="36" />
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
    <!-- End Nav ---------------------------------------------------->
    <!-- Content ---------------------------------------------------->
    <div class="container" style="margin-top: 110px;">
      <div class="row">
        <!-- Main Content ---------------------------------------------------->
        <div class="col-sm-8">
          <div class="container">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100 tahukahkamu" src="img/food3.jpg" alt="First slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Tahukah Kamu #1</h5>
                        <p>The whole caption will only show up if the screen is at least medium size.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 tahukahkamu" src="img/food2.jpg" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Tahukah Kamu #2</h5>
                        <p>The whole caption will only show up if the screen is at least medium size.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 tahukahkamu" src="img/food1.jpg" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Tahukah Kamu #3</h5>
                        <p>The whole caption will only show up if the screen is at least medium size.</p>
                    </div>
                </div>
            </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                  </a>
            </div>

              <!-- Blog ---------------------------------------------------->

                  <?php foreach($recipe as $card) : ?>

                  <?php $link_img = $card["sumber"].".jpg";?>
                  <form action="search-category.php" method="post">
                      <div class="card mt-4">
                        <img src="blog/<?php echo $link_img?>" class="card-img-top" alt="...">
                        <div class="card-body">
                          <div class="text-justify">
                            <a href="blog/<?php echo $card["sumber"].".php"?>" class="text-decoration-none hover-orange"><h5><?php echo $card["judul"]?></h5></a>
                            <p><?php echo $card["deskripsi"] ?></p>
                            <?php if ( strlen($card["tag1"])) :?>
                            <input type="submit" class="btn btn-primary" name="submit_ct" value="<?php echo $card["tag1"];?>">  
                            <?php endif ?>
                            <?php if (strlen($card["tag2"])) :?>
                              <input type="submit" class="btn btn-primary" name="submit_ct" value="<?php echo $card["tag2"];?>">
                            <?php endif ?>
                            <?php if ( strlen($card["tag3"])) :?>
                              <input type="submit" class="btn btn-primary" name="submit_ct" value="<?php echo $card["tag3"];?>">
                            <?php endif ?>
                            <?php if ( strlen($card["tag4"])) :?>
                              <input type="submit" class="btn btn-primary" name="submit_ct" value="<?php echo $card["tag4"];?>">
                            <?php endif ?>
                          </div>
                        </div>
                      </div>
                    </form>

                  <?php endforeach; ?>
            
              <!--  ---------------------------------------------------->
                <!-- End Blog ---------------------------------------------------->
          
        </div>
      </div>


      <!-- End Main Content ---------------------------------------------------->
      <!-- Trend ---------------------------------------------------->
      <div class="col-sm-4">
        <p>Populer Post</p>



        <div class="row row-cols-1 row-cols-md-1 g-4">
          <div class="col mb-3">
            <div class="card">
              <img src="img/food1.jpg" class="card-img-top" alt="..." />
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              </div>
            </div>
          </div>
          <div class="col mb-3">
            <div class="card">
              <img src="img/food2.jpg" class="card-img-top" alt="..." />
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              </div>
            </div>
          </div>
          <div class="col mb-3">
            <div class="card">
              <img src="img/food3.jpg" class="card-img-top" alt="..." />
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
              </div>
            </div>
          </div>
          <div class="col mb-3">
            <div class="card">
              <img src="img/Fruit.jpg" class="card-img-top" alt="..." />
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              </div>
            </div>
          </div>
        </div>
      </div>


       <!-- End Trend ---------------------------------------------------->
  </div>
<!-- End Content ---------------------------------------------------->

    <!-- Footer ---------------------------------------------------->

    <nav aria-label="...">
        <ul class="pagination mt-3 justify-content-center">
            <?php if($halamanAktif > 1 ) : ?>
                <li class="page-item"><a class="page-link" href="?halaman=<?= $halamanAktif-1 ?>">Previous</a></li>
            <?php else : ?>
                <li class="page-item disabled"><a class="page-link" href="?halaman=<?= $halamanAktif-1 ?>">Previous</a></li>
            <?php endif;?>
            <?php for ($i=1; $i<=$jumlahHalaman; $i++) : ?>
              <?php if ($i == $halamanAktif) : ?>
                <li class="page-item active">
                  <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                </li>
              <?php else : ?>
                <li class="page-item">
                  <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                </li>
                
              <?php endif;?>
            <?php endfor; ?>

            <?php if($halamanAktif < $jumlahHalaman ) : ?>
                <li class="page-item"><a class="page-link" href="?halaman=<?= $halamanAktif+1 ?>">Next</a></li>
            <?php else : ?>
                <li class="page-item disabled"><a class="page-link" href="?halaman=<?= $halamanAktif-1 ?>">Next</a></li>
            <?php endif;?>
        </ul>
    </nav>
    
</div>

<footer class="bg-dark mt-auto">
    <div class="container">
      <footer class="py-4 footer-blog">
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
      </footer>
    </div>
  </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  </body>
</html>

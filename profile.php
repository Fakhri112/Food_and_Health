<?php
  require 'function.php';

  session_start();
  $conn = mysqli_connect("localhost","root","","food_and_health");
  $username_profile = $_SESSION["username"];
  $recipe = queryResep("SELECT blog_name FROM bookmark WHERE username = '$username_profile' AND status = 'ON'");
  $resep_terkirim = queryResep("SELECT * FROM submit_resep WHERE username = '$username_profile' ORDER BY id DESC");
  $komentar = queryResep("SELECT * FROM tbl_comment WHERE comment_sender_name = '$username_profile' ORDER BY date DESC");

  if (isset($_POST["submit_pp"])){
      ubah_foto_profil();
  }
  if (isset($_POST["logout"])){
        session_unset();
        session_destroy();
        unset($_POST["logout"]);
        header("Location:index.php");
  }

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
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body>

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

  <div class="container" style="margin-top:110px">

    <div class="d-flex justify-content-end">
    <form action="" method="post">
    <button class="btn btn-danger btn-sm" name="logout" id="logout" value="1">Keluar</button>
    </form>
    </div>


    <div class="d-flex justify-content-center">
    <?php if (!apply_foto_profil()) : ?>
      <img class="rounded-circle" src="img/avatar.jpg" alt="..." height="100" />
    <?php else : ?>
    <img class="rounded-circle" src="upload/foto-profil/<?=apply_foto_profil()?>" alt="..." height="120" width="120" />
    <?php endif?>

    </div>

      <div class="d-flex mt-3 justify-content-center">
      <h4><?=$_SESSION["username"]?></h4>
      </div>

      <div class="d-flex justify-content-center">
        <form id="form_pp" action="" method="post" enctype="multipart/form-data">
          <label  class="btn-info p-2 rounded" for="profile_pic">Ubah Foto Profil</label>
          <input type="file" name="profile_pic" id="profile_pic" value="gambar" style="display: none;">
          <input type="submit" name="submit_pp" id="submit_pp" value="submit_pp" style="display: none;">
        </form>
      </div>


      <hr/>

        <nav>
          <div class="nav nav-tabs bg-warning rounded p-3 mb-3 justify-content-left" id="nav-tab" role="tablist";">
            <a class="nav-item nav-link select active ml-2" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Bookmark</a>
            <a class="nav-item nav-link select ml-2" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Komentar</a>
            <a class="nav-item nav-link select ml-2" id="nav-profile0-tab" data-toggle="tab" href="#nav-profile0" role="tab" aria-controls="nav-profile0" aria-selected="false">Notifikasi</a>
            <a class="nav-item nav-link select ml-2" id="nav-profile1-tab" data-toggle="tab" href="#nav-profile1" role="tab" aria-controls="nav-profile1" aria-selected="false">Resep Terkirim</a>
            <a class="nav-item nav-link select ml-2" id="nav-profile2-tab" data-toggle="tab" href="#nav-profile2" role="tab" aria-controls="nav-profile2" aria-selected="false">Info Pengguna</a>
          </div>
        </nav>
        <div class="tab-content " id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

          <!-- -->
          <div class="row">
         <?php foreach($recipe as $card) :?>
          <div class="col-3">
          <div class="card mb-3" style="width: 250px;">
              <img src="blog/<?=$card["blog_name"].".jpg"?>" class="card-img-top" alt="..." />
              <div class="card-body">
                <?php
                $blog_name = $card['blog_name'];
                $nama_resep = queryResep("SELECT * FROM resep WHERE sumber = '$blog_name'")
                ?>
                <a href="blog/<?=$card["blog_name"].".php";?>" class="text-decoration-none hover-orange">
                <h5 class="card-title"><?=$nama_resep[0]["judul"];?></h5>
                </a>
                <p class="card-text"><?=$nama_resep[0]["deskripsi"] ?></p>
              </div>
            </div>
          </div>
          <?php endforeach?>
          </div>

          </div>

          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                <?php foreach($komentar as $comment) :?>
                <div class="row container">
                <?php 
                $blog_name = $comment['blog_name'];
                $nama_resep = queryResep("SELECT * FROM resep WHERE sumber = '$blog_name'");
                ?>
                <h5><?=$nama_resep[0]["judul"]?></h5>
                    <div class="mt-1 ml-2"><i><?=$comment["date"]?></i></div>
                </div>
                <?php if ($comment["parent_comment_id"] == 0) : ?>
                <?=$comment["comment"]?>
                <?php else : ?>
                <div class="row container">
                <?php 
                $parent_comment_id = $comment["parent_comment_id"];
                $replier = queryResep("SELECT * FROM tbl_comment WHERE comment_id = '$parent_comment_id'");
                ?>
                    <h6>RE [<?=$replier[0]["comment_sender_name"];?>] : </h6>
                    <div class="ml-2"><?=$replier[0]["comment"];?></div>
                </div>
                    <?=$comment["comment"]?>
                <?php endif?>
                <hr>
                <?php endforeach ?>
                
          </div>

          <div class="tab-pane fade" id="nav-profile0" role="tabpanel" aria-labelledby="nav-profile0-tab">
            <div class="row container">
                <h5>Cara menang giveaway</h5>
                    <div class="mt-1 ml-2"><i> 08-01-2022</i></div>
                </div>
                <div class="row container">
                    <h6>[harukanakagawa] membalas komentar anda : </h6>
                    <div class="ml-2"> kamu siapa </div>
                </div>
                    aku harugon
                <hr>
                            

                <div class="row container">
                <h5>Resep Anda : [Cara Jadi Yutuber]</h5>

                </div>
                    <div class="p-2 text-white bg-success" style="width: 360px;">Sudah Disetujui</div>
                <hr>
          </div>
          <div class="tab-pane fade" id="nav-profile1" role="tabpanel" aria-labelledby="nav-profile1-tab">
                
                <!-- <?php //foreach($resep_terkirim as $submitted) : ?>
                <div class="card mb-3" style="width: 300px;">
                    <img src="upload/submit-resep/<?//$submitted["gambar"];?>" class="card-img-top" alt="..." />
                    <div class="card-body">
                        <button class="text-left btn-card-no-background"data-toggle="modal" data-target=".bd-example-modal-lg"><?=$submitted["nama_resep"];?></button>
                        <p class="card-text"><?//$submitted["deskripsi_resep"];?></p>
                    </div>
                </div>
                <?php //endforeach;?> -->



                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        </div>
                    </div>
                </div>

          </div>
          <div class="tab-pane fade" id="nav-profile2" role="tabpanel" aria-labelledby="nav-profile2-tab">
                <div class="d-flex justify-content-center">
                <form action="" method="post" enctype="multipart/form-data">
                    
                    <div class="row">
                    <h6>Username</h6>
                    </div>
                    <div class="row mb-3">
                    <input type="text" name="username" id="username" class="form-control" style="width: 340px;">
                    </div>
                    

                    <h6 class="row">Password</h6>
                    <div class="row mb-3">
                    <input type="password" name="password" id="password" class="form-control" data-toggle="password" style="width: 300px;">
                    <span class="input-group-text"><i class="fa fa-eye"></i></span>
                    </div>

                    <h6 class="row">Email</h6>
                    <div class="row mb-3">
                    <input type="text" name="email" id="email" class="form-control" style="width: 350px;">
                    </div>

                    <h6 class="row">No. HP</h6>
                    <div class="row mb-3">
                    <input type="text" name="nohp" id="nohp" class="form-control" style="width: 350px;">
                    </div>

                    <div class="d-flex justify-content-center">
                    <input type="submit" name="ubah_data" id="ubah_data" class="btn btn-info mt-3 mb-4" value="Ubah">
                    </div>

                </form>
                </div>
          </div>

        </div>
    </div>


    <div class="bg-dark">
    <div class="container">
      <div class="p-4 footer-blog">
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
  </div>

  <script src="bootstrap-show-password.js"></script>
  <script>
    document.getElementById("profile_pic").onchange = function() {
    
    setTimeout(function(){
   
    $('#submit_pp').trigger('click');

    }, 650);

    };
  </script>

</body>
</html>
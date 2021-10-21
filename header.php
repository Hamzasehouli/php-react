<?php
include('./session.php'); //inlude the session code in order to check if the session already started and if a user exists in order to hide/show login button etc....
?>
<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <div><a class="navbar-brand anch" href=<?php echo 'index.php' ?>>PHP auth project</a></div>
    <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span> -->
    <!-- </button> -->
    <div><div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php
        if(empty($_SESSION['username'])){ //cehck if username exists and set in the session variable

          echo '<li class="nav-item"><a class="nav-link active" aria-current="page" href="login.php">Se connecter</a></li>';
          echo '<li class="nav-item">
          <a class="nav-link active" aria-current="page" href="signup.php">S\'inscrire</a>
        </li>';
        }else{
          echo '';
        }
         ?>  
         <?php
        if(!empty($_SESSION['username'])){
          echo '<li class="nav-item">
          <a class="nav-link active" aria-current="page" href="logout.php">Se deconnecter</a>
        </li>';
        }else{
          echo '';
        }
         ?> 
        
        <li class="nav-item">
          <span  class="nav-link active" aria-current="page" href="#"><?php if(!empty($_SESSION['username'])){
echo $_SESSION['username'];
          } ?></span>
        </li>
      </ul>
    </div></div>
  </div>
</nav>
</header>
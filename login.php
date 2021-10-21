<?php
    include('./config.php');// include the confige file to reconnect with data base
    
    session_start(); // staring a new session
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
      header('location:index.php');//checking if the session is already started, if so it will be redirected to to home page
      exit;
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST'){ // it is very important to check if the http method is the post request, to avoid redering errors if we reload page which uses get method;
      $username = strtolower(trim($_POST['username']));//lower case and remove any white space in the usrname input
      $password = trim($_POST['password']);
      $username_err =null;
      $password_err =null;
      $login_err =null;

      if(empty($username)){
        $username_err='Veuillez entrez votre nom d\'utilisateur';
      }
      if(empty($password) ?: strlen($password) < 8 ){
        $password_err='Veuillez entrer votre nom d\'utilisateur, le mot de passe doit contenir au moins 8 caractères';
      }

      if(empty($username_err) && empty($password_err)){ //check if there is no empty values entred by a user; if so we start quering for the user if exists;
        if($statement = $con->prepare('SELECT * FROM user WHERE username=:username')){//initiationn of the query statement
          $statement->bindValue(':username',$username); // bind the the input value with its key in the query statement 
          if($statement->execute()){// execute the query if the status is OK;we move to an other line 
            if($statement->rowCount() === 1){//rowCount will render the number of rows found related to the used query after INSESRT, DELETE and UPDATE methods;
             
              if($row = $statement->fetch()){ // fetch the existed user and store it into row variable
                $id=$row['ID'];
                $usern=$row['username'];
                $hashed_password = $row['password'];
                //cehck if the stored password in DB is te same as the entered plain password ny the user;
                if(password_verify($password, $hashed_password)){ 
                  // starting new session;
                  session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $usern;
                header('location:index.php');//redirect to home page;           
                }else{
                  $login_err = 'Le nom d\'utilisateur ou le mot de passe sont incorrects';
                }
              }else{
                $login_err = 'Le nom d\'utilisateur ou le mot de passe sont incorrects';
              }
              //// number of rows after INSERT DELET AND UPDATE
            } else{
              $login_err = 'aucun utilisateur a été trouvé avec ce nom';
            }
          }else{
            $login_err = 'Une erreur s\'est produite. Veuillez réessayer';
          }
        }
      }


    }
    include('./session.php');
 ?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<?php include_once('./header.php') ?>
    <section class="section-form">
    <form class="form" action=<?php echo 'login.php'?>  method="POST">
    <h2 style="color:red;"><?php
    if(!empty($login_err)){
      echo $login_err;
    }
    ?></h2>
  <div class="mb-3">
    <label for="username" class="form-label">Nom d'utilisateur</label>
    <input name="username" type="text" class="form-control" id="username" aria-describedby="emailHelp">
    <span><?php
    if(!empty($username_err)){
      echo $username_err;
    }
    ?>
    </span>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input name="password" type="password" class="form-control" id="password"> <span>
      <?php
    if(!empty($password_err)){
        echo $password_err;
    }
    ?>
    </span>
  </div>
  <button type="submit" class="btn btn-primary">Se connecter</button>
  <a href=<?php echo 'signup.php'?> class="btn btn-primary">Vous n'avez pas ncore un compte ? s'inscrire ici</a>
</form>
    </section>
</body> 
</html>
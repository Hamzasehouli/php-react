<?php
    include('./config.php'); //including the config file to keep the connection with the corresponding data base;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){ //make sure the the login inside the if statement will run durinn post requests
    $username = strtolower(trim($_POST['username']));
    $email = strtolower(trim($_POST['email']));
    $password = trim($_POST['password']);
    $username_err = null;
    $email_err = null;
    $password_err = null;
    $state = null;
    

    if(empty($username)){
      $username_err = 'Veuillez entrer un nom d\'utilisateur valide';
    };

    if(empty($email) || stripos($email, '@') === false ){
      $email_err = 'Veuillez entrer un email valide';
    }
    if(empty($password) || strlen($password) < 8){
      $password_err = 'Veuillez entrer un mot de passe valide';
    }

    if(empty($username_err) && empty($email_err) && empty($password_err) ){
      $query= 'SELECT username FROM user WHERE username = :username';
      $query_email= 'SELECT email FROM user WHERE email = :email';
      $check=$con->prepare($query);
      $check_email=$con->prepare($query_email);
      $check->bindValue(':username', $username);
      $check_email->bindValue(':email', $email);
      $check->execute();
      $check_email->execute();
     
      if($check->rowCount() > 0){
        session_start();
        $_SESSION['err']='403, l\'utilisateur saisi est déjà utilisé';
        header('location:/error.php');
        exit();
      }
      if($check_email->rowCount() > 0){
        session_start();
        $_SESSION['err']='403, l\'email saisi est déjà utilisé';
        header('location:/error.php');
        exit();
      }
      $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
      //prepare the insert statement
      $statement = $con->prepare('INSERT INTO user(username, email, password) VALUES(:username, :email, :password)');
      //bind the entered value with those set in the insert statement
      $statement->bindValue('username', $username);
      $statement->bindValue('email', $email);
      $statement->bindValue('password', $hashedpassword);
      //execute the insert statement
      if($statement->execute()){
        // $state='<div class="state">Thank You! I will be in touch</div>';
        $state='success';
      }else{
        // $state='<div class="state">Sorry there was an error sending your message. Please try again later</div>';
        $state='fail';
      }
    }
  }


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
<h1><?php
if(!empty($state)){
  if($state === 'success'){
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    header('location:/'.basename(__DIR__).'/index.php');
  }else{
    echo '<div class="state">Sorry there was an error sending your message. Please try again later</div>';
  }
}
?></h1>
    <section class="section-form">
    <form class="form" action=<?php echo '/'.basename(__DIR__).'/signup.php'?> method="POST">
    
  <div class="mb-3">
    <label for="username" class="form-label">Nom d'utilisateur</label>
    <input name="username" type="text" class="form-control" id="username" aria-describedby="emailHelp">
    <p><?php if(!empty($username_err)){
      echo $username_err;
    } ?></p>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input name="email" type="email" class="form-control" id="email"><p><?php if(!empty($email_err)){
      echo $email_err;
    } ?></p>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input name="password" type="password" class="form-control" id="password">
    <p><?php if(!empty($password_err)){
      echo $password_err;
    } ?></p>
  </div>
  <button type="submit" class="btn btn-primary">S'inscrire</button>
  <a href=<?php echo '/'.basename(__DIR__).'/login.php'?> class="btn btn-primary">Vous avez deja un compte ? se connecter ici</a>
</form>
    </section>
</body>
</html>
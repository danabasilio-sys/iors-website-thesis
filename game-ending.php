<?php

require_once 'init.php';

require_once 'db_conn.php';

require_once 'functions.php';

$username = $_SESSION['username'];

if(isset($_POST['post-game-otp'])){

  $pre_game_otp = validate($_POST['post-game-otp']);

  if(!check_post_game_otp_exists_for_username($username,$pre_game_otp)){

    $_SESSION['post_game_otp_error'] = 'OTP code invalid';
    
    $_SESSION['check_url'] = "post-game-verification.php";

    //$_SESSION['resend_otp'] = true;

    header('location: post-game-verification.php');

    exit();

  }

}else{

    

  //send email contain otp code

    $_SESSION['post_game_otp_error'] = 'please type OTP code here';
  
    $_SESSION['check_url'] = "post-game-verification.php";

    //$_SESSION['resend_otp'] = true;

    header('location: post-game-verification.php');

}

$_SESSION['check_url'] = "game-ending.php";

?>

<?php if(isset($_SESSION['user_id']) && intval($_SESSION['user_id']) > 0 && $_SESSION['check_url'] == "game-ending.php") { ?>

<?php 
  unset($_SESSION);
  $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
  foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
  } 
?>

<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">



  <link rel="icon" type="image/png" sizes="32x32" href="./assets/favicon-stiletto.png">

  <!-- Google fonts -->

  <link rel="preconnect" href="https://fonts.googleapis.com">

  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;700&family=Bellefair&family=Barlow:wght@400;700&display=swap"

      rel="stylesheet">

      

  <!-- Our custom CSS -->

  <link rel="stylesheet" href="index.css">

  <title>In Our Red Stilettos | Game</title>

  <script src="navigation.js" defer></script>

  <script src="tabs.js" defer></script>

 <!-- GAME STYLING -->
  
  <style>
    
    .ending-container {
      position: relative;
      padding-bottom: 56.25%;
      padding-top: 35px;
      height: 0;
      overflow: hidden;
      margin: 30px 0;
     }
    
    
    .ending-container iframe {
      position: absolute;
      top:0;
      left: 0;
      width: 100%;
      height: 100%;
    }
   
  </style>

  <!-- END OF GAME STYLING -->

</head>



<body class="actual-game">

  <a class="skip-to-content" href="#main">Skip to content</a>

  <header class="primary-header flex">

    <div>

      <img src="./assets/shared/stiletto-logo.png" alt="In Our Red Stilettos Logo" class="logo">

    </div>

    <button class="mobile-nav-toggle" aria-controls="primary-navigation"><span class="sr-only" aria-expanded="false">Menu</span></button>

    <nav> 

        <?php include 'parts/menu.php'; ?>

    </nav>

  </header>
  
  
  <div id="end" class="container-quick-quiz flex-center flex-column">
    
    <div class="fs-400 ff-sans-cond letter-spacing-3 uppercase" style="color: #D2D8F9; margin: 0 0 10px;">GAME ENDING</div>
    
    <!-- GAME ENDING -->
   
    <div class="ending-container">
      <iframe src="epilogue/www/index.html" height="628" width="820" allowfullscreen="" frameborder="0">
      </iframe>
    </div>
    
    <br><br><br><br>
    
    <!-- END OF GAME ENDING -->
    
  </div>

  </body>
  
</html>
<?php }else{ 
    header("location: game.php");
    exit();
}
?>

</html>

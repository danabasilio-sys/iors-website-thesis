<?php

require_once 'init.php';

require_once 'db_conn.php';

require_once 'functions.php';


if(isset($_SESSION['username'])){

    $existingUsername = $_SESSION['username'];

    $msg = "Good job, ".$existingUsername;



    if(isset($_POST['preGameScore'])){

        $preGameScore = intval($_POST['preGameScore']);
      if (save_player_pre_game_score($existingUsername,$preGameScore)) {
        $msg.= "<br>Your pre-game quiz score has been saved successfully!<br><br>";
        $_SESSION['check_url'] = "end-pre-game.php";

        unset($_POST['preGameScore']);
      } else {
        $_SESSION['username_error'] = "<br>Your pre-game quiz score could not be sent.<br><br>";
      } 
    }

}else{

  //$_SESSION['username_error'] = 'please provide a username to store your score';

  header('location: game.php');

}



?>

<?php if(isset($_SESSION['user_id']) && intval($_SESSION['user_id']) > 0 && $_SESSION['check_url'] == "end-pre-game.php") { ?>

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



</head>



<body class="end-quiz">

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



  <?php

 

    echo "<center> $msg </center>";



?>



  <div id="end" class="container-quick-quiz flex-center flex-column">

    <div class="final-score">

        <div id="hud-item">

            <p class="hud-prefix --fs-500 --ff-sans-cond uppercase">

                Final Score

            </p>

        <h1 class="hud-main-text" id="finalScore" name="preGameScore"></h1>

    </div>

</div>



      <h2 class="finished-quiz fs-700 ff-serif uppercase flex-center flex-column">PRE-GAME QUIZ FINISHED</h2>

      <p>To access the game, please enter your email address below so we can send you a

          one-time PIN code.

      </p>

      <br>

      

      <form action="pre-game-verification.php" method="post" class="fs-400 ff-sans-cond letter-spacing-3 uppercase">

          <div style="color:red"><?php 

          echo isset($_SESSION['pre_game_email_error']) ? $_SESSION['pre_game_email_error'] : ''; 

          unset($_SESSION['pre_game_email_error']);

          ?></div>

          <label for="pre-game-email">Get a one-time PIN code</label><br><br>

          <input type="email" id="pre-game-email" name="pre-game-email" placeholder="TYPE EMAIL HERE" required /><br>

          <br>



          <button type="submit" class="verify-button uppercase ff-serif text-dark bg-white">Send</button>

          <br><br><br><br>

      </form>

  </div>

  <script src="end-pre-game.js"></script>

  </body>
    
  <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $('body').on('click', function(e) {
    changes = false; 
    var target, href;
      url = '';
    target = $(e.target);
    if (e.target.tagName === 'A' || target.parents('a').length > 0 ) {
      changes = true;
        url = $(e.target).attr('href');
      if(changes){
        e.preventDefault();
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButtonColor: '#9F1616',
          cancelButtonColor: '#0B0A29',
        },
          buttonsStyling: true
        })
        swalWithBootstrapButtons.fire({
          text: "Are you sure you want to leave this page? Your progress will not be saved.",
            padding: '3em',
          color: '#fff',
          background: '#0B0A29',
          confirmButtonColor: '#9F1616',
          cancelButtonColor: '#0B0A29',
          showCancelButton: true,
          confirmButtonText: 'Leave',
          cancelButtonText: 'Cancel',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            <?php $_SESSION['check_url'] = "end-pre-game.php"; ?>
            window.location.href=url;
          } 
        })
      }
      changes = false;
    }
  });
</script>

</html>

<?php }else{
 
  header("location: game.php");
  exit();
}
?>

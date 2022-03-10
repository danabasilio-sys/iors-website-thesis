<?php

require_once 'init.php';

require_once 'db_conn.php';

require_once 'functions.php';

$username = $_SESSION['username'];

if(isset($_POST['pre-game-otp'])){
  $pre_game_otp = validate($_POST['pre-game-otp']);
  
  $_SESSION['check_url'] = "gameplay.php";
  unset($_POST['pre-game-otp']);

  if(!check_pre_game_otp_exists_for_username($username,$pre_game_otp)){

    $_SESSION['pre_game_otp_error'] = 'OTP code invalid';
    $_SESSION['check_url'] = "pre-game-verification.php";

    //$_SESSION['resend_otp'] = true;

    header('location: pre-game-verification.php');

    exit();

  }

}

$_SESSION['check_url'] = "gameplay.php";

?>

<?php if(isset($_SESSION['user_id']) && intval($_SESSION['user_id']) > 0 && $_SESSION['check_url'] == "gameplay.php") { ?>

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
  
  <!-- Table Styling -->
  
  <style>
    #game-commands {
      border-collapse: collapse;
    }

    #game-commands td, #customers th {
      border: 2px solid #151552;
      padding: 8px;
    }
    
    #game-commands td {
      background-color: hsl( var(--clr-light) );
      color: black;
      text-align: left;
    }

    #game-commands th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: center;
      background-color: #151552;
      color: white;
    }
    
    /* GAME STYLING */
    
    .game-container {
      position: relative;
      padding-bottom: 56.25%;
      padding-top: 35px;
      height: 0;
      overflow: hidden;
      margin: 30px 0;
     }
    
    
    .game-container iframe {
      position: absolute;
      top:0;
      left: 0;
      width: 100%;
      height: 100%;
    }

    /* END OF GAME STYLING */
    
  </style>

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
    
    <div class="fs-400 ff-sans-cond letter-spacing-3 uppercase" style="color: #D2D8F9; margin: 10px 0 30px;">GAME COMMANDS LIST</div>
    
    <!-- GAME COMMANDS LIST -->
    <table id="game-commands" style="width: 100%; margin: 20px 0;">
      
      <tr>
       <th>Actions</th>
       <th>Commands</th>
      </tr>
      
      <tr>
        <td>Enter Full Screen Mode</td>
        <td>F4</td>
      </tr>
      
      <tr>
        <td>Exit Full Screen Mode</td>
        <td>ESC</td>
      </tr>
      
      <tr>
        <td>Progress Through Dialogue</td>
        <td>ENTER, SPACE, or Z</td>
      </tr>
      
      <tr>
        <td>Select Character’s Choice of Action</td>
        <td>Up or Down Arrow Keys → ENTER or CLICK</td>
      </tr>
      
      <tr>
        <td>Move</td>
        <td>Arrow Keys</td>
      </tr>
      
      <tr>
        <td>Run</td>
        <td>Shift + Arrow Keys</td>
      </tr>
      
      <tr>
        <td>Interact</td>
        <td>ENTER, SPACE, or Z</td>
      </tr>
      
      <tr>
        <td>Open Game Menu<br>
          <i>*can only be done while navigating town map</i>
        </td>
        <td>X</td>
      </tr>
      
      <tr>
        <td>Return to Previous Screen in Game Menu</td>
        <td>ESC</td>
      </tr>
      
      <tr>
        <td>Exit Game Menu</td>
        <td>ESC</td>
      </tr>
      
      <tr>
        <td>Modify Game Options</td>
        <td>X → Options → Select option to modify → Left or Right Arrow Keys</td>
      </tr>
      
      <tr>
        <td>Save Game Progress</td>
        <td>X → Save → Select any of the save file slots</td>
      </tr>
      
      <tr>
        <td>Continue Game From Save File (From Title Screen)</td>
        <td>Continue → Select save file</td>
      </tr>
      
      <tr>
        <td>Continue Game From Save File (From Ongoing Gameplay)</td>
        <td>X → Return to Title → Continue → Select save file</td>
      </tr>

    </table>
    
    <!-- END OF GAME COMMANDS LIST -->
    
    <div class="fs-400 ff-sans-cond letter-spacing-3 uppercase" style="color: #D2D8F9; margin: 50px 0 10px;">GAMEPLAY</div>
    
    <!-- GAME -->
   
    <div class="game-container">
      <iframe src="iors-game/www/index.html" height="628" width="820" allowfullscreen="" frameborder="0">
      </iframe>
    </div>
    
    <p><b>NOTE:</b> If you experience lag at any point in the game, it may be due to your browser taking some time
      to load the large game files. Please wait for it to finish loading instead of refreshing the page
      or closing the tab.
      <br><br>
      If you encounter an Uncaught TypeError, please refresh the page and play again. It is recommended that you save your game
      progress as much as possible to be able to easily continue from your current save point instead of starting over 
      after refreshing the page. Remember that you can only save game progress while your character is in the town map. 
      Refer to the commands list above the game for more details.
    </p>
    
    <br><br><br><br>
    
    <!-- END OF GAME -->
    
    <!--  QUICK POST-GAME QUIZ MESSAGE
    <h2 class="fs-700 ff-serif uppercase flex-center flex-column">QUICK POST-GAME QUIZ</h2>

    <p>You need to answer a final quiz to unlock the game ending. This is to determine your 

      knowledge on the subject matter of the game after gameplay. To proceed with the quiz, click 

      the button below.

    </p>

    <br> 
    
    -->

    <!--<button  type="button" onclick="location.href='post-game-quiz'" id="start-button" class="start-button uppercase ff-serif text-dark bg-white">Start</button>-->
    
    
    <form method="POST" action="post-game-quiz.php" style="display: none;">
      <input type="text" name="postGamePlay" value="post-game-play"/>
      <button  type="submit" class="start-button uppercase ff-serif text-dark bg-white" id="start-button">Start</button>
    </form>

    <!--<br><br><br><br>
    
    END OF QUICK POST-GAME QUIZ MESSAGE -->

</div>

  </body>
  
  <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $('body').on('click', function(e) {
    changes = false; 
    var target, href;
    target = $(e.target);
    url ='';
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
          text: "Are you sure you want to leave this page? Your progress in the game will be lost if you have not saved it.",
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
            <?php $_SESSION['check_url'] = "gameplay.php"; ?>
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

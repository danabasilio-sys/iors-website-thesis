<?php

require_once 'init.php';

require_once 'db_conn.php';

require_once 'functions.php';

$username = $_SESSION['username'];

if(!isset($_SESSION['post_game_otp_error']) && !isset($_POST['resend-otp'])){
  
    if(isset($_POST['post-game-email']) && !empty($_POST['post-game-email'])){
      
      $_SESSION['check_url'] = "end-post-game.php";
      
      $email = validate($_POST['post-game-email']);
      $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
      if(!preg_match($regex, $email)){
        $_SESSION['post_game_email_error'] = 'Invalid Email';
        header("Location:end-post-game.php");
        exit();
      }
      if(strlen($email)>40){

        $_SESSION['post_game_email_error'] = 'Email length should not exceed 40 characters';
        header("Location: end-post-game.php");
        exit();
      }

      if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        
        if(!check_pre_game_email_exists($username,$email)){

          $_SESSION['post_game_email_error'] = 'This email does not match the previous email you inputted. Please try again.';

          header('location: end-post-game.php');

          exit();

        }else{
          //send email contain otp code
          $result = save_post_game_email($username,$email);
          if($result){
            $otp_code = generate_random_otp_code();
            if($otp_code){
              $result = '';
              $result = save_post_game_otp_for_username($username,$otp_code);
              if($result){
                $email = get_pre_game_email_for_username($username);
                send_otp($email,$username,$otp_code);
              }
            }
          } 
        }
      }else{
        $_SESSION['post_game_email_error'] = 'Email invalid';
        header('location: end-post-game.php');
      }
    }else{
      $_SESSION['post_game_email_error'] = 'Please provide email address to send OTP code';
      header('location: end-post-game.php');
    }

}

if(isset($_POST['resend-otp'])){
    $_SESSION['otp_code_sent'] = 'OTP code sent to email.';
    $otp_code = generate_random_otp_code();
    if($otp_code){
      $result = '';
      $result = save_post_game_otp_for_username($username,$otp_code);
      if($result){
        $email = get_pre_game_email_for_username($username);
        send_otp($email,$username,$otp_code);
        $_SESSION['otp_code_sent'] = 'OTP code sent to email.';
      }
    }
}

$_SESSION['check_url'] = "post-game-verification.php";

?>

<?php if(isset($_SESSION['user_id']) && intval($_SESSION['user_id']) > 0 && $_SESSION['check_url'] == "post-game-verification.php") { ?>

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

        <ul id="primary-navigation" data-visible="false" class="primary-navigation underline-indicators flex">

            <li><a class="ff-sans-cond uppercase text-white letter-spacing-2" href="index.html"><span aria-hidden="true">00</span>Home</a>

            <li><a class="ff-sans-cond uppercase text-white letter-spacing-2" href="characters.html"><span aria-hidden="true">01</span>Characters</a>

            <li class="active"><a class="ff-sans-cond uppercase text-white letter-spacing-2" href="game.php"><span aria-hidden="true">02</span>Game</a>

            <li><a class="ff-sans-cond uppercase text-white letter-spacing-2" href="about.html"><span aria-hidden="true">03</span>About</a>

        </ul>

    </nav>

  </header>



  <div id="end" class="container-quick-quiz flex-center flex-column">

      <h2 class="fs-700 ff-serif uppercase flex-center flex-column">ONE-TIME PIN CODE SENT</h2>

      <p>The one-time PIN code has been sent to your email address. Please enter it below to proceed.

      </p>

      <br>

      

      <form action="game-ending.php" method="post" class="fs-400 ff-sans-cond letter-spacing-3 uppercase">

        <div style="color:red"><?php echo isset($_SESSION['post_game_otp_error']) ? $_SESSION['post_game_otp_error'] :''; 

          unset($_SESSION['post_game_otp_error']); ?></div>

          <label for="post-game-otp">One-time PIN code</label><br><br>

          <input type="text" id="post-game-otp" name="post-game-otp" placeholder="TYPE HERE" required><br>

          <br>

          <button type="submit" class="verify-button uppercase ff-serif text-dark bg-white">Verify</button>

      </form>

      <form action="post-game-verification" method="post" class="fs-400 ff-sans-cond letter-spacing-3 uppercase">

              <input type="hidden" name="resend-otp" value="true"/>

               <div style="color:green"><?php echo isset($_SESSION['otp_code_sent']) ? $_SESSION['otp_code_sent'] :''; 

          unset($_SESSION['otp_code_sent']); ?></div>

              <button type="submit" class="verify-button uppercase ff-serif text-dark bg-white">Resend OTP</button>

       </form>

       <br><br><br><br>

  </div>

  <!--<script src="end-pre-game.js"></script>-->

  </body>
  
  <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $('body').on('click', function(e) {
    changes = false; 
    url = '';
    var target, href;
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
            <?php $_SESSION['check_url'] = "post-game-verification.php"; ?>
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

</html>

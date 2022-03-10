<?php

require_once 'init.php';

require_once 'db_conn.php';

require_once 'functions.php';
foreach($_SESSION as $key=> $value){
  if($key != "username_error"){
    unset($_SESSION[$key]);
  }
}
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



</head>



<body class="game-quick-quiz">

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



  <div class="container-quick-quiz">

    <h2 class="fs-700 ff-serif uppercase flex-center flex-column">Quick Pre-Game Quiz</h2>

    <p>You need to answer a quiz to unlock this game. This is to determine your pre-existing

    knowledge on the subject matter of the game. To proceed with the quiz, please fill out

    the necessary information below.</p>

    <br>



    <form action="pre-game-quiz.php" method="POST" class="fs-400 ff-sans-cond letter-spacing-3 uppercase">

      <div style="color:red"><?php echo isset($_SESSION['username_error']) ? $_SESSION['username_error']: '';

      unset($_SESSION['username_error']);

      ?></div>

      <label for="username">Username*</label><br><br>

      <input type="text" id="username" name="username" placeholder="TYPE HERE" required maxlength="30"><br><br>



      <label for="age">Age*</label><br><br>

      <select name="age" class="select fs-400 ff-sans-cond letter-spacing-3 uppercase" required>

        <option selected hidden value="">Select category</option>

        <option value="14 and below">14 and below</option>

        <option value="15-19">15-19</option>

        <option value="20-24">20-24</option>

        <option value="25-29">25-29</option>

        <option value="30-34">30-34</option>

        <option value="35-39">35-39</option>

        <option value="40-44">40-44</option>

        <option value="45-49">45-49</option>

        <option value="50-54">50-54</option>

        <option value="55-59">55-59</option>

        <option value="60-64">60-64</option>

        <option value="65 and above">65 and above</option>

      </select>



      <br><br>



      <label for="gender">Gender*</label><br><br>

      <select name="gender" class="select fs-400 ff-sans-cond letter-spacing-3 uppercase" required>

        <option selected hidden value="">Select category</option>

        <option value="M">Male</option>

        <option value="F">Female</option>

        <option value="N">Nonbinary</option>

      </select>

      <br><br>



      <label for="race">Race*</label><br><br>

      <select name="race" class="select fs-400 ff-sans-cond letter-spacing-3 uppercase" required>

        <option selected hidden value="">Select category</option>

        <option value="White">White</option>

        <option value="Asian">Asian</option>

        <option value="Latino">Latino</option>

        <option value="Black">Black</option>
        
        <option value="Mixed">Mixed</option>

      </select>

      <br><br>
      <button type="submit" class="verify-button uppercase ff-serif text-dark bg-white" value="Proceed">Proceed</button>

      <br><br><br><br>



    </form>



  </div>

</body>

</html>

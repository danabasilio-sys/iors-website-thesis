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

  <title>In Our Red Stilettos | Home</title>

  <script src="navigation.js" defer></script>

</head>

<body class="home">

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

  

  <main id="main" class="grid-container grid-container--home">

    <div>

      <h1 class="text-accent fs-500 ff-sans-cond uppercase letter-spacing-1">In our red

      <span class="d-block fs-700 ff-serif text-white">Stilettos</span></h1>

      

      <p>It's easy to say racial and gender discrimination don't exist in the workplace

        when you've never experienced them firsthand, but what happens when you find yourself 

        in a simulation that puts you in the shoes of 4 different women who may or may not be

        forced to deal with it?</p>

    </div>

    <div>

      <a href="game" class="large-button uppercase ff-serif text-dark bg-white">Play</a>

    </div>

  </main>

</body>

</html>

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

  <title>In Our Red Stilettos | Characters</title>

  <script src="navigation.js" defer></script>

  <script src="tabs.js" defer></script>

</head>



<body class="characters">

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

  

  <main id="main" class="grid-container grid-container--characters flow">

    <h1 class="numbered-title"><span aria-hidden="true">01</span> Meet the characters</h1>

    

    <picture id="white-image">

      <source srcset="assets/characters/image-white.webp" type="image/webp">

      <img src="assets/characters/image-white.png" alt="white">

    </picture>

    <picture hidden id="asian-image">

      <source srcset="assets/characters/image-asian.webp" type="image/webp">

      <img src="assets/characters/image-asian.png" alt="asian">

    </picture>

    <picture hidden id="latina-image">

      <source srcset="assets/characters/image-latina.webp" type="image/webp">

      <img src="assets/characters/image-latina.png" alt="latina">

    </picture>

    <picture hidden id="black-image">

      <source srcset="assets/characters/image-black.webp" type="image/webp">

      <img src="assets/characters/image-black.png" alt="black">

    </picture>

    

    

    <div class="tab-list underline-indicators flex" role="tablist" aria-label="characters list">

        <button aria-selected="true" role="tab" aria-controls="white-tab" class="uppercase ff-sans-cond text-accent letter-spacing-2" tabindex="0" data-image="white-image">Amanda</button>

        <button aria-selected="false" role="tab" aria-controls="asian-tab" class="uppercase ff-sans-cond text-accent letter-spacing-2" tabindex="-1" data-image="asian-image">Shinobu</button>

        <button aria-selected="false" role="tab" aria-controls="latina-tab" class="uppercase ff-sans-cond text-accent letter-spacing-2" tabindex="-1" data-image="latina-image">Salomé</button>

        <button aria-selected="false" role="tab" aria-controls="black-tab" class="uppercase ff-sans-cond text-accent letter-spacing-2" tabindex="-1" data-image="black-image">Willow</button>

    </div>



    <!-- Amanda -->

    <article class="characters-info flow" id="white-tab" tabindex="0" role="tabpanel">

      <h2 class="fs-800 uppercase ff-serif">Amanda</h2>



      <p>For the most part, life has been a bed of roses for Amanda—a king size bed, to be exact.

        Growing up with an influential family and having opportunities left and right—one might

        say she is the poster girl of privilege.

        <br><br>

        So when she arbitrarily decides to study IT in university and finds herself applying for

        a job in the industry alongside multiple brilliant candidates who come from humble origins, 

        she soon realizes that her sense of normalcy is but a far-fetched luxury to the people around her.

      </p>

      

      <div class="characters-meta flex">

        <div>

          <h3 class="text-accent fs-200 uppercase">Age</h3>

          <p class="ff-serif uppercase">24</p>

        </div>

        <div>

          <h3 class="text-accent fs-200 uppercase">Hometown</h3>

          <p class="ff-serif uppercase">Los Angeles, California</p>

        </div>

      </div>

    </article>

    

    <!-- Shinobu -->

    <article hidden class="characters-info flow" id="asian-tab" tabindex="0"  role="tabpanel">

      <h2 class="fs-800 uppercase ff-serif">Shinobu</h2>



      <p>Having been raised in a relatively homogeneous society and trying to make it big on the

        opposite side of the world where the population is as heterogeneous as it can get, Graphic

        Design fresh graduate Shinobu has her first taste of culture shock.

        <br><br>

        With this divergence of cultural values and attitudes comes further eye-opening encounters

        that push her to challenge stereotypes—something she has never had to do back home.

      </p>

      

      <div class="characters-meta flex">

        <div>

          <h3 class="text-accent fs-200 uppercase">Age</h3>

          <p class="ff-serif uppercase">22</p>

        </div>

        <div>

          <h3 class="text-accent fs-200 uppercase">Hometown</h3>

          <p class="ff-serif uppercase">Sapporo, Hokkaido</p>

        </div>

      </div>

    </article>

    

    <!-- Salome -->

    <article hidden class="characters-info flow" id="latina-tab" tabindex="0"  role="tabpanel">

      <h2 class="fs-800 uppercase ff-serif">Salomé</h2>

      <p>Becoming a single mother while struggling to pay off her student loans was the last thing

        on Salomé's bucket list, yet fate had a humorous way of making it the first to come true.

        <br><br>

        After finishing a Master's degree in Business Administration in hopes of finally securing

        a stable job, she realizes that sometimes dreams should be put on hold to make ends meet

        when circumstances become too unpredictable.

      </p>

      <div class="characters-meta flex">

        <div>

          <h3 class="text-accent fs-200 uppercase">Age</h3>

          <p class="ff-serif uppercase">26</p>

        </div>

        <div>

          <h3 class="text-accent fs-200 uppercase">Hometown</h3>

          <p class="ff-serif uppercase">Niterói, Rio de Janeiro</p>

        </div>

      </div>

    </article>

    

    <!-- Willow -->

    <article hidden class="characters-info flow" id="black-tab" tabindex="0"  role="tabpanel">

      <h2 class="fs-800 uppercase ff-serif">Willow</h2>



      <p>Throughout life, Willow never quite knew if she attracted challenges or challenges attracted her. Either

        way, one thing was for sure: she loved proving people wrong and killing them with success,

        having graduated from university with Latin honors.

        <br><br>

        As someone who has always had a knack for

        problem solving, her pursuing a career in IT seemed like it was written in the stars. 

        <br><br>

        That is—until she realizes that software bugs are not the only challenging problems she should

        be concerned about in the corporate world.

      </p>

      

      <div class="characters-meta flex">

        <div>

          <h3 class="text-accent fs-200 uppercase">Age</h3>

          <p class="ff-serif uppercase">24</p>

        </div>

        <div>

          <h3 class="text-accent fs-200 uppercase">Hometown</h3>

          <p class="ff-serif uppercase">Jackson, Mississippi</p>

        </div>

      </div>

    </article>

  </main>

  

<body>





  

</body>

</html>

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

  <title>In Our Red Stilettos | About</title>

  <script src="navigation.js" defer></script>

  <script src="tabs.js" defer></script>

  <!-- IMAGES STYLING FOR DESKTOP
  
  <style>
    
  #game-image {
    
    margin-bottom: 60px;
    
  }
  
  #campaign-image {
    
    margin-bottom: 110px;
    
  }
    
  </style>
  
  
  END OF IMAGES STYLING FOR DESKTOP -->


</head>



<body class="about">

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



  <main id="main" class="grid-container grid-container--about flow">

    <h1 class="numbered-title"><span aria-hidden="true">03</span> The game, campaign & developers</h1>

    

    <div class="dot-indicators flex" role="tablist" aria-label="about member list">

      <button aria-selected="true" aria-controls="game-tab" role="tab" data-image="game-image" tabindex="0">1<span class="sr-only">The game</span></button>

      <button aria-selected="false" aria-controls="campaign-tab" role="tab" data-image="campaign-image" tabindex="-1">2<span class="sr-only">The developers</span></button>

      <button aria-selected="false" aria-controls="devs-tab" role="tab" data-image="devs-image" tabindex="-1">3<span class="sr-only">The campaign</span></button>

    </div>

    

    <!-- the game -->

    <article class="about-details flow" id="game-tab" role="tabpanel" tabindex="0">

      <header class="flow flow--space-small">

        <h2 class="fs-500 ff-sans-cond letter-spacing-3 uppercase">About the</h2>

        <p class="fs-700 uppercase ff-serif">Game</p>

      </header>

      <p>In Our Red Stilettos is an interactive storytelling game that follows
        
        the consecutive, intertwined stories of Amanda, Salomé, Shinobu, and Willow
        
        as they navigate their way through adulthood and strive to climb the corporate

        ladder.

        <br><br>

        They are soon faced with the unjust implications of their race and gender on career prospects,

        and are brought up to speed with how the biases and prejudices fueling such discrimination

        are more prevalent in the workforce than they thought.

        <br><br>

        The events and outcomes that subsequently unfold depend on the choices that the player makes

        throughout the game.</p>

    </article> 

    

    <!-- the campaign -->

    <article hidden class="about-details flow" id="campaign-tab" role="tabpanel" tabindex="0">

      <header class="flow flow--space-small">

        <h2 class="fs-500 ff-sans-cond letter-spacing-3 uppercase">About the</h2>

        <p class="fs-700 uppercase ff-serif">Campaign</p>

      </header>

      <p>In Our Red Stilettos is a project that aims to raise awareness on the distinctive experiences of 

        racial and gender discrimination that women of diverse backgrounds are subjected to in the workplace

        by means of a compelling educational video game. 

        <br><br>

        <!--What makes this project innovative is its intention to leverage the combined informative power

        of websites and games in a society that has become predominantly digitized, which is a circumstance

        that traditional forms of social campaigning fail to take advantage of. 

        <br><br>-->

        This project implements a vicarious learning approach — a conscious process that allows players

        to learn from the experience of others through story immersion, making it easier for them

        to empathize with the types of women represented by the characters whose stories they would be

        playing through.

        <br><br>

        <!--The situational perspective that players are given would allow them to comprehend the

        characters’ feelings and general sentiment towards their fictitious encounters in the game on a

        deeper level, with said encounters designed to mimic those faced by women of color in real life as

        closely as possible.

        <br><br>-->

        Players will take a quiz to test their knowledge on the topic prior to and after playing the game

        to determine the effectiveness of the project.</p>

    </article>



     <!-- the devs -->

     <article hidden class="about-details flow" id="devs-tab" role="tabpanel" tabindex="0">

      <header class="flow flow--space-small">

        <h2 class="fs-500 ff-sans-cond letter-spacing-3 uppercase">About the</h2>

        <p class="fs-700 uppercase ff-serif">Developers</p>

      </header>

      <p>The developers are 4th-year students in their final term of college 

        pursuing a Bachelor of Science degree in Information Technology with specialization in Web Development.

      </p>

    </article>



    <!-- extra

    <article hidden class="about-details flow" id="about-tab" role="tabpanel" tabindex="0">

      <header class="flow flow--space-small">

        <h2 class="fs-600 ff-serif uppercase">About</h2>

        <p class="fs-700 uppercase ff-serif">Something</p>

      </header>

      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt 

        ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 

        laboris nisi ut aliquip ex ea commodo consequat.</p>

    </article>

  -->



    <picture id="game-image" class="aboutgame">

      <source srcset="assets/about/about-game-img.webp" type="image/webp">

      <img src="assets/about/about-game-img.png" alt="The Game">

    </picture>



    <picture hidden id="campaign-image" class="aboutcampaign">

      <source srcset="assets/about/about-campaign-img.webp" type="image/webp">

      <img src="assets/about/about-campaign-img.png" alt="The Campaign">

    </picture>



    <picture hidden id="devs-image">

      <source srcset="assets/about/about-devs-img.webp" type="image/webp">

      <img src="assets/about/about-devs-img.png" alt="The Devs">

    </picture>



    <!--

    <picture hidden id="about-image">

      <source srcset="assets/about/image-anousheh-ansari.webp" type="image/webp">

      <img src="assets/about/image-anousheh-ansari.png" alt="Douglas Hurley">

    </picture>

    -->



  </main>

  <br><br>

</body>

</html>

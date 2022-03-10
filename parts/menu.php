<?php 

require_once 'init.php';



$request = explode('/', $_SERVER['REQUEST_URI']);

$page = end($request);



$game_in = in_array($page, array('pre-game-quiz.php','end-pre-game.php','pre-game-verification.php','gameplay.php','post-game-quiz.php','end-post-game.php'));



?>



<ul id="primary-navigation" data-visible="false" class="primary-navigation underline-indicators flex">

	<li class="<?php echo empty($page) ? 'active' : ''; ?>"><a class="ff-sans-cond uppercase text-white letter-spacing-2" href="/"><span aria-hidden="true">00</span>Home</a>

    <li class="<?php echo $page=='characters.php' ? 'active' : ''; ?>"><a class="ff-sans-cond uppercase text-white letter-spacing-2" href="characters.php"><span aria-hidden="true">01</span>Characters</a>

    <li class="<?php echo ($page=='game.php' || $game_in) ? 'active' : ''; ?>"><a class="ff-sans-cond uppercase text-white letter-spacing-2" href="<?php if(isset($_SESSION['check_url']) && $_SESSION['check_url'] == "gameplay.php"){echo "gameplay.php";}else{echo "game.php"; }?>"><span aria-hidden="true">02</span>Game</a>

    <li class="<?php echo $page=='about.php' ? 'active' : ''; ?>"><a class="ff-sans-cond uppercase text-white letter-spacing-2" href="about.php"><span aria-hidden="true">03</span>About</a>

</ul>


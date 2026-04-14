<?php session_start(); ?>
<?php if(file_exists('./logicals/'.$find['file'].'.php')) { include("./logicals/{$find['file']}.php"); } ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?= $pagetitle['title'] . ( (isset($pagetitle['motto'])) ? ('|' . $pagetitle['motto']) : '' ) ?></title>
	<link rel="stylesheet" href="./styles/style.css" type="text/css">
	<?php if(file_exists('./styles/'.$find['file'].'.css')) { ?><link rel="stylesheet" href="./styles/<?= $find['file']?>.css" type="text/css"><?php } ?>
</head>
<body>
    <?php
    $isLoggedIn = isset($_SESSION['login']) && $_SESSION['login'] !== '';
    $headerLoginLine = '';
    if ($isLoggedIn) {
        $lastName = isset($_SESSION['ln']) ? trim((string) $_SESSION['ln']) : '';
        $firstName = isset($_SESSION['fn']) ? trim((string) $_SESSION['fn']) : '';
        $username = trim((string) $_SESSION['login']);
        $fullName = trim($lastName . ' ' . $firstName);
        $headerLoginLine = ($fullName !== '' ? $fullName : 'User') . ' (' . $username . ')';
    }
    ?>
	<header>
		<img src="./images/<?=$header['imagesource']?>" alt="<?=$header['imagealt']?>">
		<h1><?= $header['title'] ?></h1>
		<?php if (isset($header['motto'])) { ?><h2><?= $header['motto'] ?></h2><?php } ?>
		<?php if($isLoggedIn) { ?>Logged-in: <strong><?= htmlspecialchars($headerLoginLine, ENT_QUOTES, 'UTF-8') ?></strong><?php } ?>
	</header>
    <div id="wrapper">
        <nav id="main-nav" aria-label="Main navigation">
            <ul>
				<?php foreach ($pages as $url => $page) { ?>
					<?php
                    $visibleForLoggedOut = !empty($page['menun'][0]);
                    $visibleForLoggedIn = !empty($page['menun'][1]);
                    $showMenuItem = (!$isLoggedIn && $visibleForLoggedOut) || ($isLoggedIn && $visibleForLoggedIn);
                    if($showMenuItem) {
                    ?>
						<li<?= (($page == $find) ? ' class="active"' : '') ?>>
						<a href="<?= ($url == '/') ? '.' : $url ?>">
						<?= $page['text'] ?></a>
						</li>
					<?php } ?>
				<?php } ?>
            </ul>
        </nav>
        <main id="content">
            <section>
            <?php include("./templates/pages/{$find['file']}.tpl.php"); ?>
            </section>
        </main>
    </div>
    <footer>
        <?php if(isset($footer['copyright'])) { ?>&copy;&nbsp;<?= $footer['copyright'] ?> <?php } ?>
		&nbsp;
        <?php if(isset($footer['firm'])) { ?><?= $footer['firm']; ?><?php } ?>
    </footer>
</body>
</html>


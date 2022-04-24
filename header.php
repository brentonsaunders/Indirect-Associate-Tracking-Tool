<?php
require_once 'constants.php';
?>
<!DOCTYPE html>
<?php
$hideMenuClass = '';

if(isset($hideMenu) && $hideMenu) {
    $hideMenuClass = ' hide-menu';
}
?>
<html>
    <head>
        <title>Indirect Associate Self-Tracker Tool</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="<?php echo SITE_ROOT; ?>/js/jquery-3.6.0.min.js"></script>
        <script src="<?php echo SITE_ROOT; ?>/js/qr_packed.js"></script>
        <script src="<?php echo SITE_ROOT; ?>/js/index.js"></script>
        <link rel="stylesheet" href="<?php echo SITE_ROOT; ?>/css/index.css">
    </head>
    <body>
        <div class="wrapper<?php echo $hideMenuClass; ?>">
            <header>
                <div id="menu-button">
                    <div><div></div><div></div><div></div></div>
                </div>
                <div id="title">Indirect Associate Self-Tracker</div>
                <nav>
                    <ul>
                        <li><a href="<?php echo SITE_ROOT; ?>/dashboard/">Home</a></li>
                        <li><a href="<?php echo SITE_ROOT; ?>/dashboard/find-associate.php">Find Associate</a></li>
                    </ul>
                    <div id="copyright">&copy; <a href="mailto:brentonasaunders@gmail.com">2022 Brenton Saunders (saubrent) &nearr;</a></div>
                </nav>
            </header>
            <main>
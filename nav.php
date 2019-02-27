<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="box">
    <header class="header">
        <div class="logo">
            <span>- _ -</span>
        </div>
        <nav class="header_nav">
            <?php
                if (isset($_SESSION['username'])) {
                    echo '<ul class="header_nav-menu">';
                    echo '<li><a href="index.php">Головна</a></li>' . '<li><a href="profile.php">Профіль</a></li>' .
                            '<li><a href="chat.php">Чат</a></li>' . '<li><a href="logout.php">Вийти ( ' . $_SESSION['username'] . ' )</a></li>';
                    echo '</ul>';
                } else {
                    echo '<ul class="header_nav-menu">';
                    echo '<li><a href="index.php">Головна</a></li>' . '<li><a href="sing_in.php">Увійти</a></li>' . '<li><a href="registration.php">Зареєструватися</a></li>';
                    echo '</ul>';
                }
            ?>
        </nav>
    </header>
    <div class="content">

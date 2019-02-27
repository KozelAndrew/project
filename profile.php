<?php
    require_once('db_conect/db_conect.php');
    require_once('sessions_start.php');
    $title = 'Профіль';
    require_once('nav.php');
    if (!isset($_SESSION['user_id'])) {
        echo '<p class="login">Щоб перейти до профіля, спочатку <a href="sing_in.php">увійдіть</a> на сайт.</p>';
        exit();
    }
    require_once('nav.php');
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $query = "SELECT username, first_name, last_name FROM chat_user WHERE user_id = '" . $_SESSION['user_id'] . "'";
    $data = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($data);
    echo '<table class="table">';
    if (!empty($row['username'])) {
        echo '<tr><td class="label">Логін:</td><td>' . $row['username'] . '</td></tr>';
    } else {
        echo '<tr><td class="label">Логін не відомий</td></tr>';
    }
    if (!empty($row['first_name'])) {
        echo '<tr><td class="label">Прізвище: </td><td>' . $row['first_name'] . '</td></tr>';
    } else {
        echo '<tr><td class="label">Прізвище не відоме</td></tr>';
    }
    if (!empty($row['last_name'])) {
        echo '<tr><td class="label">Ім\'я: </td><td>' . $row['last_name'] . '</td></tr>';
    } else {
        echo '<tr><td class="label">Ім\'я не відоме</td></tr>';
    }
    echo '</td></tr>';
    echo '</table>';
    mysqli_close($dbc);
    require_once('footer.php');
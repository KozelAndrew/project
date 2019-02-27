<?php
    require_once('db_conect/db_conect.php');
    require_once('sessions_start.php');
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if (isset($_POST['submit'])) {
        $msg = mysqli_real_escape_string($dbc, trim($_POST['msg']));
        $user_id = $_SESSION['user_id'];
        $user_name = $_SESSION['username'];
        if (!empty($msg)) {
            $query = "INSERT INTO chat_mgs (user_id, username, date, msg) VALUES ('$user_id', '$user_name', NOW(), '$msg')";
            $data = mysqli_query($dbc, $query);
            $msg = "";
            mysqli_close($dbc);
        } else {
            echo '<p class="error">Введіть повідомлення</p>';
        }
    }
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/chat.php';
    header('Location: ' . $home_url);
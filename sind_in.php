<?php
    require_once('db_conect/db_conect.php');
    $title = 'Вхід';
    require_once 'sessions_start.php';
    require_once 'nav.php';
    $error_msg = "";

    if (!isset($_SESSION['user_id'])) {
        if (isset($_POST['submit'])) {
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
            $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));
            if (!empty($user_username) && !empty($user_password)) {
                $query = "SELECT user_id, username FROM chat_user WHERE username = '$user_username'" .
                        "AND password = SHA('$user_password')";
                $data = mysqli_query($dbc, $query);
                if (mysqli_num_rows($data) == 1) {
                    $row = mysqli_fetch_array($data);
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['username'] = $row['username'];
                    setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 30));
                    setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30));
                    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/profile.php';
                    header('Location: ' . $home_url);
                } else {
                    $error_msg = 'Не вірний логін чи пароль';
                }
            } else {
                $error_msg = 'Введіть логін і пароль';
            }
        }
    }
    if (empty($_SESSION['user_id'])) {
        echo '<p class="error">' . $error_msg . '</p>';
    }
?>
    <form class="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"><br/>
        <legend>Вхід</legend>
        <br/>
        <label for="username">Логін</label><br/>
        <input type="text" id="username" name="username"><br/>
        <label for="password">Пароль</label><br/>
        <input type="password" id="password" name="password"><br/>
        <input type="submit" name="submit" value="Увійти"><br/>
    </form>
<?php
    require_once('footer.php');

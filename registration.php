<?php
    require_once('db_conect/db_conect.php');
    $title = 'Реєстрація';
    require_once 'nav.php';
    $error_msg = "";
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (isset($_POST['submit'])) {
        $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
        $first_name = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
        $last_name = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
        $password = mysqli_real_escape_string($dbc, trim($_POST['password']));
        $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));

        if (!empty($username) && !empty($first_name) && !empty($last_name) && !empty($password)
                && !empty($password1) && $password == $password1) {
            $query = "SELECT * FROM chat_user WHERE username = '$username'";
            $data = mysqli_query($dbc, $query);

            if (mysqli_num_rows($data) == 0) {
                $query = "INSERT INTO chat_user (username, password, first_name, last_name) VALUES ('$username', SHA('$password'), '$first_name', '$last_name')";
                $date = mysqli_query($dbc, $query);
                echo 'Ви зареєструвалися як ' . $username . ' Відредагуйте свій <a href="profile.php">профіль</a>';
                mysqli_close($dbc);
            } else {
                $error_msg = 'Даний логін зайнятий, виберіть інший';
                $username = "";
                $password = "";
                $password1 = "";
            }
        } else {
            $error_msg = 'Введіть всі дані. Переконайтися що паролі співпадають';
        }
    }
    mysqli_close($dbc);
    if (empty($_SESSION['user_id'])) {
        echo '<p class="error">' . $error_msg . '</p>';
    }
?>
    <form class="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <legend> Реєстрація</legend>
        <br/>
        <label for="username">Логін</label> <br/>
        <input type="text" id="username" name="username"> <br/>
        <label for="first-name">Ім'я</label> <br/>
        <input type="text" id="first-name" name="first_name"> <br/>
        <label for="last-name">Прізвище</label> <br/>
        <input type="text" id="last-name" name="last_name"> <br/>
        <label for="password">Пароль</label> <br/>
        <input type="password" id="password" name="password"> <br/>
        <label for="password1">Повторіть пароль</label> <br/>
        <input type="password" id="password1" name="password1"> <br/>
        <input type="submit" name="submit" value="Зареєструватися"> <br/>
    </form>
<?php
    require_once('footer.php');

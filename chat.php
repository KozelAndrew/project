<?php
    require_once('db_conect/db_conect.php');
    require_once('sessions_start.php');
    $title = 'Чат';
    require_once('nav.php');
    if (!isset($_SESSION['user_id'])) {
        echo '<p class="login">Щоб перейти до чату, спочатку <a href="sing_in.php">увійдіть</a> на сайт.</p>';
        exit();
    }
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $query = "SELECT user_id, username, date, msg FROM chat_mgs ORDER BY date DESC";
    $data = mysqli_query($dbc, $query);
    echo '<div class="msg">';
    $i = 0;
    while ($row = mysqli_fetch_array($data)) {
        if ($row['user_id'] == $_SESSION['user_id']) {
            echo '<p align="right" class="you">' . $_SESSION['username'] . '<br />' . htmlspecialchars($row['msg']) . '</p><br/ >';
        } else {
            echo '<p class="friend">' . $row['username'] . '<br />' . htmlspecialchars($row['msg']) . '</p></p><br/ >';
        }
        $i++;
    }
    echo '</div>';
?>
    <form class="form" method="post" action="msg.php">
        <label for="msg">Повідомлення</label><br/>
        <input type="text" id="msg" name="msg"> <br/>
        <input type="submit" name="submit" value="Відправити">
    </form>

<?php
    require_once('footer.php');
<?php
session_start();
require_once __DIR__ . '/inc/functions.php';
include __DIR__ . '/inc/header.php';
?>
<form method='post' action='login.php'>
    <p>
        <label for="username">ユーザ名</label>
        <input type='text' name='username'>
    </p>
    <p> <label for="password">パスワード</label>
        <input type='password' name='password'>
    </p>
    <input type='submit' value='送信する'>
</form>

<?php
if (!empty($_SESSION['login'])) {
    echo "ログイン済みです<br>";
    echo "<a href=index.php>リストに戻る</a>";
    exit;
}

if ((empty($_POST['username'])) || (empty($_POST['password']))) {
    echo "ユーザ名、パスワードを入力してください";
    exit;
}

try {
    $dbh = db_open();
    $sql = "SELECT password FROM users WHERE username=:username";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":username", $_POST['username'], PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        echo "ログインに失敗しました";
        exit;
    }
    if (password_verify($_POST['password'], $result['password'])) {
        session_regenerate_id(true);
        $_SESSION['login'] = true;
        header("Location:index.php");
    } else {
        echo 'ログインに失敗しました(2)';
    }
} catch (PDOException $e) {
    echo "エラー！！！:" . str2html($e->getMessage());
    exit;
}

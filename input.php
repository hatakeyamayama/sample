<?php
session_start();
$token = bin2hex(random_bytes(20));
$_SESSION['token']=$token;
?>

<?php require_once __DIR__ . '/login_check.php'; ?>
<?php include __DIR__ . '/inc/header.php'; ?>

<form action='add.php' method='post'>
    <p>
        <label for='title'> タイトル（必須・20文字まで）:</label>
        <input type='text' name='title' maxlength="20" required="required">
    </p>
    <p>
        <label for='isbn'>ISBN（13 桁までの数字）:</label>
        <input type='number' name='isbn' max="9999999999999" required="required">
    </p>
    <p>
        <label for='price'> 定価（6 桁までの数字）:</label>
        <input type='number' name='price' max="999999" required="required">
    </p>
    <p>
        <label for='published'> 出版日:</label>
        <input type='date' name='publish' required="required">
    </p>
    <p>
        <label for='author'> 著者（80 文字まで）:</label>
        <input type='text' name='author'>
    </p>
    <p class='button'>
        <input type='hidden' name='token' value='<?php echo $token ?>'>
        <input type='submit' value=' 送信する'>
    </p>
</form>
<?php include __DIR__ . '/inc/footer.php'; ?>
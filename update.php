<?php
//var_dump(__DIR__); //←phpの組み込み定数 このバーダンプで中身が見れる
//var_dump(__LINE__);//どれが目的の行番号かわからなくなる時にDIRと一緒に書くとわかりやすい
//var_dump(__FILE__);//ファイル名、パスが出てくる
//絶対パスで書く必要はなく、相対パスで書けます

require_once __DIR__.'/inc/functions.php'; //相対パスなら　inc/functions.php
include __DIR__.'/inc/error_check.php';
include __DIR__.'/inc/header.php';

if (empty($_POST['id'])) {
    echo "idを指定してください";
    exit;
}
if (!preg_match('/\A\d{0,11}\Z/u', $_POST['id'])) {
    echo "idが正しくありません";
    exit;
}
try {
    $dbh = db_open();

    $sql = "UPDATE books SET 
title=?,
isbn=?,
price=?,
publish=?,
author=?
WHERE id =?"; //idが?と等しい行のみが条件

    $stmt = $dbh->prepare($sql);
    //priceとidのキャストは不要
    $stmt->bindParam(1, $_POST['title'], PDO::PARAM_STR);
    $stmt->bindParam(2, $_POST['isbn'], PDO::PARAM_STR);
    $stmt->bindParam(3, $_POST['price'], PDO::PARAM_INT);
    $stmt->bindParam(4, $_POST['publish'], PDO::PARAM_STR);
    $stmt->bindParam(5, $_POST['author'], PDO::PARAM_STR);
    $stmt->bindParam(6, $_POST['id'], PDO::PARAM_INT);
    $stmt->execute();

    echo "データが更新されました<br>";
    echo "<a href='index.php'>リストへ戻る</a>";
} catch (PDOException $e) {
    echo "エラー！！" . str2html($e->getMessage()) . "<br>";
    exit;
}
?>
<?php include __DIR__.'/inc/footer.php';
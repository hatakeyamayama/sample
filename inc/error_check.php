<?php
if (empty($_POST['title'])) {
    echo "タイトルは必須です。";
    exit;
}
if (!preg_match('/\A[[:^cntrl:]]{1,20}\z/u', $_POST['title'])) {
    echo "タイトルは20文字までです。";
    exit;
}
if (!preg_match('/\A\d{0,13}\z/u', $_POST['isbn'])) {
    echo "ISBNは数字13桁までです。";
    exit;
}
if (!preg_match('/\A\d{0,6}\z/u', $_POST['price'])) {
    echo "価格は数字6桁までです。";
    exit;
}
if (empty($_POST['publish'])) {
    echo "日付は必須です。";
    exit;
}
if (!strtotime($_POST['publish'])) {
    echo "日付のフォーマットが違います。";
    exit;
}
$date = explode('-', $_POST['publish']);
if (!checkdate($date[1], $date[2], $date[0])) {
    echo "正しい日付を入力してください。";
    exit;
}
if (!preg_match('/\A[[:^cntrl:]]{0,80}\z/u', $_POST['author'])) {
    echo "著者名は80文字以内で入力して下さい";
    exit;
}
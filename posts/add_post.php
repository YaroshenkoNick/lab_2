<?php

$text = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);
$user = $_COOKIE['user'];
//addslashes  Возвращает строку с обратным слешом перед символами, которые нужно экранировать.
//file_get_contents() возвращает содержимое файла в строке, начиная с указанного смещения offset и до length байт

$mysql_posts = new mysqli('localhost', 'root', 'root', 'lab_2_nikita');
$mysql_posts->query("INSERT INTO `posts` (`user`,`text`, `likes`) VALUES ('$user', '$text', '0')");

header('Location: /lab_2_nikita/main.php');
?>

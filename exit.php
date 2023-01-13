<?php
    setcookie('user', $user['login'], time() - 3600, "/"); // удаляет куки
    header('Location: /lab_2_nikita/index.php'); // переадресация на главную страницу
?>

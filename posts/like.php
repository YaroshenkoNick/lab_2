<?php

$post_id = filter_var(trim($_POST['post_id']), FILTER_SANITIZE_STRING);

$mysql = new mysqli('localhost', 'root', 'root', 'login_form');
$mysql_user = $mysql->query("SELECT * FROM `users` WHERE login = '{$_COOKIE['user']}'");
$mysql_user = $mysql_user->fetch_assoc();
$user_id = $mysql_user['id'];

$mysql1 = new mysqli('localhost', 'root', 'root', 'lab_2_nikita');
$mysql_post = $mysql1->query("SELECT COUNT(*) as count FROM posts_like where id_post = $post_id ");
$mysql_post = $mysql_post->fetch_assoc();
$like_count = $mysql_post["count"];

$mysql2 = new mysqli('localhost', 'root', 'root', 'lab_2_nikita');
$mysql_date = $mysql2->query("SELECT * FROM posts_like WHERE id_post=$post_id AND id_user=$user_id");
$mysql_user = $mysql_date->fetch_assoc();


if($mysql_date -> num_rows > 0) {
    $like_count = $like_count - 1;

    $mysql2->query("DELETE FROM posts_like WHERE id_post = $post_id AND id_user = $user_id");
    $mysql1->query("UPDATE posts SET likes = $like_count WHERE id = $post_id");
    header('Location: /lab_2_nikita/main.php');

} else {
        $like_count = $like_count + 1;

        $mysql2->query("INSERT INTO posts_like (id_post, id_user) VALUES ($post_id, $user_id)");
        $mysql1->query("UPDATE posts SET likes = $like_count WHERE id = $post_id");
        header('Location: /lab_2_nikita/main.php');
}
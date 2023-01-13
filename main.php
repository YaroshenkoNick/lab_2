<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css?ver=<?php echo time()?>">
    <title>News</title>
</head>
<body>
    <div class="header">
        <div class="container">
            <div class="header__content">
                <p><?=$_COOKIE['user']?></p>
                <a href="/lab_2_nikita/exit.php">Exit</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="main__form">
            <form class="add__post__form" action="posts/add_post.php" method="post">
                <textarea placeholder="Введите текст" rows="4" cols="50" id="massage" name="message"  required="" ></textarea>
                <button class="offer__news" type="submit">Предложить новость</button>
            </form>
        </div>
    </div>



    <div class="main">
        <div class="container">
            <div class="main__content">
                <div class="news">
                    <?php
                    $connect = mysqli_connect('localhost', 'root', 'root', 'lab_2_nikita');
                    $mysql = mysqli_query($connect, "SELECT * FROM `posts` order by id desc");
                    $count = 0;

                    if($mysql->num_rows > 0) {
                        while ($row = $mysql->fetch_assoc()) {
                            if($count <= 100) {
                                $user = $row;
                                $user_id = $user['id'];
                                $user_id = (int)$user_id;

                                $post =  '
                                <div class="news__content">
                                    <h3 class="news__user">'.htmlspecialchars($user['user']).'</h3>
                                    <p class="news__text">'.htmlspecialchars($user['text']).'</p>
                                    <div class="feedback">
                                        <form action="posts/like.php" method="post">
                                            <input type="hidden" value="'.$user_id.'" name="post_id">
                                            <button type="submit" class="like" name="like">
                                                <img class="plus" src="images/pngwing.com.png">
                                                <p class="counter__like">'.htmlspecialchars($user['likes']).'</p>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            '."\n";

                                echo $post;
                                $comment = '';
                                $count++;
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>


</body>
</html>
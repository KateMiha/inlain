<?php
include_once('database/database.php');

//Подключение файлов запросов в БД
$create_bd = file_get_contents('database/create_bd.sql');
$create_table_articles = file_get_contents('database/create_table_articles.sql');
$create_table_comments = file_get_contents('database/create_table_comments.sql');
//Создание БД и таблиц
if ($mysqli->query($create_bd) === TRUE) {
    $mysqli->select_db('inlain');
    if (!$mysqli->query($create_table_articles) === TRUE) {
        echo "Ошибка создания таблиц: " . $mysqli->error ;
    }
    if (!$mysqli->query($create_table_comments) === TRUE) {
        echo "Ошибка создания таблиц: " . $mysqli->error ;
    }
} else {
    echo "Ошибка создания базы данных: " . $mysqli->error ;
}

//Выгрузка данных с ресурса
$url_articles = 'https://jsonplaceholder.typicode.com/posts';
$articles = json_decode(file_get_contents($url_articles));
$url_comments = 'https://jsonplaceholder.typicode.com/comments';
$comments = json_decode(file_get_contents($url_comments));

//Заргузка данных в БД
$mysqli->select_db('inlain');
for($i = 0;$i < count($articles);$i++){
    $id = $articles[$i]->id;
    $userId = $articles[$i]->userId;
    $title = $articles[$i]->title;
    $body = $articles[$i]->body;

    $mysqli-> query("
    INSERT INTO `articles`(`id`, `userId`, `title`, `body`)
    VALUES ('$id', '$userId', '$title', '$body' );
    ");
}
$count_articles = $i;
for($i = 0;$i < count($comments);$i++){
    $id = $comments[$i]->id;
    $postId = $comments[$i]->postId;
    $name = $comments[$i]->name;
    $email = $comments[$i]->email;
    $body = $comments[$i]->body;

$mysqli-> query("
    INSERT INTO `comments`(`id`, `postId`, `name`,`email`, `body`)
    VALUES ('$id','$postId','$name','$email','$body');
    ");
}
$count_comments = $i;

//Вывод результата в консоль
if (count($articles) === $count_articles && count($comments) === $count_comments){
    echo '<script>console.log("Загружено '.$count_articles .' статей и '.$count_comments .' комеентариев."); </script>';
}else{
    echo '<script>console.log("Загружены не все статьи и коментарии."); </script>';
}



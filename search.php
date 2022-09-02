<?php
include_once('database/database.php');
$mysqli->select_db('inlain');

$words = $_GET['text'];

$sql = "SELECT * FROM `comments` WHERE `body`  LIKE '%$words%'";
$result = $mysqli->query($sql);

$comments = [];
$postIs = [];
$arr = [];

foreach ($result as $a) {
    array_push($comments,$a);
    if(!in_array($a['postId'],$postIs)){
        array_push($postIs,$a['postId']);
    }
}

for($i = 0; $i < count($postIs); $i++){
    $sql = "SELECT * FROM `articles` WHERE `id` = '$postIs[$i]'";
    $result = $mysqli->query($sql);
    foreach ($result as $a) {
        $arr[$i]['postId'] = $a['id'];
        $arr[$i]['title'] = $a['title'];
    }
    for($b = 0; $b < count($comments);$b++){
        if($postIs[$i] === $comments[$b]['postId']){
            $arr[$i]['comments'][] = $comments[$b];
        }
    }
}

print_r(json_encode($arr,  JSON_UNESCAPED_SLASHES));



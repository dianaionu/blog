<?php

function getPublishedPosts() {
    global $conn;
    $query = 'SELECT * FROM posts WHERE published=true';
    $result = mysqli_query($conn, $query);
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $final_posts=[];
    foreach($posts as $post){
        $post['topic'] = getPostTopic($post['id']);
        array_push($final_posts, $post);
    }

    return $final_posts;
}

function getPostTopic($post_id){
    global $conn;
    $query = "SELECT * FROM topics WHERE id=(SELECT topic_id FROM post_topic WHERE post_id='$post_id') LIMIT 1";
    $result = mysqli_query($conn, $query);
    $topics = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $topics;
}


function getPublishedPostsByTopic($topic_id){
    global $conn;
    $query = "SELECT * FROM posts WHERE posts.id IN 
    (
        SELECT post_topic.post_id FROM post_topic 
        WHERE post_topic.topic_id = $topic_id
        GROUP BY post_topic.post_id 
        HAVING COUNT(1)=1
    )";

    $result = mysqli_query($conn, $query);
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $final_posts=[];
    foreach($posts as $post){
        $post['topic'] = getPostTopic($post['id']);
        array_push($final_posts, $post);
    }

    return $final_posts;

}

function getTopicNameById($id){
    global $conn;
    $query = "SELECT name FROM topics WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $topic = mysqli_fetch_all($result);
    return $topic[0][0];
}

function getPost($slug){
    global $conn;
    $query = "SELECT * FROM posts WHERE slug = '$slug' AND publisher=true";
    $result = mysqli_query($conn, $query);
    $post = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if($post){
        $post['topic'] = getPostTopic($post['id']);
    }
    return $post;
}
 
function getAllTopics(){
    global $conn;
    $query = "SELECT * FROM topics";
    $result = mysqli_query($conn, $query);
    $topics = mysqli_fetch_all($result);
    return $topics;
}
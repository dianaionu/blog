<?php

$errors = [];
$username = '';
$email = '';

// Registration
if(isset($_POST['reg_user'])) {
    $username = htmlspecialchars(trim($_POST['username'])); 
    $email = htmlspecialchars(trim($_POST['email'])); 
    $password_1 = htmlspecialchars(trim($_POST['password_1'])); 
    $password_2 = htmlspecialchars(trim($_POST['password_2'])); 

    if(empty($username)) {array_push($errors, 'Uhmm...We gonna need your username'); }
    if(empty($email)) {array_push($errors, 'Oops.. Email is missing'); }
    if(empty($password_1)) {array_push($errors, 'uh-oh you forgot the password'); }
    if($password_1 !== $password_2) {array_push($errors, 'The two passwords do not match'); }

    $user_check_query = "SELECT * FROM users WHERE username = '$username' or email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if($user) {
        if($user['username'] === $username) {
            array_push($errors, 'Username have already existed');
        }

        if($user['email'] === $email) {
            array_push($errors, 'Email have already existed');
        }
    }
    var_dump($errors);
    if(count($errors) == 0 ) {
        $password  = md5($password_1 . 'test');

        $query = "INSERT INTO users (username, email, password, created_at, updated_at) 
            VALUES($username, $email, $password, now(), now())";

        mysqli_query($conn, $query);
        
        $reg_user_id = mysqli_insert_id($conn);
        $test = getUserById($reg_user_id);
        $_SESSION['user'] = getUserById($reg_user_id);
        
        var_dump($test);

    }
}

// functions
function getUserById($id) {
    global $conn;
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    return $user;
}
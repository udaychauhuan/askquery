<?php

session_start();
include("include/classloader.php");
//isset($_SESSION['askquery_userid']);

$login = new Login();
$user_data = $login->check_login($_SESSION['askquery_userid']);

if (isset($_SERVER['HTTP_REFERER'])) {
    # code...
    $return_to = $_SERVER['HTTP_REFERER'];
} else {
    $return_to = "profile.php";
}
if (isset($_GET['type']) && isset($_GET['id'])) {
    # code...
    if (is_numeric($_GET['id'])) {
        # code...
        $allowed[] = 'post';
        $allowed[] = 'user';
        $allowed[] = 'comment';

        if (in_array($_GET['type'], $allowed)) {
            # code...
            $post = new Post();
            $user_class = new User();
            $post->like_post($_GET['id'], $_GET['type'],$_SESSION['askquery_userid']);

            if ($_GET['type']== "user") {
                $user_class->follow_user($_GET['id'], $_GET['type'], $_SESSION['askquery_userid']);
            }
        }
    }
}
header("location: " . $return_to);
die;

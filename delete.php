<?php

session_start();
            
if(!$_SESSION['user']) {
    header("location: login.php");
}
include 'class.php';
$id = $_GET['id'];
$index = $user->find_index($id);
$users = $user->fetch();

if (file_exists("upload/".$users[$index]['avatar']))
    {

        unlink("upload/".$users[$index]['avatar']);
    }

$user->delete($users,$id);
header("location: users.php");


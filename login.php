<?php
include ("init.php");
use Models\Auth;
session_start();

$template = $mustache->loadTemplate('login.mustache');
echo $template->render();

try {
    if(isset($_POST['email'])){
        //var_dump($_POST['email'], $_POST['password']);
        $faculty_auth = new Auth();
        $faculty_auth->setConnection($connection);
        $faculty_auth = $faculty_auth->login($_POST['email'], $_POST['password']);
        // var_dump($faculty_auth);
        $user_id = $faculty_auth[0];
        $_SESSION['user_id'] = $user_id;
        //var_dump($user_id);
        if($faculty_auth != NULL){
            echo "<script>window.location.href='index.php';</script>";
        exit();
    }
    }
} catch (Exception $e) {
    
}

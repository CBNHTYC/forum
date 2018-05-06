<?php
    require_once 'database.php';
    require_once 'functions.php';
    
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    
    $loginResult = loginUser($password, $email);
    session_start();
    $_SESSION['sessUserID'] = $loginResult['userID'];
    header('Location:/?insert='.$loginResult['result'].'&sess='.$_SESSION['sessUserID'] );



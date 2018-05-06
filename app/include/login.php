<?php
    require_once 'database.php';
    require_once 'functions.php';
    require_once 'authorisation.php';
    
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    
    $loginResult = loginUser($password, $email);
    $_SESSION['userID'] = $loginResult['userID'];
    header('Location:/?insert='.$loginResult['result']);



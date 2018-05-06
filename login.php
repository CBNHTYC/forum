<?php
    require_once 'database.php';
    require_once 'functions.php';
    require_once 'authorisation.php';
    
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    
    $loginResult = loginUser($password, $email);
    
    header('Location:/app/include/authorisation.php?userID='.$loginResult['userID'].'&insert='.$loginResult['result']);



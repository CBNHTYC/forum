<?php
    require_once 'database.php';
    require_once 'functions.php';
    require_once 'authorisation.php';
    
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    $insertResult = addUser($username, $email, $password);
    
    header('Location:/?insert='.$insertResult);

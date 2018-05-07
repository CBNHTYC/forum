<?php
    require_once 'database.php';
    require_once 'functions.php';
    
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    
    $insertResult = addCat($title, $description);
    
    header('Location:/main.php?insert='.$insertResult);


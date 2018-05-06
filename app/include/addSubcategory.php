<?php
    require_once 'database.php';
    require_once 'functions.php';
    session_start();
    
    $categoryID = $_GET['catID'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    
    if (isset($_SESSION['sessUserID']))
    {
        $userID = $_SESSION['sessUserID'];
    }
    else
    {
        $userID = 0;
    }
    
    $insertResult = addSubcat($categoryID, $title, $description, $userID);
    
    header('Location:/category.php?id='.$categoryID.',insert='.$insertResult)
    
?>



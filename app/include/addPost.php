<?php
    require_once 'database.php';
    require_once 'functions.php';
    
    $subcatID = $_GET['catID'];
    $text = trim($_POST['text']);
    session_start();
    if (isset($_SESSION['sessUserID']))
    {
        $userID = $_SESSION['sessUserID'];
    }
    else
    {
        $userID = 0;
    }
    
    $insertResult = addPost($subcatID, $text, $userID);
    
    header('Location:/subcategory.php?subcatID='.$subcatID.'&insert='.$insertResult)
    
?>

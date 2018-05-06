<?php
    require_once 'database.php';
    require_once 'functions.php';
    require_once 'authorisation.php';
    
    $subcatID = $_GET['catID'];
    $text = trim($_POST['text']);
    
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

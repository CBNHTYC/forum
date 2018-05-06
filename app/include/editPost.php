<?php
    require_once 'database.php';
    require_once 'functions.php';
    require_once 'authorisation.php';
    $postID = $_GET['postID'];
    $subcatID = $_GET['subcatID'];
    $text = $_POST['text'];
    
    if (isset($_SESSION['sessUserID']))
    {
        $userID = $_SESSION['sessUserID'];
    }
    else
    {
        $userID = 0;
    }
    
    $editResult = editPost($postID, $subcatID, $text, $userID);
    
    header('Location:/subcategory.php?subcatID='.$subcatID.'&insert='.$editResult);


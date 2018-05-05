<?php
    require_once 'database.php';
    require_once 'functions.php';
    require_once 'authorisation.php';
    
    $subcatID = $_GET['catID'];
    $text = trim($_POST['text']);
    
    $insertResult = addPost($subcatID, $text, $authID);
    
    header('Location:/subcategory.php?subcatID='.$subcatID.'&insert='.$insertResult)
    
?>

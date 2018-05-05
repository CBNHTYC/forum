<?php
    require_once 'database.php';
    require_once 'functions.php';
    require_once 'authorisation.php';
    $postID = $_GET['postID'];
    $subcatID = $_GET['subcatID'];
    $text = $_POST['text'];
    
    $editResult = editPost($postID, $subcatID, $text, $authID);
    
    header('Location:/subcategory.php?subcatID='.$subcatID.'&insert='.$editResult);


<?php
    require_once 'database.php';
    require_once 'functions.php';
    require_once 'authorisation.php';
    
    $categoryID = $_GET['catID'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    
    $insertResult = addSubcat($categoryID, $title, $description, $authID);
    
    header('Location:/category.php?id='.$categoryID.',insert='.$insertResult)
    
?>



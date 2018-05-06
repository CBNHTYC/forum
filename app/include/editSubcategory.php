<?php
    require_once 'database.php';
    require_once 'functions.php';
    $catID = $_GET['catID'];
    $subcatID = $_GET['subcatID'];
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
    
    $editResult = editSubcat($subcatID, $title, $description, $userD);
    
    header('Location:/category.php?id='.$catID.',insert='.$editResult);
    

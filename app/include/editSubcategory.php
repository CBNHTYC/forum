<?php
    require_once 'database.php';
    require_once 'functions.php';
    require_once 'authorisation.php';
    $catID = $_GET['catID'];
    $subcatID = $_GET['subcatID'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);    
    
    $editResult = editSubcat($subcatID, $title, $description, $authID);
    
    header('Location:/category.php?id='.$catID.',insert='.$editResult);
    
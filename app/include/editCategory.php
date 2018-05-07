<?php
    require_once 'database.php';
    require_once 'functions.php';
    $catID = $_GET['catID'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']); 
    
    $editResult = editCat($catID, $title, $description);
    header('Location:/main.php?insert='.$editResult);
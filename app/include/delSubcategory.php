<?php
    require_once 'database.php';
    require_once 'functions.php';
    $subcatID = $_GET['subcatID']; 
    $catID = $_GET['catID'];
    
    $editResult = delSubcat($subcatID);
    header('Location:/category.php?id='.$catID.',insert='.$editResult);


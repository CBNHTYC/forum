<?php
    require_once 'database.php';
    require_once 'functions.php';
    $postID = $_GET['postID'];
    $subcatID = $_GET['subcatID'];
    
    $editResult = delPost($postID);
    header('Location:/subcategory.php?subcatID='.$subcatID.'&insert='.$editResult);


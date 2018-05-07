<?php
    require_once 'database.php';
    require_once 'functions.php';
    $catID = $_GET['catID']; 
    
    $editResult = delCat($catID);
    header('Location:/main.php?insert='.$editResult);
<?php
    require_once 'app/include/database.php';
    require_once 'app/include/functions.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Наш форум</title>

    <!-- Bootstrap -->
    <link href="public/css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#responsive-menu">
                    <span class="sr-only">Открыть навигацию</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Наш форум</a>
            </div>
            <div class="collapse navbar-collapse" id="responsive-menu">
                <ul class="nav navbar-nav">
                    <?php                      
                        $categories = getCategories();
                    ?>
                    <li><a href="/">Главная</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Разделы<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?php foreach ($categories as $category): ?>
                                <li><a href = "/category.php?id=<?=$category['id']?>"><?=$category['title']?></a></li>
                                <li class="divider"></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>            
                </ul>
                <?php if (!isset($_SESSION['sessUserID']) || $_SESSION['sessUserID'] == 0) : ?>
                <form action="/app/include/login.php" method="post" class="navbar-form navbar-right hidden-sm">
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" placeholder="E-mail" value="">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Пароль" value="">
                        </div>
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-sign-in"></i> ВОЙТИ
                        </button>
                        <a href="/registr.php" class="btn btn-default">Регистрация</a>
                    </form>
                <?php else : ?>
                <div class="navbar-form navbar-right hidden-sm">
                    <button type="button" class="btn btn-default btn-md">
                        <a href="/user.php?userID=<?=$_SESSION['sessUserID']?>" style="color:#000000"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?= getUserNameByID($_SESSION['sessUserID'])?></a>   
                    </button>
                     <button type="button" class="btn btn-default btn-md">
                         <a href="/app/include/logout.php" style="color:#000000"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Выход </a>   
                    </button>
                </div>
                <?php endif;?>
            </div>
        </div>
    </div>
    


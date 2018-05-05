<?php
ini_set('error_reporting', 'E_ALL');
ini_set('display_errors', 'E_ALL');
ini_set('display_startup_errors', 'E_ALL');
#ПОДКЛЮЧЕНИЕ php ФАЙЛОВ

/*
include ''; аналог require, может возвращать значение
include_once '';
require ''; при повтороном подключении одного и того же файла, мы получаем дубликат
require_once ''; не получаем дубликат
*/

require 'app/header.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <?php
                $subcatID = $_GET['subcatID'];
                $posts = getPostsBySubcat($subcatID);
                $subcat = getSubcatByID($subcatID);
                $categoryID = $subcat['catID'];
                $categoryTitle = getCategoryTitle($categoryID);
            ?>
            
            <div class="container">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1><?=$subcat['title']?></h1>
                        <p><?=$subcat['description']?></p>
                        <br/>
                        <ul class="list-inline">
                            <li><i class="glyphicon glyphicon-list"></i> <li><a href = "/category.php?id=<?=$categoryID?>"><?=$categoryTitle?></a> | </li>
                            <li><a href = "/subcategory.php?id=<?=$subcatID?>"><?=$subcat['title']?></a></li> </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <?php foreach ($posts as $post): ?>
            <div class="row">
                <div class="col-md-12">
                    <p><?=$post['text']?></p>
                    <br/>
                    <ul class="list-inline">
                        <li><i class="glyphicon glyphicon-user"></i> by <a href="/user.php"><?=getUserNameByID($post['authID'])?></a> | </li>
                        <li><i class="glyphicon glyphicon-calendar"></i> <?=$post['date']?> | </li>
                        <li><a href="#spoiler-<?=$post['id']?>" data-toggle="collapse" class="btn btn-link spoiler collapsed">Редактировать</a></li>    
                    </ul>
                    <form action="/app/include/editPost.php?postID=<?=$post['id']?>&subcatID=<?=$subcatID?>" method="post" class="collapse" id="spoiler-<?=$post['id']?>">
                        <div class="well">
                            <textarea class="form-control" name="text" rows="3"><?=$post['text']?></textarea>
                            <p></p>
                            <div class="form-group">
                                <button type="submit" class="btn btn-default">Подтвердить изменения</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <?php endforeach;?>
            <form action="/app/include/addPost.php?catID=<?=$subcatID?>" method="post">
                <textarea class="form-control" name="text" rows="3" placeholder="Введите Ваше сообщение..."></textarea>
                <p></p>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">Отправить</button>
                </div>
            </form>          
        </div>
    </div>
</div>

<?php
include_once 'app/footer.php';
?>


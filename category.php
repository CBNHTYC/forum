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
                $categoryID = $_GET['id'];
                $subcategories = getSubcatByCategory($categoryID);
                $categoryTitle = getCategoryTitle($categoryID);
            ?>
            
            <div class="container">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>
                            <?=$categoryTitle?>
                            <?php if (isset($_SESSION['sessIsAdmin']) && $_SESSION['sessIsAdmin'] > 0) : ?>
                                <a href="#spoiler-add" data-toggle="collapse" class="btn btn-link spoiler collapsed">Добавить подраздел</a>
                            <?php endif; ?>
                        </h1>
                        <form action="/app/include/addSubcategory.php?catID=<?=$categoryID['id']?>" method="post" class="collapse" id="spoiler-add">
                            <div class="well">
                                <input type="text" name="title" value="" class="form-control" placeholder="Название">
                                <p></p>
                                <textarea class="form-control" name="description" value="" rows="3" placeholder="Описание подтемы"></textarea>
                                <p></p>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default">Добавить</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <?php foreach ($subcategories as $subcategory): ?>
            <div class="row">
                <div class="col-md-12">
                    <h4><a href="/subcategory.php?subcatID=<?=$subcategory['id']?>"><?=$subcategory['title']?></a></h4>
                    <p><?=$subcategory['description']?></p>
                    <p>
                        <a class="btn btn-info btn-sm" href="/subcategory.php?subcatID=<?=$subcategory['id']?>">Перейти в подраздел</a>
                        <?php if ($subcategory['userID'] == $_SESSION['sessUserID']) : ?>
                            <a href="#spoiler-<?=$subcategory['id']?>" data-toggle="collapse" class="btn btn-link spoiler collapsed">Редактировать подраздел</a>    
                        <?php endif;?>
                    </p> 
                    <br/>
                    <ul class="list-inline">
                        <li><i class="glyphicon glyphicon-list"></i> <li><a href = "/category.php?id=<?=$categoryID?>"><?=$categoryTitle?></a></li> | </li>
                        <li><i class="glyphicon glyphicon-user"></i> by <a href="/user.php?userID=<?=$subcategory['userID']?>"><?=getUserNameByID($subcategory['userID'])?></a> | </li>
                    </ul>
                    
                    <form action="/app/include/editSubcategory.php?catID=<?=$categoryID['id']?>&subcatID=<?=$subcategory['id']?>" method="post" class="collapse" id="spoiler-<?=$subcategory['id']?>">
                        <div class="well">
                            <input type="text" name="title" value="<?=$subcategory['title']?>" class="form-control">
                            <p></p>
                            <textarea class="form-control" name="description" rows="3"><?=$subcategory['description']?></textarea>
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
            <hr>            
        </div>  
    </div>
</div>

<?php
include_once 'app/footer.php';
?>
<?php
    ini_set('error_reporting', 'E_ALL');
    ini_set('display_errors', 'E_ALL');
    ini_set('display_startup_errors', 'E_ALL');
    require 'app/header.php';
    require 'app/footer.php';
                      
    $categories = getCategories();
?>

<div class="container">
    <div class="row">
            <div class="col-md-9" >
                <h3>
                    Добро пожаловать!
                    <?php if (isset($_SESSION['sessIsAdmin']) && $_SESSION['sessIsAdmin'] == 2) : ?>
                        <a href="#spoiler-add" data-toggle="collapse" class="btn btn-link spoiler collapsed">Добавить раздел</a>
                    <?php endif; ?>
                </h3>
                <form action="/app/include/addCategory.php" method="post" class="collapse" id="spoiler-add">
                    <div class="well">
                        <input type="text" name="title" value="" class="form-control" placeholder="Название">
                        <p></p>
                        <textarea class="form-control" name="description" value="" rows="3" placeholder="Описание раздела"></textarea>
                        <p></p>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default">Добавить</button>
                        </div>
                    </div>
                </form>
            </div>
    </div>
</div>

<div class="container">
    <p></p>
    <?php foreach ($categories as $category): ?>
        <div class="row">
            <div class="col-md-9" >
                <h4><a href="/category.php?id=<?=$category['id']?>"><?=$category['title']?></a></h4>
                <p><?=$category['description']?></p>
                <p>
                    <a class="btn btn-info btn-sm" href="/category.php?id=<?=$category['id']?>">Перейти в раздел</a>
                    <?php if (isset($_SESSION['sessIsAdmin']) && $_SESSION['sessIsAdmin'] == 2) : ?>
                        <a href="#spoiler-<?=$category['id']?>" data-toggle="collapse" class="btn btn-link spoiler collapsed">Редактировать раздел</a>    
                    <?php endif;?>
                </p> 
                <br/>


                <form action="/app/include/editCategory.php?catID=<?=$category['id']?>" method="post" class="collapse" id="spoiler-<?=$category['id']?>">
                    <div class="well">
                        <input type="text" name="title" value="<?=$category['title']?>" class="form-control">
                        <p></p>
                        <textarea class="form-control" name="description" rows="3"><?=$category['description']?></textarea>
                        <p></p>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default">Подтвердить изменения</button>
                            <a href="/app/include/delCategory.php?catID=<?=$category['id']?>" class="btn btn-default">Удалить раздел</a>
                        </div>
                    </div>
                </form>
            <hr>
            </div>
        </div>
    <?php endforeach; ?>
</div>



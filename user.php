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

<?php
    $userID = $_GET['userID'];
    $user = getUserByID($userID);
?>

<?php if($userID > 0) : ?>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h3><i class="glyphicon glyphicon-user"></i> <?=$user['username']?> </h3>
                <!--<input type="file" accept="jpg" name="getavatar">-->
                <br/>
                <div class="col-md-2">
                    <img src='/public/images/avatars/<?=$user['img']?>' alt="" width="150">
                </div>
                <div class="col-md-10">
                    <div class="col-md-10 col-md-offset-1">
                        <li> Контакты: <?=$user['email']?> </li>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="container">
       <div class="row">
           <div class="col-md-9">
               <h3>Пользователь не прошёл регистрацию, идентификация не возможна</h3>
             </div>
        </div>
    </div>
<?php endif; ?>

<?php
include_once 'app/footer.php';
?>

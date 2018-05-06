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
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="well">
                <h3>Регистрация</h3>
                <form action="/app/include/addUser.php" method="post">
                    <p>Введите имя пользователя:</p>
                    <input class="form-control" type="text" name="username" value="" rows="3" placeholder="Username" required>
                    <p></p>
                    <p>Укажите Ваш e-mail:</p>
                    <input class="form-control" type="email" name="email" value="" rows="3" placeholder="E-mail" required>
                    <p></p>
                    <p>Придумайте пароль:</p>
                    <input class="form-control" type="text" name="password" value="" rows="3" placeholder="Password" required>
                    <p></p>
                    <button type="submit" class="btn btn-default">Зарегестрироваться</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
include_once 'app/footer.php';
?>


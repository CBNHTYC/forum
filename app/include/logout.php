<?php

session_start();
unset($_SESSION['sessUserID']);
unset($_SESSION['sessIsAdmin']);

 header('Location:/');


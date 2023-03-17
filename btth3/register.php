<?php
//Khai báo autoloader
require_once 'vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader("src");
$twig = new \Twig\Environment($loader);

echo $twig->render('register.html',[
]);
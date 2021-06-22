<?php

require_once dirname(__DIR__).'/vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__).'/templates');
$twig = new \Twig\Environment($loader);
$template = $twig->load('index.twig');


$user = 'admin';
$pass = 'admin';

try {
    $dbh = new PDO('mysql:host=localhost;dbname=chat_db', $user, $pass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

$loginr = $_GET['loginr'];
$password = $_GET['password'];
$text = $_GET['text'];

$login = false;



echo $template->render(['login' => $login]);
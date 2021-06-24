<?php

require_once dirname(__DIR__).'/vendor/autoload.php';
require_once dirname(__DIR__).'/app/User.php';
require_once dirname(__DIR__).'/app/Message.php';

$loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__).'/templates');
$twig = new \Twig\Environment($loader);
$template = $twig->load('index.twig');


$user_db = 'admin';
$pass_db = 'admin';

try {
    $db = new PDO('mysql:host=localhost;dbname=chat_db', $user_db, $pass_db);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

$login = $_GET['login'];
$password = $_GET['password'];
$text = $_GET['text'];

$user = new User(null, null);
$authorized = false;
$authErr = false;
$allMessages = [];

if ($login && $password) {
    $user = new User($login, $password);
    $userExist = $user->isExist($db)[0]['login'];

    if ($userExist) {
        $authorized = true;
    } else {
        $authErr = true;

    }
}

if ($authorized) {
    $message = $_GET['message'];
    $mm = new MessageMapper($db);
    $allMessages = $mm->all();

    if ($message) {
        $mess = new Message($user->getLogin(), $message, date('l jS \of F Y h:i:s A'));
        $mm->save($mess);
    }
}

echo $template->render(['authorized' => $authorized, 'err' => $authErr, 'user' => $user]);
<?php

require_once __DIR__.'/vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
]);

echo $twig->render('index.twig',
    [
        'name' => 'Slava',
        'age' => 21,
        'job' => 'Rapper',
        'sex' => 'Male'
    ]);
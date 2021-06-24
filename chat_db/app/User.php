<?php

class User {
    private $login;
    private $password;

    public function __construct($login, $password) {
        $this->login = $login;
        $this->password = $password;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getPassword() {
        return $this->password;
    }

    public function save ($db) {
        $req = $db->prepare('insert into `users` (`login`, `password`) values (?, ?)');
        $req->exequte([$this->login, $this->password]);
    }

    public function remove ($db) {
        $req = $db->prepare('delete from `users` where `login` = ?');
        $req->execute([$this->login]);
    }

    public function all($db) {
        $req = $db->prepare('select * from `users`');
        $req->execute();

        return $req->fetchAll();
    }

    public function getByLogin($db) {
        $req = $db->prepare('select * from `users` where `login` = ?');
        $req->execute([$this->login]);

        return $req->fetchAll();
    }

    public function getByPassword($db) {
        $req = $db->prepare('select * from `users` where `password` = ?');
        $req->execute([$this->password]);

        return $req->fetchAll();
    }

    public function isExist($db) {
        $req = $db->prepare('select * from `users` where `login` = ? and `password` = ?');
        $req->execute([$this->login, $this->password]);

        return $req->fetchAll();
    }
}
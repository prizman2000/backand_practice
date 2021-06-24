<?php

class Message {
    private $user;
    private $text;
    private $date;

    public function __construct($user, $text, $date) {
        $this->user = $user;
        $this->text = $text;
        $this->date = $date;
    }

    public function getUser() {
        return $this->user;
    }

    public function getText() {
        return $this->text;
    }

    public function getDate() {
        return $this->date;
    }


}

class MessageMapper {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function save(Message $msg) {
        $req = $this->db->prepare('insert into `messages` (`user`, `text`, `date`) values (?, ?, ?)');
        $req->execute([$msg->getUser(), $msg->getText(), $msg->getDate()]);
    }

    public function remove(Message $msg) {
        $req = $this->db->prepare('delete from `messages` where `user` = ? and `text` = ? and `date` = ?');
        $req->execute([$msg->getUser(), $msg->getText(), $msg->getDate()]);
    }

    public function all() {
        $req = $this->db->prepare('select * from `messages`');
        $req->execute();

        $res = $req->fetchAll;

        $body = [];

        if ($res->length){
            for ($i=0; $i<$res->length(); $i++) {
                $body[$i] = new Message($res[$i]['user'], $res[$i]['text'], $res[$i]['date']);
            }
        }

        return $body;
    }

    public function getByUser($user) {
        $req = $this->db->prepare('select * from `messages` where `user` = ?');
        $req->execute([$user]);

        $res = $req->fetchAll();

        $body = [];

        for ($i=0; $i<$res->length(); $i++) {
            $body[$i] = new Message($res[$i]['user'], $res[$i]['text'], $res[$i]['date']);
        }

        return $body;
    }

    public function getByText($text) {
        $req = $this->db->prepare('select * from `messages` where `text` = ?');
        $req->execute([$text]);

        $res = $req->fetchAll();

        $body = [];

        for ($i=0; $i<$res->length(); $i++) {
            $body[$i] = new Message($res[$i]['user'], $res[$i]['text'], $res[$i]['date']);
        }

        return $body;
    }

    public function getByDate($date) {
        $req = $this->db->prepare('select * from `messages` where `date` = ?');
        $req->execute([$date]);

        $res = $req->fetchAll();

        $body = [];

        for ($i=0; $i<$res->length(); $i++) {
            $body[$i] = new Message($res[$i]['user'], $res[$i]['text'], $res[$i]['date']);
        }

        return $body;
    }
}
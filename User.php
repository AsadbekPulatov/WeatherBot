<?php

require_once "connect.php";

class User
{
    public $chat_id;

    public function __construct($chat_id)
    {
        $this->chat_id = $chat_id;
    }

    public function createUser(){
        global $connect;
        $sql = "DELETE users FROM WHERE chat_id = $this->chat_id";
        $connect->query($sql);
        $sql = "INSERT INTO users(chat_id) VALUES($this->chat_id)";
        $connect->query($sql);
    }

    public function setPage($page){
        global $connect;
        $sql = "UPDATE users SET page='{$page}' WHERE chat_id = $this->chat_id";
        $connect->query($sql);
    }

    public function getPage(){
        global $connect;
        $sql = "SELECT page FROM users WHERE chat_id = $this->chat_id";
        $result = $connect->query($sql);
        $row = $result->fetch_assoc();
        return $row['page'];
    }

    public function setLanguage($language){
        global $connect;
        $sql = "UPDATE users SET language='$language' WHERE chat_id = $this->chat_id";
        $connect->query($sql);
    }

    public function getLanguage(){
        global $connect;
        $sql = "SELECT `language` FROM users WHERE chat_id = $this->chat_id";
        $result = $connect->query($sql);
        $row = $result->fetch_assoc();
        return $row['language'];
    }

    public function GetText($keyword){
        global $connect;
        $language = $this->getLanguage();
        $sql = "SELECT * FROM texts WHERE keyword = '{$keyword}'";
        $result = $connect->query($sql);
        $row = $result->fetch_assoc();
        return $row[$language];
    }
}
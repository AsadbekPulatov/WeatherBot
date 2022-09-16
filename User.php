<?php

require_once "connect.php";

class User
{
    private $chat_id;

    function __construct($chat_id)
    {
        $this->chat_id = $chat_id;
    }

    function createUser($chat_id){
        global $connect;
        $this->chat_id = $chat_id;
        $sql = "DELETE FROM users WHERE chat_id = '$chat_id'";
        $connect->query($sql);
        $sql = "INSERT INTO users(chat_id) values('$chat_id')";
        $connect->query($sql);
    }

    function setPage($page)
    {
        global $connect;
        $sql = "UPDATE users SET page = '$page' WHERE chat_id = '$this->chat_id'";
        $connect->query($sql);
    }

    function getPage()
    {
        global $connect;
        $sql = "SELECT * FROM users WHERE chat_id = '$this->chat_id'";
        $result = $connect->query($sql);

        $row = $result->fetch_assoc();
        return $row['page'];
    }

    function setLanguage($language)
    {
        global $connect;
        $sql = "UPDATE users SET language = '$language' WHERE chat_id = '$this->chat_id'";
        $connect->query($sql);
    }

    function getLanguage()
    {
        global $connect;
        $sql = "SELECT * FROM users WHERE chat_id = '$this->chat_id'";
        $result = $connect->query($sql);

        $row = $result->fetch_assoc();
        return $row['language'];
    }

    function GetText($keyword)
    {
        global $connect;
        $language = $this->getLanguage();
        $sql = "SELECT * FROM texts WHERE keyword = '{$keyword}'";
        $result = $connect->query($sql);
        $row = $result->fetch_assoc();
        if (isset($row[$language])) {
            return $row[$language];
        }
    }
}